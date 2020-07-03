@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Request Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Request Dosen</li>
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
                    <h3 class="card-title">Input Request Surat</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <!-- Button trigger Add modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus-circle"></i> Tambah Data
                    </button>
                    {{-- End Trigger Button --}}
                    <br><br>
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Kode Jabatan</th>
                                <th scope="col">Nama Jabatan</th>
                                <th scope="col">Kode Unit Surat</th>
                                <th scope="col">Kode Unit Induk</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenjang as $jenjangjabatan)
                            <tr style="text-align: center;">
                                <th>{{ $jenjangjabatan->id }}</th>
                                <td>{{ $jenjangjabatan->kode_jenjang }}</td>
                                <td>{{ $jenjangjabatan->nama_jabatan }}</td>
                                <td>{{ $jenjangjabatan->kode_unitsurat }}</td>
                                <td>{{ $jenjangjabatan->kode_unitinduk }}</td>
                                <td>
                                    <a href="#" data-toggle="modal" class="btn btn-success edit"><i class="fas fa-edit"></i></a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenjang Jabatan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <form role="Insertform" action="{{ action('JenjangJabatanController@store') }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label>Unit Induk</label>
                                            <select class="form-control" name="untinduk" required>
                                                <option>-----</option>
                                                @foreach ($induk as  $untinduk)
                                                    <option value="{{$untinduk->kd_unit}}">{{$untinduk->nama_unit}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Unit Surat</label>
                                            <select class="form-control" name="untsurat" required>
                                                <option>-----</option>
                                                @foreach ($surat as  $untsurat)
                                                    <option value="{{$untsurat->kode_unitsurat}}">{{$untsurat->nama_unitsurat}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Kode Jenjang Jabatan</label>
                                            <input type="text" class="form-control" placeholder="Kode Jabatan" name="kdjabatan" value="{{ old('kdjabatan') }}" maxlength="3">
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Jabatan</label>
                                            <input type="text" class="form-control" placeholder="Nama Jabatan" name="nmjabatan" value="{{ old('nmjabatan') }}">
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
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Jenjang Jabatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/jenjangjabatan" method="post" id="editForm" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group">
                                                <label>Id Jabatan</label>
                                                <input type="number" class="form-control" placeholder="Id Jenjang Jabatan" name="idjabatan" id="idjabatan" disabled>
                                            </div>

                                            <div class="form-group">
                                            <label>Unit Induk</label>
                                            <select class="form-control" name="untinduk" id="untinduk" required>
                                                <option>-----</option>
                                                @foreach ($induk as  $untinduk)
                                                    <option value="{{$untinduk->kd_unit}}">{{$untinduk->nama_unit}}</option>
                                                @endforeach
                                            </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Unit Surat</label>
                                                <select class="form-control" name="untsurat" id="untsurat" required>
                                                    <option>-----</option>
                                                    @foreach ($surat as  $untsurat)
                                                        <option value="{{$untsurat->kode_unitsurat}}">{{$untsurat->nama_unitsurat}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kode Jenjang Jabatan</label>
                                                <input type="text" class="form-control" placeholder="Kode Jabatan" name="kdjabatan" id="kdjabatan" value="{{ old('kdjabatan') }}" maxlength="3">
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Jabatan</label>
                                                <input type="text" class="form-control" placeholder="Nama Jabatan" name="nmjabatan" id="nmjabatan" value="{{ old('nmjabatan') }}">
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
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data Jenjang Jabatan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/jenjangjabatan" method="post" id="deleteForm" enctype="multipart/form-data">
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

                $('#idjabatan').val(data[0]);
                $('#untinduk').val(data[4]);
                $('#untsurat').val(data[3]);
                $('#kdjabatan').val(data[1]);
                $('#nmjabatan').val(data[2]);

                $('#editForm').attr('action', '/jenjangjabatan/'+data[0]);
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

                $('#deleteForm').attr('action', '/jenjangjabatan/'+data[0]);
                $('#deleteModal').modal('show');
            });
            //End Delete Record
        });
    </script>
@endsection