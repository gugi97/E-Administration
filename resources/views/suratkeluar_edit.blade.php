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
                    @foreach($suratkeluar as $ske)
                    <form method="post" action="/suratkeluar/update">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Id Surat Keluar</label>
                            <input type="text" name="id_suratkeluar" value="{{ $ske->id_suratkeluar }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nomor Agenda</label>
                            <input type="number" name="no_agenda" class="form-control" value="{{ $ske->no_agenda }}">
                        </div>
                        <div class="form-group">
                            <label>Kode_Klasifikasi</label>
                            <input type="text" name="kode_klasifikasi" class="form-control" placeholder="Kode Klasifikasi" value="{{ $ske->kode_klasifikasi }}">
                            @if($errors->has('kode_klasifikasi'))
                                <div class="text-danger">
                                    {{ $errors->first('kode_klasifikasi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <textarea name="isi" class="form-control" placeholder="Isi Surat">{{ $ske->isi }}</textarea>
                            @if($errors->has('isi'))
                                <div class="text-danger">
                                    {{ $errors->first('isi')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tujuan</label>
                            <input type="text" name="tujuan" class="form-control" placeholder="Tujuan" value="{{ $ske->tujuan }}">
                            @if($errors->has('tujuan'))
                                <div class="text-danger">
                                    {{ $errors->first('tujuan')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_suratkeluar" class="form-control" placeholder="Nomor Surat" value="{{ $ske->no_suratkeluar }}">
                            @if($errors->has('no_suratkeluar'))
                                <div class="text-danger">
                                    {{ $errors->first('no_suratkeluar')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Tanggal Surat</label>
                            <input type="date" name="tgl_surat" class="form-control" value="{{ $ske->tgl_surat }}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Input Surat</label>
                            <input type="date" name="tgl_catat" class="form-control" value="{{ $ske->tgl_catat }}">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="{{ $ske->keterangan }}">
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
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>