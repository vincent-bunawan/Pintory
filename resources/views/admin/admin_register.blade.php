<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register | Admin </title>
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

</head>

<section class="min-h-screen overflow-hidden">
    {{-- <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">

                    <div class="text-center mt-4">
                        <div class="mb-3">
                            <a href="index.html" class="auth-logo">
                                <img src="{{ asset('backend/assets/images/logo-dark.png') }}" height="30"
                                    class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('backend/assets/images/logo-light.png') }}" height="30"
                                    class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-18"><b>Daftarkan Akun</b></h4>

                    <div class="p-3">

                        <form class="form-horizontal mt-3" method="POST" action="{{ route('admin.register') }}">
                            @csrf

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="name" type="text" name="name"
                                        required="" placeholder="Name">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="username" type="text" name="username"
                                        required="" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="email" type="email" name="email"
                                        required="" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="password" type="password" name="password"
                                        required="" placeholder="Password">
                                </div>
                            </div>


                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control" id="password_confirmation" type="password"
                                        name="password_confirmation" required="" placeholder="Password Confirmation">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light"
                                        type="submit">Register</button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3 text-center">
                                    <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
        </div>
        <!-- end container -->
    </div> --}}
    <!-- end -->

    <div class="row">
        <div class="container col-sm-6 col-md-6 col-xl-6 mt-4">
            <h2 class="display-6 fw-bold mt-5 text-center">Buat Akun</h2>
            <h3 class="fw-light mt-3 mb-4 text-center">Sebelum mendaftarkan merchant, <br> silahkan mengisi form di
                bawah
                untuk membuat akun pemilik</h3>
            <form method="POST" action="{{ route('admin.register') }}" class="container mt-1 col-md-6">
                @csrf
                <label for="name"
                    class="col-md-1 col-form-label text-md-end text-sm-end text-lg-end">{{ __('Nama') }}
                </label>
                <div class="col">
                    <input class="form-control" id="name" type="text" name="name" required=""
                        placeholder="John Doe">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <label for="phone"
                    class="col-md-1 col-form-label text-md-end text-sm-end text-lg-end text-nowrap">{{ __('Nama Pengguna') }}
                </label>
                <div class="col">
                    <input class="form-control" id="username" type="text" name="username" required=""
                        placeholder="john_doe">
                </div>
                <label for="email"
                    class="col-md-1 col-form-label text-md-end text-sm-end text-lg-end">{{ __('Email') }}
                </label>
                <div class="col">
                    <input class="form-control" id="email" type="email" name="email" required=""
                        placeholder="johndoe@example.com">
                </div>
                <label for="password"
                    class="col-md-1 col-form-label text-md-end text-sm-end text-lg-end text-nowrap">{{ __('Kata Sandi') }}
                </label>
                <div class="col">
                    <input class="form-control" id="password" type="password" name="password" required=""
                        placeholder="Password">
                </div>
                <label for="password-confirm"
                    class="col-md-1 col-form-label text-md-end text-sm-end text-lg-end text-nowrap">{{ __('Ulang Kata Sandi') }}
                </label>
                <div class="col-12">
                    <input class="form-control" id="password_confirmation" type="password" name="password_confirmation"
                        required="" placeholder="Konfirmasi Password">
                </div>
                <div class="row justify-content-center mt-4 mb-2">
                    <button type="submit"
                        class="w-75 btn btn-primary waves-effect waves-primary justify-content-center">
                        {{ __('Daftar') }}
                    </button>
                </div>
                <div class="row justify-content-center mt-1 mb-2">
                    <button type="submit" class="w-50 btn btn-link text-center text-sm text-nowrap mr-1">
                        <a href="/owner/login">Sudah memiliki akun? Masuk Disini</a>
                    </button>
                </div>
            </form>
        </div>

        <div class="container col-sm-6 col-md-6 col-xl-6">
            <div class="bg-image position-relative"
                style="background-image: url({{ asset('/assets/images/Register1.png') }});
        background-size: cover; background-repeat: no-repeat; min-height:1033px;">
            </div>
        </div>


        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('backend/assets/js/app.js') }}"></script>

</section>

</html>
