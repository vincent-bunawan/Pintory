@extends('employee.employee_master')
@section('employee')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Stok Masuk</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('employee.purchase.add') }}"
                            class="btn btn-success btn-rounded waves-effect waves-light" style="float:right;"><i
                            class="fa fa-plus"></i> &nbsp;Tambah Pembayaran </a> <br> <br>

                            <h4 class="card-title">Semua Data Stok Masuk</h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pembelian</th>
                                        <th>Tanggal</th>
                                        <th>Supplier</th>
                                        <th>Kategori</th>
                                        <th>Kuantitas</th>
                                        <th>Nama Produk</th>
                                        <th>Status</th>
                                        {{-- <th>Action</th> --}}

                                </thead>


                                <tbody>

                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->purchase_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                            <td> {{ $item['supplier']['name'] }} </td>
                                            <td> {{ $item['category']['name'] }} </td>
                                            <td> {{ $item->buying_qty }} </td>
                                            <td> {{ $item['product']['name'] }} </td>

                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="btn btn-warning">Pending</span>
                                                @elseif($item->status == '1')
                                                    <span class="btn btn-success">Disetujui</span>
                                                @elseif($item->status == '2')
                                                    <span class="btn btn-danger">Ditolak</span>
                                                @endif
                                            </td>

                                            {{-- <td>
                                        @if ($item->status == '0')
                                        <a href="{{ route('purchase.delete',$item->id) }}" class="btn btn-danger sm"
                                            title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>
                                        @endif
                                    </td> --}}

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
