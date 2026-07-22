<?php

namespace App\Imports;

use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiteImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return Site::updateOrCreate(

            [
                'site_id' => trim($row['site_id']),
            ],

            [
                'site_name'            => $row['sitename'] ?? null,
                'branch'               => $row['branch'] ?? null,
                'cluster'              => $row['cluster'] ?? null,
                'city'                 => $row['city'] ?? null,
                'site_focus_mtd'       => $row['site_focus_mtd'] ?? null,
                'kecamatan'            => $row['kecamatan'] ?? null,
                'program'              => $row['program'] ?? null,
                'detail_program_ssgj'  => $row['detail_program_ssgj'] ?? null,
                'new_infra'            => $row['new_infra'] ?? null,
                'tech'                 => $row['tech'] ?? null,
                'class'                => $row['class'] ?? null,
                'ne'                   => $row['ne'] ?? null,
                'network_condition'    => $row['network_condition'] ?? null,
            ]

        );
    }
}