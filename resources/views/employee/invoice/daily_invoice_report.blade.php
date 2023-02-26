@extends('employee.employee_master')
@section('employee')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Laporan Mutasi Stok Keluar </h4><br><br>

                            <form method="GET" action="{{ route('employee.daily.invoice.pdf') }}" target="_blank"
                                id="myForm">
                                <div class="row">



                                    <div class="col-md-4">
                                        <div class="md-3 form-group">
                                            <label for="example-text-input" class="form-label">Tanggal Awal</label>
                                            <input class="form-control example-date-input" name="start_date" type="date"
                                                id="start_date" placeholder="YY-MM-DD">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="md-3 form-group">
                                            <label for="example-text-input" class="form-label">Tanggal Akhir</label>
                                            <input class="form-control example-date-input" name="end_date" type="date"
                                                id="end_date" placeholder="YY-MM-DD">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label" style="margin-top:43px;">
                                            </label>
                                            <button type="submit" class="btn btn-info">Search</button>
                                        </div>
                                    </div>



                                </div> <!-- // end row  -->

                            </form>

                        </div> <!-- End card-body -->



                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },

                },
                messages: {
                    start_date: {
                        required: 'Pilih Tanggal Awal Dahulu',
                    },
                    end_date: {
                        required: 'Pilih Tanggal Akhir Dahulu',
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
