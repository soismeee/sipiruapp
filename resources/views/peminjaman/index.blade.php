@extends('layout.main')
@section('container')
    <div class="row layout-top-spacing" id="cancel-row">
        
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6>Daftar Pengajuan peminjaman aula</h6>
                        @if (auth()->user()->role == 1)
                        <p><strong class="text-warning">Catatan : </strong>Anda dapat memproses pengajuan peminjaman aula dengan cara menekan tombol aksi</p>
                        @else
                        <p><strong class="text-warning">Catatan : </strong>semua pengajuan peminjaman anda, baik pengajuan baru, proses ataupun selesai ada di menu ini</p>
                        <div class="d-flex justify-content-end">
                            <div>
                                <a href="/cp" class="btn btn-md btn-primary">Buat Pengajun Baru</a>
                            </div>
                        </div>
                        @endif
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
                                        <th>Aksi</th>
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
    <script>
        $(document).ready(function(e){
            loadingdatakosongtabel();
            $('#loading').hide();
            $('#datakosong').show();
        });
        function loadingdatakosongtabel(){
            $('#laporan table tbody').html('');
            $('#laporan table tfoot').html('');
            $('#laporan table tbody').append(`
                <tr id="loading">
                    <td colspan="7" class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading
                    </td>
                </tr>
                <tr id="datakosong">
                    <td colspan="7" class="text-center">Belum ada pengajuan peminjaman</td>
                </tr>
            `);
        }

        function loaddata(){
            $.ajax({
                type: "GET",
                url: "{{ url('get_p') }}",
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
                            <td>`+item.invoice+`</td>
                            <td>`+item.tanggal+`</td>
                            <td>`+item.total_barang+`</td>
                            <td>Rp. `+rupiah(item.total_nominal)+`</td>
                        </tr>
                        `
                        no++;
                        $('#laporan table tbody').append(isi);
                    });
                    let total = `
                        <tr>
                            <td colspan="4"><strong>Total</strong></td>
                            <td><strong>Rp. `+rupiah(response.total)+`</strong></td>
                        </tr>
                    `
                    $('#laporan table tbody').append(total);
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