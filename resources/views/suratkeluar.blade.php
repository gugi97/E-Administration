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
                                <th>No.Agenda</th>
                                <th>Kode Klasifikasi</th>
                                <th>Isi Ringkas</th>
                                <th>File</th>
                                <th>Tujuan</th>
                                <th>No.Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suratkeluar as $ske)
                            <tr>
                                <td>{{ $ske->no_agenda }}</td>
                                <td>{{ $ske->kode_klasifikasi }}</td>
                                <td>{{ $ske->isi }}</td>
                                <td>{{ $ske->file }}</td>
                                <td>{{ $ske->tujuan }}</td>
                                <td>{{ $ske->no_suratkeluar }}</td>
                                <td>{{ $ske->tgl_surat }}</td>
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