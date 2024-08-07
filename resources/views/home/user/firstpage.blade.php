
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="/properti/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="/properti/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/properti/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/properti/assets/css/pages/coming-soon/style.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="/properti/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="/properti/assets/css/forms/switches.css">
</head>
<body class="coming-soon">    

    <div class="coming-soon-container">
        <div class="coming-soon-cont">
            <div class="coming-soon-wrap">
                <div class="coming-soon-container">
                    <div class="coming-soon-content">

                        <h4 class="">Baru daftar</h4>
                        <p class="">Lengkapi profil anda.....</p>

                        <form action="{{ url('sk') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="nama_klien">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_klien" id="nama_klien" value="{{ old('nama_klien') }}">
                                    @error('nama_klien')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" name="nip" id="nip" value="{{ old('nip') }}">
                                    @error('nip')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="no_telepon">Telepon</label>
                                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}">
                                    @error('no_telepon')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ old('jabatan') }}">
                                    @error('jabatan')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="alamat">Alamat rumah</label>
                                    <textarea name="alamat" id="alamat" cols="3" rows="3" class="form-control"> {{ old('alamat') }} </textarea>
                                    @error('alamat')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label for="alamat_kantor">Alamat kantor</label>
                                    <textarea name="alamat_kantor" id="alamat_kantor" cols="3" rows="3" class="form-control"> {{ old('alamat_kantor') }}</textarea>
                                    @error('alamat_kantor')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>    
                                    @enderror
                                </div>

                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>

                        <p class="terms-conditions">© {{ date('Y') }} Sistem pinjam ruang aula DPMPTSP Kabupaten Batang.</p>

                    </div>                    
                </div>
            </div>
        </div>
        <div class="coming-soon-image">
            <div class="l-image">
                <div class="img-content">
                    <img src="/properti/assets/img/mindset.svg" alt="coming_soon">
                </div>
            </div>
        </div>
    </div>
    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/properti/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/properti/bootstrap/js/popper.min.js"></script>
    <script src="/properti/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="/properti/assets/js/pages/coming-soon/coming-soon.js"></script>

</body>
</html>