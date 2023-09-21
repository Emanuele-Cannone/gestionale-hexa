<?php

namespace App\Exports\Sheet;

use App\Models\Proof;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class RosterPerDaySheet implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithEvents, WithHeadings, WithTitle
{
    use Exportable;

    protected $day;

    protected $selects;

    protected $row_count;

    protected $column_count;

    public function __construct(string $day)
    {
        $this->day = $day;

        $users = User::select('id', 'name')->get();

        $proofs = Proof::whereIn('id', [8, 10, 15, 16, 18, 19, 21, 22])->pluck('name')->toArray();

        sort($proofs);

        $selects = [
            ['giustificativo' => 'C', 'options' => $proofs],
        ];

        $this->selects = $selects;

        // numero di righe contenenti il menù a tendina
        $this->row_count = count($users) + 1;

        //number of columns to be auto sized
        $this->column_count = 5;
    }

    public function headings(): array
    {

        $heading = [];

        // Aggiungo la colonna utenti
        $heading = [
            'id_utente',
            'nominativo',
            'giustificativo',
            'inizio',
            'fine',
        ];

        return $heading;
    }

    public function collection()
    {
        $users = User::select('id', 'name')->get();

        return $users;
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_TIME3,
            'E' => NumberFormat::FORMAT_DATE_TIME3,
        ];
    }

    public function title(): string
    {
        return $this->day;
    }

    public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function (AfterSheet $event) {

                $row_count = $this->row_count;
                $column_count = $this->column_count;

                foreach ($this->selects as $select) {

                    $drop_column = $select['giustificativo'];
                    $options = $select['options'];

                    // setto il menù a tendina
                    $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST);
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION);
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input non valido');
                    $validation->setError('Valore non esistente nella lista.');
                    $validation->setPromptTitle('Seleziona dalla lista');
                    $validation->setPrompt('Seleziona un giustificativo dalla lista');
                    $validation->setFormula1(sprintf('"%s"', implode(',', $options)));

                    // clone validation to remaining rows
                    for ($i = 3; $i <= $row_count; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                    // // set columns to autosize
                    // for ($i = 1; $i <= $column_count; $i++) {
                    //     $column = Coordinate::stringFromColumnIndex($i);
                    //     $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    // }
                }

            },
        ];
    }
}
