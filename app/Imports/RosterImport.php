<?php

namespace App\Imports;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RosterImport implements SkipsEmptyRows, WithChunkReading, WithMultipleSheets
{
    use Importable;

    public string $weekOfYear;

    public function __construct(string $weekOfYear)
    {
        $this->weekOfYear = $weekOfYear;

    }

    public function chunkSize(): int
    {
        return 300;
    }

    /**
     * Summary of sheets
     */
    public function sheets(): array
    {
        $today = Carbon::now();

        $weekNumber = $today->setISODate(date('Y'), (int) $this->weekOfYear);

        $from = $weekNumber->startOfWeek()->format('d-m-Y');

        $to = $weekNumber->endOfWeek()->format('d-m-Y');

        $period = CarbonPeriod::create($from, $to);

        $arrayPeriod = $period->toArray();

        $sheets = [];

        for ($i = 0; $i <= 6; $i++) {
            $sheets[] = new RosterImportDay($arrayPeriod[$i]->format('Y-m-d'));
        }

        smilify('success', 'You are successfully reconnected');

        return $sheets;
    }
}
