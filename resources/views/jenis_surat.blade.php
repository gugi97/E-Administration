@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jenis Surat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jenis Surat</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{-- General Form Elements --}}
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title">Input Jenis Surat</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <form role="Insertform" method="post" action="{{url('jenissurat/insert')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Kode Jenis</label>
                            <input type="text" class="form-control" placeholder="Kode Jenis Surat" name="kdjns" value="" id="kdjns" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Jenis</label>
                            <input type="text" class="form-control" placeholder="Nama Jenis Surat" name="namajns" value="" id="namajns" required>
                        </div>
                        <div class="form-actions">
                            <center>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('jenissurat')}}" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                            </center>
                        </div>
                    </form>
                    <br>
                    
                    <div>
                        <table class="table table-bordered table-hover table-striped" id="dataTable1">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No</th>
                                    <th>Kode Jenis</th>
                                    <th>Nama Jenis</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inputjenis as $ambil)
                                    <tr style="text-align: center;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ambil->kode_jenissurat }}</td>
                                        <td>{{ $ambil->nama_jenissurat }}</td>
                                        <td width="20px;"><a href="#edit-data{{$ambil->kode_jenissurat}}" data-toggle="modal" class="btn btn-warning">Edit</a></td>
                                        <td width="20px;"><a href="jenissurat/hapus/{{ $ambil->kode_jenissurat }}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @foreach ($inputjenis as $ambil) 
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                    id="edit-data{{$ambil->kode_jenissurat}}" width="75%" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Ubah Data</h4>
                            </div>
                            <form class="form-horizontal" action="{{url('jenissurat/edit')}}/{{$ambil->kode_jenissurat}}"
                                method="post" enctype="multipart/form-data" role="form">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-sm-1">Kode Jenis Surat</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="jenjang" name="kode" placeholder="Kode Jenis Surat" value="{{$ambil->kode_jenissurat}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 col-sm-1">Nama Jenis Surat</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Jenis Surat"
                                                value="{{$ambil->nama_jenissurat}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Footer -->
                <div class="card-footer">

                </div>
                <!-- End Footer -->
            </div>
            {{-- End General Form --}}
        </div>
    </section>
    <!-- /.content -->
@endsection
