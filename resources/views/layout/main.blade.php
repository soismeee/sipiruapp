<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $title }} </title>
    <link rel="icon" type="image/x-icon" href="/properti/assets/img/logobatang.ico" />
    <link href="/properti/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="/properti/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="/properti/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/properti/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    @stack('css')
</head>

<body class="alt-menu sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <div class="nav-logo align-self-center">
                <a class="navbar-brand" href="\"><span class="navbar-brand-name">SIPIRU</span></a>
            </div>

            <ul class="navbar-item flex-row mr-auto">
                {{-- <li class="nav-item align-self-center search-animated">
                    <form class="form-inline search-full form-inline search" role="search">
                        <div class="search-bar">
                            <input type="text" class="form-control search-form-control  ml-lg-auto"
                                placeholder="Search...">
                        </div>
                    </form>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-search toggle-search">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </li> --}}
            </ul>

            <ul class="navbar-item flex-row nav-dropdowns">

                <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <h6>{{ auth()->user()->name }}</h6>
                                <p>
                                    @if (auth()->user()->role == 1)
                                        Dinas
                                    @else
                                        Pengguna
                                    @endif
                                </p>
                            </div>
                            <img src="/properti/assets/img/90x90.jpg" class="img-fluid" alt="admin-profile">
                            <span class="badge badge-success"></span>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="dropdown-item">
                            <a href="/profile">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> <span> Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#" data-toggle="modal" data-target="#logout">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg> <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('layout.navbar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{ $menu }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="javascript:void(0);">{{ $submenu }}</a></li>
                        </ol>
                    </nav>
                </div>

                @yield('container')

                <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">{{ date('Y') }} Sistem peminjaman ruang Aula DPMPTSP.</p>
                    </div>
                    <div class="footer-section f-section-2">
                        <p>Kab. Batang</p>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="logout" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anda akan keluar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-x">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text">Klik keluar untuk keluar dari aplikasi ini</p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal"><i
                                        class="flaticon-cancel-12"></i>Batal</button>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    {{-- <script src="/assets/js/jquery-3.5.1.js"></script> --}}
    <script src="/properti/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="/properti/bootstrap/js/popper.min.js"></script>
    <script src="/properti/bootstrap/js/bootstrap.min.js"></script>
    <script src="/properti/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/properti/assets/js/app.js"></script>
    <script src="/properti/plugins/sweetalerts/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });

        function sweetAlert(title, message, type) {
            swal({
                title: title,
                text: message,
                type: type,
                padding: '2em'
            });
        }
    </script>
    <script src="/properti/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    @stack('js')
</body>

</html>
