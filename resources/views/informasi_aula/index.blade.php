@extends('layout.main')
@section('container')
<div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <h4>gambar aula</h4>
                    <div class="row">
                        <div class="col-6 mb-4">
                            <img src="{{ asset('properti/ruang/1.jpg') }}" width="100%">
                        </div>
                        <div class="col-6 mb-4">
                            <img src="{{ asset('properti/ruang/2.jpg') }}" width="100%">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('properti/ruang/3.jpg') }}" width="100%">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('properti/ruang/4.jpg') }}" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4>Kelengkapan ruangan :</h4>
                    <table class="table table-bordered">
                        <tr>
                            <td width="50%"><h5>Meja Panjang Depan</h5></td>
                            <td width="50%"><h5>: {{ $aula['meja_depan'] }} buah</h5></td>
                        </tr>
                        <tr>
                            <td width="50%"><h5>Meja Podium</h5></td>
                            <td width="50%"><h5>: {{ $aula['podium'] }} buah</h5></td>
                        </tr>
                        <tr>
                            <td width="50%"><h5>Meja Panjang</h5></td>
                            <td width="50%"><h5>: {{ $aula['meja_panjang'] }} buah</h5></td>
                        </tr>
                        <tr>
                            <td width="50%"><h5>Kursi</h5></td>
                            <td width="50%"><h5>: {{ $aula['kursi'] }} buah</h5></td>
                        </tr>
                        <tr>
                            <td width="50%"><h5>Lain - lain</h5></td>
                            <td width="50%">
                                <h5>
                                <ul>
                                    <li>Proyektor</li>
                                    <li>Proyektor/LCD</li>
                                    <li>Smart TV</li>
                                    <li>Alat audio</li>
                                </ul>
                                </h5>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection