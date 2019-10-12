<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak Laporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('/css/app.css')}}" />
    <script src="main.js"></script>
    <script type="text/javascript">
        window.print();
    </script>
</head>
<body>
<div class="container">
<h1 align="center">Aplikasi Perpustakkan</h1>
<h3  align="center">Sederhana</h3> <hr>
<p class="float-right">
{{ date('d-m-Y')}}
</p>
   @if($kondisi == 'user') 
   <table class="table table-hover">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>status</th>
        </tr>
    </thead>
    <tbody>
    @php($no = 1)
    @foreach($tampil as $t)
        <tr >
            <td>{{ $no++ }}</td>
            <td>{{ $t->name}}</td>
            <td>{{ $t->email}}</td>
            <td>{{ $t->level}}</td>
            
            </tr>
     @endforeach
    </tbody>
    </table>
   @elseif($kondisi == 'penerbit')
   <table class="table table-hover">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No Hp</th>
        <th>Alamat</th>
        
        </tr>
    </thead>
    <tbody>
    @php($no = 1)
    @foreach($tampil as $t)
        <tr >
        <td>{{ $no++ }}</td>
        <td>{{ $t->nama_penerbit}}</td>
        <td>{{ $t->email}}</td>
        <td>{{ $t->nohp}}</td>
        <td>{{ $t->alamat}}</td>
        
        </tr>
        @endforeach
    </tbody>
    </table>
   @elseif($kondisi == 'siswa')
   <table class="table table-hover">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>nis</th>
            <th>jK.</th>
            <th>Agama</th>
            <th>tempat/tgl. Lahir</th>
            <th>No Hp</th>
            <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
        @php($no = 1)
         @foreach($tampil as $t)
            <tr >
                <td>{{$no++}}</td>
                <td>{{ $t->name}}</td>
                <td>{{ $t->nis}}</td>
                <td>{{ $t->jk}}</td>
                <td>{{ $t->agama}}</td>
                <td>{{ $t->tp_lahir}} / {{ $t->tgl_lahir}}</td>
                <td>{{ $t->nohp}}</td>
                <td>{{ $t->alamat}}</td>
                
                </tr>
                @endforeach
        </tbody>
        </table>
   @elseif($kondisi == 'buku')
   <table class="table table-hover">
    <thead>
        <tr>
        <th>No</th>
        <th>KD Buku</th>
        <th>Judul</th>
        <th>ISBN</th>
        <th>Pengarang</th>
        <th>Kelas</th>
        <th>TH. Terbit</th>
        <th>Halaman</th>
        <th>Jumlah</th>
        <th>Penerbit</th>
        <th>Kategori</th>
        </tr>
    </thead>
    <tbody>
    @php($no = 1)
    @foreach($tampil as $t)
        <tr>
        <td>{{ $no++}}</td>
        <td>{{ $t->kd_buku }}</td>
        <td>{{ $t->judul_buku }}</td>
        <td>{{ $t->isbn }}</td>
        <td>{{ $t->pengarang }}</td>
        <td>{{ $t->kelas }}</td>
        <td>{{ $t->th_terbit }}</td>
        <td>{{ $t->halaman }}</td>
        <td>{{ $t->jumlah }}</td>
        <td>{{ $t->nama_penerbit }}</td>
        <td>{{ $t->kategori }}</td>
        
        </tr>
    @endforeach
    </tbody>
    </table>
   @elseif($kondisi == 'peminjaman')
   <table class="table table-hover">
    <thead>
        <tr>
        <th>No</th>
        <th>KD Buku</th>
        <th>Judul</th>
        <th>Nama Peminjam</th>
        <th>tgl peminjaman</th>
        <th>tgl tempo</th>
        <th>tgl pengembalian</th>
        <th>denda</th>
        </tr>
    </thead>
    <tbody>
    @php($no = 1)
    @foreach($tampil as $t)
        <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $t->kd_buku }}</td>
        <td>{{ $t->judul_buku }}</td>
        <td>{{ $t->name }}</td>
        <td>{{ $t->tgl_peminjaman }}</td>
        <td>{{ $t->tgl_j_tempo }}</td>
        <td>{{ $t->tgl_pengembalian }}</td>
        <td>{{ $t->denda }}</td>
        
        </tr>
        @endforeach
    </tbody>
    </table>
   @endif
   </div>
</body>
</html>