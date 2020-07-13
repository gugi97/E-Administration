@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="callout callout-info">
            <h5 style="margin-bottom: 0px;">Selamat Datang <b>{{Auth::user()->name}}</b></h5>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header" style="text-align: center;">
                <h3>Jumlah Data Transaksi Surat</h3>
            </div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                
                <div class="row">
                    @if(auth()->user()->status == 'Admin' OR auth()->user()->status == 'Staf')
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$sm_count}}</h3>

                                <p>Surat Masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <a href="suratmasuk" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$sk_count}}</h3>

                                <p>Surat Keluar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="suratkeluar" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$skep_count}}</h3>

                                <p>Surat Keputusan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="suratkeputusan" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(auth()->user()->status == 'Admin')
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box" style="color: white !important; background-color: #FFC107;">
                            <div class="inner">
                                <h3>{{$user_count}}</h3>
                                <p>User</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="user" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    @if(auth()->user()->status == 'Dosen')
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$req_count}}</h3>

                                <p>Request Surat</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="dosenrequest" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$req_selesai}}</h3>

                                <p>Request Selesai</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <a href="dosenrequest" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box" style="color: white !important; background-color: #FFC107;">
                            <div class="inner">
                                <h3>{{$req_proses}}</h3>
                                <p>Request Diproses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pen-square"></i>
                            </div>
                            <a href="dosenrequest" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$req_tolak}}</h3>

                                <p>Request Ditolak</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="dosenrequest" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- -------------KAPRODI------------ -->
                    @if(auth()->user()->status == 'Ketua Program Studi')
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$req_kapreq}}</h3>
                                <p>Request Verifikasi SK</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="kaprodi" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$req_kapreq_terima}}</h3>
                                <p>SK Diterima</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <a href="kaprodi" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box" style="color: white !important; background-color: #FFC107;">
                            <div class="inner">
                                <h3>{{$req_kapreq_prop}}</h3>
                                <p>SK Proposed</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pen-square"></i>
                            </div>
                            <a href="kaprodi" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$req_kapreq_tolak}}</h3>
                                <p>SK Ditolak</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="kaprodi" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                    <!-- -------------END KAPRODI------------ -->

                    <!-- -------------DEKAN------------ -->
                    @if(auth()->user()->status == 'Dekan')
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$req_dekreq}}</h3>
                                <p>Request Persetujuan SK</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="dekan" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$req_dekreq_terima}}</h3>
                                <p>SK Disetujui</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <a href="dekan" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box" style="color: white !important; background-color: #FFC107;">
                            <div class="inner">
                                <h3>{{$req_dekreq_prop}}</h3>
                                <p>SK Proposed</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pen-square"></i>
                            </div>
                            <a href="dekan" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$req_dekreq_tolak}}</h3>
                                <p>SK Tidak Disetujui</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <a href="dekan" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                    <!-- -------------END DEKAN------------ -->

                    @if(auth()->user()->status == 'Staf')
                    <div class="col-lg-3 col-6">
                        <!-- small card -->
                        <div class="small-box" style="color: white !important; background-color: #FFC107;">
                            <div class="inner">
                                <h3>{{$req_count}}</h3>
                                <p>Request Surat</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="requestsurat" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card-footer">
                
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection