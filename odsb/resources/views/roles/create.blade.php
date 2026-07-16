@extends('layouts.app')

@section('title', 'Tambah Role')

@section('page-title', 'Tambah Role')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('roles.index') }}">Role</a>
    </li>
    <li class="breadcrumb-item active">
        Tambah
    </li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Tambah Role
        </h3>
    </div>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="card-body">
            @include('roles.form')
        </div>

    </form>

</div>

@endsection