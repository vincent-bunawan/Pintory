<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | Owner </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>

<body class="container">
    <div class="bg-overlay"
        style="background-image: url({{ asset('/assets/images/PintoryBackground1.png') }});
    background-size: cover; background-repeat: no-repeat; min-height:1000px;">
    </div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <h4 class="text-muted text-center font-size-18"><b>Masuk sebagai Owner</b></h4>

                    <div class="p-3">

                        @if (Session::has('error'))
                            <div>
                                <strong>{{ session::get('error') }}</strong>
                            </div>
                        @endif

                        <form class="form-horizontal mt-3" method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="email" name="email" type="text"
                                        required="" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="password" name="password" type="password"
                                        required="" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 waves-effect waves-light"
                                        type="submit">Masuk</button>
                                </div>
                            </div>

                            <div class="form-group mb-3 text-center row mt-4 pt-1">
                                <div class="text-muted mb-2">
                                    Belum mendaftarkan merchant?
                                </div>
                                <div class="col-12">
                                    <a class="btn btn-outline-dark w-100"
                                        href="{{ route('admin.register.form') }}">Daftar
                                        Merchant</a>
                                </div>
                            </div>



                            {{-- <div class="form-group mb-0 row mt-2">
                                <div class="col-sm-7 mt-3">
                                    <a href="{{ route('password.request') }}" class="text-muted"><i
                                            class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                                <div class="col-sm-5 mt-3">
                                    <a href="{{ route('register') }}" class="text-muted"><i
                                            class="mdi mdi-account-circle"></i> Create an account</a>
                                </div>
                            </div> --}}
                        </form>
                        <div class="text-center text-decoration-underline">
                            <a href="{{ route('employee.login.form') }}">
                                Login Sebagai Karyawan
                            </a>
                        </div>
                    </div>
                    <!-- end -->
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div>
    <!-- end -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
