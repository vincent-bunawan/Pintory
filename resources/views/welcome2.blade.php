<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Pintory</title>
</head>

<body>
    <div style="height: 550px; display: block;">
        <div class="bg-image pt-5" style="background-image: url({{ asset('/assets/images/PintoryBanner.png') }});
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
                        <div class="card p-3 mx-auto mb-3 mb-lg-3">
                            <div class="d-flex">
                                <div class="bi-shop m-auto text-black" style="font-size: 400%"></div>
                            </div>
                            <h5 class="fw-bold">Multi-outlet Management</h5>
                            <p>Mengatur dan memanage inventory dalam lokasi yang berbeda</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 mx-auto mb-3 mb-lg-3">
                            <div class="d-flex">
                                <div class="bi-people m-auto text-black" style="font-size: 400%"></div>
                            </div>
                            <h5 class="fw-bold">Multi-role Management</h5>
                            <p>Kelola akses setiap user untuk kontrol stok yang berbeda</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 mx-auto mb-3 mb-lg-3">
                            <div class="d-flex">
                                <div class="bi-file-earmark-spreadsheet m-auto text-black" style="font-size: 400%">
                                </div>
                            </div>
                            <h5 class="fw-bold">Export & Print Data</h5>
                            <p>Export data inventory dalam bentuk PDF & Excel ataupun Print</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card p-3 mx-auto mb-3 mb-lg-3">
                            <div class="d-flex">
                                <div class="bi-clipboard-data m-auto text-black" style="font-size: 400%"></div>
                            </div>
                            <h5 class="fw-bold">Supplier & Customer</h5>
                            <p>Kelola informasi yang berkaitan dengan Supplier & Customer</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </section>
</body>
<section>
    <footer class="pt-3 bg-dark">
        <ul class="nav justify-content-center border-bottom pb-3 mb-4">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Fitur Kami</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Tentang Kami</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
        </ul>
        <h6 class="text-center text-white fw-bold">&copy; 2022 Pintory</h6>
        <br>
    </footer>
</section>

</html>