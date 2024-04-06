@extends('layout.main')
@push('css')
    <link href="/properti/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="/properti/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    
@endpush
@section('container')

<div class="row layout-top-spacing">

    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h5 class="">Data Peminjaman</h5>
            </div>

            <div class="widget-content">
                <div id="revenueMonthly"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-two">
            <div class="widget-heading">
                <h5 class="">Total Peminjaman</h5>
            </div>
            <div class="widget-content">
                <div id="chart-2" class=""></div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-three">

            <div class="widget-heading">
                <h5 class="">Daftar peminjaman belum di proses</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-scroll">
                        <thead>
                            <tr>
                                <th><div class="th-content">Nama Klien</div></th>
                                <th><div class="th-content th-heading">Alamat</div></th>
                                <th><div class="th-content th-heading">Tanggal Pinjam</div></th>
                                <th><div class="th-content">Keperluan</div></th>
                                <th><div class="th-content">Status</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><div class="td-content">User</div></td>
                                <td><div class="td-content">Batang</div></td>
                                <td><div class="td-content">17/04/2023</div></td>
                                <td><div class="td-content">Rapat penting</div></td>
                                <td><div class="td-content"><span class="badge bg-info">Proses</span></div></td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection
@push('js')
<script src="/properti/plugins/apex/apexcharts.min.js"></script>
<script src="/properti/assets/js/dashboard/dash_1.js"></script>
    
@endpush