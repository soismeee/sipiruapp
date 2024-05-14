@extends('layout.main')
@push('css')
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/properti/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    {{-- <link href="/plugins/noUiSlider/nouislider.min.css" rel="stylesheet" type="text/css"> --}}
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    {{-- <link href="/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" /> --}}
    <link href="/properti/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    {{-- <link href="/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet" type="text/css"> --}}
    <link href="/properti/plugins/bootstrap-range-Slider/bootstrap-slider.css" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->
@endpush
@section('container')
    <div class="row layout-top-spacing" id="cancel-row">

        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="card">
                <div class="card-body">
                    <h6>Pilih rentang tanggal peminjaman</h6>
                    <h6><strong class="text-warning">Note</strong> : Tombol <strong class="text-primary">Lihat</strong> digunakan untuk melihat data dengan rentang tanggal yang di pilih, data akan muncul pada kolom tabel di bawah, tombol <strong class="text-success">Cetak</strong> Digunakan untuk mencetak laporan dengan rentang tanggal yang dipilih</h6>
                    <hr />
                    <form id="form_laporan" action="{{ url('cetak') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="text" class="form-control flatpickr flatpickr-input" name="range_tanggal" id="range_tanggal" placeholder="rentang tanggal peminjaman">
                            </div>
                            <div class="col-lg-4">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" id="lihat">Lihat</button>
                                    <button type="submit" class="btn btn-success">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6>Daftar Transaksi Barang</h6>
                        <hr />
                        <div class="table-responsive" id="laporan">
                            <table class="table table-bordered table-striped mb-4">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Invoice</th>
                                        <th>Klien</th>
                                        <th>Sesi</th>
                                        <th>Informasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('js')
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/properti/plugins/flatpickr/flatpickr.js"></script>
        <script src="/properti/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "decimal",
                currency: "IDR"
            }).format(number);
        }

        function loadingdatakosongtabel(){
            $('#laporan table tbody').html('');
            $('#laporan table tfoot').html('');
            $('#laporan table tbody').append(`
                <tr id="loading">
                    <td colspan="6" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading
                    </td>
                </tr>
                <tr id="datakosong">
                    <td colspan="6" class="text-center">Pilih rentang tanggal</td>
                </tr>
            `);
        }

        $(document).ready(function(e){
            var range_tanggal = flatpickr(document.getElementById('range_tanggal'), {
                mode: "range"
            });
            loadingdatakosongtabel();
            $('#loading').hide();
            $('#datakosong').show();
        });
        
        $(document).on('click', '#lihat', function(e){
            e.preventDefault();
            loadingdatakosongtabel();
            $('#loading').show();
            $('#datakosong').hide();
            loaddata();
        });

        function loaddata(){
            $.ajax({
                type: "GET",
                url: "{{ url('get_l') }}",
                data: { 'range_tanggal' : $('#range_tanggal').val() },
                dataType: "json",
                success: function(response) {
                    let isi = "";
                    let no = 1;
                    let data = response.data;
                    $('#loading').hide();
                    data.forEach((item) => {
                        isi = `
                        <tr>
                            <td>`+no+`</td>
                            <td>`+item.id+`</td>
                            <td>`+item.klien.nama_klien+`</td>
                            <td>`+item.jadwal_aula.nama_sesi+`</td>
                            <td>Hal : `+item.keperluan+` <br />Tgl : `+item.tanggal+`</td>
                            <td>`+item.status_peminjaman+`</td>
                        </tr>
                        `
                        no++;
                        $('#laporan table tbody').append(isi);
                    });
                },
                error: function(err){
                    $('#loading').hide();
                    $('#datakosong').show();
                    sweetAlert("Maaf!!!", err.responseJSON.errors.tanggal, "warning");
                }
            });
        }
    </script>
@endpush