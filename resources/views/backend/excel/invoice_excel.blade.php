<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Customer Name</th>
            <th>Invoice No</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total_sum = '0';
        @endphp
        @foreach($allData as $key => $item)
        <tr>
            <th>{{ $key+1 }}</th>
            <td>{{ $item['payment']['customer']['name'] }}</td>
            <td>{{ $item->invoice_no }}</td>
            {{-- <td>{{ date('d-m-Y',strtotime($item->date)) }}</td> --}}
            <td>{{ $item->description }}</td>
            <td>Rp{{
                number_format($item['payment']['total_amount']) }}</td>
        </tr>
        @php
        $total_sum += $item['payment']['total_amount'];
        @endphp
        @endforeach

        {{-- <tr>
            <th>Total Harga</th>
            <td>Rp{{ number_format($total_sum)}}</td>
        </tr> --}}
    </tbody>
</table>