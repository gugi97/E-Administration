@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jenis Surat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Jenis Surat</li>
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
                    <h3 class="card-title">Input Jenis Surat</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <!-- Button trigger Add modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                    </button>
                    {{-- End Trigger Button --}}
                    <br><br>
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Kode Jenis</th>
                                <th scope="col">Nama Jenis</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis as $jnsdata)
                            <tr style="text-align: center;">    
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $jnsdata->kode_jenissurat }}</td>
                                <td>{{ $jnsdata->nama_jenissurat }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-success edit">Edit</a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger">Delete</a>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <form role="Insertform" action="{{ action('JenisSuratController@store') }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label>Kode Jenis</label>
                                            <input type="text" class="form-control" placeholder="Kode Jenis Surat" name="kodejns" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Jenis</label>
                                            <input type="text" class="form-control" placeholder="Nama Jenis Surat" name="namajns" required>
                                        </div>
                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/jenissurat" method="post" id="editForm" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
    
                                            <div class="form-group">
                                                <label>Kode Jenis</label>
                                                <input type="text" class="form-control" placeholder="Kode Jenis Surat" name="kodejns" id="kodejns" required>
                                                </div>
    
                                            <div class="form-group">
                                                <label>Nama Jenis</label>
                                                <input type="text" class="form-control" placeholder="Nama Jenis Surat" name="namajns" id="namajns" required>
                                            </div>
                                                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- End Edit Modal --}}

                    {{-- 
                    <div>
                        <table class="table table-bordered table-hover table-striped" id="dataTable1">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>No</th>
                                    <th>Kode Jenis</th>
                                    <th>Nama Jenis</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inputjenis as $ambil)
                                    <tr style="text-align: center;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ambil->kode_jenissurat }}</td>
                                        <td>{{ $ambil->nama_jenissurat }}</td>
                                        <td width="20px;"><a href="#edit-data{{$ambil->kode_jenissurat}}" data-toggle="modal" class="btn btn-warning">Edit</a></td>
                                        <td width="20px;"><a href="jenissurat/hapus/{{ $ambil->kode_jenissurat }}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> --}}
                </div>

                {{-- @foreach ($inputjenis as $ambil) 
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                    id="edit-data{{$ambil->kode_jenissurat}}" width="75%" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Ubah Data</h4>
                            </div>
                            <form class="form-horizontal" action="{{url('jenissurat/edit')}}/{{$ambil->kode_jenissurat}}"
                                method="post" enctype="multipart/form-data" role="form">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-lg-3 col-sm-1">Kode Jenis Surat</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="jenjang" name="kode" placeholder="Kode Jenis Surat" value="{{$ambil->kode_jenissurat}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 col-sm-1">Nama Jenis Surat</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Jenis Surat"
                                                value="{{$ambil->nama_jenissurat}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach --}}

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
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.min.js"></script>

    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js" defer></script>
    <script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js" defer></script>

    <script type="text/javascript">

        $(document).ready(function() {
            
            var table = $('#datatable').DataTable();

            //Start Edit Record
            table.on('click', '.edit', function() {
                
                $tr = $(this).closest('tr');
                if($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data);

                $('#kodejns').val(data[1]);
                $('#namajns').val(data[2]);
                
                $('#editForm').attr('action', '/jenissurat/'+data[0]);
                $('#editModal').modal('show');
            });
            //End Edit Record
        });
    </script>
@endsection