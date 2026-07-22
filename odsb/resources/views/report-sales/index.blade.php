@extends('layouts.app')

@section('title', 'Report Sales')

@section('page-title', 'Report Sales')

@section('breadcrumb')
<li class="breadcrumb-item active">
    Report Sales
</li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Data Report Sales

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Tanggal</th>
                    <th>DS</th>
                    <th>Site ID</th>
                    <th>Site Name</th>
                    <th>Total TRX</th>
                    <th>Total REV</th>

                </tr>

            </thead>

            <tbody>

                @forelse($reports as $report)

                    <tr>

                        <td>

                            {{
                                ($reports->currentPage()-1)
                                * $reports->perPage()
                                + $loop->iteration
                            }}

                        </td>

                        <td>

                            {{ $report->report_date->format('d-m-Y') }}

                        </td>

                        <td>

                            {{ $report->user?->name }}

                        </td>

                        <td>

                            {{ $report->site?->site_id }}

                        </td>

                        <td>

                            {{ $report->site?->site_name }}

                        </td>

                        <td>

                            {{ number_format($report->total_trx) }}

                        </td>

                        <td>

                            Rp {{ number_format($report->total_rev) }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Belum ada laporan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $reports->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection