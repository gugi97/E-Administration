@extends('layouts.master')
<!-- Header END -->

<!-- PAGE CONTENT BEGIN -->
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Verifikasi Surat Keputusan Kaprodi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Verifikasi SK Kaprodi</li>
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
                    <h3 align="center">Data Request Surat Keputusan</h3>
                </div>
                <!-- End Card Header -->

                <!-- form start -->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th scope="col">No</th>
                                <th scope="col">Nomor Request</th>
                                <th scope="col">Tanggal Pengajuan</th>
                                <th scope="col">NIP Staff</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skdankaprodi as $skdankp)
                            <tr style="text-align: center;">
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $skdankp->noreq }}</td>
                                <td>{{ $skdankp->tglsk }}</td>
                                <td>{{ $skdankp->nipstaf }}</td>                            
                                <td>{{ $skdankp->statusreq }} </td>
                                <td>
                                    @if($skdankp->nipkaprodi == Auth::user()->nip )
                                        <a href="{{action('KaprodiController@edit', $skdankp->idreq)}}" class="btn btn-success edit"><i class="fas fa-edit"></i></a>
                                    @else
                                        <a href="{{action('KaprodiController@edit', $skdankp->idreq)}}" class="btn btn-success edit disabled"><i class="fas fa-edit"></i></a>
                                    @endif
                                </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
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

    <script>
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
    });
    </script>

@endsection