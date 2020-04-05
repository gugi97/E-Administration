@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Surat Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Surat Masuk</li>
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
                    <h3 class="card-title"><a href="/suratmasuk/tambah" class="btn btn-primary"> + Tambah Data</a></h3>
                    <h3 align="center">Data Surat Masuk</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Tanggal Terima</th>
                                <th>Pengirim</th>
                                <th>Perihal</th>
                                <th>Keterangan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratmasuk as $sms)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sms->no_surat }}</td>
                                <td>{{ $sms->tgl_surat }}</td>
                                <td>{{ $sms->tgl_terima }}</td>
                                <td>{{ $sms->pengirim }}</td>
                                <td>{{ $sms->perihal }}</td>
                                <td>{{ $sms->keterangan }}</td>
                                <td>
                                    <a href="suratmasuk/edit/{{ $sms->id_suratmasuk }}" class="btn btn-warning">Sunting</a>
                                    <a href="suratmasuk/hapus/{{ $sms->id_suratmasuk }}" class="btn btn-danger">Hapus</a>
                                </td>
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
