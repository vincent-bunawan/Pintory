@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Stok Keluar</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('admin.invoice.add') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light" style="float:right;"><i
                                    class="fa fa-plus"></i> &nbsp;Tambah Stok Keluar </a> <br> <br>

                            <h4 class="card-title">Semua Data Stok Keluar</h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Customer</th>
                                        <th>No Invoice</th>
                                        <th>Tanggal </th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Jumlah</th>

                                </thead>


                                <tbody>

                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['payment']['customer']['name'] }} </td>
                                            <td> {{ $item->invoice_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>


                                            <td> {{ $item->description }} </td>
                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="btn btn-warning">Pending</span>
                                                @elseif($item->status == '1')
                                                    <span class="btn btn-success">Disetujui</span>
                                                @elseif($item->status == '2')
                                                    <span class="btn btn-danger">Ditolak</span>
                                                @endif
                                            </td>

                                            <td> Rp {{ number_format($item['payment']['total_amount']) }} </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
