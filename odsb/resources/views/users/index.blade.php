@extends('layouts.app')

@section('title','User')

@section('page-title','Master User')

@section('breadcrumb')
<li class="breadcrumb-item active">
    User
</li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Data User
        </h3>

        <div class="card-tools">

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

@endsection