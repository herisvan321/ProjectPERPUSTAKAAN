<!DOCTYPE html>
<html>
<head>
	<title>Cetak Kartu</title>
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
<table border="1" cellspacing="0">
	<tr>
		<td colspan="2">icon sekolah</td>
		<td>
			<h3 align="CENTER">KARTU TANDA ANGGOTA <br> PERPUSTAKAAN Sederhana padang</h2>
			<p align="CENTER">ALAMAT : ... TLP : ...</p>
		</td>
	</tr>
	<tr>
		<td colspan="2">Nis </td>
		<td>
			: {{$cek->nis}}
		</td>
	</tr>
	<tr>
		<td colspan="2">Nama</td>
		<td>: {{$cek->nama_siswa}}</td>
	</tr>
	<tr>
		<td colspan="2">Jenis Kelamin</td>
		<td>: {{$cek->jk}}</td>
	</tr>
	<tr>
		<td colspan="2">Alamat</td>
		<td>: {{$cek->alamat}}</td>
	</tr>
	<tr>
		<td colspan="2">
		<img src="{{ asset('upload/siswa/'.$cek->foto)}}" style="width:180px;height:200px;">
		</td>
		<td>
			Pimpinan : <br><br><br><br> <br> <br>
			<u>Nama </u><br>
			Nip :
		</td>
	</tr>
</table>
</body>
</html>