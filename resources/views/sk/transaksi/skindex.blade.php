@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Surat Keputusan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Surat Keputusan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{-- ALERT MESSAGE --}}
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(Session::has('success'))
            <div class="alert alert-success">
                <p style="margin-bottom: 0px;">{{ Session::get('success') }}</p>
            </div>
            @endif
            {{-- END ALERT MESSAGE --}}

            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <h3 class="card-title"><a href="/suratkeputusan/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</a></h3>
                    <h3 align="center">Data Surat Keputusan</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>    
                                <th scope="col">Nomor SK</th>
                                <th scope="col">Tanggal SK</th>
                                <th scope="col">Staf</th>
                                <th scope="col">Status</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Tahun Ajar</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sk as $sk)
                            <tr style="text-align: center;">
                                <th>{{ $loop->iteration }}
                                    <span class="idsk d-none">{{ $sk->idsk }}</span>
                                </th>   
                                <td>{{ $sk->nosk }}</td>
                                <td>{{ $sk->tglsk }}</td>
                                <td>{{ $sk->nip}}</td>
                                <td>{{ $sk->status }}</td>
                                <td>{{ $sk->semester }}</td>
                                <td>{{ $sk->tahunajar }}</td>
                                <td>
                                    @if($sk->status == 'Disetujui (Dekan)')
                                        <button class="btn btn-primary kirim" value="{{$sk->idsk}}"><i class="fas fa-paper-plane">&nbsp;</i> Kirim</button>
                                    @elseif($sk->status == "Proposed")
                                        <a href="{{action('SuratKeputusanController@edit', $sk->idsk)}}" class="btn btn-success edit"><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-danger delete" value="{{$sk->idsk}}"><i class="fas fa-trash-alt"></i></button>
                                    @elseif($sk->status == "Diterima (Kaprodi)")
                                        <a href="{{action('SuratKeputusanController@edit', $sk->idsk)}}" class="btn btn-success edit disabled" disabled><i class="fas fa-edit"></i></a>
                                        <button class="btn btn-danger delete disabled" value="{{$sk->idsk}}"><i class="fas fa-trash-alt"></i></button>
                                    @elseif($sk->status == "Ditolak")
                                        <button class="btn btn-danger delete" value="{{$sk->idsk}}"><i class="fas fa-trash-alt"></i></button>
                                    @elseif($sk->status == "Tidak Disetujui")
                                        <button class="btn btn-danger delete" value="{{$sk->idsk}}"><i class="fas fa-trash-alt"></i></button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Start Delete Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Data Surat Keputusan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form role="Insertform" action="/suratkeputusan" method="post" id="deleteForm" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <input type="hidden" name="_method" value="DELETE">
                                        <p>Apa yakin ingin menghapus data?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Ya, Hapus Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Delete Modal --}}
                </div>

                <!-- Start Kirim Modal -->
                <div class="modal fade" id="kirimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kirim Surat Keputusan : {{$sk->nosk}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form role="Insertform" action="/suratkeputusan" method="post" id="kirimForm" enctype="multipart/form-data">
                                    <div class="modal-body text-left"  style="overflow-y: initial !important">
                                        {{ csrf_field() }}

											<p>Berikan tanda check (&#10003;) untuk penerima Surat Keputusan :</p>
                                                <div class="row border mx-1 p-1 rounded" style="max-height: 250px; overflow-y: auto;">
									                @foreach($dosen as $dsn)
										                <div class="col-md-6">
														    <div class="form-check">
																<input type="checkbox" class="form-check-input" name="dosen[]" id="dosen" value="{{$dsn->email}}">
																<label class="form-check-label">{{$dsn->gelar_depan}} {{$dsn->name}} {{$dsn->gelar_belakang}}</label>
															</div>
														</div>                                                   
                                                    @endforeach
									            </div>																	
                                    </div>
                                    <div class="modal-footer" style="padding: 9px !important;">
                                        <div class="form-check" style="position: relative; right: 180px;">
                                            <input type="checkbox" class="form-check-input select-all"  name="select-all" value="">
                                            <label class="form-check-label">Pilih Semua</label>
										</div>
									    <div class="float-right">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Batal</button> &nbsp;
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
										</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Kirim Modal --}}

                <!-- Footer -->
                <div class="card-footer">

                </div>
                <!-- End Footer -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <script src="/adminlte/plugins/jquery/jquery.slim.min.js"></script>
    <script src="/adminlte/plugins/popper/umd/popper.min.js"></script>

    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js" defer></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#datatable').DataTable();

            //Start Delete Record
            table.on('click', '.delete', function() {

                let id_test = $(this).val();
                console.log(id_test);

                $('#deleteForm').attr('action', '/suratkeputusan/'+ id_test);
                $('#deleteModal').modal('show');
            });
            //End Delete Record

            //Start kirim Record
            table.on('click', '.kirim', function() {

                $('.select-all').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $(':checkbox').each(function() {
                            this.checked = true;                        
                        });
                    } else {
                        $(':checkbox').each(function() {
                            this.checked = false;                       
                        });
                    }
			    });

                let id_test = $(this).val();
                console.log(id_test);

                $('#kirimForm').attr('action', '/suratkeputusan/'+ id_test);
                $('#kirimModal').modal('show');
            });
            //End kirim Record
        });
    </script>
@endsection