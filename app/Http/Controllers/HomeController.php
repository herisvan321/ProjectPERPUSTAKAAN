<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Siswa;
use App\Buku;
use App\Kategori;
use App\Penerbit;
use App\User;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.index');
    }

    public function home()
    {
        $buku=  @count(Buku::all());
        $penerbit=  @count(Penerbit::all());
        $user=  @count(User::where('level', '!=', 'siswa')->get());
        $siswa = @count(User::where('level',  'siswa')->get());
        $peminjaman = @count(Action::where('status',2)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->get());
        $id_user = auth()->user()->id_user;
        $akun = User::find($id_user);
        return response()->json([
            'buku' => $buku,
            'user' => $user,
            'siswa' => $siswa,
            'penerbit' => $penerbit,
            'akuns' => $akun,
            'peminjaman' => $peminjaman,
        ], 200);
    }

    public function showBukuPinjam($id)
    {
        $id_user = auth()->user()->id_user;
        $proses = Action::where('kd_buku', $id)->where('id_user' , $id_user)->where('status', 0)->first();
        $pinjam = Action::where('kd_buku', $id)->where('id_user' , $id_user)->where('status', 1)->first();
        if(@count($proses) > 0)
        {
            return response()->json(['cekdata' => 'Buku dengan Kode '. $id .' dalam Proses, Silahkan Pergi perpustakaan untuk Mengambil Buku!' ], 200);
        }
        elseif(@count($pinjam) > 0)
        {
            return response()->json(['cekdata' => 'Buku dengan Kode '. $id .' Sedang Anda Pinjam' ], 200);
        }

        $cek = Buku::find($id);
        return response()->json($cek, 200);
    }

    public function setPinjamSiswa(Request $r)
    {
        
        $id_user = auth()->user()->id_user;
        $jtempo = date('Y-m-d', strtotime('+ 7 days',strtotime(date('Y-m-d'))));
        $input = new Action();
        $input->kd_buku = $r->kd_buku;
        $input->jumlah = 1;
        $input->status = 0;
        $input->id_user = $id_user;
        $input->save();

        $up = Buku::find($r->kd_buku);
        $up->jumlah = $up->jumlah - 1;
        $up->update();

        if($input)
        {
            return response()->json(['sukses' => 'data berhasil disimpan!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'data gagal disimpan!'], 500);
        }
    }

    public function showRiwayatPeminjamanSiswa()
    {
        $id_user = auth()->user()->id_user;
        $cek = Action::where('actions.id_user', $id_user)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        return response()->json($cek, 200);
    }

    public function cetakdatauser()
    {
        $kondisi = 'user';
        $tampil = User::where('level', '!=', 'siswa')->get();
        return view('cetak', compact('kondisi', 'tampil'));
    }
    public function cetakdatapenerbit()
    {
        $kondisi = 'penerbit';
        $tampil = Penerbit::all();
        return view('cetak', compact('kondisi', 'tampil'));
    }
    public function cetakdatasiswa()
    {
        $kondisi = 'siswa';
        $tampil = User::where('users.level', 'siswa')
        ->join('siswas', 'users.id_user', '=', 'siswas.id_user')
        ->get();
        return view('cetak', compact('kondisi', 'tampil'));
    }
    public function cetakdatabuku()
    {
        $kondisi = 'buku';
        $tampil = Buku::join('penerbits', 'bukus.kd_penerbit','=','penerbits.kd_penerbit')
        ->join('kategoris', 'bukus.kd_kategori','=','kategoris.kd_kategori')->get();
        return view('cetak', compact('kondisi', 'tampil'));
    }
    public function cetakdatapeminjaman()
    {
        $kondisi = 'peminjaman';
        $tampil = Action::where('status',2)
        ->join('users', 'actions.id_user', '=', 'users.id_user')
        ->join('bukus', 'actions.kd_buku', '=', 'bukus.kd_buku')
        ->get();
        return view('cetak', compact('kondisi', 'tampil'));
    }

    public function akun()
    {
        $cek= User::find(auth()->user()->id_user);
        return response()->json($cek, 200);
    }

    public function upakun(Request $r)
    {
        $cek= User::find(auth()->user()->id_user);
        $cek->name = $r->name;
        $cek->email = $r->email;
        if($r->password == '')
        {
            $cek->password = $cek->password;
        }
        else
        {
            $cek->password = $r->password;
        }
        $cek->update();
        if($cek)
        {
            return response()->json(['sukses' => 'Akun Berhasi di Update!'], 200);
        }
        else
        {
            return response()->json(['gagal' => 'Akun Gagal di Update!'], 500);
        }
    }

    public function cetakkartuanggota($id)
    {
        $cek = Siswa::find($id);
        if(!$cek)
        {
            abort(403,'data siswa tidak ada ');
        }
        return view('cetakanggota',compact('cek'));
    }

}
