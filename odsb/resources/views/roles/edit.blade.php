@extends('layouts.app')

@section('title', 'Edit Role')

@section('page-title', 'Edit Role')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('roles.index') }}">Role</a>
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Edit Role
        </h3>
    </div>

    <form action="{{ route('roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
            @include('roles.form')
        </div>

    </form>
</div>

@endsection