@extends('layouts.app')

@section('title', 'Detail Report Sales')

@section('page-title', 'Detail Report Sales')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ route('report-sales.index') }}">
        Report Sales
    </a>
</li>

<li class="breadcrumb-item active">
    Detail
</li>
@endsection

@section('content')

{{-- =========================
    INFORMASI REPORT
========================= --}}

<div class="row">

    <div class="col-lg-12">

        <div class="card card-primary card-outline shadow-sm">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-file-alt mr-2"></i>
                    Informasi Report
                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">
                        <strong>Tanggal</strong>

                        <p class="mb-0">
                            {{ $report->report_date->format('d-m-Y') }}
                        </p>
                    </div>

                    <div class="col-md-3">
                        <strong>Sales</strong>

                        <p class="mb-0">
                            {{ $report->user?->name }}
                        </p>
                    </div>

                    <div class="col-md-3">
                        <strong>Site ID</strong>

                        <p class="mb-0">
                            {{ $report->site?->site_id }}
                        </p>
                    </div>

                    <div class="col-md-3">
                        <strong>Site Name</strong>

                        <p class="mb-0">
                            {{ $report->site?->site_name }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =========================
    DETAIL PENJUALAN
========================= --}}

<div class="row">

    <div class="col-lg-12">

        <div class="card card-success card-outline shadow-sm">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-chart-bar mr-2"></i>

                    Detail Penjualan

                </h3>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="text-center">

                        <tr>

                            <th width="35%">Kategori</th>
                            <th width="20%">TRX</th>
                            <th width="45%">REV</th>

                        </tr>

                        </thead>

                        <tbody>

                        <tr>
                            <td>Renewal</td>
                            <td class="text-center">{{ number_format($report->renewal_trx) }}</td>
                            <td>Rp {{ number_format($report->renewal_rev) }}</td>
                        </tr>

                        <tr>
                            <td>Voucher</td>
                            <td class="text-center">{{ number_format($report->voucher_trx) }}</td>
                            <td>Rp {{ number_format($report->voucher_rev) }}</td>
                        </tr>

                        <tr>
                            <td>SA SP</td>
                            <td class="text-center">{{ number_format($report->sa_sp_trx) }}</td>
                            <td>Rp {{ number_format($report->sa_sp_rev) }}</td>
                        </tr>

                        <tr>
                            <td>SA BYU</td>
                            <td class="text-center">{{ number_format($report->sa_byu_trx) }}</td>
                            <td>Rp {{ number_format($report->sa_byu_rev) }}</td>
                        </tr>

                        <tr>
                            <td>MyTelkomsel</td>
                            <td class="text-center">{{ number_format($report->mytelkomsel_trx) }}</td>
                            <td class="text-center text-muted">-</td>
                        </tr>

                        <tr>
                            <td>Halo</td>
                            <td class="text-center">{{ number_format($report->halo_trx) }}</td>
                            <td>Rp {{ number_format($report->halo_rev) }}</td>
                        </tr>

                        <tr>
                            <td>Orbit</td>
                            <td class="text-center">{{ number_format($report->orbit_trx) }}</td>
                            <td>Rp {{ number_format($report->orbit_rev) }}</td>
                        </tr>

                        <tr>
                            <td>Nomor Spesial</td>
                            <td class="text-center">{{ number_format($report->nomor_spesial_trx) }}</td>
                            <td>Rp {{ number_format($report->nomor_spesial_rev) }}</td>
                        </tr>

                        </tbody>

                        <tfoot>

                        <tr class="bg-light">

                            <th>Total</th>

                            <th class="text-center">
                                {{ number_format($report->total_trx) }}
                            </th>

                            <th>
                                Rp {{ number_format($report->total_rev) }}
                            </th>

                        </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>
{{-- =========================
    MARKET INSIGHT
========================= --}}

<div class="row">

    <div class="col-lg-12">

        <div class="card card-warning card-outline shadow-sm">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-lightbulb mr-2"></i>

                    Market Insight

                </h3>

            </div>

            <div class="card-body">

                @if($report->market_insight)

                    <div
                        class="p-3 rounded"
                        style="background:#fff8e6;font-size:15px;line-height:1.8;">

                        {!! nl2br(e($report->market_insight)) !!}

                    </div>

                @else

                    <div class="text-center text-muted py-4">

                        <i class="fas fa-info-circle fa-2x mb-2"></i>

                        <br>

                        Belum ada Market Insight

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================
    PHOTO ACTIVITY
========================= --}}

<div class="row mt-3">

    <div class="col-lg-12">

        <div class="card card-info card-outline shadow-sm">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-camera mr-2"></i>

                    Photo Activity

                </h3>

            </div>

            <div class="card-body">

                @php
                    $photos = json_decode($report->foto_activity, true) ?? [];
                @endphp

                @if(count($photos))

                    <div class="row">

                        @foreach($photos as $photo)

                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

                                <div class="card border-0 shadow-sm">

                                    <img
                                        src="{{ asset('storage/'.$photo) }}"
                                        class="card-img-top photo-preview"
                                        style="
                                            height:240px;
                                            object-fit:cover;
                                            cursor:pointer;
                                            transition:.3s;
                                        ">

                                    <div class="card-body text-center">

                                        <a
                                            href="{{ asset('storage/'.$photo) }}"
                                            download
                                            class="btn btn-success btn-sm">

                                            <i class="fas fa-download mr-1"></i>

                                            Download

                                        </a>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="text-center text-muted py-5">

                        <i class="fas fa-image fa-3x mb-3"></i>

                        <h5>Belum ada Photo Activity</h5>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>
{{-- =========================
    TOMBOL KEMBALI
========================= --}}

<div class="card shadow-sm">

    <div class="card-body text-right">

        <a
            href="{{ route('report-sales.index') }}"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left mr-1"></i>

            Kembali

        </a>

    </div>

</div>


{{-- =========================
    MODAL PREVIEW FOTO
========================= --}}

<div
    class="modal fade"
    id="photoModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-dark text-white">

                <h5 class="modal-title">

                    <i class="fas fa-image mr-2"></i>

                    Preview Photo

                </h5>

                <button
                    type="button"
                    class="close text-white"
                    data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div
                class="modal-body text-center"
                style="background:#f4f6f9;">

                <img
                    id="previewImage"
                    src=""
                    class="img-fluid rounded shadow"
                    style="max-height:70vh;">

            </div>

            <div class="modal-footer">

                <a
                    id="downloadImage"
                    href=""
                    download
                    class="btn btn-success">

                    <i class="fas fa-download mr-1"></i>

                    Download

                </a>

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>


@push('scripts')
<script>

$(function(){

    $('.photo-preview').click(function(){

        let image = $(this).attr('src');

        $('#previewImage').attr('src', image);

        $('#downloadImage').attr('href', image);

        $('#photoModal').modal('show');

    });

});

</script>
@endpush

@endsection