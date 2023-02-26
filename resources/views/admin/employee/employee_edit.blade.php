@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Form Edit Karyawan </h4><br><br>



                            <form method="post" action="{{ route('employee.update') }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $employee->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Karyawan </label>
                                    <div class="form-group col-sm-10">
                                        <input name="name" value="{{ $employee->name }}" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Username </label>
                                    <div class="form-group col-sm-10">
                                        <input name="username" value="{{ $employee->username }}" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                {{-- <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Password </label>
                                <div class="form-group col-sm-10">
                                    <input name="password" value="{{ $employee->password }}" class="form-control"
                                        type="password">
                                </div>
                            </div> --}}
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Telepon </label>
                                    <div class="form-group col-sm-10">
                                        <input name="mobile_no" value="{{ $employee->mobile_no }}" class="form-control"
                                            type="number">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email </label>
                                    <div class="form-group col-sm-10">
                                        <input name="email" value="{{ $employee->email }}" class="form-control"
                                            type="email">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Posisi
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <input name="position" value="{{ $employee->position }}" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                {{-- <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Outlet </label>
                                <div class="col-sm-10">
                                    <select name="outlet_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Pilih...</option>
                                        @foreach ($outlet as $outle)
                                        <option value="{{ $outle->id }}">{{ $outle->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Alamat
                                    </label>
                                    <div class="form-group col-sm-10">
                                        <input name="address" value="{{ $employee->address }}" class="form-control"
                                            type="text">
                                    </div>
                                </div>
                                <!-- end row -->





                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Edit Karyawan">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Please Enter Your Name',
                    },
                    mobile_no: {
                        required: 'Please Enter Your Mobile Number',
                    },
                    email: {
                        required: 'Please Enter Your Email',
                    },
                    address: {
                        required: 'Please Enter Your Address',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
