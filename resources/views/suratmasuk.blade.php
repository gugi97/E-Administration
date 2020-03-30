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
                            <h3 class="card-title">Input Surat Masuk</h3>
                        </div>
                        <!-- End Card Header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    {{-- TEST PENGGUNA --}}
                                    <input type="hidden" value="" name="nip">
                                    {{-- END TEST PENGGUNA --}}
                                    <label>Kode Jenis Surat</label>
                                    <select class="form-control" name="jenis" required>
                                        <option>--------</option>
                                        @foreach ($alljenis as  $ambil)
                                            <option value="{{$ambil->kode_jenissurat}}">{{$ambil->nama_jenissurat}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Kode Jenjang Jabatan</label>
                                    <select class="form-control" name="jabat" required>
                                        <option>--------</option>
                                        {{-- @foreach ($jabatan as  $ambil)
                                            <option value="{{$ambil->kd_unit}}/{{$ambil->kode_unitsurat}}/{{$ambil->kd_jenjang}}">
                                                {{$ambil->kd_unit}}/{{$ambil->kode_unitsurat}}/{{$ambil->kd_jenjang}}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>No Urut</label>
                                    <input type="text" class="form-control" placeholder="Sesuai surat yang diterima">
                                </div>

                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select class="form-control" name="bulan"required>
                                        <option>--------</option>
                                        @for ($i = 01; $i <= 12; $i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="text" class="form-control" placeholder="Dua Digit Terakhir, ex : 2020(20)" required name="tahun" value="" id="tahun">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Surat</label>
                                    <input type="date" class="form-control" required name="tglsurat" id="tglsurat">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Terima</label>
                                    <input type="date" class="form-control" required name="tglterima" id="tglterima">
                                </div>

                                <div class="form-group">
                                    <label>Pengirim</label>
                                    <input type="text" class="form-control" placeholder="Pengirim" required name="pengirim" id="pengirim">
                                </div>

                                <div class="form-group">
                                    <label>Perihal</label>
                                    <input type="text" class="form-control" placeholder="Perihal" required name="perihal" id="perihal">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" required name="ket" id="ket">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Scan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{url('/suratmasuk')}}" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                                    </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                    </div>
                    {{-- End General Form --}}
            </div>
    </section>
    <!-- /.content -->
@endsection
