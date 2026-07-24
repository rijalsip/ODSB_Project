<?php

namespace App\Http\Controllers;

use App\Models\ReportSales;
use App\Models\User;
use App\Services\ReportSalesService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReportSalesController extends Controller
{
    public function __construct(
        protected ReportSalesService $reportSalesService
    ) {}

    /**
     * Display a listing of reports.
     */
    public function index(Request $request): View
    {
        $reports = $this->reportSalesService
            ->getPaginatedReports($request->all());

        $users = User::orderBy('name')->get();

        return view(
            'report-sales.index',
            compact('reports', 'users')
        );
    }

    /**
     * Export Report Sales ke Excel.
     */
    public function export(Request $request)
    {
        return $this->reportSalesService
            ->exportReportSales($request->all());
    }

    /**
     * Display report detail.
     */
    public function show(int $id): View
    {
        $report = ReportSales::with([
            'user',
            'site',
        ])->find($id);

        if (!$report) {
            throw new NotFoundHttpException(
                'Report tidak ditemukan.'
            );
        }

        return view(
            'report-sales.show',
            compact('report')
        );
    }
}