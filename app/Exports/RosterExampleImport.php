<?php

namespace App\Exports;

use App\Exports\Sheet\RosterPerDaySheet;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RosterExampleImport implements WithMultipleSheets
{
    use Exportable;

    private $weekOfYear;

    public function __construct(string $weekOfYear)
    {
        $this->weekOfYear = $weekOfYear;
    }

    public function sheets(): array
    {
        $today = Carbon::now();

        $weekNumber = $today->setISODate(date('Y'), $this->weekOfYear);

        $sheets[] = new RosterPerDaySheet($weekNumber);

        
        return $sheets;
    }
}
