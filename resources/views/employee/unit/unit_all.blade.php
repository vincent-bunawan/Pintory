@extends('employee.employee_master')
@section('employee')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Daftar Satuan Unit</h4>



                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- <a href="{{ route('unit.add') }}" class="btn btn-dark btn-rounded waves-effect waves-light"
                            style="float:right;"><i class="fas fa-plus-circle"> Tambah Unit </i> </a> <br> <br> --}}

                        <h4 class="card-title">Semua Satuan Unit</h4>


                        <table id="datatable" class="table table-bordered dt-responsive now  rap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th width="20%">Aksi</th>

                            </thead>


                            <tbody>

                                @foreach($units as $key => $item)
                                <tr>
                                    <td> {{ $key+1}} </td>
                                    <td> {{ $item->name }} </td>
                                    <td>
                                        <a href="{{ route('employee.unit.edit',$item->id) }}" class="btn btn-info sm"
                                            title="Edit Data"> <i class="fas fa-edit"></i> </a>

                                        {{-- <a href="{{ route('empl.delete',$item->id) }}" class="btn btn-danger sm"
                                            title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a> --}}

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