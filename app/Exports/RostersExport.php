<?php

namespace App\Exports;

use App\Models\Roster;
use Maatwebsite\Excel\Concerns\FromCollection;

class RostersExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Roster::all();
    }
}
