<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Action;
use App\Siswa;
use App\Buku;
use App\Kategori;
use App\Penerbit;
use App\User;
use Image;

class ApiController extends Controller
{
  
    public function coba()
    {
        $a = [
            'nama' => 'herisvan hendra',
            'panggilan' => 'rivan'
        ];
        return $a;
    }
    public function setUser(Request $r)
    {
        $r->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'password' => 'required|min:6'
        ]);

        $input = new User();
        $input->name = $r->nama;
        $input->email = $r->email;
        $input->level = $r->level;
        $input->password = Hash::make($r->password);
        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil disimpan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal disimpan!'], 500);
        }
        
    }
    public function getUser()
    {
        
        $data = User::orderBy('level', 'ASC')->paginate(30);
        return response()->json($data,200);
    }
    public function showSiswa($id)
    {
        $cek = Siswa::find($id);
        // dd(@count($cek));
        if(@count($cek) > 0)
        {
            return response()->json($cek,200);
        }else{
        $data = User::find($id);
        return response()->json($data,200);
        }
    }
    public function setSiswa(Request $r)
    {
        $r->validate([
            'id_user' => 'required',
            'name' => 'required',
            'nis' => 'required|numeric',
            'jk' => 'required|max:20',
            'agama' => 'required|max:25',
            'tmplahir' => 'required|max:35',
            'tgllahir' => 'required',
            'nohp' => 'required|numeric',
            'alamat' => 'required|max:255',
            'image' => 'required',
        ]);

        if($r->get('image')){
            $image = $r->get('image');
            $nameimage = "IMG_".date('dmYHis').'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($r->get('image'))->save(public_path('upload/siswa/').$nameimage);
        }
        $input = new Siswa();
        $input->id_user = $r->id_user;
        $input->nama_siswa = $r->name;
        $input->nis = $r->nis;
        $input->jk = $r->jk;
        $input->agama = $r->agama;
        $input->tp_lahir = $r->tmplahir;
        $input->tgl_lahir = $r->tgllahir;
        $input->nohp = $r->nohp;
        $input->alamat = $r->alamat;
        $input->foto = $nameimage;
        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasi disimpan'], 200);
        }
        else{
            return response()->json(['gagal' => 'data gagal disimpan'], 500);
        }
    }

    public function updateSiswa(Request $r, $id)
    {
        
        $input =  Siswa::find($id);
        if($r->get('image')){
            $image = $r->get('image');
            $nameimage = "IMG_".date('dmYHis').'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($r->get('image'))->save(public_path('upload/siswa/').$nameimage);
            $target = 'upload/siswa/'.$input->foto;
            unlink($target);
        }
        else{
            $nameimage = $input->foto;
        }
        $input->nama_siswa = $r->name;
        $input->nis = $r->nis;
        $input->jk = $r->jk;
        $input->agama = $r->agama;
        $input->tp_lahir = $r->tmplahir;
        $input->tgl_lahir = $r->tgllahir;
        $input->nohp = $r->nohp;
        $input->alamat = $r->alamat;
        $input->foto = $nameimage;
        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasi diupdate'], 200);
        }
        else{
            return response()->json(['gagal' => 'data gagal diupdate'], 500);
        }
    }
    public function showUser($id)
    {
        $cek = User::find($id);
        return response()->json($cek, 200);
    }
    public function UpdateUser(Request $r, $id)
    {
        $r->validate([
            'name' => 'required',
            'email' => 'required|email',
            'level' => 'required',
        ]);

        $input =  User::find($id);
        $input->name = $r->name;
        $input->email = $r->email;
        $input->level = $r->level;
        if($r->password == '')
        {
            $input->password = $input->password; 
        }
        else
        {
            $input->password = Hash::make($r->password);
        }
        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil disimpan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal disimpan!'], 500);
        }
    }

    public function getPenerbit()
    {
        $cek = Penerbit::all();
        return response()->json($cek, 200);
    }
    public function setPenerbit(Request $r)
    {
        $r->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nohp' => 'required|numeric',
            'alamat' => 'required|max:255'
        ]);

        $cek = Penerbit::orderBy('kd_penerbit', 'desc')->first();
        if(@count($cek) > 0)
        {
            $potong = substr($cek->kd_penerbit,3,4);
            $tambah = $potong + 1;
            $kd_penerbit =  "PNB".sprintf('%04s', $tambah);
        }
        else
        {
            $kd_penerbit = 'PNB0001';
        }

        $input = new Penerbit();
        $input->kd_penerbit = $kd_penerbit;
        $input->nama_penerbit = $r->nama;
        $input->email = $r->email;
        $input->nohp = $r->nohp;
        $input->alamat = $r->alamat;
        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil disimpan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal disimpan!'], 500);
        }
    }
    public function showPenerbit($id)
    {
        $cek = Penerbit::find($id);
        return response()->json($cek, 200);
    }
    public function UpPenerbit(Request $r,$id)
    {
        $r->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nohp' => 'required|numeric',
            'alamat' => 'required|max:255'
        ]);

        $input = Penerbit::find($id);
        $input->nama_penerbit = $r->nama;
        $input->email = $r->email;
        $input->nohp = $r->nohp;
        $input->alamat = $r->alamat;
        $input->update();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil diupdate!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal diupdate!'], 500);
        }
    }
    public function dlPenerbit(Request $r,$id)
    {
        $dl = Penerbit::find($id);
        $dl->delete();
        if($dl)
        {
            return response()->json(['sukses' => 'data berhasil dihapus!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal dihapus!'], 500);
        }
    }

    public function getKategori()
    {
        $cek = Kategori::all();
        return response()->json($cek, 200);
    }
    public function setKategori(Request $r)
    {
        $r->validate([
            'kategori' => 'required',
        ]);

        $cek = Kategori::orderBy('kd_kategori', 'desc')->first();
       
        if(@count($cek) > 0)
        {
            $potong = substr($cek->kd_kategori,3,4);
            $tambah = $potong + 1;
            $kd_kategori =  "KTG".sprintf("%04s", $tambah);
            // dd($kd_kategori);
           
        }
        else
        {
            $kd_kategori = 'KTG0001';
        }

        $input = new Kategori();
        $input->kd_kategori = $kd_kategori;
        $input->kategori = $r->kategori;
        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil disimpan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal disimpan!'], 500);
        }

    }
    public function showKategori($id)
    {
        $cek = Kategori::find($id);
        return response()->json($cek, 200);
    }
    public function UpKategori(Request $r, $id)
    {
        $r->validate([
            'kategori' => 'required',
        ]);
        $input = Kategori::find($id);
        $input->kategori = $r->kategori;
        $input->update();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil diupdate!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal diupdate!'], 500);
        }

    }
    public function dlKategori(Request $r,$id)
    {
        $dl = Kategori::find($id);
        $dl->delete();
        if($dl)
        {
            return response()->json(['sukses' => 'data berhasil dihapus!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal dihapus!'], 500);
        }
    }

    public function getBuku()
    {
        $cek = Buku::join('penerbits', 'bukus.kd_penerbit','=','penerbits.kd_penerbit')
        ->join('kategoris', 'bukus.kd_kategori','=','kategoris.kd_kategori')
        ->orderBy('bukus.kd_buku', 'asc')
        ->get();
        return response()->json($cek, 200);
    }
    public function setBuku(Request $r)
    {
        $r->validate([
            'isbn' => 'required',
            'pengarang' => 'required',
            'kelas' => 'required', 
            'th_terbit' => 'required',
            'halaman' => 'required',
            'sinopsis' => 'required', 
            'jumlah' => 'required',
            'judul_buku' => 'required',
            'image' => 'required',
            'kd_penerbit' => 'required', 
            'kd_kategori' => 'required',
        ]);
        $cek = Buku::orderBy('kd_buku', 'desc')->first();
        if(@count($cek) > 0)
        {
            $potong = substr($cek->kd_buku,3,4);
            $tambah = $potong + 1;
            $kd_buku =  "KDB".sprintf('%04s', $tambah);
        }
        else
        {
            $kd_buku = 'KDB0001';
        }

        if($r->get('image')){
            $image = $r->get('image');
            $nameimage = "IMG_".date('dmYHis').'_'.$kd_buku.'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($r->get('image'))->save(public_path('upload/buku/').$nameimage);
           
        }

        $input = new Buku();
        $input->kd_buku = $kd_buku;
        $input->judul_buku = $r->judul_buku;
        $input->isbn = $r->isbn;
        $input->pengarang = $r->pengarang;
        $input->kelas = $r->kelas;
        $input->th_terbit = $r->th_terbit;
        $input->halaman = $r->halaman;
        $input->sinopsis = $r->sinopsis;
        $input->jumlah = $r->jumlah;
        $input->gambar = $nameimage;
        $input->kd_penerbit = $r->kd_penerbit;
        $input->kd_kategori = $r->kd_kategori;

        $input->save();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil disimpan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal disimpan!'], 500);
        }

    }
    public function showBuku($id)
    {
        $cek = Buku::find($id);
        return response()->json($cek, 200);
    }
    public function UpBuku(Request $r, $id)
    {
        $r->validate([
            'isbn' => 'required',
            'pengarang' => 'required',
            'kelas' => 'required', 
            'th_terbit' => 'required',
            'halaman' => 'required',
            'sinopsis' => 'required', 
            'jumlah' => 'required',
            'judul_buku' => 'required',
            'kd_penerbit' => 'required', 
            'kd_kategori' => 'required',
        ]);


        $input = Buku::find($id);
        if($r->get('image')){
            $image = $r->get('image');
            $nameimage = "IMG_".date('dmYHis').'.'.explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($r->get('image'))->save(public_path('upload/buku/').$nameimage);
            $target = 'upload/buku/'.$input->foto;
            unlink($target);
        }
        else{
            $nameimage = $input->gambar;
        }
        $input = Buku::find($id);
        $input->judul_buku = $r->judul_buku;
        $input->isbn = $r->isbn;
        $input->pengarang = $r->pengarang;
        $input->kelas = $r->kelas;
        $input->th_terbit = $r->th_terbit;
        $input->halaman = $r->halaman;
        $input->sinopsis = $r->sinopsis;
        $input->jumlah = $r->jumlah;
        $input->gambar = $nameimage;
        $input->kd_penerbit = $r->kd_penerbit;
        $input->kd_kategori = $r->kd_kategori;

        $input->Update();
        if($input)
        {
            return response()->json(['sukses' => 'data berhasil diupdate!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal diupdate!'], 500);
        }

    }

    public function dlBuku(Request $r,$id)
    {
        $dl = Buku::find($id);
        $target = 'upload/buku/'.$dl->gambar;
        unlink($target);
        $dl->delete();
        if($dl)
        {
            return response()->json(['sukses' => 'data berhasil dihapus!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal dihapus!'], 500);
        }
    }
    public function peminjamanBuku()
    {
        $cek = Action::where('actions.status', 0)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        return response()->json($cek, 200);
    }

    public function setujuiPeminjamanBuku(Request $r)
    {
        $jtempo = date('Y-m-d', strtotime('+ 7 days',strtotime(date('Y-m-d'))));
        $up = Action::where('kd_buku', $r->kd_buku)->where('id_user', $r->id_user)->where('status', 0)->first();
        $up->tgl_peminjaman = date('Y-m-d');
        $up->tgl_j_tempo = $jtempo;
        $up->status = 1;
        $up->update();
        if($up)
        {
            return response()->json(['sukses' => 'Peminjaman Selesai dilakukan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'Peminjaman gagal dilakukan!'], 500);
        }
    }

    public function hapusPeminjaman($id)
    {
        $del = Action::find($id);
        $del->delete();
        if($del)
        {
            return response()->json(['sukses' => 'Peminjaman berhasil dihapus!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'Peminjaman gagal dihapus!'], 500);
        }

    }

    public function getdatapinjam()
    {
        $cek = Action::where('actions.status', 1)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        return response()->json($cek, 200);
    }

    public function setPengembalian($id)
    {
        $up = Action::find($id);
        $up->tgl_pengembalian = date('Y-m-d');
        $cekdenda = ( date('Ymd') - date('Ymd', strtotime($up->tgl_j_tempo )))  ;
        if($cekdenda > 0)
        {
            $denda = (int) $cekdenda * 500;
        }
        elseif($cekdenda < 0){
            $denda = 0;
        }
        // dd($cekdenda);
        $up->denda = $denda;
        $up->status = 2;
        $up->update();

        $buku = Buku::find($up->kd_buku);
        $buku->jumlah = $buku->jumlah + 1;
        $buku->update();
        if($up)
        {
            return response()->json(['sukses' => 'Buku Berhasil dikembalikan'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'Buku Gagal Dikembalikan'], 500);
        }
    }

    public function cariPeminjaman(Request $r)
    {
        if($r->cari == '')
        {
            $cek = Action::where('actions.status', 1)
            ->join('users', 'actions.id_user', '=', 'users.id_user')
            ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
            ->get();
            // dd(count($cek));
            return response()->json($cek, 200); 
        }
        $cek = Action::where('actions.kd_buku','LIKE', '%'.$r->cari.'%')
        ->where('actions.status', 1)
        ->orWhere('users.name','LIKE', '%'.$r->cari.'%')
        ->where('actions.status', 1)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        // dd(count($cek));
        return response()->json($cek, 200);
    }
    public function cariPeminjamanMenunggu(Request $r)
    {
        if($r->cari == '')
        {
            $cek = Action::where('actions.status', 0)
            ->join('users', 'actions.id_user', '=', 'users.id_user')
            ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
            ->get();
            // dd(count($cek));
            return response()->json($cek, 200); 
        }
        $cek = Action::where('actions.kd_buku','LIKE', '%'.$r->cari.'%')
        ->where('actions.status', 0)
        ->orWhere('users.name','LIKE', '%'.$r->cari.'%')
        ->where('actions.status', 0)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        // dd(count($cek));
        return response()->json($cek, 200);
    }

    public function getdatauser()
    {
        $cek = User::where('level', '!=', 'siswa')->get();
        return response()->json($cek, 200);
    }
    public function getdataSiswa()
    {
        $cek = User::where('users.level', 'siswa')
        ->join('siswas', 'users.id_user', '=', 'siswas.id_user')
        ->get();
        return response()->json($cek, 200);
    }
    public function getlaporanPeminjaman()
    {
        $cek = Action::where('status',2)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        return response()->json($cek, 200);
    }

    


}
