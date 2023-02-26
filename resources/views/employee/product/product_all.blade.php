@extends('employee.employee_master')
@section('employee')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Produk</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- <a href="{{ route('admin.product.add') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light" style="float:right;"><i
                                    class="fa fa-plus"></i> &nbsp;Tambah Produk </a> <br> <br> --}}

                            <h4 class="card-title">Semua Produk</h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Supplier </th>
                                        <th>Unit</th>
                                        <th>Kategori</th>

                                </thead>


                                <tbody>

                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td> {{ $item['supplier']['name'] }} </td>
                                            <td> {{ $item['unit']['name'] }} </td>
                                            <td> {{ $item['category']['name'] }} </td>

                                            {{-- <a href="{{ route('admin.product.edit', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"> <i class="fas fa-edit"></i>
                                                </a> --}}

                                            {{-- <a href="{{ route('admin.product.delete', $item->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                        class="fas fa-trash-alt"></i> </a> --}}



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
