@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request Surat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Request Surat</li>
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
                    {{-- <h3 class="card-title"><a href="/suratkeputusan/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Data</a></h3> --}}
                    <h3 align="center">Data Request Surat Keluar</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">No. Request</th>
                                <th scope="col">Tanggal Pengajuan</th>
                                <th scope="col">NIP Dosen</th>
                                <th scope="col">Kebutuhan</th>
                                <th scope="col">Detail Surat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($req as $reqdosen)
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <tr style="text-align: center;">
                                <th></th>
                                <td>{{ $reqdosen->no_req }}</td>
                                <td>{{ $reqdosen->tgl_maxsurat }}</td>
                                <td>{{ $reqdosen->nip }}</td>
                                <td>{{ $reqdosen->kebutuhan }}</td>
                                <td>{{ $reqdosen->detail_surat }}</td>
                                <td>@if($reqdosen->statusreq == "Proposed")
                                    <span class="bg-info p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="requestsurat/diterima/{{$reqdosen->no_req}}" class="btn btn-success">Diterima</a>
                                    <a href="requestsurat/ditolak/{{$reqdosen->no_req}}" class="btn btn-danger">Ditolak</a>
                                </td>
                                
                                    @elseif($reqdosen->statusreq == "Diterima")
                                    <span class="bg-success p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="requestsurat/proses/{{$reqdosen->no_req}}" class="btn btn-warning">Proses</a>
                                </td>
                                
                                    @elseif($reqdosen->statusreq == "Proses")
                                    <span class="bg-warning p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="requestsurat/selesai/{{$reqdosen->no_req}}" class="btn btn-primary">Selesai</a>
                                </td>
                                
                                    @elseif($reqdosen->statusreq == "Ditolak")
                                    <span class="bg-danger p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="requestsurat/diterima/{{$reqdosen->no_req}}" class="btn btn-success">Diterima</a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                </td>

                                    @elseif($reqdosen->statusreq == "Selesai")
                                    <span class="bg-primary p-1 rounded" style="vertical-align:sub;">{{ $reqdosen->statusreq }}</span>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
                                </td>
                                    @endif
                            @endforeach
                            </tr>
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
                                <form role="Insertform" action="/requestsurat" method="post" id="deleteForm" enctype="multipart/form-data">
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

            //Start Delete Record
            table.on('click', '.delete', function() {

                $tr = $(this).closest('tr');
                if($($tr).hasClass('child'))
                {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#deleteForm').attr('action', '/requestsurat/'+data[1]);
                $('#deleteModal').modal('show');
            });
            //End Delete Record
        });
    </script>
@endsection
