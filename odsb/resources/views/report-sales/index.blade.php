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
<form method="GET" class="mb-3">

    <div class="row">

        <!-- Search -->
        <div class="col-md-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari DS, Site ID, Site Name..."
                value="{{ request('search') }}">
        </div>

        <!-- Tanggal -->
        <div class="col-md-2">
            <input
                type="date"
                name="report_date"
                class="form-control"
                value="{{ request('report_date') }}">
        </div>

        <!-- DS -->
        <div class="col-md-3">
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

        <!-- Tombol Cari -->
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                🔍 Cari
            </button>
        </div>

        <!-- Tombol Reset -->
        <div class="col-md-2">
            <a
                href="{{ route('report-sales.index') }}"
                class="btn btn-secondary w-100">

                Reset

            </a>
        </div>

    </div>

</form>
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
        class="btn btn-info btn-sm">

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

        <div class="mt-3">

            {{ $reports->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection