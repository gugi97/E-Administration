<!DOCTYPE html>
<html>
<head>
	<title>Laporan PDF Surat Keluar</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan PDF Surat Keluar Dari Tanggal {{$dari_tgl2}} s/d {{$sampai_tgl2}}</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nomor Surat Keluar</th>
                <th>Tanggal Surat</th>
                <th>Perihal</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $ord)
			<tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ord->no_suratkeluar }}</td>
                <td>{{ $ord->tgl_suratkeluar }}</td>
                <td>{{ $ord->perihal }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>