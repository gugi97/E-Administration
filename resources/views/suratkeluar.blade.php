@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Surat Keluar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Surat Keluar</li>
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
                    <h3 class="card-title"><a href="/suratkeluar/tambah" class="btn btn-primary"> + Tambah Data</a></h3>
                    <h3 align="center">Data Surat Keluar</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Surat Keluar</th>
                                <th>Tgl. Surat Keluar</th>
                                <th>Lampiran</th>
                                <th>Perihal</th>
                                <th>Tujuan Surat</th>
                                <!-- <th>File</th> -->
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratkeluar as $ske)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ske->no_suratkeluar }}</td>
                                <td>{{ $ske->tgl_suratkeluar }}</td>
                                <td>{{ $ske->lampiran }}</td>
                                <td>{{ $ske->perihal }}</td>
                                <!-- <td><img width="150px" src="{{ url('uploads/suratkeluar/'.$ske->gambar) }}"></td> -->
                                <td>{{ $ske->tujuan_surat }}</td>
                                <td>
                                    <a href="suratkeluar/edit/{{ $ske->id_suratkeluar }}" class="btn btn-warning">Sunting</a>
                                    <a href="suratkeluar/hapus/{{ $ske->id_suratkeluar }}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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