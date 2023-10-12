<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id','name','email','manager_id')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nominativo',
            'Email',
            'Responsabile'
        ];
    }
}
