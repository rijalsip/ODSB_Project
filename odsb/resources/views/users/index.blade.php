@extends('layouts.app')

@section('title','User')

@section('page-title','Master User')

@section('breadcrumb')
<li class="breadcrumb-item active">
    User
</li>
@endsection

@section('content')

<div class="card shadow border-0">

    {{-- HEADER DESKTOP --}}
    <div class="card-header bg-white py-3 d-none d-md-block">

        <div class="d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center">

                <div class="mr-3">

                    <i class="fas fa-users fa-2x text-primary"></i>

                </div>

                <div>

                    <h3 class="font-weight-bold mb-1">

                        Data User

                    </h3>

                    <p class="text-muted mb-0">

                        Kelola seluruh data pengguna yang terdaftar pada sistem.

                    </p>

                </div>

            </div>

            <div>

                <a
                    href="{{ route('users.template') }}"
                    class="btn btn-info">

                    <i class="fas fa-download mr-1"></i>

                    Download Template

                </a>

                <button
                    type="button"
                    class="btn btn-success ml-2"
                    data-toggle="modal"
                    data-target="#importUserModal">

                    <i class="fas fa-file-excel mr-1"></i>

                    Import User

                </button>

                <a
                    href="{{ route('users.create') }}"
                    class="btn btn-primary ml-2">

                    <i class="fas fa-plus mr-1"></i>

                    Tambah User

                </a>

            </div>

        </div>

    </div>

    {{-- HEADER MOBILE --}}
    <div class="card-header bg-white py-3 d-block d-md-none">

        <div class="d-flex align-items-center mb-3">

            <i class="fas fa-users fa-2x text-primary mr-3"></i>

            <div>

                <h4 class="font-weight-bold mb-1">

                    Data User

                </h4>

                <small class="text-muted">

                    Kelola seluruh data pengguna.

                </small>

            </div>

        </div>

        <a
            href="{{ route('users.template') }}"
            class="btn btn-info btn-block mb-2">

            <i class="fas fa-download mr-1"></i>

            Download Template

        </a>

        <div class="row">

            <div class="col-6 pr-1">

                <button
                    type="button"
                    class="btn btn-success btn-block"
                    data-toggle="modal"
                    data-target="#importUserModal">

                    <i class="fas fa-file-excel mr-1"></i>

                    Import

                </button>

            </div>

            <div class="col-6 pl-1">

                <a
                    href="{{ route('users.create') }}"
                    class="btn btn-primary btn-block">

                    <i class="fas fa-plus mr-1"></i>

                    Tambah

                </a>

            </div>

        </div>

    </div>

    <div class="card-body">

<form action="{{ route('users.index') }}" method="GET" class="mb-4">

    <div class="row align-items-end">

        <div class="col-lg-6 col-md-8 col-12">

            <label class="font-weight-bold">
                Cari User
            </label>

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Cari nama atau username..."
                    value="{{ request('search') }}">

                <div class="input-group-append">

                    <button
                        class="btn btn-primary"
                        type="submit">

                        <i class="fas fa-search"></i>

                    </button>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4 col-12 mt-2 mt-md-0">

            <a href="{{ route('users.index') }}"
               class="btn btn-secondary btn-block">

                <i class="fas fa-sync-alt mr-1"></i>

                Reset

            </a>

        </div>

    </div>

</form>

<div class="table-responsive">

        <table class="table table-bordered table-hover">

           <thead class="bg-light">

                <tr>

                    <th width="50">
                        No
                    </th>

                    <th>
                        Nama
                    </th>

                    <th>
                        Username
                    </th>

                    <th>
                        ID Digipos
                    </th>
                    <th>
    Cluster
</th>
                    <th>
                        Role
                    </th>

                    <th>
                        Status
                    </th>

                    <th width="150">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->username }}
                        </td>

                        <td>
    {{ $user->id_digipos ?? '-' }}
</td>

<td>
    {{ $user->cluster ?? '-' }}
</td>

                        <td>
                            {{ $user->role->name ?? '-' }}
                        </td>

                        <td>

                            @if($user->is_active)

                                <span class="badge badge-success">
                                    Aktif
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td>

                            <a
                                href="{{ route('users.edit',$user) }}"
                                class="btn btn-warning btn-sm"
                            >
                                <i class="fas fa-edit"></i>
                            </a>

                            <form
                                action="{{ route('users.destroy',$user) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                >
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="text-center"
                        >
                            Data tidak tersedia
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $users->links() }}

    </div>

</div>

</div>

<div
    class="modal fade"
    id="importUserModal"
    tabindex="-1"
>

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                action="{{ route('users.import') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                <div class="modal-header">

                    <h5 class="modal-title">
                        Import User
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                    >
                        <span>&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>
                            File Excel
                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control @error('file') is-invalid @enderror"
                            accept=".xlsx,.xls,.csv"
                            required
                        >

                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <small class="text-muted">

                        Format yang didukung:

                        <strong>
                            .xlsx, .xls, .csv
                        </strong>

                    </small>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="fas fa-upload"></i>

                        Import
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection