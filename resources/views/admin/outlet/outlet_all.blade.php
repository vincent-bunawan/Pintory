@extends('admin.admin_master2')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-center">
                        <h1 class="mb-5 fw-bold">Pilih Outlet</h1>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{ route('admin.outlet.first.add') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light" style="float:right;"><i
                                    class="fa fa-plus"></i> &nbsp;Tambah Outlet </a> <br> <br>

                            <h4 class="card-title"> Semua Outlet </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Outlet</th>
                                        <th>Nomor Handphone</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                </thead>


                                <tbody>
                                    @php
                                        function hp($nohp)
                                        {
                                            $nohp = str_replace(' ', '', $nohp);
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace('(', '', $nohp);
                                            // kadang ada penulisan no hp (0274) 778787
                                            $nohp = str_replace(')', '', $nohp);
                                            // kadang ada penulisan no hp 0811.239.345
                                            $nohp = str_replace('.', '', $nohp);
                                            if (!preg_match('/[^+0-9]/', trim($nohp))) {
                                                // cek apakah no hp karakter 1-3 adalah +62
                                                if (substr(trim($nohp), 0, 3) == '+62') {
                                                    $hp = trim($nohp);
                                                }
                                                // cek apakah no hp karakter 1 adalah 0
                                                elseif (substr(trim($nohp), 0, 1) == '0') {
                                                    $hp = '+62' . substr(trim($nohp), 1);
                                                }
                                            }
                                            return $hp;
                                        }
                                    @endphp
                                    @foreach ($outlets as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->name }} </td>
                                            <td>{{ $item->mobile_no }}
                                                {{-- <a href="https://wa.me/{{ hp($item->mobile_no) }}"><i
                                                class="ri-whatsapp-fill" style="color: #2FCC71;"></i></a> --}}
                                            </td>
                                            {{-- <td> {{ $item->email }} </td> --}}
                                            <td> {{ $item->address }} </td>
                                            <td>
                                                <a href="https://wa.me/{{ hp($item->mobile_no) }}"><i
                                                        class="btn ri-whatsapp-fill ri-2x" style="color: #2FCC71;"></i></a>
                                                <a href="{{ route('admin.outlet.edit', $item->id) }}"
                                                    class="btn btn-info sm" title="Edit Data"> <i class="fas fa-edit"></i>
                                                </a>
                                                {{-- <a href="{{ route('admin.outlet.delete',$item->id) }}"
                                            class="btn btn-danger sm" title="Delete Data" id="delete"> <i
                                                class="fas fa-trash-alt"></i> </a> --}}
                                                <a href="{{ route('admin.outlet.choose', $item->id) }}"
                                                    class="btn btn-success sm">Pilih
                                                    Outlet</a>
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
