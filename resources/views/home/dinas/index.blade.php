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
                <h5 class="">Daftar peminjaman belum di proses</h5>
            </div>

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-scroll">
                        <thead>
                            <tr>
                                <th><div class="th-content">#</div></th>
                                <th><div class="th-content">Nama Klien</div></th>
                                <th><div class="th-content th-heading">Alamat</div></th>
                                <th><div class="th-content th-heading">Tanggal Pinjam</div></th>
                                <th><div class="th-content">Keperluan</div></th>
                                <th><div class="th-content">Status</div></th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($peminjaman as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_peminjam }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->keperluan }}</td>
                                    <td>{{ $item->status_peminjaman }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center"><h4>Tidak ada peminjaman dengan status proses</h4></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-two">
            <div class="widget-heading">
                <h5 class="">Total Peminjaman</h5>
                <p>Data Peminjaman pada bulan sekarang</p>
            </div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <tr class="text-center">
                        <td>Status</td>
                        <td>Jumlah</td>
                    </tr>
                    <tr>
                        <td>Pengajuan</td>
                        <td>{{ $pengajuan }}</td>
                    </tr>
                    <tr>
                        <td>Proses</td>
                        <td>{{ $proses }}</td>
                    </tr>
                    <tr>
                        <td>Selesai</td>
                        <td>{{ $selesai }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    

</div>
@endsection
@push('js')
    <script src="/properti/plugins/apex/apexcharts.min.js"></script>
    <script src="/properti/assets/js/dashboard/dash_1.js"></script>
    
@endpush