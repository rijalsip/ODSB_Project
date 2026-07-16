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

    <div class="card-header d-flex justify-content-between">

        <h3 class="card-title">
            Data Role
        </h3>

        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i>
            Tambah Role
        </a>

    </div>

  <div class="card-body">

    <table class="table table-bordered table-striped">
        <thead>
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

@endsection