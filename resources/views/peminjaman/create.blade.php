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
                        <form action="/save" method="POST">
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
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control" name="tanggal" id="tanggal" value="{{ date('Y-m-d') }}" disabled>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="keperluan">Keperluan</label>
                                <input type="text" class="form-control" name="keperluan" id="keperluan" placeholder="Masukan alamat kantor" value="{{ $klien->alamat_kantor }}">
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
                        <h3 class="text-center">Semua data pengajuan</h3>
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