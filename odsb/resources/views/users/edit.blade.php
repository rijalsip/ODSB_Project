@extends('layouts.app')

@section('title', 'Edit User')

@section('page-title', 'Edit User')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}">User</a>
    </li>

    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Edit User
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
        action="{{ route('users.update', $user) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="card-body">

            @include('users.form')

        </div>

    </form>

</div>

@endsection