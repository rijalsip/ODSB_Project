<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            'nama',
            'username',
            'id_digipos',
            'cluster',
            'role',
            'phone',
        ];
    }

    public function array(): array
    {
        return [

            [
                'Muhammad Rizal',
                'rizal',
                'DGP001',
                'Dumai',
                'Admin',
                '08123456789',
            ],

        ];
    }
}