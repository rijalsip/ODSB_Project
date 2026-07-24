@extends('layouts.app')

@section('title', 'Data Site')

@section('page-title', 'Data Site')

@section('breadcrumb')
<li class="breadcrumb-item active">
    Site
</li>
@endsection

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            Data Site
        </h3>

        <div>

            <button
                type="button"
                class="btn btn-success btn-sm"
                data-toggle="modal"
                data-target="#importModal">

                <i class="fas fa-file-excel"></i>

                Import Excel

            </button>

            <a
                href="{{ route('sites.create') }}"
                class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>

                Tambah Site

            </a>

        </div>

    </div>

   <div class="card-body p-0">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif
<form method="GET" action="{{ route('sites.index') }}" class="mb-3">

    <div class="row">

        <div class="col-md-4">
            <input
                type="text"
                name="keyword"
                class="form-control"
                placeholder="Cari Site ID / Site Name..."
                value="{{ request('keyword') }}">
        </div>

        <div class="col-md-2">
            <select name="status" class="form-control">
                <option value="">Semua Status</option>

                @foreach (['NON', 'P1', 'P2', 'P3'] as $status)
                    <option value="{{ $status }}"
                        {{ request('status') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="col-md-3">
            <select name="cluster" class="form-control">

                <option value="">Semua Cluster</option>

                @foreach ($clusters as $cluster)

                    <option
                        value="{{ $cluster }}"
                        {{ request('cluster') == $cluster ? 'selected' : '' }}>

                        {{ $cluster }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="col-md-1">
            <select name="per_page" class="form-control">

                @foreach ([10,25,50,100] as $page)

                    <option
                        value="{{ $page }}"
                        {{ request('per_page',10) == $page ? 'selected' : '' }}>

                        {{ $page }}

                    </option>

                @endforeach

            </select>
        </div>

        <div class="col-md-2">

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Cari
            </button>

            <a href="{{ route('sites.index') }}" class="btn btn-secondary">
                Reset
            </a>

        </div>

    </div>

</form>
       <div class="table-responsive">

    <table class="table table-bordered table-striped mb-0">

            <thead>

                <tr>

                    <th width="60">
                        No
                    </th>

                    <th>
                        Site ID
                    </th>

                    <th>
                        Site Name
                    </th>

                    <th>Cluster</th>
<th>City</th>
<th>Status</th>
<th>Kecamatan</th>
<th>Program</th>
<th>Tech</th>
<th>Class</th>

                    <th width="180">
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

                        <td>

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

    @if($status == 'P1')

        <span class="badge badge-danger">
            P1
        </span>

    @elseif($status == 'P2')

        <span class="badge badge-warning">
            P2
        </span>

    @elseif($status == 'P3')

        <span class="badge badge-info">
            P3
        </span>

    @else

        <span class="badge badge-secondary">
            NON
        </span>

    @endif

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
                        <td>

                            <a
                                href="{{ route('sites.edit', $site) }}"
                                class="btn btn-warning btn-sm">

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
                                    onclick="return confirm('Yakin ingin menghapus site ini?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="text-center">

                            Belum ada data Site.

                        </td>

                    </tr>

                @endforelse

            </tbody>

       </table>

</div>

<div class="p-3">

    {{ $sites->links('pagination::bootstrap-4') }}

</div>

</div>
<!-- Modal Import -->
<div
    class="modal fade"
    id="importModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="{{ route('sites.import') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fas fa-file-excel text-success mr-2"></i>

                        Import Data Site

                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>

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

                            Format yang didukung:
                            <strong>.xlsx</strong> dan
                            <strong>.xls</strong>

                        </small>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fas fa-upload"></i>

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

$(function () {

    $('#importModal').modal('show');

});

</script>

@endif

@endpush