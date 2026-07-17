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
                'site_name'  => $row['site_name'] ?? null,
                'regional'   => $row['regional'] ?? null,
                'branch'     => $row['branch'] ?? null,
                'cluster'    => $row['cluster'] ?? null,
                'kabupaten'  => $row['kabupaten'] ?? null,
                'kecamatan'  => $row['kecamatan'] ?? null,
                'address'    => $row['address'] ?? null,
                'latitude'   => $row['latitude'] ?? null,
                'longitude'  => $row['longitude'] ?? null,
                'is_active'  => isset($row['is_active'])
                    ? (bool) $row['is_active']
                    : true,
            ]

        );
    }
}