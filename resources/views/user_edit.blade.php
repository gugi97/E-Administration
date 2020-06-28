@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/suratkeluar')}}">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                    <h3 class="card-title"><a href="/user" class="btn btn-primary">Kembali</a></h3>
                    <h3 align="center">Edit User</h3>
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
                @foreach($user as $usr)
                <form role="form" method="post" action="{{url('user/update')}}/{{$usr->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ $usr->nip }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $usr->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email User</label>
                            <input type="email" class="form-control"  name="email" id="email" value="{{ $usr->email }}" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control"  name="password" id="password" value="{{ $usr->password }}" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <?php if($usr->status == "Karyawan"){
                                ?>
                                    <option value="{{$usr->status}}">{{$usr->status}}</option>
                                    <option value="Ketua Program Studi">Ketua Program Studi</option>
                                    <option value="Dekan">Dekan</option>
                                <?php
                                }else if($usr->status == "Ketua Program Studi"){
                                ?>
                                    <option value="{{$usr->status}}">{{$usr->status}}</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Dekan">Dekan</option>
                                <?php
                                }else if($usr->status == "Dekan"){
                                ?>
                                    <option value="{{$usr->status}}">{{$usr->status}}</option>
                                    <option value="Karyawan">Karyawan</option>
                                    <option value="Ketua Program Studi">Ketua Program Studi</option>
                                <?php
                                }
                                ?> 
                            </select>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="card-footer">
                        <div class="row">
                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                <a href="{{url('user')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
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
        @php $allImages = explode(',', $usr->gambar); @endphp
        @foreach($allImages as $Image)
        <input type="hidden" name="hidden_name[]" value="{{ $Image }}" multiple/>
        <td align="center">
            <a class="image-popup-vertical-fit" href="/{{$usr->lokasi}}/{{$Image}}">
                <img width="150px" src="/{{$usr->lokasi}}/{{$Image}}">
            </a>
        </td>
        @endforeach
        <td style="vertical-align:middle">
        <div class="input-group">
            <label for="exampleInputFile">Update Gambar</label>
            <div class="input-group control-group increment">
            <input type="file" name="gambarbaru[]" class="form-control" style="padding:3px;" id="gambarbaru" multiple/>
            <input type="hidden" name="hidden_tujuan" value="{{ $usr->lokasi }}" />
            </div>
        </div>
        </td>
    </tr>
</table>
Akhir-->