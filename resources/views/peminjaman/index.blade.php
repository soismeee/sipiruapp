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
    @include('peminjaman.modal_proses')
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        // ketika tampilan halaman siap, script ini akan otomatis dijalankan
        $(document).ready(function(e){
            loadingdatakosongtabel();
            $('#loading').show();
            $('#datakosong').hide();
            loaddata();
        });

        // fungsi untuk membuat tampilan loading lebih menarik
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

        // fungsi untuk mengambil data dari database kemudian ditampilkan pada tabel
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
                    $('#datakosong').hide();
                    data.forEach((item) => {
                        let tanggal = moment(item.tanggal).format("DD-MM-YYYY");
                        let status = "dark";
                        if (item.status_peminjaman == "Terima") { status = "primary"; }
                        if (item.status_peminjaman == "Selesai") { status = "success"; }
                        isi = `
                        <tr>
                            <td>`+no+`</td>
                            <td>`+item.id+`</td>
                            <td>`+item.nama_peminjam+`</td>
                            <td>
                                Nama : `+item.jadwal_aula.nama_sesi+`
                                <br />    
                                Waktu : `+item.jadwal_aula.sesi_awal+` - `+item.jadwal_aula.sesi_akhir+`
                            </td>
                            <td>
                                Tanggal : `+tanggal+` <br />
                                CP : `+item.no_telepon+` <br />
                                Keperluan : `+item.keperluan+`
                                </td>
                            <td><span class="badge bg-`+status+`">`+item.status_peminjaman+`</span></td>
                            @can('dinas')
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary proses" data-id="`+item.id+`" data-status="`+item.status_peminjaman+`">Proses</button>
                                </div>
                            </td>
                            @endcan
                            @can('klien')
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-danger hapus" data-id="`+item.id+`">Hapus</button>
                                </div>
                            </td>
                            @endcan
                        </tr>
                        `
                        no++;
                        $('#laporan table tbody').append(isi);
                    });
                },
                error: function(err){
                    $('#loading').hide();
                    $('#datakosong').show();
                }
            });
        }

        // menampilkan modal proses pengajuan
        $(document).on('click', '.proses', function(e){
            e.preventDefault();
            $('#id').val($(this).data('id'));
            $('#status_peminjaman').val($(this).data('status'));
            $('#modalProses').modal('show');
        });

        // fungsi untuk menjalankan proses pengajuan
        $(document).on('submit', '#form_proses', function(e){
            e.preventDefault();
            $('#tombol_proses').prop('disabled', true).html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>  Loading');
            $.ajax({
                type: "POST",
                url: "{{ url('proses') }}/" + $('#id').val(),
                data: $('#form_proses').serialize(),
                dataType: "json",
                success: function(response) {
                    loadingdatakosongtabel();
                    loaddata();
                    $('#tombol_proses').prop('disabled', false).html('Proses');
                    $('#modalProses').modal('hide');
                    sweetAlert("Berhasil!!!", response.message, "success");
                },
                error: function(err) {
                    $('#tombol_proses').prop('disabled', false).html('Proses');
                    sweetAlert("Maaf!!!", err.responseJSON.message, "danger");
                }
            });
        });

        // fungsi untuk menghapus pengajuan peminjaman
        $(document).on('click', '.hapus', function(e) {
            e.preventDefault();
            let idhapus = $(this).data('id');
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success btn-rounded',
                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Anda yakin?',
                text: "Akan menghapus Peminjaman ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus Peminjaman!',
                cancelButtonText: 'Batal!',
                reverseButtons: true,
                padding: '2em'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('del_p') }}/" + idhapus,
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(response) {
                            swalWithBootstrapButtons(
                                'Terhapus!',
                                response.message,
                                'success'
                            )
                            loaddata();
                        }
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Batal',
                        'Barang tidak dihapus!!!',
                        'error'
                    );
                }
            });
        });
    </script>
@endpush