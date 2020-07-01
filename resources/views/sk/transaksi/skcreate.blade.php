@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Surat Keputusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/jenissk')}}">Surat Keputusan</a></li>
                        <li class="breadcrumb-item active">Tambah Surat Keputusan</li>
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
                            <h3 class="card-title"><a href="/suratkeputusan" class="btn btn-primary">Kembali</a></h3>
                            <h3 align="center">Tambah Data Surat Keputusan</h3>
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
                        <form role="form" method="post" action="{{ action('SuratKeputusanController@store') }}" enctype="multipart/form-data" id='formName'>
                            {{ csrf_field() }}
                            <div class="card-body">
                                {{-- TEST PENGGUNA --}}
                                <input type="hidden" value="{{$nip->nip}}" name="nip">
                                {{-- END TEST PENGGUNA --}}
                                <div class="form-group">
                                    <label>Nomor SK</label>
                                    <input type="text" class="form-control" placeholder="Nomor SK" name="nosk" id="nosk" value="{{ old('nosk') }}">
                                </div>

                                <div class="form-group">
                                    <label>Tentang SK</label>
                                    <input type="text" class="form-control" placeholder="Tentang SK" name="tentangsk" id="tentangsk" value="{{ old('tentangsk') }}">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal SK</label>
                                    <input type="date" class="form-control" name="tglsk" id="tglsk" value="{{ old('tglsk') }}">
                                </div>

                                <div class="form-group">
                                    <label>Dituju</label>
                                    <select class="form-control" name="tujuan" id="tujuan" required>
                                        <option value="">--------</option>
                                        @foreach ($alluser as  $user)
                                            <option value="{{ $user->status }}">{{$user->status}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Semester</label>
                                    <select class="form-control" name="semester" required>
                                        <option>--------</option>
                                        <option>Genap</option>
                                        <option>Ganjil</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <select class="form-control" name="tahunajar" required>
                                        <option>--------</option>
                                        <option>2018/2019</option>
                                        <option>2019/2020</option>
                                        <option>2020/2021</option>
                                        <option>2021/2022</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Template Surat</label>
                                    <select class="form-control" name="templatesurat" id="templatesurat" required>
                                        <option value="">--------</option>
                                        @foreach ($alltemplate as  $template)
                                            <option value="{{ $template->idjenis_sk }}">{{$template->nama_template}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group text-center mt-3">
						            <button type="button" id='generate' class="btn btn-primary w-50" name="generate">Generate</button>
					            </div>

                                <div class="form-group">
                                    <label>Hasil Output:</label>
                                    <div class="border p-3" name="templateSurat" id='templateSurat'> -- PILIH TEMPLATE SURAT TERLEBIH DAHULU -- </div>
                                </div>

                                <input type='hidden' id='templateHasil' name='hasil' readonly>
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary d-none" id='buttonCetak' ><i class="far fa-save"></i> Simpan</button>
                                    <a href="{{url('suratkeputusan')}}" class="btn btn-danger" style="margin-left: 20px;"><i class="fas fa-ban"></i> Batal</a>
                                </div>
                            </div>
                            <!-- End Footer -->
                        </form>
                    </div>
            </div>
    
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
		    <script src="{{asset('ckeditor/custom.js')}}"></script>
            <script>
                CKEDITOR.replace( 'templatesk' );
            </script>

            <script>
			$(document).ready(function(){

				// TAMPIL TEMPLATE SURAT JIKA DROPDOWN BERUBAH
				$("#templatesurat").change(function(){
					var idtemplate    = $(this).val();
					
					if(idtemplate) {
						$.ajax({
							url: "{{asset('ajaxRequest.php')}}",
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
							}
						});
					}
					else
					{
						$('#templateSurat').empty();
					}
				});
				
				// JIKA BUTTON GENERATE DI KLIK
				$('#generate').click(function() {
					
					// GET TEMPLATE SURAT
					$('#templateSurat').html();
					
					// MENGISI KOLOM DINAMIS PADA TEMPLATE SURAT DENGAN ISIAN DARI INPUT FIELD
					$('#templateSurat').find('#nomorSurat').html($('#nosk').val());

                    $('#templateSurat').find('#tentangSurat').html($('#tentangsk').val());
					
					$('#templateSurat').find('#namaDekan').html($('#tujuan').val());
					
                    $('#buttonCetak').removeClass('d-none');
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
{{-- End Add Modal --}}
@endsection
