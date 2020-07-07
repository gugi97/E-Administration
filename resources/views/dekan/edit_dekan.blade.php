@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Request Surat Keputusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/dekan')}}">Verifikasi SK Dekan</a></li>
                        <li class="breadcrumb-item active">Update Request Surat Keputusan</li>
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
                            <h3 class="card-title"><a href="/dekan" class="btn btn-primary">Kembali</a></h3>
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
                        @foreach($kaprodi as $kaprodi)
                        <form role="Insertform" action="{{ action('KaprodiController@update', $kaprodi->idreq) }}" method="post" id="editForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label>No Request</label>
                                    <input type="number" class="form-control" name="noreq" id="noreq" value="{{ $kaprodi->noreq }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>NIP Kaprodi</label>
                                    <input type="text" class="form-control" placeholder="NIP" name="nip" id="nip" value="{{ Auth::user()->nip }}" maxlength="9" disabled>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="exampleInputFile">Upload Tanda Tangan</label>
                                    <div class="input-group control-group increment" >
                                        <input type="file" class="form-control" style="padding:3px;" name="ttd" id="ttd" value="{{ $kaprodi->ttd }}">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label>Status Sk</label>
                                    <select class="form-control" name="statusreq" id="satatusreq" required>
                                        @if($kaprodi->statusreq == "Porposed")
                                            <option value="{{ $kaprodi->statusreq }}">{{$kaprodi->statusreq}}</option>
                                            <option value="Ditolak">Ditolak</option>
                                            <option value="Diterima">Diterima</option>
                                        @elseif($kaprodi->statusreq == "Ditolak")
                                            <option value="{{ $kaprodi->statusreq }}">{{$kaprodi->statusreq}}</option>
                                            <option value="Porposed">Porposed</option>
                                            <option value="Diterima">Diterima</option>
                                        @elseif($kaprodi->statusreq == "Diterima"){
                                            <option value="{{$kaprodi->statusreq}}">{{$kaprodi->statusreq}}</option>
                                            <option value="Porposed">Porposed</option>
                                            <option value="Ditolak">Ditolak</option>
                                        @endif
                                    </select>
                                </div>

                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                        <a href="{{url('kaprodi')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
                                    </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                        @endforeach
                    </div>
            </div>
            
    </section>
{{-- End Edit--}}
@endsection