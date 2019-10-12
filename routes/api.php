<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('save/user', 'ApiController@setUser');
Route::get('tampil/{id}/siswa', 'ApiController@showSiswa');
Route::get('show/{id}/user', 'ApiController@showUser');
//
Route::post('/save/siswa', 'ApiController@setSiswa');
Route::put('/update/{id}/siswa', 'ApiController@updateSiswa');
Route::put('/update/{id}/user', 'ApiController@UpdateUser');
//
Route::post('/save/kategori', 'ApiController@setKategori');
Route::get('tampil/{id}/kategori', 'ApiController@showKategori');
Route::put('/update/{id}/kategori', 'ApiController@UpKategori');
Route::delete('/kategori/{id}/delete','ApiController@dlKategori');
//
Route::post('/save/penerbit', 'ApiController@setPenerbit');
Route::get('tampil/{id}/penerbit', 'ApiController@showPenerbit');
Route::put('/update/{id}/penerbit', 'ApiController@UpPenerbit');
Route::delete('/penerbit/{id}/delete','ApiController@dlPenerbit');
//
Route::post('/save/buku', 'ApiController@setBuku');
Route::get('tampil/{id}/buku', 'ApiController@showBuku');
Route::put('/update/{id}/buku', 'ApiController@UpBuku');
Route::delete('/buku/{id}/delete','ApiController@dlBuku');
//




//
Route::get('/coba', 'ApiController@coba');
Route::get('/peminjaman/buku/', 'ApiController@peminjamanBuku');
Route::put('/update/peminjaman/buku/setujui', 'ApiController@setujuiPeminjamanBuku');
Route::delete('/delete/{id}/peminjaman/buku', 'ApiController@hapusPeminjaman');
//

Route::put('/update/peminjaman/buku/{id}/dikembaliakan', 'ApiController@setPengembalian');
//
Route::get('/home', 'ApiController@home');
