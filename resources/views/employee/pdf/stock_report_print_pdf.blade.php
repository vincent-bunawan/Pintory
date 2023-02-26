<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Mutasi Stok Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        {{-- <h2 class="text-center mb-3">Laravel HTML to PDF Example</h2>
        <div class="d-flex justify-content-end mb-4">
            <a class="btn btn-primary" href="{{ URL::to('#') }}">Export to PDF</a>
        </div> --}}
        <h2 class="text-center mb-3">Laporan Stock</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama Supplier</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Kategori</th>
                    {{-- <th scope="col">Date</th> --}}
                    <th scope="col">Nama Produk</th>
                    {{-- <th scope="col">Jumlah Stock In</th>
                    <th scope="col">Jumlah Stock Out</th> --}}
                    <th scope="col">Stok</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php
                $total_sum = '0';
                @endphp --}}
                @foreach($allData as $key => $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td> {{ $item['supplier']['name'] }} </td>
                    <td> {{ $item['unit']['name'] }} </td>
                    <td> {{ $item['category']['name'] }} </td>
                    <td> {{ $item->name }} </td>
                    {{-- <td> {{ $buying_total }} </td>
                    <td> {{ $selling_total }} </td> --}}
                    <td> {{ $item->quantity }} </td>
                </tr>
                {{-- @php
                $total_sum += $item['payment']['total_amount'];
                @endphp --}}
                @endforeach

                {{-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total Harga</td>
                    <td>Rp{{ number_format($total_sum)}}</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>