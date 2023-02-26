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
        <h2 class="text-center mb-3">Laporan Invoice Per Tanggal {{$start_date}} Sampai {{$end_date}}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No Pembelian</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kuantitas</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total_qty = '0';
                @endphp
                @foreach($allData as $key => $item)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $item->purchase_no }}</td>
                    <td>{{ $item['supplier']['name'] }}</td>
                    {{-- <td>{{ date('d-m-Y',strtotime($item->date)) }}</td> --}}
                    <td>{{ $item['category']['name'] }}</td>
                    <td>{{ $item['product']['name'] }}</td>
                    <td>{{ $item->buying_qty }}</td>
                </tr>
                @php
                $total_qty += $item->buying_qty;
                @endphp
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>Total Barang</td>
                    <td>{{ ($total_qty)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>