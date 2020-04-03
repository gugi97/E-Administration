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
                    <h3 class="card-title"><a href="/suratkeluar" class="btn btn-primary">Kembali</a></h3>
                    <h3 align="center">Tambah Data Surat Keluar</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                <div class="card-body">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                        @endforeach
                    </div>
                    @endif
                    <form method="post" action="/suratkeluar/store" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <?php
                                $dbhost = 'localhost'; 
                                $dbuser = 'root';     // ini berlaku di xampp
                                $dbpass = '';         // ini berlaku di xampp
                                $dbname = 'db_efilling';
                                $connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
                                //mengambil no agenda terbesar dari table suratkeluar
                                $query = mysqli_query($connect,"SELECT MAX(no_agenda) AS no_agenda FROM suratkeluar");
                                $suratkeluar = mysqli_fetch_array($query); //pecah data ke dalam array
                                $kodebaru = $suratkeluar['no_agenda']+1; //kode max ditambah 1 agar jadi kode baru
                            ?>
                            <label>Nomor Agenda</label>
                            <input type="number" name="no_agenda" class="form-control" value="<?php echo $kodebaru?>">
                            @if($errors->has('no_agenda'))
                                <div class="text-danger">
                                    {{ $errors->first('no_agenda')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Kode_Klasifikasi</label>
                            <input type="text" name="kode_klasifikasi" class="form-control" placeholder="Kode Klasifikasi">
                            @if($errors->has('kode_klasifikasi'))
                                <div class="text-danger">
                                    {{ $errors->first('kode_klasifikasi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" class="form-control" placeholder="Isi Surat"></textarea>
                            @if($errors->has('isi'))
                                <div class="text-danger">
                                    {{ $errors->first('isi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" name="tujuan" class="form-control" placeholder="Tujuan">
                            @if($errors->has('tujuan'))
                                <div class="text-danger">
                                    {{ $errors->first('tujuan')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_suratkeluar" class="form-control" placeholder="Nomor Surat">
                            @if($errors->has('no_suratkeluar'))
                                <div class="text-danger">
                                    {{ $errors->first('no_suratkeluar')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" name="tgl_surat" id="tgl_surat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Input Surat</label>
                            <input type="date" name="tgl_catat" id="tgl_catat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Upload File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                            @if($errors->has('keterangan'))
                                <div class="text-danger">
                                    {{ $errors->first('keterangan')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" value="Simpan">Submit</button>
                            <a href="{{url('/suratkeluar/tambah')}}" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="card-footer">
        </div>
        <!-- End Footer -->
    {{-- End General Form --}}
    </section>
    <!-- /.content -->
@endsection