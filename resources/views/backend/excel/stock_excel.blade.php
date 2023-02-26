<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Supplier</th>
            <th>Unit</th>
            <th>Kategori</th>
            <th>Nama Produk</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
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
        @endforeach

        {{-- <tr>
            <th>Total Harga</th>
            <td>Rp{{ number_format($total_sum)}}</td>
        </tr> --}}
    </tbody>
</table>