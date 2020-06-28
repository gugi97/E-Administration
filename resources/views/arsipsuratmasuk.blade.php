@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Arsip Surat Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Arsip Surat Masuk</li>
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
                    <h3 align="center">Arsip Data Surat Masuk</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                <table class="table table-bordered table-hover table-striped" >
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>No. Surat Masuk</th>
                            <th>Tgl. Surat Masuk</th>
                            <th colspan="3">Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arsipsuratmasuk as $sms)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sms->no_surat }}</td>
                            <td>{{ $sms->tgl_surat }}</td>
                                <?php if($sms->gambar != null){
                                ?>
                                @php $allImages = explode(',', $sms->gambar); @endphp
                                @foreach($allImages as $Image)
                                    <td align="center">
                                        <a class="image-popup-vertical-fit" href="/{{$sms->lokasi}}/{{$Image}}">
                                            <img width="150px" src="/{{$sms->lokasi}}/{{$Image}}">
                                        </a>
                                    </td>
                                @endforeach
                                <?php
                                }else{
                                ?>
                                    <td>Gambar Tidak Ada</td>
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