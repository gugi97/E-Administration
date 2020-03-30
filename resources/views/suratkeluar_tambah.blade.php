<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
        <title>Tutorial</title>
    </head>
    <body>
        <div class="container">
            <div class="card mt-5">
                <div class="card-header text-center">
                    CRUD Data Surat Keluar - <strong>TAMBAH DATA</strong>
                </div>
                <div class="card-body">
                    <a href="/suratkeluar" class="btn btn-primary">Kembali</a>
                    <br/>
                    <br/>
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                        @endforeach
                    </div>
                    @endif
                    <form method="post" action="/suratkeluar/store">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <?php
                                $dbhost = 'localhost'; 
                                $dbuser = 'root';     // ini berlaku di xampp
                                $dbpass = '';         // ini berlaku di xampp
                                $dbname = 'db_efilling';
                                $connect = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
                                //mengambil no agenda terbesar dari table suratkeluar
                                $query = mysqli_query($connect,"SELECT MAX(no_agenda) AS no_agenda FROM suratkeluar");
                                $suratkeluar = mysqli_fetch_array($query); //pecah data ke dalam array
                                $kodebaru = $suratkeluar['no_agenda']+1; //kode max ditambah 1 agar jadi kode baru
                            ?>
                            <label>Nomor Agenda</label>
                            <input type="number" name="no_agenda" class="form-control" value="<?php echo $kodebaru?>">
                            @if($errors->has('no_agenda'))
                                <div class="text-danger">
                                    {{ $errors->first('no_agenda')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Kode_Klasifikasi</label>
                            <input type="text" name="kode_klasifikasi" class="form-control" placeholder="Kode Klasifikasi">
                            @if($errors->has('kode_klasifikasi'))
                                <div class="text-danger">
                                    {{ $errors->first('kode_klasifikasi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" class="form-control" placeholder="Isi Surat"></textarea>
                            @if($errors->has('isi'))
                                <div class="text-danger">
                                    {{ $errors->first('isi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" name="tujuan" class="form-control" placeholder="Tujuan">
                            @if($errors->has('tujuan'))
                                <div class="text-danger">
                                    {{ $errors->first('tujuan')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_suratkeluar" class="form-control" placeholder="Nomor Surat">
                            @if($errors->has('no_suratkeluar'))
                                <div class="text-danger">
                                    {{ $errors->first('no_suratkeluar')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" name="tgl_surat" id="tgl_surat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Input Surat</label>
                            <input type="date" name="tgl_catat" id="tgl_catat" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                            @if($errors->has('keterangan'))
                                <div class="text-danger">
                                    {{ $errors->first('keterangan')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>