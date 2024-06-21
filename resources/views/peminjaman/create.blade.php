@extends('layout.main')
@push('css')
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/properti/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
        <link href="/properti/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
        <!--  END CUSTOM STYLE FILE  -->
@endpush
@section('container')
<div class="row layout-top-spacing" id="cancel-row">
    <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Form pengajuan peminjaman aula</h4>
                        <form action="/save" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="nama_peminjam">Nama</label>
                                    <input type="hidden" name="klien_id" id="klien_id" value="{{ $klien->id }}">
                                    <input type="text" class="form-control" name="nama_peminjam" id="nama_peminjam" placeholder="Masukan nama peminjam" value="{{ $klien->nama_klien }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="no_telepon">Telepon</label>
                                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="Masukan nomor telepon" value="{{ $klien->no_telepon }}">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukan Alamat" value="{{ $klien->alamat }}">
                            </div>
                            <div class="form-group mb-4">
                                <label for="alamat_kantor">Alamat Kantor</label>
                                <input type="text" class="form-control" name="alamat_kantor" id="alamat_kantor" placeholder="Masukan alamat kantor" value="{{ $klien->alamat_kantor }}">
                            </div>
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="ja_id">Sesi</label>
                                    <select name="ja_id" id="ja_id" class="form-control">
                                        <option selected disabled>Pilih sesi</option>
                                        @foreach ($jadwal as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_sesi }}</option>
                                        @endforeach
                                    </select>
                                    @error('ja_id')
                                        <span class="text-danger">Sesi harus dipilih</span>
                                    @enderror        
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" disabled>
                                    @error('tanggal')
                                        <span class="text-danger">Tanggal tidak boleh kosong</span>
                                    @enderror    
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="">Pilih bentuk ruang dengan cara klik gambar dibawah ini</label> <br />
                                <img class="gambar" src="/properti/ruang/Gambar1.jpg" width="20%">
                                <img class="gambar" src="/properti/ruang/Gambar2.jpeg" width="20%">
                                <img class="gambar" src="/properti/ruang/Gambar3.jpg" width="20%">
                                <img class="gambar" src="/properti/ruang/Gambar4.jpeg" width="20%">
                                <input type="text" class="form-control mt-2" name="bentuk_ruang" id="bentuk_ruang" readonly>
                                @error('bentuk_ruang')
                                    <span class="text-danger">Bentuk ruangan harus dipilih</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keperluan">Keperluan</label>
                                <input type="text" class="form-control" name="keperluan" id="keperluan" placeholder="Masukan keperluan">
                                @error('keperluan')
                                        <span class="text-danger">Keperluan tidak boleh kosong</span>
                                    @enderror    
                            </div>
                            <div class="form-group mb-4">
                                <label for="surat_pinjam">Upload surat pinjam</label>
                                <input type="file" class="form-control" name="surat_pinjam" id="surat_pinjam">
                                @error('surat_pinjam')
                                    <span class="text-danger">Peminjaman harus menyertakan surat peminjaman</span>
                                @enderror    
                            </div>
                            <label>Fasilitas yang di ajukan, (hapus fasilitas yang tidak anda inginkan)</label>
                            <div id="list_fasilitas">
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="">Fasilitas</label>
                                        <input type="text" class="form-control" name="fasilitas[]" value="Meja">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty[]" value="1" value="1">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="" class="mb-3">&nbsp;</label> <br />
                                        <a href="#" class="hapus_fasilitas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="">Fasilitas</label>
                                        <input type="text" class="form-control" name="fasilitas[]" value="Kursi">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty[]" value="1">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="" class="mb-3">&nbsp;</label> <br />
                                        <a href="#" class="hapus_fasilitas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="">Fasilitas</label>
                                        <input type="text" class="form-control" name="fasilitas[]" value="Smart TV">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty[]" value="1">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="" class="mb-3">&nbsp;</label> <br />
                                        <a href="#" class="hapus_fasilitas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="">Fasilitas</label>
                                        <input type="text" class="form-control" name="fasilitas[]" value="Proyektor">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty[]" value="1">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="" class="mb-3">&nbsp;</label> <br />
                                        <a href="#" class="hapus_fasilitas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <label for="">Fasilitas</label>
                                        <input type="text" class="form-control" name="fasilitas[]" value="Alat audio">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Qty</label>
                                        <input type="number" class="form-control" name="qty[]" value="1">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="" class="mb-3">&nbsp;</label> <br />
                                        <a href="#" class="hapus_fasilitas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-end">

                                    <button type="button" class="btn btn-dark mr-4" id="tambah_fasilitas">Tambah fasilitas</button>
                                </div>
                            </div>
                          <button type="submit" class="btn btn-primary mt-3">Simpan Pengajuan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 layout-spacing">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-center">Daftar data pengajuan</h3>
                        <ul>
                            @foreach ($data_peminjaman as $dp)
                                <li> <h5> {{ $dp->jadwal_aula->nama_sesi }} : {{ date('d/m/Y', strtotime($dp->tanggal)) }} </h5></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="/properti/plugins/flatpickr/flatpickr.js"></script>

{{-- <script src="/properti/plugins/flatpickr/custom-flatpickr.js"></script> --}}
    <script>
        // $(document).ready(function() {
        //     var disabledDates = @json($tanggal); // Tambahkan tanggal yang ingin dinonaktifkan
        //     flatpickr("#tanggal", {
        //         disable: disabledDates,
        //         minDate: "today", // Opsional: tidak memperbolehkan tanggal sebelum hari ini
        //         dateFormat: "Y-m-d", // Format tanggal yang sesuai dengan yang Anda gunakan
        //     });
        // });

        $(document).on('click', '#tambah_fasilitas', function(e){
            $('#list_fasilitas').append(`
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="">Fasilitas</label>
                        <input type="text" class="form-control" name="fasilitas[]" placeholder="Tulisan kebutuhan anda">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Qty</label>
                        <input type="number" class="form-control" name="qty[]" value="1">
                    </div>
                    <div class="form-group col-md-1">
                        <label for="" class="mb-3">&nbsp;</label> <br />
                        <a href="#" class="hapus_fasilitas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </a>
                    </div>
                </div>
            `)
        });

        $(document).on('click', '.gambar', function(e){
            e.preventDefault();
            let bentuk_ruang = $(this).attr('src');
            $('#bentuk_ruang').val(bentuk_ruang);
        })

        $(document).on("click", ".hapus_fasilitas", function(e) {
            e.preventDefault();
            $(this).parent().parent().remove(); 
        });

        $(document).on('change', '#ja_id', function(e){
            let ja_id = $(this).val();
            $.ajax({
                url: "{{ url('/cek_p') }}/" + ja_id,
                type: "GET",
                success: function(response){
                    $('#tanggal').prop('disabled', false);
                    disabledTanggal(response)
                }
            });
        });

        function disabledTanggal(tanggal){
            var disabledDates = tanggal; // Tambahkan tanggal yang ingin dinonaktifkan
            flatpickr("#tanggal", {
                disable: disabledDates,
                minDate: "today", // Opsional: tidak memperbolehkan tanggal sebelum hari ini
                dateFormat: "Y-m-d", // Format tanggal yang sesuai dengan yang Anda gunakan
            });
        }
    </script>
@endpush