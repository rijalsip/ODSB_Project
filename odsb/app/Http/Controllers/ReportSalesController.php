<?php

namespace App\Http\Controllers;

use App\Services\ReportSalesService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class ReportSalesController extends Controller
{
    public function __construct(
        protected ReportSalesService $reportSalesService
    ) {}

    public function index(Request $request): View
{
    $reports = $this->reportSalesService
        ->getPaginatedReports(
            $request->all()
        );

    $users = User::orderBy('name')->get();

    return view(
        'report-sales.index',
        compact('reports', 'users')
    );
}
}