@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Surat Keluar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/suratkeluar')}}">Surat Keluar</a></li>
                        <li class="breadcrumb-item active">Tambah Surat Keluar</li>
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
                    <h3 align="center">Input Surat Keluar</h3>
                </div>
                <!-- End Card Header -->
                <!-- Menampilkan error validasi -->
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Peringatan!</strong> Ada yang bermasalah dengan inputan anda.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Akhir Validasi -->
                <!-- form start -->
                <form role="form" method="post" action="{{url('suratkeluar/store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            {{-- TEST PENGGUNA --}}
                                <input type="hidden" value="{{$nip->nip}}" name="nip">
                            {{-- END TEST PENGGUNA --}}
                            <label>Kode Jenis Surat</label>
                            <select class="form-control" name="jenis" required>
                                <option value="">--------</option>
                                @foreach ($alljenis as  $ambil)
                                    <option value="{{ $ambil->kode_jenissurat }}">{{$ambil->nama_jenissurat}}</option>
                                @endforeach
                            </select>
                            <h1></h1>
                        </div>
                        <div class="form-group">
                            <label>Kode Jenjang Jabatan</label>
                            <select class="form-control" name="jabat" required>
                                <option value="">--------</option>
                                @foreach ($alljabatan as  $ambil)
                                    <option value="{{ $ambil->kode_unitinduk}}/{{$ambil->kode_unitsurat}}/{{$ambil->kode_jenjang }}">
                                        {{$ambil->kode_unitinduk}}/{{$ambil->kode_unitsurat}}/{{$ambil->kode_jenjang}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Urut</label>
                            <input type="text" class="form-control" placeholder="Sesuai surat yang diterima" name="urut" value="{{ $no_urut }}" id="urut">
                        </div>
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan" required>
                                <option value="">--------</option>
                                @for ($i = 01; $i <= 12; $i++)
                                    <option>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" class="form-control" placeholder="Dua Digit Terakhir, ex : 2020(20)" name="tahun" value="{{ old('tahun') }}" id="tahun" maxlength="2">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat Keluar</label>
                            <input type="date" name="tgl_suratkeluar" id="tgl_suratkeluar" class="form-control" value="{{ old('tgl_suratkeluar') }}">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" placeholder="Perihal" name="perihal" value="{{ old('perihal') }}" id="perihal">
                        </div>
                        <div class="form-group">
                            <label>Lampiran</label>
                            <input type="text" class="form-control" placeholder="Lampiran" name="lampiran" value="{{ old('lampiran') }}" id="lampiran" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" name="tujuan_surat" class="form-control" value="{{ old('tujuan_surat') }}" placeholder="Tujuan Surat">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}" placeholder="Keterangan">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Gambar</label>
                            <div class="input-group control-group increment" >
                                <input type="file" name="gambar[]" class="form-control" style="padding:3px;" id="gambar" multiple/>
                            </div>
                        </div>
                        </div>
                    </div>
                <div class="card-footer">
                    <div class="row">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                        <a href="{{url('suratkeluar/tambah')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <!-- Footer -->
        <!-- End Footer -->
    {{-- End General Form --}}
    </section>
    <!-- /.content -->
@endsection