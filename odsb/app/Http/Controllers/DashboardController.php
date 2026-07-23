<?php

namespace App\Http\Controllers;

use App\Models\ReportSales;
use App\Models\Role;
use App\Models\Site;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | Total Direct Sales
        |--------------------------------------------------------------------------
        */

        $directSalesRole = Role::where('name', 'Direct Sales')->first();

        $totalDirectSales = $directSalesRole
            ? User::where('role_id', $directSalesRole->id)->count()
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Total Site
        |--------------------------------------------------------------------------
        */

        $totalSite = Site::count();

        /*
        |--------------------------------------------------------------------------
        | Selling Hari Ini
        |--------------------------------------------------------------------------
        */

        $today = ReportSales::whereDate(
            'report_date',
            Carbon::today()
        );

        $todayTrx = (int) $today->sum('total_trx');

        $todayRevenue = (int) $today->sum('total_rev');

        /*
        |--------------------------------------------------------------------------
        | Selling Bulan Ini
        |--------------------------------------------------------------------------
        */

        $month = ReportSales::whereMonth(
                'report_date',
                Carbon::now()->month
            )
            ->whereYear(
                'report_date',
                Carbon::now()->year
            );

        $monthTrx = (int) $month->sum('total_trx');

        $monthRevenue = (int) $month->sum('total_rev');

        /*
        |--------------------------------------------------------------------------
        | Monitoring Produk
        |--------------------------------------------------------------------------
        */

        $monitoring = [

            [
                'title' => 'Renewal',
                'trx' => ReportSales::sum('renewal_trx'),
                'rev' => ReportSales::sum('renewal_rev'),
            ],

            [
                'title' => 'Voucher',
                'trx' => ReportSales::sum('voucher_trx'),
                'rev' => ReportSales::sum('voucher_rev'),
            ],

            [
                'title' => 'SA SP',
                'trx' => ReportSales::sum('sa_sp_trx'),
                'rev' => ReportSales::sum('sa_sp_rev'),
            ],

            [
                'title' => 'SA by.U',
                'trx' => ReportSales::sum('sa_byu_trx'),
                'rev' => ReportSales::sum('sa_byu_rev'),
            ],

            [
                'title' => 'MyTelkomsel',
                'trx' => ReportSales::sum('mytelkomsel_trx'),
                'rev' => null,
            ],

            [
                'title' => 'Halo',
                'trx' => ReportSales::sum('halo_trx'),
                'rev' => ReportSales::sum('halo_rev'),
            ],

            [
                'title' => 'Orbit',
                'trx' => ReportSales::sum('orbit_trx'),
                'rev' => ReportSales::sum('orbit_rev'),
            ],

            [
                'title' => 'Nomor Spesial',
                'trx' => ReportSales::sum('nomor_spesial_trx'),
                'rev' => ReportSales::sum('nomor_spesial_rev'),
            ],



        ];

        return view('dashboard.index', compact(
            'totalDirectSales',
            'totalSite',
            'todayTrx',
            'todayRevenue',
            'monthTrx',
            'monthRevenue',
            'monitoring'
        ));
    }
}