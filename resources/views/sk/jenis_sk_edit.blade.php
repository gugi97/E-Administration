@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data Jenis Surat Keputusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/jenissk')}}">Jenis Surat Keputusan</a></li>
                        <li class="breadcrumb-item active">Edit Jenis Surat Kepurusan</li>
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
                            <h3 align="center">Edit Data Jenis SK</h3>
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
                        @foreach($jenis as $jenissk)
                        <form role="Insertform" action="{{ action('JenisSKController@update', $jenissk->idjenis_sk) }}" method="post" id="editForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label>Id SK</label>
                                    <input type="number" class="form-control" name="idsk" id="idsk" value="{{ $jenissk->idjenis_sk }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Jenis Surat Keputusan</label>
                                    <input type="text" class="form-control" placeholder="Jenis SK" name="jenissk" id="jenissk" value="{{ $jenissk->jenis_sk }}">
                                </div>

                                <div class="form-group">
                                    <label>Nama Template Surat Keputusan</label>
                                    <input type="text" class="form-control" placeholder="Nama Template SK" name="namask" id="namask" value="{{ $jenissk->nama_template }}">
                                </div>

                                <div class="form-group" style="margin-bottom: 0px !important;">
                                    <label>Template Surat Keputusan</label>
                                    <?php
                                        $data = str_replace( '&', '&amp;', $jenissk->template );
                                    ?>
                                    <textarea id="templatesk" class="form-control" cols="30" rows="10" name="templatesk" id="templatesk"><?= $data ?></textarea>
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
                        @endforeach
                    </div>
            </div>

            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
		    <script src="{{asset('ckeditor/ckeditor_conf.js')}}"></script>
            <script>
                CKEDITOR.replace( 'templatesk' );
            </script>
    </section>
{{-- End Edit--}}
@endsection
