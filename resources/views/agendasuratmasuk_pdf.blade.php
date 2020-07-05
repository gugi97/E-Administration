<!DOCTYPE html>
<html>
<head>
	<title>Laporan PDF Surat Masuk</title>
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
		<h5>Laporan PDF Surat Masuk Dari Tanggal {{$dari_tgl2}} s/d {{$sampai_tgl2}}</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nomor Surat Masuk</th>
                <th>Tanggal Surat</th>
                <th>Perihal</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $ord)
			<tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ord->no_surat }}</td>
                <td>{{ $ord->tgl_surat }}</td>
                <td>{{ $ord->perihal }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>