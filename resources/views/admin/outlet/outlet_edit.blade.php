@extends('admin.admin_master2')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Halaman Update Outlet </h4><br><br>



                        <form method="post" action="{{ route('admin.outlet.update') }}" id="myForm"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $outlet->id }}">
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nama Outlet </label>
                                <div class="form-group col-sm-10">
                                    <input name="name" class="form-control" type="text" value="{{ $outlet->name }}">
                                </div>
                            </div>
                            <!-- end row -->


                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Nomor Telepon Outlet
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="mobile_no" class="form-control" type="number"
                                        value="{{ $outlet->mobile_no }}">
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Alamat Outlet
                                </label>
                                <div class="form-group col-sm-10">
                                    <input name="address" class="form-control" type="text"
                                        value="{{ $outlet->address }}">
                                </div>
                            </div>
                            <!-- end row -->



                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Outlet">
                        </form>



                    </div>
                </div>
            </div> <!-- end col -->
        </div>



    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                }, 
                 mobile_no: {
                    required : true,
                },
                 address: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please Enter Your Name',
                },
                mobile_no: {
                    required : 'Please Enter Your Mobile Number',
                },
                address: {
                    required : 'Please Enter Your Address',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>


@endsection