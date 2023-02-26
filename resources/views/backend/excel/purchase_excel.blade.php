<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>No Pembelian</th>
            <th>Nama Supplier</th>
            <th>Kategori</th>
            <th>Nama Produk</th>
            <th>Kuantitas</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_qty = '0';
        @endphp
        @foreach($allData as $key => $item)
        <tr>
            <th>{{ $key+1 }}</th>
            <td>{{ $item->purchase_no }}</td>
            <td>{{ $item['supplier']['name'] }}</td>
            <td>{{ $item['category']['name'] }}</td>
            <td>{{ $item['product']['name'] }}</td>
            <td>{{ $item->buying_qty }}</td>
        </tr>
        @php
        $total_qty += $item->buying_qty;
        @endphp
        @endforeach

        {{-- <tr>
            <th>Total Harga</th>
            <td>Rp{{ number_format($total_sum)}}</td>
        </tr> --}}
    </tbody>
</table>