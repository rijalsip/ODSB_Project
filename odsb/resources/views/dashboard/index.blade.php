@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">
        Dashboard
    </li>
@endsection

@section('content')

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">

                <div class="inner">
                    <h3>0</h3>
                    <p>Total Direct Sales</p>
                </div>

                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>

                <a href="#" class="small-box-footer">
                    Lihat Detail
                    <i class="fas fa-arrow-circle-right"></i>
                </a>

            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">

                <div class="inner">
                    <h3>0</h3>
                    <p>Total Site</p>
                </div>

                <div class="icon">
                    <i class="fas fa-tower-cell"></i>
                </div>

                <a href="#" class="small-box-footer">
                    Lihat Detail
                    <i class="fas fa-arrow-circle-right"></i>
                </a>

            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">

                <div class="inner">
                    <h3>0</h3>
                    <p>Selling Hari Ini</p>
                </div>

                <div class="icon">
                    <i class="fas fa-cart-shopping"></i>
                </div>

                <a href="#" class="small-box-footer">
                    Lihat Detail
                    <i class="fas fa-arrow-circle-right"></i>
                </a>

            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">

                <div class="inner">
                    <h3>0</h3>
                    <p>Selling Bulan Ini</p>
                </div>

                <div class="icon">
                    <i class="fas fa-chart-column"></i>
                </div>

                <a href="#" class="small-box-footer">
                    Lihat Detail
                    <i class="fas fa-arrow-circle-right"></i>
                </a>

            </div>
        </div>

    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-line mr-1"></i>
                Monitoring Sales
            </h3>
        </div>

        <div class="card-body">
            <p class="mb-0">
                Selamat datang di Sistem Monitoring Sales.
            </p>
        </div>

    </div>

@endsection
