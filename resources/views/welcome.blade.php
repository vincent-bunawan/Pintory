<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pintory : Pintarkan Inventorymu!</title>
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="antialiased">
    <div>
        <div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <nav class="collapse navbar-collapse justify-evenly" id="navbarNav">
                        <ul class="navbar-nav mb-2">
                            <nav>
                                <a class="navbar-brand" href="#">
                                    <img src="/assets/images/PintoryVerticalLogo.png" width="10%" height="100%"
                                        alt="">
                                </a>
                            </nav>
                            <li class="nav-item ml-auto justify-evenly">
                            <li class="nav-item ml-auto p-2 mt-2">
                                <a class="nav-link text-nowrap" href="#features">Fitur Kami</a>
                            </li>
                            @guest
                                @if (Route::has('admin.login.form'))
                                    <li class="nav-item p-2 mt-2">
                                        <a class="nav-link text-nowrap" href="{{ route('admin.login.form') }}">Login</a>
                                    </li>
                                @endif
                                @if (Route::has('admin.register'))
                                    <li class="nav-item p-2 mt-2">
                                        <a class="btn btn-primary text-nowrap"
                                            href="{{ route('admin.register.form') }}">Daftarkan
                                            Merchant</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}</a>

                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>
        </div>

        <div style="height: 550px; display: block;">
            <div class="bg-image pt-5"
                style="background-image: url({{ asset('/assets/images/PintoryBanner.png') }});
                background-size: cover; background-repeat: no-repeat; height: 500px;">
                <div class="container d-flex align-items-center flex-column mb-5 mt-5 pt-5">
                    <h1 class="fw-bold text-white mb-3 mt-5">Tingkatkan produktivitas bisnis anda</h1>
                    <h2 class="fw-bold text-white">Kelola inventaris anda dengan Pintory</h2>
                </div>
            </div>
            <section id="features" class="bg-white text-center">
                <div class="container pt-5 pb-5">
                    <h1 class="align-items-center fw-bold text-black pb-2">Fitur Kami</h1>
                    <br>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="card p-5 mx-auto mb-3 mb-lg-3">
                                <div class="d-flex">
                                    <div class="bi-shop m-auto text-black" style="font-size: 300%"></div>
                                </div>
                                <h5 class="fw-bold pt-3">Multi-outlet Management</h5>
                                <p>Mengatur dan memanage inventory dalam lokasi yang berbeda</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-5 mx-auto mb-3 mb-lg-3">
                                <div class="d-flex">
                                    <div class="bi-people m-auto text-black" style="font-size: 300%"></div>
                                </div>
                                <h5 class="fw-bold pt-3">Multi-role Management</h5>
                                <p>Kelola akses setiap user untuk kontrol stok yang berbeda</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-5 mx-auto mb-3 mb-lg-3">
                                <div class="d-flex">
                                    <div class="bi-file-earmark-spreadsheet m-auto text-black" style="font-size: 300%">
                                    </div>
                                </div>
                                <h5 class="fw-bold pt-3">Export & Print Data Manajemen Stok</h5>
                                <p>Kemudahan export data inventory dalam bentuk PDF & Excel ataupun Print</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card p-5 mx-auto mb-3 mb-lg-3">
                                <div class="d-flex">
                                    <div class="bi-clipboard-data m-auto text-black" style="font-size: 300%"></div>
                                </div>
                                <h5 class="fw-bold pt-3">Manage Supplier & Customer</h5>
                                <p>Kelola informasi yang berkaitan dengan Supplier & Customer</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </section>
            <footer class="bg-light text-center text-lg-start">
                <!-- Copyright -->
                <div class="text-center p-4 bg-dark">
                    <h5 class="fw-bold text-light"> © 2023 Copyright : Pintory</h5>
                </div>
            </footer>
</body>

</html>
