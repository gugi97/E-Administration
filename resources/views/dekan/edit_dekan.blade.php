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
                                    @if($dekan->nip_dekan == "")
                                    <input type="text" class="form-control" placeholder="NIP" name="nip_dekan" id="nip_dekan" value="{{ Auth::user()->nip }}" maxlength="9" disabled>
                                    @else
                                    <input type="text" class="form-control" placeholder="NIP" name="nip_dekan" id="nip_dekan" value="{{ $dekan->nip_dekan }}" maxlength="9" disabled>
                                    @endif
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

                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Tanda Tangan</label>
                                    <div class="input-group control-group increment" >
                                        <input type="file" class="form-control" style="padding:3px;" id="ttd">
                                    </div>
                                </div>

                                <div class="form-group text-center mt-3">
						            <button type="button" id='templatesurat' class="btn btn-primary w-50" name="templatesurat" value="{{ $dekan->id_dekan }}">Generate</button>
					            </div>

                                <div class="form-group">
                                    <label>Surat Keputusan :</label>
                                    <div class="border p-3" name="templateSurat" id='templateSurat'> -- KLIK TOMBOL TERLEBIH DAHULU -- </div>
                                </div>

                                <input type='hidden' id='templateHasil' name='hasil' readonly>
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                    <div class="row">
                                        <button type="submit" class="btn btn-primary d-none" id='buttonCetak' ><i class="far fa-save"></i> Simpan</button>
                                        <a href="{{url('dekan')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
                                    </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                        @endforeach
                    </div>
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>

            <script>
                $(document).ready(function(){

                    // JIKA BUTTON GENERATE DI KLIK
                    $('#templatesurat').click(function() {
                        var idtemplate  = $(this).val();
                                                
                        $('#buttonCetak').removeClass('d-none');
                        if(idtemplate) {
                            $.ajax({
                                url: "{{asset('ajaxRequest3.php')}}",
                                type: "POST",
                                data : {"idtemplate":idtemplate},
                                dataType: "json",
                                success:function(data) {
                                    $('#templateSurat').empty();
                                    $('#templateSurat').append(data);

                                },
                                error:function(e) {
                                    $('#templateSurat').empty();
                                    $('#templateSurat').append(e.responseText);

                                    // GET TEMPLATE SURAT
                                    $('#templateSurat').html();
                                    
                                    // MENGISI KOLOM DINAMIS PADA TEMPLATE SURAT DENGAN ISIAN DARI INPUT FIELD
                                    // MEMBUAT TAG IMG UNTUK GAMBAR TTD
                                    $('#templateSurat').find('#ttdDekan').empty();
                                    $('#templateSurat').find('#ttdDekan').html('<img class="m-2" id="ttdcoba" src="" height="100px">');

                                    // MENGISI DENGAN GAMBAR
                                    var preview = document.querySelector('#ttdcoba');
                                    var file    = document.querySelector('input[type=file]').files[0];
                                    var reader  = new FileReader();

                                    reader.onloadend = function () {
                                        preview.src = reader.result;
                                    }
                                    
                                    if (file) {
                                        reader.readAsDataURL(file);
                                    } else {
                                        preview.src = "";
                                    }

                                    let hariIni = new Date();
                                    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                    let hari= hariIni.getDate()+' '+months[hariIni.getMonth()]+' '+hariIni.getFullYear();
                                    $('#templateSurat').find('#tanggalSurat').html(hari);
                                    
                                    let namaDekan = '{{Auth::user()->name}}';
                                    $('#templateSurat').find('#namaDekan').html(namaDekan);
                                    
                                    $('#buttonCetak').removeClass('d-none');   
                                }
                            });
                        }
                        else
                        {
                            $('#templateSurat').empty();
                        }            
                    });

                    // JIKA BUTTON CETAK DI KLIK
                    $('#buttonCetak').click(function() {
                            
                            // MENGISI INPUT FIELD (ID: templateHasil) DENGAN ISIAN DARI ELEMENT (ID: templateSurat)
                            $("#templateHasil").val($("#templateSurat").html());
                            
                            // SUBMIT FORM
                            $("#formName").submit();
                    });
            });
            </script>
    </section>
{{-- End Edit--}}
@endsection