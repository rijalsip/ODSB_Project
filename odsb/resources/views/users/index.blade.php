@extends('layouts.app')

@section('title','User')

@section('page-title','Master User')

@section('breadcrumb')
<li class="breadcrumb-item active">
    User
</li>
@endsection

@section('content')
<style>
@media (max-width: 768px) {

    .card-tools{
        width:100%;
        display:flex;
        justify-content:flex-start;
    }

    .card-tools form{
        width:auto;
        margin-right:10px;
        margin-bottom:8px;
    }

    .card-tools .input-group{
        width:100px !important;
    }

    .card-tools .btn{
        margin-bottom:5px;
    }

}
</style>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Data User
        </h3>

 <div class="card-tools d-flex align-items-center">

    <form
        action="{{ route('users.index') }}"
        method="GET"
        class="mr-2"
    >

        <div class="input-group input-group-sm" style="width:220px;">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari Username..."
                value="{{ request('search') }}"
            >

            <div class="input-group-append">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="fas fa-search"></i>
                </button>

                <a
                    href="{{ route('users.index') }}"
                    class="btn btn-secondary"
                >
                    <i class="fas fa-sync"></i>
                </a>

            </div>

        </div>

    </form>

    <a
        href="{{ route('users.template') }}"
        class="btn btn-info btn-sm mr-1"
    >
        <i class="fas fa-download"></i>
        Download Template
    </a>

    <button
        type="button"
        class="btn btn-success btn-sm mr-1"
        data-toggle="modal"
        data-target="#importUserModal"
    >
        <i class="fas fa-file-excel"></i>
        Import User
    </button>

    <a
        href="{{ route('users.create') }}"
        class="btn btn-primary btn-sm"
    >
        <i class="fas fa-plus"></i>
        Tambah User
    </a>

</div>
    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead>

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