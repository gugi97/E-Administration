@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                    <h3 align="center">Data User</h3>
                </div>
                <!-- End Card Header -->
                <!-- form start -->
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th colspan="2">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $usr)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $usr->nip }}</td>
                                <td>{{ $usr->name }}</td>
                                <td>{{ $usr->email }}</td>
                                <td>{{ $usr->status }}</td>
                                <td align="center">
                                    <a href="user/edit/{{ $usr->id }}"><i class="fas fa-edit"></i></a>
                                </td>
                                <td align="center">
                                    <a href="user/hapus/{{ $usr->id }}"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
