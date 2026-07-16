@extends('layouts.app')

@section('title', 'Tambah Site')

@section('page-title', 'Tambah Site')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('sites.index') }}">Site</a>
    </li>
    <li class="breadcrumb-item active">
        Tambah
    </li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Tambah Site
        </h3>
    </div>

    <form action="{{ route('sites.store') }}" method="POST">
        @csrf

        <div class="card-body">
            @include('sites.form')
        </div>

    </form>

</div>

@endsection