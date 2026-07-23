<?php

namespace App\Services;

use App\Exports\ReportSalesExport;
use App\Models\ReportSales;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportSalesService
{
    /**
     * Query dasar yang dipakai oleh
     * halaman Report Sales dan Export Excel.
     */
    private function getFilteredQuery(array $filters = [])
    {
        return ReportSales::with([
                'user',
                'site'
            ])

            ->when(
                !empty($filters['search']),
                function ($query) use ($filters) {

                    $search = $filters['search'];

                    $query->where(function ($q) use ($search) {

                        $q->whereHas('user', function ($user) use ($search) {

                            $user->where(
                                'name',
                                'like',
                                "%{$search}%"
                            );

                        })

                        ->orWhereHas('site', function ($site) use ($search) {

                            $site->where(
                                'site_id',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'site_name',
                                'like',
                                "%{$search}%"
                            );

                        });

                    });

                }
            )

            ->when(
                !empty($filters['report_date']),
                function ($query) use ($filters) {

                    $query->whereDate(
                        'report_date',
                        $filters['report_date']
                    );

                }
            )

            ->when(
                !empty($filters['user_id']),
                function ($query) use ($filters) {

                    $query->where(
                        'user_id',
                        $filters['user_id']
                    );

                }
            )

            ->latest('report_date');
    }
        /**
     * Data untuk halaman Report Sales
     */
    public function getPaginatedReports(
        array $filters = []
    ): LengthAwarePaginator {

        $perPage = $filters['per_page'] ?? 10;

        return $this
            ->getFilteredQuery($filters)
            ->paginate($perPage)
            ->withQueryString();

    }

    /**
     * Simpan Report Sales
     */
    public function createReport(
        array $data
    ): ReportSales {

        return ReportSales::create($data);

    }

    /**
     * Update Report Sales
     */
    public function updateReport(
        ReportSales $report,
        array $data
    ): ReportSales {

        $report->update($data);

        return $report;

    }

    /**
     * Hapus Report Sales
     */
    public function deleteReport(
        ReportSales $report
    ): void {

        $report->delete();

    }

    /**
     * Export Report Sales ke Excel
     */
    public function exportReportSales(
    array $filters = []
): BinaryFileResponse {

    $reports = $this
        ->getFilteredQuery($filters)
        ->get();

    return Excel::download(

        new ReportSalesExport($reports),

        'report-sales-' .
        now()->format('Y-m-d') .
        '.xlsx'

    );

}
}