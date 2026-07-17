@extends('layouts.app')

@section('title', 'Edit Site')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Edit Site</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('sites.update', $site->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('sites.form')
            </form>
        </div>
    </div>
</div>
@endsection