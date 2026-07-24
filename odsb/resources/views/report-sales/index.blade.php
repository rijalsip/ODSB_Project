@extends('layouts.app')

@section('title', 'Report Sales')

@section('page-title', 'Report Sales')

@section('breadcrumb')
<li class="breadcrumb-item active">
    Report Sales
</li>
@endsection

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h3 class="card-title">

            Data Report Sales

        </h3>

    </div>

   <div class="card-body">

<form method="GET">

    <div class="row g-3">

        <!-- Search -->
        <div class="col-lg-5 col-md-12">

            <label class="font-weight-bold">

                Cari Data

            </label>

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari DS, Site ID, Site Name..."
                value="{{ request('search') }}">

        </div>

        <!-- Tanggal -->
        <div class="col-lg-3 col-md-6">

            <label class="font-weight-bold">

                Tanggal

            </label>

            <input
                type="date"
                name="report_date"
                class="form-control"
                value="{{ request('report_date') }}">

        </div>

        <!-- DS -->
        <div class="col-lg-4 col-md-6">

            <label class="font-weight-bold">

                DS

            </label>

            <select
                name="user_id"
                class="form-control">

                <option value="">
                    Semua DS
                </option>

                @foreach($users as $user)

                    <option
                        value="{{ $user->id }}"
                        {{ request('user_id') == $user->id ? 'selected' : '' }}>

                        {{ $user->name }}

                    </option>

                @endforeach

            </select>

        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-12 d-flex justify-content-between flex-wrap">

            <div>

                <button
                    class="btn btn-primary mr-2">

                    <i class="fas fa-search"></i>

                    Cari

                </button>

                <a
                    href="{{ route('report-sales.index') }}"
                    class="btn btn-outline-secondary">

                    <i class="fas fa-sync"></i>

                    Reset

                </a>

            </div>

            <div>

                <a
                    href="{{ route('report-sales.export', request()->query()) }}"
                    class="btn btn-success">

                    <i class="fas fa-file-excel"></i>

                    Export Excel

                </a>

            </div>

        </div>

    </div>

</form>

<hr>

<div class="table-responsive">

<div class="table-responsive">

    <table class="table table-hover table-bordered align-middle mb-0">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Tanggal</th>
                    <th>DS</th>
                    <th>Site ID</th>
                    <th>Site Name</th>
                    <th>Total TRX</th>
                    <th>Total REV</th>
<th width="100">Action</th>

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

<td class="text-center">

    <a
        href="{{ route('report-sales.show', $report->id) }}"
        class="btn btn-info btn-sm px-3"
        title="Lihat Detail">

        <i class="fas fa-eye"></i>

    </a>

</td>
                        

                    </tr>

                @empty

                    <tr>

                        <td colspan="8" class="text-center">

                            Belum ada laporan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

</div>

<div class="p-3">

    {{ $reports->links('pagination::bootstrap-4') }}

</div>

</div>

@endsection