<!DOCTYPE html>
<html>
<head>
	<title>Laporan PDF Surat Keputusan</title>
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
		<h5>Laporan PDF Surat Keputusan Dari Tanggal {{$dari_tgl2}} s/d {{$sampai_tgl2}}</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nomor Surat Keputusan</th>
                <th>Tanggal Surat</th>
                <th>Tentang Surat</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $ord)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $ord->nosk }}</td>
				<td>{{ $ord->tglsk }}</td>
				<td>{{ $ord->tentangsk }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>