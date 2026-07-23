<?php

namespace App\Services;

class ReportParserService
{
    /**
     * Field yang wajib ada.
     */
    private array $fields = [
        'renewal_trx',
        'renewal_rev',
        'voucher_trx',
        'voucher_rev',
        'sa_sp_trx',
        'sa_sp_rev',
        'sa_byu_trx',
        'sa_byu_rev',
        'mytelkomsel_trx',
        'halo_trx',
        'halo_rev',
        'orbit_trx',
        'orbit_rev',
        'nomor_spesial_trx',
        'nomor_spesial_rev',

    ];

    public function parse(string $text): array
    {
        $data = [];
        $errors = [];

        foreach ($this->fields as $field) {
            $data[$field] = null;
        }

        $lines = preg_split('/\r\n|\r|\n/', trim($text));

        foreach ($lines as $line) {

            if (!str_contains($line, ':')) {
                continue;
            }

            [$key, $value] = explode(':', $line, 2);

            $key = strtolower(trim($key));

            $key = str_replace(
                [' ', '-', '.'],
                '_',
                $key
            );

            $value = trim($value);

            if (!array_key_exists($key, $data)) {
                continue;
            }

            if (!is_numeric($value)) {

                $errors[] = "Field {$key} harus berupa angka.";

                continue;
            }

            $data[$key] = (int) $value;
        }

        foreach ($this->fields as $field) {

            if ($data[$field] === null) {

                $errors[] = "Field {$field} belum diisi.";

            }

        }

        if (!empty($errors)) {

            return [
                'success' => false,
                'errors' => $errors,
            ];

        }

        $data['total_trx'] =
            $data['renewal_trx']
            + $data['voucher_trx']
            + $data['sa_sp_trx']
            + $data['sa_byu_trx']
            + $data['mytelkomsel_trx']
            + $data['halo_trx']
            + $data['orbit_trx']
            + $data['nomor_spesial_trx'];


        $data['total_rev'] =
            $data['renewal_rev']
            + $data['voucher_rev']
            + $data['sa_sp_rev']
            + $data['sa_byu_rev']
            + $data['halo_rev']
            + $data['orbit_rev']
            + $data['nomor_spesial_rev'];


        return [
            'success' => true,
            'data' => $data,
        ];
    }
}