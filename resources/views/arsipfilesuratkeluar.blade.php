@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Arsip File Surat Keluar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Arsip File Surat Keluar</li>
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
                    <h3 align="center">Arsip File Surat Keluar</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                <table class="table table-bordered table-hover table-striped" >
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>No. Surat Keluar</th>
                            <th>Tgl. Surat Keluar</th>
                            <th >File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arsipfilesuratkeluar as $ske)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ske->no_suratkeluar }}</td>
                            <td>{{ $ske->tgl_suratkeluar }}</td>
                            <?php if($ske->file != null){
                            ?>
                                <td>File Tersimpan di {{$ske->lokasifile}}/{{$ske->file}}</td>
                            <?php
                            }else{
                            ?>
                                <td>File Tidak Ada</td>
                            <?php
                            }
                            ?>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Footer -->
                <div class="card-footer">
                    <div class="row small text-muted">
                        Last Updated at  <?php date_default_timezone_set("Asia/Jakarta"); echo date("h:i:s a")?>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
            {{-- End General Form --}}
        </div>
    </section>
    <!-- /.content -->
@endsection