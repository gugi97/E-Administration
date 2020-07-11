@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buku Agenda Surat Keputusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Buku Agenda Surat Keputusan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{-- General Form Elements --}}
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                @if($orders != null)
                    <h3 class="card-title"><a href="/agendasuratkeputusan" class="btn btn-primary"><i class="fas fa-sync-alt"></i> Refresh Data</a></h3>
                @endif
                    <h3 align="center">Buku Agenda Surat Keputusan</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                <form role="form" method="get" action="{{url('agendasuratkeputusan/pencarian')}}">
                    @if($orders == null)
                    <table class="table table-bordered table-hover table-striped" >
                        <thead>
                            <tr align="center">
                                <th>Dari Tanggal</th>
                                <th>-</th>
                                <th>Sampai Dengan Tanggal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="date" name="dari_tgl" id="dari_tgl" class="form-control" value="{{ old('dari_tgl') }}">
                                </td>
                                <td align="center" style="padding-top:20px">-</td>
                                <td>
                                    <input type="date" name="sampai_tgl" id="sampai_tgl" class="form-control" value="{{ old('sampai_tgl') }}">
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary form-control">Cari</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </form>
                
                @if($orders != null)
                <table class="table table-bordered table-hover table-striped" >
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Nomor Surat Keputusan</th>
                            <th>Tanggal Surat</th>
                            <th>Tentang Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($test != "0")
                        @foreach($orders as $ord)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ord->nosk }}</td>
                                <td>{{ $ord->tglsk }}</td>
                                <td>{{ $ord->tentangsk }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" align="center">Data Tidak Ada / Data Tidak Ditemukan</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <form role="form" method="get" action="{{url('agendasuratkeputusan_pdf')}}" align='center'>
                    <input type="hidden" name="dari_tgl2" id="dari_tgl2" class="form-control" value="{{ $dari_tgl }}">
                    <input type="hidden" name="sampai_tgl2" id="sampai_tgl2" class="form-control" value="{{ $sampai_tgl }}">
                    @if($test != "0")
                        <button type="submit" class="btn btn-primary" align="center" style="margin-bottom:20px;"><i class="far fa-file-pdf"></i> Cetak PDF</button>
                    @endif
                </form>
                @endif
                
                <!-- Footer -->
                <div class="card-footer">
                    <div class="row small text-muted">
                        Last Updated at  <?php date_default_timezone_set("Asia/Jakarta"); echo date("h:i:s a")?>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
            {{-- End General Form --}}
        </div>
    </section>
    <!-- /.content -->
@endsection