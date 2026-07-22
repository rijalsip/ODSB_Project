<?php

namespace App\Http\Controllers;

use App\Services\ReportSalesService;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ReportSalesController extends Controller
{
    public function __construct(
        protected ReportSalesService $reportSalesService
    ) {}

    public function index(Request $request): View
    {
        $reports = $this->reportSalesService
            ->getPaginatedReports(
                $request->input('per_page', 10)
            );

        return view(
            'report-sales.index',
            compact('reports')
        );
    }
}