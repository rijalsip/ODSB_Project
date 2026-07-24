@extends('layouts.app')

@section('title', 'Data Site')

@section('page-title', 'Data Site')

@section('breadcrumb')
<li class="breadcrumb-item active">
    Site
</li>
@endsection

@section('content')

<div class="card shadow border-0">

    {{-- HEADER --}}
    <div class="card-header bg-white py-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div class="d-flex align-items-center">

                <div class="mr-3">
                    <i class="fas fa-broadcast-tower fa-2x text-primary"></i>
                </div>

                <div>

                    <h3 class="font-weight-bold mb-1">
                        Data Site
                    </h3>

                    <p class="text-muted mb-0">
                        Kelola seluruh data site yang terdaftar pada sistem.
                    </p>

                </div>

            </div>

            <div class="ml-auto mt-3 mt-md-0">

                <button
                    type="button"
                    class="btn btn-success"
                    data-toggle="modal"
                    data-target="#importModal">

                    <i class="fas fa-file-excel mr-1"></i>
                    Import Excel

                </button>

                <a
                    href="{{ route('sites.create') }}"
                    class="btn btn-primary ml-2">

                    <i class="fas fa-plus mr-1"></i>
                    Tambah Site

                </a>

            </div>

        </div>

    </div>

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FILTER --}}
        <form
            method="GET"
            action="{{ route('sites.index') }}"
            class="mb-4">

            <div class="card border shadow-sm">

                <div class="card-body">

                    {{-- SEARCH --}}
                    <div class="row">

                        <div class="col-12 mb-3">

                            <label class="font-weight-bold">
                                Cari Data
                            </label>

                            <div class="input-group">

                                <input
                                    type="text"
                                    name="keyword"
                                    class="form-control"
                                    placeholder="Cari Site ID atau Site Name..."
                                    value="{{ request('keyword') }}">

                                <div class="input-group-append">

                                    <span class="input-group-text bg-white">

                                        <i class="fas fa-search text-muted"></i>

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- FILTER BARIS 2 --}}
                    <div class="row">

                        <div class="col-lg-4 col-md-6 mb-3">

                            <label class="font-weight-bold">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-control">

                                <option value="">
                                    Semua Status
                                </option>

                                @foreach (['NON','P1','P2','P3'] as $status)

                                    <option
                                        value="{{ $status }}"
                                        {{ request('status') == $status ? 'selected' : '' }}>

                                        {{ $status }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-lg-4 col-md-6 mb-3">

                            <label class="font-weight-bold">
                                Cluster
                            </label>

                            <select
                                name="cluster"
                                class="form-control">

                                <option value="">
                                    Semua Cluster
                                </option>

                                @foreach ($clusters as $cluster)

                                    <option
                                        value="{{ $cluster }}"
                                        {{ request('cluster') == $cluster ? 'selected' : '' }}>

                                        {{ $cluster }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-lg-2 col-md-6 mb-3">

                            <label class="font-weight-bold">
                                Tampilkan
                            </label>

                            <select
                                name="per_page"
                                class="form-control">

                                @foreach([10,25,50,100] as $page)

                                    <option
                                        value="{{ $page }}"
                                        {{ request('per_page',10) == $page ? 'selected' : '' }}>

                                        {{ $page }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-lg-2 col-md-6 mb-3 d-flex align-items-end">

                            <div class="btn-group w-100">

                                <button
                                    class="btn btn-primary"
                                    type="submit">

                                    <i class="fas fa-search"></i>

                                </button>

                                <a
                                    href="{{ route('sites.index') }}"
                                    class="btn btn-secondary">

                                    <i class="fas fa-sync-alt"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">

                    <tr>

                        <th width="60">No</th>

                        <th>Site ID</th>

                        <th>Site Name</th>

                        <th>Cluster</th>

                        <th>City</th>

                        <th>Status</th>

                        <th>Kecamatan</th>

                        <th>Program</th>

                        <th>Tech</th>

                        <th>Class</th>

                        <th class="text-center" style="width:100px;">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>
                    @forelse($sites as $site)

<tr>

    <td>

        {{
            ($sites->currentPage() - 1)
            * $sites->perPage()
            + $loop->iteration
        }}

    </td>

    <td class="font-weight-bold">

        {{ $site->site_id }}

    </td>

    <td>

        {{ $site->site_name ?? '-' }}

    </td>

    <td>

        {{ $site->cluster ?? '-' }}

    </td>

    <td>

        {{ $site->city ?? '-' }}

    </td>

    <td>

        @php
            $status = strtoupper($site->site_focus_mtd ?? 'NON');
        @endphp

        @switch($status)

            @case('P1')

                <span class="badge badge-danger px-3 py-2">
                    P1
                </span>

                @break

            @case('P2')

                <span class="badge badge-warning px-3 py-2">
                    P2
                </span>

                @break

            @case('P3')

                <span class="badge badge-info px-3 py-2">
                    P3
                </span>

                @break

            @default

                <span class="badge badge-secondary px-3 py-2">
                    NON
                </span>

        @endswitch

    </td>

    <td>

        {{ $site->kecamatan ?? '-' }}

    </td>

    <td>

        {{ $site->program ?? '-' }}

    </td>

    <td>

        {{ $site->tech ?? '-' }}

    </td>

    <td>

        {{ $site->class ?? '-' }}

    </td>

    <td class="text-center">

        <div
            class="btn-group"
            role="group">

            <a
                href="{{ route('sites.edit', $site) }}"
                class="btn btn-warning btn-sm"
                title="Edit">

                <i class="fas fa-edit"></i>

            </a>

            <form
                action="{{ route('sites.destroy', $site) }}"
                method="POST"
                class="d-inline">

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin ingin menghapus site ini?')"
                    title="Hapus">

                    <i class="fas fa-trash"></i>

                </button>

            </form>

        </div>

    </td>

</tr>

@empty

<tr>

    <td
        colspan="11"
        class="text-center py-5">

        <i
            class="fas fa-folder-open fa-3x text-muted mb-3">
        </i>

        <br>

        <span class="text-muted">

            Belum ada data Site.

        </span>

    </td>

</tr>

@endforelse

</tbody>
            </table>

        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap p-3 border-top">

            <div class="text-muted small">

                Menampilkan

                <strong>

                    {{ $sites->firstItem() ?? 0 }}

                </strong>

                -

                <strong>

                    {{ $sites->lastItem() ?? 0 }}

                </strong>

                dari

                <strong>

                    {{ $sites->total() }}

                </strong>

                data

            </div>

            <div>

                {{ $sites->links('pagination::bootstrap-4') }}

            </div>

        </div>

    </div>

</div>


{{-- ===========================
        MODAL IMPORT
=========================== --}}

<div
    class="modal fade"
    id="importModal"
    tabindex="-1"
    aria-labelledby="importModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <form
                action="{{ route('sites.import') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-header bg-success text-white">

                    <h5
                        class="modal-title"
                        id="importModalLabel">

                        <i class="fas fa-file-excel mr-2"></i>

                        Import Data Site

                    </h5>

                    <button
                        type="button"
                        class="close text-white"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label class="font-weight-bold">

                            Pilih File Excel

                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".xlsx,.xls"
                            required>

                        @error('file')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                        <small class="text-muted">

                            Format yang didukung :
                            <strong>.xlsx</strong>,
                            <strong>.xls</strong>

                        </small>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        <i class="fas fa-times mr-1"></i>

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fas fa-upload mr-1"></i>

                        Import

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
@push('scripts')

@if ($errors->has('file'))

<script>

$(document).ready(function () {

    $('#importModal').modal('show');

});

</script>

@endif

<script>

$(function () {

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

});

</script>

@endpush