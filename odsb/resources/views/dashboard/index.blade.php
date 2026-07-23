@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">
    Dashboard
</li>
@endsection

@push('styles')

<style>

.small-box{
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
    min-height:165px;
}

.small-box .inner{
    min-height:165px;
}

.small-box .inner{
    padding:20px;
}

.small-box h3{
    font-size:32px;
    font-weight:700;
}

.small-box p{
    font-size:15px;
    margin-bottom:0;
}

.monitor-card{
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    transition:.25s;
    height:100%;
    background:#fff;
}

.monitor-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 28px rgba(0,0,0,.15);
}

.monitor-header{
    height:8px;
}

.monitor-body{
    padding:22px;
}

.monitor-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:25px;
}

.monitor-number{
    font-size:34px;
    font-weight:700;
    line-height:1;
}

.monitor-label{
    color:#777;
    font-size:13px;
}

.monitor-divider{
    margin:20px 0;
}

.monitor-revenue{
    font-size:23px;
    font-weight:bold;
    color:#28a745;
}

.monitor-revenue-label{
    color:#777;
    font-size:13px;
}

</style>

@endpush

@section('content')

<div class="row">

    {{-- Total Direct Sales --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-info">

         <div class="inner">

    <h3>{{ number_format($totalDirectSales) }}</h3>

    <p>Total Direct Sales</p>

    <small>
        &nbsp;
        <br>
        <strong>&nbsp;</strong>
    </small>

</div>

            <div class="icon">

                <i class="fas fa-users"></i>

            </div>

        </div>

    </div>

    {{-- Total Site --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-success">

           <div class="inner">

    <h3>{{ number_format($totalSite) }}</h3>

    <p>Total Site</p>

    <small>
        &nbsp;
        <br>
        <strong>&nbsp;</strong>
    </small>

</div>

            <div class="icon">

                <i class="fas fa-tower-cell"></i>

            </div>

        </div>

    </div>

    {{-- Selling Hari Ini --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>{{ number_format($todayTrx) }}</h3>

                <p>Transaksi Hari Ini</p>

                <small>

                    Revenue

                    <br>

                    <strong>

                        Rp {{ number_format($todayRevenue,0,',','.') }}

                    </strong>

                </small>

            </div>

            <div class="icon">

                <i class="fas fa-cart-shopping"></i>

            </div>

        </div>

    </div>

    {{-- Selling Bulan Ini --}}
    <div class="col-lg-3 col-md-6 col-12">

        <div class="small-box bg-danger">

            <div class="inner">

                <h3>{{ number_format($monthTrx) }}</h3>

                <p>Transaksi Bulan Ini</p>

                <small>

                    Revenue

                    <br>

                    <strong>

                        Rp {{ number_format($monthRevenue,0,',','.') }}

                    </strong>

                </small>

            </div>

            <div class="icon">

                <i class="fas fa-chart-column"></i>

            </div>

        </div>

    </div>

</div>

<div class="card card-outline card-primary">

    <div class="card-header">

        <h3 class="card-title">

            Monitoring Sales

        </h3>

    </div>

    <div class="card-body">

        <div class="row">
    @php

$colors = [
    'bg-primary',
    'bg-success',
    'bg-warning',
    'bg-danger',
    'bg-info',
    'bg-secondary',
    'bg-indigo',
    'bg-teal',
];

@endphp

@foreach($monitoring as $index => $item)

<div class="col-lg-4 col-md-6 mb-4">

    <div class="monitor-card">

        <div class="monitor-header {{ $colors[$index % count($colors)] }}"></div>

        <div class="monitor-body">

            <div class="monitor-title">

                {{ $item['title'] }}

            </div>

            <div class="monitor-number">

                {{ number_format($item['trx']) }}

            </div>

            <div class="monitor-label">

                Total Transaksi

            </div>

            <hr class="monitor-divider">

            <div class="monitor-revenue">

                @if(is_null($item['rev']))

                    -

                @else

                    Rp {{ number_format($item['rev'],0,',','.') }}

                @endif

            </div>

            <div class="monitor-revenue-label">

                Total Revenue

            </div>

        </div>

    </div>

</div>

@endforeach

        </div>

    </div>

</div>
@endsection

@push('scripts')

<script>

$(function(){

    $('.monitor-card').hover(

        function(){

            $(this).css({

                transition:'0.25s',

                cursor:'pointer'

            });

        },

        function(){

            $(this).css({

                transition:'0.25s'

            });

        }

    );

});

</script>

@endpush
