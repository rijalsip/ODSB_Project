<?php

namespace App\Services;

use App\Models\ReportSales;
use Illuminate\Support\Facades\DB;

class ReportSalesService
{
    public function createReport(array $data): ReportSales
    {
        return DB::transaction(function () use ($data) {

            $data['total_trx'] =
                $data['renewal_trx'] +
                $data['voucher_trx'] +
                $data['sa_sp_trx'] +
                $data['sa_byu_trx'] +
                $data['mytelkomsel_trx'] +
                $data['halo_trx'] +
                $data['orbit_trx'] +
                $data['nomor_spesial_trx'] +
                $data['bogem_trx'];

            $data['total_rev'] =
                $data['renewal_rev'] +
                $data['voucher_rev'] +
                $data['sa_sp_rev'] +
                $data['sa_byu_rev'] +
                $data['halo_rev'] +
                $data['orbit_rev'] +
                $data['nomor_spesial_rev'] +
                $data['bogem_rev'];

            $reportSales = ReportSales::create($data);

            return $reportSales->refresh();
        });
    }
}