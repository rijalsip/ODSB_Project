@extends('layouts.app')

@section('title', 'Tambah User')

@section('page-title', 'Tambah User')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">User</a>
    </li>

    <li class="breadcrumb-item active">
        Tambah
    </li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Tambah User
        </h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger m-3">
            <h5>
                <i class="fas fa-exclamation-triangle"></i>
                Terjadi Kesalahan
            </h5>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('users.store') }}"
        method="POST"
    >
        @csrf

        <div class="card-body">

            @include('users.form')

        </div>

    </form>

</div>

@endsection