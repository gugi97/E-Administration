@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dosen</li>
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
                    <h3 class="card-title">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-plus-circle"></i> Tambah Data
                        </button>    
                    </h3>
                    <h3 align="center">Data Dosen</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">NIP Dosen</th>
                                <th scope="col">Nama Dosen</th>
                                <th scope="col">Nomor HP</th>
                                <th scope="col">Email</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosen as $dsn)
                            <tr style="text-align: center;">
                                <th></th>
                                <td>{{ $dsn->nip }}</td>
                                <td><span id='fieldGelarDepan'>{{$dsn->gelar_depan}}</span>
                                    <span id='fieldNama'>{{ $dsn->name }}</span>
                                    <span id='fieldGelarBelakang'>{{$dsn->gelar_belakang}}</span>
                                </td>
                                <td>{{ $dsn->no_hp }}</td>
                                <td>{{ $dsn->email }}</td>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <form role="Insertform" action="{{ action('DosenController@store') }}" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <label>NIP Dosen</label>
                                            <input type="text" class="form-control" placeholder="NIP Dosen" name="nip" value="{{ old('nip') }}" onkeypress="return angkaSaja(event)" maxlength="9">
                                        </div>

                                        <div class="form-group">
                                            <label>Gelar Depan Dosen</label>
                                            <input type="text" class="form-control" placeholder="Gelar Depan Dosen" name="gelar_depan" value="{{ old('gelar_depan') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Dosen</label>
                                            <input type="text" class="form-control" placeholder="Nama Dosen" name="name" value="{{ old('name') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Gelar Belakang Dosen</label>
                                            <input type="text" class="form-control" placeholder="Gelar Belakang Dosen" name="gelar_belakang" value="{{ old('gelar_belakang') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Handphone</label>
                                            <input type="text" class="form-control" placeholder="Nomor Handphone" name="no_hp" value="{{ old('no_hp') }}" maxlength="14">
                                        </div>

                                        <div class="form-group">
                                            <label>Email Dosen</label>
                                            <input type="email" class="form-control" placeholder="Email Dosen" name="email" value="{{ old('email') }}">
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
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/dosen" method="post" id="editForm" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}

                                            <div class="form-group">
                                                <label>NIP Dosen</label>
                                                <input type="text" class="form-control" placeholder="NIP Dosen" name="nip" id="nip" onkeypress="return angkaSaja(event)" value="{{ old('nip') }}" maxlength="9">
                                            </div>

                                            <div class="form-group">
                                                <label>Gelar Depan Dosen</label>
                                                <input type="text" class="form-control" placeholder="Gelar Depan Dosen" name="gelar_depan" id="gelar_depan" value="{{ old('gelar_depan') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Dosen</label>
                                                <input type="text" class="form-control" placeholder="Nama Dosen" name="name" id="name" value="{{ old('name') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Gelar Belakang Dosen</label>
                                                <input type="text" class="form-control" placeholder="Gelar Belakang Dosen" name="gelar_belakang" id="gelar_belakang" value="{{ old('gelar_belakang') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Nomor Handphone</label>
                                                <input type="text" class="form-control" placeholder="Nomor Handphone" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" maxlength="14">
                                            </div>

                                            <div class="form-group">
                                                <label>Email Dosen</label>
                                                <input type="email" class="form-control" placeholder="Email Dosen" name="email" id="email" value="{{ old('email') }}">
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
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data Dosen</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form role="Insertform" action="/dosen" method="post" id="deleteForm" enctype="multipart/form-data">
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

        function angkaSaja(evt){
            var charCode=(evt.which) ? evt.which: event.keyCode;
            if(charCode>31 && (charCode<48 || charCode>57))
            return false;
            return true;
        }

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

                $('#nip').val(data[1]);
                $('#gelar_depan').val($(data[2]).html());
                $('#name').val($(data[2]).next().html());
                $('#gelar_belakang').val($(data[2]).next().next().html());
                $('#no_hp').val(data[3]);
                $('#email').val(data[4]);

                $('#editForm').attr('action', '/dosen/'+data[1]);
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

                $('#deleteForm').attr('action', '/dosen/'+data[1]);
                $('#deleteModal').modal('show');
            });
            //End Delete Record
        });
    </script>
@endsection
