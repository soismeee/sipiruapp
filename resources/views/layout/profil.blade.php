@extends('layout.main')
@push('css')
    <link href="/properti/assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
@endpush
@section('container')
<div class="row layout-spacing">

    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

        <div class="bio layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="">Profil</h3>
                <p>Selamat datang pada aplikasi Fikal Store, anda terdaftar pada sistem ini dengan posisi
                    @if (auth()->user()->role == 1)
                        Owner Toko
                    @else
                        Karyawan
                    @endif
                    <br />
                    Anda dapat mengganti profil pengguna pada form dibawah ini
                </p>
                <div class="bio-skill-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="/change_profile" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{ auth()->user()->name }}" placeholder="Masukan nama">
                                    <small class="form-text text-muted">Anda dapat mengubah nama pengguna anda.</small>
                                    @error('name')
                                    <div class="alert alert-danger mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Maaf!</strong> Nama tidak boleh kosong. </div>
                                    @enderror   
                                    @if ($message = Session::get('error'))
                                    <div class="alert alert-danger mb-4" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Maaf!</strong> {{ $message }}. </div>
                                    @endif 
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" class="form-control" id="sPassword" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Simpan profil</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>                                
        </div>
    </div>
</div>
@endsection