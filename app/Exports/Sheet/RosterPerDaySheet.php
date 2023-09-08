<?php

namespace App\Exports\Sheet;

use App\Models\Proof;
use App\Models\User;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\NumberFormat;

class RosterPerDaySheet implements FromCollection, ShouldAutoSize, WithColumnFormatting, WithEvents, WithHeadings
{
    use Exportable;

    protected $weekNumber;

    protected $selects;

    protected $row_count;

    protected $column_count;

    public function __construct(object $weekNumber)
    {
        $this->weekNumber = $weekNumber;

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

        $from = $this->weekNumber->startOfWeek()->format('d-m-Y');

        $to = $this->weekNumber->endOfWeek()->format('d-m-Y');

        $period = CarbonPeriod::create($from, $to);

        // Convert the period to an array of dates
        $emptyRosterDays = $period->toArray();

        $heading = [];

        // Aggiungo la colonna utenti
        $heading = [
            'id_utente',
            'nominativo',
            'giustificativo',
        ];

        foreach ($emptyRosterDays as $day) {
            $heading[] = $day->format('Y-m-d');
        }

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
            // 'D' => PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME3,
            // 'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'L' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'P' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
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
