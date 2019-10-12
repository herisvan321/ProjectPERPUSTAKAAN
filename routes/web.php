<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/cetak', 'HomeController@cetak');
Route::get('/home/index', 'HomeController@home');
//
Route::get('tampil/{id}/buku/pinjam', 'HomeController@showBukuPinjam');
Route::post('/save/pinjam/buku/siswa', 'HomeController@setPinjamSiswa');
Route::get('/tampil/riwayat/peminjaman/siswa','HomeController@showRiwayatPeminjamanSiswa');
Route::get('/home/cetak/user', 'HomeController@cetakdatauser');
Route::get('/home/cetak/penerbit', 'HomeController@cetakdatapenerbit');
Route::get('/home/cetak/siswa', 'HomeController@cetakdatasiswa');
Route::get('/home/cetak/buku', 'HomeController@cetakdatabuku');
Route::get('/home/cetak/peminjaman', 'HomeController@cetakdatapeminjaman');
Route::get('/home/cetak/{id}/kartu/anggota', 'HomeController@cetakkartuanggota');
//
Route::get('/getpenerbit', 'ApiController@getPenerbit');

Route::get('data/user', 'ApiController@getUser');

Route::get('/getkategori', 'ApiController@getKategori');

Route::get('/getbuku', 'ApiController@getBuku');

Route::get('/peminjaman/buku/dikebalikan', 'ApiController@getdatapinjam');

Route::get('/peminjaman/cari', 'ApiController@cariPeminjaman');
Route::get('/peminjaman/cari/menunggu', 'ApiController@cariPeminjamanMenunggu');
Route::get('/laporan/getdatauser', 'ApiController@getdatauser');
Route::get('/laporan/getdatasiswa', 'ApiController@getdataSiswa');
Route::get('/laporan/peminjaman', 'ApiController@getlaporanPeminjaman');

Route::get('/setting/akun', 'HomeController@akun');
Route::put('/setting/akun/simpan', 'HomeController@upakun' );
