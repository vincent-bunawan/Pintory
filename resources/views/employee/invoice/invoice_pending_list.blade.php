@extends('employee.employee_master')
@section('employee')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Pengajuan Stok Keluar</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- <a href="{{ route('employee.invoice.add') }}"
                            class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i
                                class="fas fa-plus-circle"> Tambah Stok Masuk </i></a> <br> <br> --}}

                            <h4 class="card-title">Semua Data Stok Masuk </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Customer</th>
                                        <th>No Invoice</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                </thead>


                                <tbody>

                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['payment']['customer']['name'] }} </td>
                                            <td> #{{ $item->invoice_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>


                                            <td> {{ $item->description }} </td>

                                            <td> Rp {{ number_format($item['payment']['total_amount']) }} </td>

                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="btn btn-warning">Pending</span>
                                                @elseif($item->status == '1')
                                                    <span class="btn btn-success">Disetujui</span>
                                                @elseif($item->status == '2')
                                                    <span class="btn btn-danger">Ditolak</span>
                                                @endif
                                            </td>


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
