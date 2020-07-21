@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Form Request</li>
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
                    <h3 align="center">Request Surat Keluar</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <!-- Button trigger Add modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus-circle"></i> Input Request
                    </button>
                    {{-- End Trigger Button --}}
                    <br><br>
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nomor Request</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Kebutuhan</th>
                                <th scope="col">Detail Surat</th>
                                <th scope="col">Tanggal Maksimum</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reqdos as $reqdosen)
                            <tr style="text-align: center;">
                                <th></th>
                                <td>{{ $reqdosen->no_req }}</td>
                                <td>{{ $reqdosen->nip }}</td>
                                <td>{{ $reqdosen->kebutuhan }}</td>
                                <td>{{ $reqdosen->detail_surat }}</td>
                                <td>{{ $reqdosen->tgl_maxsurat }}</td>
                                <td>
                                    @if($reqdosen->statusreq == "Proposed")
                                        <span class="bg-info p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    @if($reqdosen->nip == Auth::user()->nip )
                                    <a href="#" data-toggle="modal" class="btn btn-success edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                    @else
                                    <a href="#" data-toggle="modal" class="btn btn-success edit disabled"><i class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete disabled"><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                    @elseif($reqdosen->statusreq == "Proses")
                                        <span class="bg-warning p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-success edit disabled"><i class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete disabled"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                    @elseif($reqdosen->statusreq == "Diterima")
                                        <span class="bg-success p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-success edit disabled"><i class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete disabled"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                    @elseif($reqdosen->statusreq == "Ditolak")
                                        <span class="bg-danger p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                    @elseif($reqdosen->statusreq == "Selesai")
                                        <span class="bg-primary p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete disabled"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Start Add Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Input Request Surat</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <form role="Insertform" action="{{ action('DosenRequestController@store') }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="nip" value="{{ Auth::user()->nip }}">
                                            
                                            <label>Kebutuhan</label>
                                            <input type="text" class="form-control" placeholder="Kebutuhan Request Surat" name="kebutuhan" value="{{ old('kebutuhan') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Detail Surat</label>
                                            <input type="text" class="form-control" placeholder="Detail Surat" name="detailsurat" value="{{ old('detailsurat') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Maksimum Pembuatan Surat</label>
                                            <input type="date" class="form-control" name="maxtglsurat" value="{{ old('maxtglsurat') }}">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Batal</button>
                                        <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Add Modal --}}

                    <!-- Start Edit Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Request Surat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/jenjangjabatan" method="post" id="editForm" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group">
                                                <label>NIP</label>
                                                <input type="number" class="form-control" name="nip" id="nip" value="{{ Auth::user()->nip }}" disabled>
                                            </div>

                                            <div class="form-group">
                                                <label>Kebutuhan</label>
                                                <input type="text" class="form-control" placeholder="Kebutuhan Request Surat" name="kebutuhan" id="kebutuhan" value="{{ old('kebutuhan') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Detail Surat</label>
                                                <input type="text" class="form-control" placeholder="Detail Surat" name="detailsurat" id="detailsurat" value="{{ old('detailsurat') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Tanggal Maksimum Pembuatan Surat</label>
                                                <input type="date" class="form-control" name="maxtglsurat" id="maxtglsurat" value="{{ old('maxtglsurat') }}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Batal</button>
                                            <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- End Edit Modal --}}

                        <!-- Start Delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data Request Surat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/dosenrequest" method="post" id="deleteForm" enctype="multipart/form-data">
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

                <!-- Footer -->
                <div class="card-footer">

                </div>
                <!-- End Footer -->
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

            var t = $('#datatable').DataTable( {
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]]
            } );
                        
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                    t.cell(cell).invalidate('dom');
                });
            }).draw();

            var table = $('#datatable').DataTable();

            //Start Edit Record
            table.on('click', '.edit', function() {

                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#kebutuhan').val(data[2]);
                $('#detailsurat').val(data[3]);
                $('#maxtglsurat').val(data[4]);

                $('#editForm').attr('action', '/dosenrequest/'+data[1]);
                $('#editModal').modal('show');
            });
            //End Edit Record

            //Start Delete Record
            table.on('click', '.delete', function() {

                $tr = $(this).closest('tr');
                if($($tr).hasClass('child'))
                {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#deleteForm').attr('action', '/dosenrequest/'+data[1]);
                $('#deleteModal').modal('show');
            });
            //End Delete Record
        });
    </script>
@endsection