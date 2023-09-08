<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class RosterImport implements SkipsEmptyRows, WithMultipleSheets
{
    private $weekOfYear;

    public function __construct(string $weekOfYear)
    {
        $this->weekOfYear = $weekOfYear;
    }

    /**
     * @return $array
     */
    public function sheets(): array
    {
        return [
            0 => new RosterImportDay($this->weekOfYear),
        ];
    }
}
