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

        <table class="table table-bordered table-striped">

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

                    <th>
                        Regional
                    </th>

                    <th>
                        Branch
                    </th>

                    <th>
                        Cluster
                    </th>

                    <th width="120">
                        Status
                    </th>

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

                            {{ $site->regional ?? '-' }}

                        </td>

                        <td>

                            {{ $site->branch ?? '-' }}

                        </td>

                        <td>

                            {{ $site->cluster ?? '-' }}

                        </td>

                        <td>

                            @if($site->is_active)

                                <span class="badge badge-success">
                                    Aktif
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Tidak Aktif
                                </span>

                            @endif

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
                            colspan="8"
                            class="text-center">

                            Belum ada data Site.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $sites->links('pagination::bootstrap-4') }}

        </div>

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