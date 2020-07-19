@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Surat Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/suratmasuk')}}">Surat Masuk</a></li>
                        <li class="breadcrumb-item active">Tambah Surat Masuk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="min-height: 1135px;">
            <div class="container-fluid">
                    {{-- General Form Elements --}}
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header">
                            <h3 class="card-title"><a href="/suratmasuk" class="btn btn-primary">Kembali</a></h3>
                            <h3 align="center">Input Surat Masuk</h3>
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
                        <form role="form" method="post" action="{{url('suratmasuk/store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    {{-- TEST PENGGUNA --}}
                                <input type="hidden" value="{{$nip->nip}}" name="nip">
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
                                        @foreach ($alljabatan as  $ambil)
                                            <option value="{{$ambil->kode_unitinduk}}/{{$ambil->kode_unitsurat}}/{{$ambil->kode_jenjang}}">
                                                {{$ambil->kode_unitinduk}}/{{$ambil->kode_unitsurat}}/{{$ambil->kode_jenjang}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>No Urut</label>
                                    <input type="text" class="form-control" placeholder="Sesuai surat yang diterima" name="urut" value="{{$no_urut}}" id="urut">
                                </div>

                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select class="form-control" name="bulan" required>
                                        <option>--------</option>
                                        @for ($i = 01; $i <= 12; $i++)
                                            <option>{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="text" class="form-control" placeholder="Dua Digit Terakhir, ex : 2020(20)"  onkeypress="return angkaSaja(event)" name="tahun" value="{{ $date }}" id="tahun" maxlength="2">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Surat</label>
                                    <input type="date" class="form-control" name="tglsurat" id="tglsurat" value="{{ old('tglsurat') }}">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Terima</label>
                                    <input type="date" class="form-control" name="tglterima" id="tglterima" value="{{ old('tglterima') }}">
                                </div>

                                <div class="form-group">
                                    <label>Pengirim</label>
                                    <input type="text" class="form-control" placeholder="Pengirim" name="pengirim" id="pengirim" value="{{ old('pengirim') }}">
                                </div>

                                <div class="form-group">
                                    <label>Perihal</label>
                                    <input type="text" class="form-control" placeholder="Perihal" name="perihal" id="perihal" value="{{ old('perihal') }}">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" name="ket" id="ket" value="{{ old('ket') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Gambar</label>
                                    <div class="input-group control-group increment" >
                                        <input type="file" name="gambar[]" class="form-control" style="padding:3px;" id="gambar" multiple/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Upload File</label>
                                    <div class="input-group control-group increment" >
                                        <input type="file" name="file" class="form-control" style="padding:3px;" id="file"/>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                        <a href="{{url('suratmasuk/tambah')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
                                    </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                    </div>
                    {{-- End General Form --}}
            </div>
    </section>
    <!-- /.content -->
    <script>
        function angkaSaja(evt){
            var charCode=(evt.which) ? evt.which: event.keyCode;
            if(charCode>31 && (charCode<48 || charCode>57))
            return false;
            return true;
        }
    </script>
@endsection
