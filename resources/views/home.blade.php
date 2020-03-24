@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Content</h3>
            </div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum provident laudantium vitae asperiores doloribus odit porro, quaerat aliquam exercitationem dicta nobis quod dolores ipsum! Ea libero nam repellat porro rem.
                <br><br>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quam, ea. Quam autem vitae reprehenderit iusto delectus ex inventore sunt eaque tempore cum, deleniti provident dolores beatae soluta voluptatum quis! Nobis?
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection