<?php

namespace App\Exports;

use App\Exports\Sheet\RosterPerDaySheet;
use Carbon\CarbonPeriod;
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

        $from = $weekNumber->startOfWeek()->format('d-m-Y');

        $to = $weekNumber->endOfWeek()->format('d-m-Y');

        $period = CarbonPeriod::create($from, $to);

        // Convert the period to an array of dates
        $emptyRosterDays = $period->toArray();

        for ($day = 0; $day <= 6; $day++) {
            $sheets[] = new RosterPerDaySheet($emptyRosterDays[$day]->format('Y-m-d'));
        }

        return $sheets;

    }
}
