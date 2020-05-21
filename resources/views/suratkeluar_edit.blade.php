@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Surat Keluar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/suratkeluar')}}">Surat Keluar</a></li>
                        <li class="breadcrumb-item active">Edit Surat Keluar</li>
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
                    <h3 class="card-title"><a href="/suratkeluar" class="btn btn-primary">Kembali</a></h3>
                    <h3 align="center">Edit Surat Keluar</h3>
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
                @foreach($suratkeluar as $ske)
                <form role="form" method="post" action="{{url('suratkeluar/update')}}/{{$ske->id_suratkeluar}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Surat Keluar</label>
                            <input type="text" name="no_suratkeluar" class="form-control" value="{{ $ske->no_suratkeluar }}" disabled>
                            @if($errors->has('no_suratkeluar'))
                            <div class="text-danger">
                                {{ $errors->first('no_suratkeluar')}}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat Keluar</label>
                            <input type="date" class="form-control" name="tgl_suratkeluar" id="tgl_suratkeluar" value="{{ $ske->tgl_suratkeluar }}">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control"  name="perihal" id="perihal" value="{{ $ske->perihal }}">
                        </div>
                        <div class="form-group">
                            <label>Lampiran</label>
                            <input type="text" class="form-control"  name="lampiran" id="lampiran" value="{{ $ske->lampiran }}" maxlength="10">
                        </div>
                        <div class="form-group">
                            <label>Tujuan Surat</label>
                            <input type="text" name="tujuan_surat" class="form-control"  value="{{ $ske->tujuan_surat }}">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control"  value="{{ $ske->keterangan }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Edit Gambar</label>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    @php $allImages = explode(',', $ske->gambar); @endphp
                                    @foreach($allImages as $Image)
                                    <input type="hidden" name="hidden_name[]" value="{{ $Image }}" multiple/>
                                    <td align="center">
                                        <a class="image-popup-vertical-fit" href="/{{$ske->lokasi}}/{{$Image}}">
                                            <img width="150px" src="/{{$ske->lokasi}}/{{$Image}}">
                                        </a>
                                    </td>
                                    @endforeach
                                    <td style="vertical-align:middle">
                                    <div class="input-group">
                                        <label for="exampleInputFile">Update Gambar</label>
                                        <div class="input-group control-group increment">
                                        <input type="file" name="gambarbaru[]" class="form-control" style="padding:3px;" id="gambarbaru" multiple/>
                                        <input type="hidden" name="hidden_tujuan" value="{{ $ske->lokasi }}" />
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="card-footer">
                        <div class="row">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                <a href="{{url('suratkeluar')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
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




























<!--Backup Upload Image
<table class="table table-bordered table-striped">
    <tr>
        @php $allImages = explode(',', $ske->gambar); @endphp
        @foreach($allImages as $Image)
        <input type="hidden" name="hidden_name[]" value="{{ $Image }}" multiple/>
        <td align="center">
            <a class="image-popup-vertical-fit" href="/{{$ske->lokasi}}/{{$Image}}">
                <img width="150px" src="/{{$ske->lokasi}}/{{$Image}}">
            </a>
        </td>
        @endforeach
        <td style="vertical-align:middle">
        <div class="input-group">
            <label for="exampleInputFile">Update Gambar</label>
            <div class="input-group control-group increment">
            <input type="file" name="gambarbaru[]" class="form-control" style="padding:3px;" id="gambarbaru" multiple/>
            <input type="hidden" name="hidden_tujuan" value="{{ $ske->lokasi }}" />
            </div>
        </div>
        </td>
    </tr>
</table>
Akhir-->