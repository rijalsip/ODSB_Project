<?php

namespace App\Services;

use App\Models\ReportSales;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ReportSalesService
{
    public function getPaginatedReports(
    array $filters = []
): LengthAwarePaginator {

    $perPage = $filters['per_page'] ?? 10;

    return ReportSales::with([
            'user',
            'site'
        ])
        ->when(!empty($filters['search']), function ($query) use ($filters) {

            $search = $filters['search'];

            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($user) use ($search) {
                    $user->where('name', 'like', "%{$search}%");
                })

                ->orWhereHas('site', function ($site) use ($search) {
                    $site->where('site_id', 'like', "%{$search}%")
                         ->orWhere('site_name', 'like', "%{$search}%");
                });

            });

        })
->when(!empty($filters['report_date']), function ($query) use ($filters) {

    $query->whereDate(
        'report_date',
        $filters['report_date']
    );

})
->when(!empty($filters['user_id']), function ($query) use ($filters) {

    $query->where(
        'user_id',
        $filters['user_id']
    );

})
        ->latest('report_date')
        ->paginate($perPage)
        ->withQueryString();

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