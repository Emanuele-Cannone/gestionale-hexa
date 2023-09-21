<?php

namespace App\Imports;

use App\DTOs\RosterDTO;
use App\Models\Proof;
use App\Models\Roster;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RosterImportDay implements SkipsEmptyRows, ToCollection, WithChunkReading, WithStartRow
{
    use Importable;

    protected $day;

    public function __construct(string $day)
    {
        $this->day = $day;

    }

    public function collection(collection $rows)
    {

        foreach ($rows as $row) {

            $proof = Proof::whereName($row[2])->first();

            $data = [
                'user_id' => $row[0],
                'proof_id' => $proof->id,
                'date' => $this->day,
                'from' => Date::excelToDateTimeObject($row[3])->format('H:i:s'),
                'to' => Date::excelToDateTimeObject($row[4])->format('H:i:s'),
            ];

            $validatedRosterDto = RosterDTO::fromArray($data);

            Roster::updateOrCreate(
                [
                    'user_id' => $validatedRosterDto->validatedData['user_id'],
                    'date' => $validatedRosterDto->validatedData['date'],
                ],
                [
                    'proof_id' => $validatedRosterDto->validatedData['proof_id'],
                    'from' => $validatedRosterDto->validatedData['from'],
                    'to' => $validatedRosterDto->validatedData['to'],
                ]
            );
        }

    }

    public function customValidationAttributes(): array
    {
        return [
            '1' => 'exists:users,id',
            '2' => 'exists:proofs,name',
            '3' => 'regex:/^[0-2][0-9]:[0-5][0-9]:[0-5][0-9]/',
            '4' => 'regex:/^[0-2][0-9]:[0-5][0-9]:[0-5][0-9]/',
        ];
    }

    public function chunkSize(): int
    {
        return 300;
    }

    public function startRow(): int
    {
        return 2;
    }
}
