@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Surat Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Surat Masuk</li>
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
                            <h3 class="card-title">Input Surat Masuk</h3>
                        </div>
                        <!-- End Card Header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kode Jenis Surat</label>
                                    <select class="form-control">
                                        <option>--------</option>
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kode Jenjang Jabatan</label>
                                    <select class="form-control">
                                        <option>--------</option>
                                        <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No Urut</label>
                                    <input type="text" class="form-control" placeholder="Sesuai surat yang diterima">
                                </div>
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select class="form-control">
                                        <option>--------</option>
                                        <option>01</option>
                                        <option>02</option>
                                        <option>03</option>
                                        <option>04</option>
                                        <option>05</option>
                                        <option>06</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="text" class="form-control" placeholder="Dua Digit Terakhir, ex : 2020(20)" required="" name="tahun" value="" id="tahun">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat</label>
                                    <input type="date" class="form-control" required="" name="tglsurat" id="tglsurat">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Terima</label>
                                    <input type="date" class="form-control" required="" name="tglterima" id="tglterima">
                                </div>
                                <div class="form-group">
                                    <label>Pengirim</label>
                                    <input type="text" class="form-control" placeholder="Pengirim" required="" name="pengirim" id="pengirim">
                                </div>
                                <div class="form-group">
                                    <label>Perihal</label>
                                    <input type="text" class="form-control" placeholder="Perihal" required="" name="perihal" id="perihal">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control" placeholder="Keterangan" required="" name="ket" id="ket">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Scan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{url('/suratmasuk')}}" class="btn btn-danger" style="margin-left: 20px;">Cancel</a>
                                    </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                    </div>
                    {{-- End General Form --}}

                    {{-- <!-- BEGIN PAGE CONTAINER -->
                    <div class="page-container">
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="card col-md-8">
                                <!-- BEGIN Portlet PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <form role="Insertform"
                                                action=""
                                                enctype="multipart/form-data" method="post">
                                                <div class="form-body">

                                                    <div class="form-group">
                                                        <input type="hidden" value="" name="nip">
                                                        <label>Kode Jenis Surat</label>
                                                        <select name="jenis" class="form-control" required>
                                                            <option value="">----</option>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Kode Jenjang Jabatan</label>
                                                        <select name="jabat" class="form-control" required>
                                                            <option value="">------</option>
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <div class="col-md-4">
                                                                <label>No Urut</label>
                                                                <input type="text" placeholder="Sesuai Surat yang diterima" required
                                                                    class="form-control" name="urut" value="" id="urut">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Bulan</label>
                                                                <select name="bulan" class="form-control" required>
                                                                    <option value="">----</option>
                                                                    <option value="01">01</option>
                                                                    <option value="02">02</option>
                                                                    <option value="03">03</option>
                                                                    <option value="04">04</option>
                                                                    <option value="05">05</option>
                                                                    <option value="06">06</option>
                                                                    <option value="07">07</option>
                                                                    <option value="08">08</option>
                                                                    <option value="09">09</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Tahun</label>
                                                                <input type="text" placeholder="dua digit terakhir, ex : 2018(18)"
                                                                    required class="form-control" name="tahun" value="" id="tahun">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Tanggal Surat</label>
                                                        <input type="date" class="form-control" placeholder="tglsurat" required
                                                            name="tglsurat" id="tglsurat">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Terima</label>
                                                        <input type="date" class="form-control" placeholder="tglterima" required
                                                            name="tglterima" id="tglterima">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pengirim</label>
                                                        <input type="text" class="form-control" placeholder="Pengirim" required
                                                            name="pengirim" id="pengirim">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Perihal</label>
                                                        <input type="text" class="form-control" placeholder="Perihal" required
                                                            name="perihal" id="perihal">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Keterangan</label>
                                                        <input type="text" class="form-control" placeholder="Keterangan" required
                                                            name="ket" id="ket">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Upload Scan</label>
                                                        <input type="file" class="form-control" placeholder="Gambar" name="gambar"
                                                            id="gambar">
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <center>
                                                        <button type="submit" class="btn blue">Save</button>
                                                        <a href="?>"
                                                            class="btn default">Cancel</a>
                                                    </center>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!-- END PORTLET-->
                            </div>
                            <div class="col-md-3">
                            </div>

                        </div>
                        <!-- END PAGE CONTAINER -->
                    </div>
                    <!-- PAGE CONTENT END --> --}}

            </div>
    </section>
    <!-- /.content -->
@endsection
