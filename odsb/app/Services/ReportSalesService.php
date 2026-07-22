<?php

namespace App\Services;

use App\Models\ReportSales;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReportSalesService
{
    public function getPaginatedReports(
        int $perPage = 10
    ): LengthAwarePaginator {

        return ReportSales::with([
                'user',
                'site'
            ])
            ->latest('report_date')
            ->paginate($perPage);

    }

    public function createReport(array $data): ReportSales
    {
        return ReportSales::create($data);
    }

    public function updateReport(
        ReportSales $report,
        array $data
    ): ReportSales {

        $report->update($data);

        return $report;

    }

    public function deleteReport(
        ReportSales $report
    ): void {

        $report->delete();

    }
}