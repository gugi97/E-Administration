@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Surat Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/suratmasuk')}}">Surat Masuk</a></li>
                        <li class="breadcrumb-item active">Edit Surat Masuk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="min-height: 800px;">
        <div class="container-fluid">
            {{-- General Form Elements --}}
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title"><a href="/suratmasuk" class="btn btn-primary">Kembali</a></h3>
                    <h3 align="center">Edit Surat Masuk</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                @foreach($suratmasuk as $sms)
                <form role="form" method="post" action="{{url('suratmasuk/update')}}/{{$sms->id_suratmasuk}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_surat" class="form-control" placeholder="Nomor Surat" value="{{ $sms->no_surat }}" disabled>
                            @if($errors->has('no_surat'))
                            <div class="text-danger">
                                {{ $errors->first('no_surat')}}
                            </div>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" required name="tglsurat" id="tglsurat" value="{{ $sms->tgl_surat }}">
                        </div>
                
                        <div class="form-group">
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" required name="tglterima" id="tglterima" value="{{ $sms->tgl_terima }}">
                        </div>
                
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" class="form-control" placeholder="Pengirim" required name="pengirim" id="pengirim" value="{{ $sms->pengirim }}">
                        </div>
                
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" placeholder="Perihal" required name="perihal" id="perihal" value="{{ $sms->perihal }}">
                        </div>
                
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" placeholder="Keterangan" required name="ket" id="ket" value="{{ $sms->keterangan }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Upload Scan</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile" value="{{ $sms->gambar }}">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Footer -->
                        <div class="card-footer">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{url('suratmasuk')}}" class="btn btn-danger" style="margin-left: 20px;">Batal</a>
                                </div>
                        </div>
                        <!-- End Footer -->
                </form>
                    @endforeach
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection
