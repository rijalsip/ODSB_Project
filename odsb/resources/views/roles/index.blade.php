@extends('layouts.app')

@section('title', 'Data Role')

@section('page-title', 'Data Role')

@section('breadcrumb')
<li class="breadcrumb-item active">
    Role
</li>
@endsection

@section('content')

<div class="card">

    <div class="card-header bg-white py-3">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <div class="d-flex align-items-center mb-2 mb-md-0">

            <div class="mr-3">

                <i class="fas fa-user-shield fa-2x text-primary"></i>

            </div>

            <div>

                <h3 class="font-weight-bold mb-1">
                    Data Role
                </h3>

                <p class="text-muted mb-0">
                    Kelola seluruh data role pada sistem.
                </p>

            </div>

        </div>

        <a
            href="{{ route('roles.create') }}"
            class="btn btn-primary">

            <i class="fas fa-plus mr-1"></i>

            Tambah Role

        </a>

    </div>

</div>

<div class="card-body">

    <form
        action="{{ route('roles.index') }}"
        method="GET"
        class="mb-4">

        <div class="row mt-2 px-lg-3">

    <div class="col-lg-5">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari nama role..."
                value="{{ request('search') }}">

            <div class="input-group-append">

                <button
                    class="btn btn-primary"
                    type="submit">

                    <i class="fas fa-search"></i>

                </button>

                <a
                    href="{{ route('roles.index') }}"
                    class="btn btn-outline-secondary">

                    <i class="fas fa-sync-alt"></i>

                </a>

            </div>

        </div>

    </div>

</div>

</form>
    <div class="table-responsive">

        <table class="table table-bordered table-hover align-middle">
        <thead class="bg-light">
            <tr>
                <th width="50">No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description ?? '-' }}</td>
                    <td>
                        @if($role->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Tidak Aktif</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('roles.edit', $role) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('roles.destroy', $role) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus role ini?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada data role.
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>

    </div>

</div>

</div>


@endsection