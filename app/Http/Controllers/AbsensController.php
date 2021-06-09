<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absensi;
use App\Guru;
use App\MataPelajaran;
use App\Siswa;
use Auth;
use Carbon\Carbon;
use PDF;
class AbsensController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // public function id() {
    //     $id = str_replace('@mail.com', '', Auth::user()->email);
    //     return $id;
    // }

    // public function absen()
    // {
    //     $siswa = Siswa::where('nis', '=', $this->id())->first();
    //     $absens = Absensi::where('id_siswa', '=', $siswa->id)->get();
    //     return view('siswa.absensi', ['absens' => $absens]);
    // }
    public function id() {
        $id = str_replace('@mail.com', '', Auth::user()->email);
        return $id;
    }
    public function absen()
    {
        $absensisiswa = AbsensiSiswa::all();
        return view('siswa.absensi', ['absensisiswa' => $absensisiswa]);
    }
    
    public function absen2()
    {
        $sekarang = Carbon::now()->toDateTimeString();
        $guru = Guru::where('nip',$this->id())->first();
        $absensi = Absensi::orderBy('datetime','DESC')->where('id_guru',$guru->id)->get();
        $mapel = MataPelajaran::find($guru->id_mapel);
        $sudah = Absensi::where('id_guru',$guru->id)->where('datetime','<=',$sekarang)->get();
        //return count($sudah);
        return view('guru.absensi', ['absensi' => $absensi,'mapel'=>$mapel,'guru'=>$guru,'sudah'=>$sudah]);
    }

    public function addAbsensiGhuru($id,$id_mapel,$status)
    {
        Absensi::create([ 
            'datetime' => Carbon::now()->toDateTimeString(),
            'status' => $status,
            'id_mapel' => $id_mapel,
            'id_guru' => $id
        ]);

        return redirect()->back();
    } 
//     public function index()
//  {
//  $article = Article::all();
//  return view('manage',['article' => $article]);
//  }
    public function addabsen(){ 
        $mapel = MataPelajaran::all();
        $guru = Guru::all();
        return view('siswa.createAbsensi', ['mapel' => $mapel], ['guru' => $guru]);
	}
    public function addAbsensi(Request $request) {   
        Absensi::create([ 
			'datetime' => $request->datetime, 
			'status' => $request->status,
            'id_mapel' => $request->mapel,
            'id_guru' => $request->guru
        ]); 
        return redirect('siswa/absensi');      
	}
    public function edit($id)
    {
        $absensi = Absensi::find($id);
        $mapel = MataPelajaran::all();
        $guru = Guru::all();
        return view('guru.editAbsensi', ['guru' => $guru, 'mapel' => $mapel, 'absensi' => $absensi]);
    }

    public function update(Request $request, $id)
    {
        $absensi = Absensi::find($id);
        $absensi->datetime = $request->datetime;
        $absensi->status = $request->status;p;
        $absensi->id_mapel = $request->mapel;
        $absensi->id_guru = $request->guru;
        $absensi->save();
        return redirect('guru/absensi2');
    }


    public function destroy($id)
    {
        $absensi = Absensi::find($id);
        $absensi->delete();
        return redirect('guru/absensi2');
    }
}
