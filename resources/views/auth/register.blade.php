
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="/properti/assets/img/logobatang.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="/properti/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/properti/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="/properti/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="/properti/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="/properti/assets/css/forms/switches.css">
</head>
<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <img src="/properti/assets/img/logobatang.png" width="15%">
                        <h2 class="">SIPIRU <br /> DPMPTSP KAB. BATANG</h2>
                        <h3 class="">Registrasi Akun</h3>
                        <form class="text-left" id="form-register">
                            @csrf
                            <div class="form">
                                <div id="name-field" class="field-wrapper input">
                                    <label for="name">NAMA</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="name" name="name" type="text" class="form-control" placeholder="Masukan nama" value="{{ old('name') }}">
                                    <span id="errname"></span>
                                </div>

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="username" name="username" type="text" value="" class="form-control" placeholder="Buat username" value="{{ old('username') }}">
                                    <span id="errusername"></span>
                                </div>

                                <div id="password-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <span class="forgot-pass-link">&nbsp;</span>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Buat password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <span id="errpassword"></span>
                                </div>
                                
                                <div class="d-sm-flex justify-content-between mb-3">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary tombol">Registrasi</button>
                                    </div>
                                </div>
                                <p class="signup-link register">Sudah memiliki akun? <a href="/login">Masuk sekarang</a></p>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="/properti/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/properti/bootstrap/js/popper.min.js"></script>
    <script src="/properti/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="/properti/assets/js/authentication/form-2.js"></script>
    <script>
        let inputname = document.getElementById('name');
        inputname.addEventListener('input', function(){
            $('#errname').removeClass('text-danger');
            $('#errname').text('');
        });
        let inputusername = document.getElementById('username');
        inputusername.addEventListener('input', function(){
            $('#errusername').removeClass('text-danger');
            $('#errusername').text('');
        });
        let inputpassword = document.getElementById('password');
        inputpassword.addEventListener('input', function(){
            $('#errpassword').removeClass('text-danger');
            $('#errpassword').text('');
        });

        $('#form-register').on('submit', function(e){
            e.preventDefault();
            $('.tombol').text('Loading...');
            let username = $('#username').val();
            let password = $('#password').val();
            $.ajax({
                type: 'POST',
                url: '/regist',
                data: $(this).serialize(),
                success: function(response){
                    $('#form-register').html(
                        `
                        <div class="text-center">
                            `+response.message+`, ingin melanjutkan untuk login ?
                        <a href="#" class="btn btn-lg btn-success mt-3" id="login" data-username="`+username+`" data-password="`+password+`">Login sekarang</a>
                        <a href="/login" class="btn btn-lg btn-primary mt-3">Nanti saja</a>
                        </div>
                        `
                    );
                },
                error: function(err){
                    $('.tombol').text('Registrasi');
                    let error = err.responseJSON;
                    $.each(error.errors, function(key, value){
                        $('#err'+key).addClass('text-danger');
                        $('#err'+key).text(value);
                    });
                }
            });
        });

        $(document).on('click', '#login', function(e) {
                e.preventDefault();
                $('#login').prop('disabled', true);
                $('#login').html('Loading...')
                let loginusername = $(this).data('username');    
                let loginpassword = $(this).data('password');    
                $.ajax({
                    type: "POST",
                    url: "{{ url('auth2') }}",
                    data: { 'username' : loginusername, 'password' : loginpassword, '_token' : "{{ csrf_token() }}" },
                    dataType: "json",
                    success: function(response) {
                        window.location.href = "{{ url('/') }}";
                    }
                });
            });
    </script>
</body>
</html>