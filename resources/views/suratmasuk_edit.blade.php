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
                    <h3 class="card-title"><a href="/suratmasuk" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a></h3>
                    <h3 align="center">Edit Surat Masuk</h3>
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
                @foreach($suratmasuk as $sms)
                <form role="form" method="post" action="{{url('suratmasuk/update')}}/{{$sms->id_suratmasuk}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nomor Surat Masuk</label>
                            <input type="text" name="no_surat" class="form-control" placeholder="Nomor Surat" value="{{ $sms->no_surat }}" disabled>
                            @if($errors->has('no_surat'))
                            <div class="text-danger">
                                {{ $errors->first('no_surat')}}
                            </div>
                            @endif
                        </div>
                
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" name="tglsurat" id="tglsurat" value="{{ $sms->tgl_surat }}">
                        </div>
                
                        <div class="form-group">
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" name="tglterima" id="tglterima" value="{{ $sms->tgl_terima }}">
                        </div>
                
                        <div class="form-group">
                            <label>Pengirim</label>
                            <input type="text" class="form-control"  name="pengirim" id="pengirim" value="{{ $sms->pengirim }}">
                        </div>
                
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control"  name="perihal" id="perihal" value="{{ $sms->perihal }}">
                        </div>
                
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control"  name="ket" id="ket" value="{{ $sms->keterangan }}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Edit Gambar</label>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <?php if($sms->gambar != null){
                                    ?>
                                        @php $allImages = explode(',', $sms->gambar); @endphp
                                        @foreach($allImages as $Image)
                                        <input type="hidden" name="hidden_name[]" value="{{ $Image }}" multiple/>
                                        <td align="center">
                                            <a class="image-popup-vertical-fit" href="/{{$sms->lokasi}}/{{$Image}}">
                                                <img width="150px" src="/{{$sms->lokasi}}/{{$Image}}">
                                            </a>
                                        </td>
                                        @endforeach
                                    <?php
                                    }else{
                                    ?>
                                        <td align="center" style="padding-top:35px">
                                            <p>Gambar Tidak Ada</p>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <td style="vertical-align:middle">
                                    <div class="input-group">
                                        <label for="exampleInputFile">Update Gambar</label>
                                        <div class="input-group control-group increment">
                                        <input type="file" name="gambarbaru[]" class="form-control" style="padding:3px;" id="gambarbaru" multiple/>
                                        <input type="hidden" name="hidden_tujuan" value="{{ $sms->lokasi }}" />
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Edit File</label>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <?php if($sms->file != null){
                                    ?>
                                        <input type="hidden" name="hidden_namefile" value="{{ $sms->file }}"/>
                                        <td align="center">
                                            <p>File Tersimpan di {{$sms->lokasifile}}/{{$sms->file}}</p>
                                        </td>
                                    <?php
                                    }else{
                                    ?>
                                        <td align="center" style="padding-top:35px">
                                            <p>File Tidak Ada</p>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <td style="vertical-align:middle">
                                    <div class="input-group">
                                        <label for="exampleInputFile">Update File</label>
                                        <div class="input-group control-group increment">
                                        <input type="file" name="filebaru" class="form-control" style="padding:3px;" id="filebaru"/>
                                        <input type="hidden" name="hidden_tujuanfile" value="{{ $sms->lokasifile }}" />
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
                                <a href="{{url('suratmasuk')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
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
