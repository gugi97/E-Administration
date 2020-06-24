@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Jenis Surat Keputusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/jenissk')}}">Surat Keputusan</a></li>
                        <li class="breadcrumb-item active">Tambah Jenis Surat Kepurusan</li>
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
                            <h3 class="card-title"><a href="/jenissk" class="btn btn-primary">Kembali</a></h3>
                            <h3 align="center">Tambah Data Jenis SK</h3>
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
                        <form role="form" method="post" action="{{ action('JenisSKController@store') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Jenis Surat Keputusan</label>
                                    <input type="text" class="form-control" placeholder="Jenis SK" name="jenissk" id="jenissk" value="{{ old('jenissk') }}">
                                </div>

                                <div class="form-group">
                                    <label>Nama Template Surat Keputusan</label>
                                    <input type="text" class="form-control" placeholder="Nama Template SK" name="namask" id="namask" value="{{ old('namask') }}">
                                </div>

                                <div class="form-group" style="margin-bottom: 0px !important;">
                                    <label>Template Surat Keputusan</label>
                                    <textarea id="templatesk" class="form-control" cols="30" rows="10" name="templatesk" id="templatesk" value="{{ old('templatesk') }}"></textarea>
                                </div>
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                        <a href="{{url('jenissk')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
                                    </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                    </div>
            </div>

            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
		    <script src="{{asset('ckeditor/custom.js')}}"></script>
            <script>
                CKEDITOR.replace( 'templatesk' );
            </script>
    </section>
{{-- End Add Modal --}}
@endsection
