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
                        @foreach($dekan as $dekan)
                        <form role="Insertform" action="{{ action('DekanController@update', $dekan->id_dekan) }}" method="post" id="editForm" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <label>No Request</label>
                                    <input type="text" class="form-control" name="noreq_dekan" id="noreq_dekan" value="{{ $dekan->noreq_dekan }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>NIP Dekan</label>
                                    <input type="text" class="form-control" placeholder="NIP" name="nip_dekan" id="nip_dekan" value="{{ Auth::user()->nip }}" maxlength="9" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Status Sk</label>
                                    <select class="form-control" name="statusreq_dekan" id="statusreq_dekan" required>
                                        @if($dekan->statusreq_dekan == "Menunggu Persetujuan")
                                            <option value="{{ $dekan->statusreq_dekan }}">{{$dekan->statusreq_dekan}}</option>
                                            <option value="Disetujui">Disetujui</option>
                                            <option value="Tidak Disetujui">Tidak Disetujui</option>
                                        @elseif($dekan->statusreq_dekan == "Disetujui")
                                            <option value="{{ $dekan->statusreq_dekan }}">{{$dekan->statusreq_dekan}}</option>
                                            <option value="Tidak Disetujui">Tidak Disetujui</option>
                                        @elseif($dekan->statusreq_dekan == "Tidak Disetujui")
                                            <option value="{{ $dekan->statusreq_dekan }}">{{$dekan->statusreq_dekan}}</option>
                                            <option value="Disetujui">Disetujui</option>
                                        @endif
                                    </select>
                                </div>

                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                        <a href="{{url('dekan')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
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