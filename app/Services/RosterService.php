<?php

namespace App\Services;

use App\Imports\RosterImport;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class RosterService
{
    /**
     * Summary of excelImport
     */
    public function rosterImport($weekOfYear, $excelFile): void
    {

        try {

            Excel::import(new RosterImport($weekOfYear), $excelFile);

        } catch (Exception $e) {

            DB::rollBack();
            Log::error('richiesta fallita', [$e->getMessage()]);

        }

    }
}
