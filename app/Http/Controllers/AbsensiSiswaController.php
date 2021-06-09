<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AbsensiSiswa;
// use App\Guru;
use App\MataPelajaran;

class AbsensiSiswaController extends Controller
{
    public function absen()
    {
        $absensisiswa = AbsensiSiswa::all();
        return view('siswa.absensi', ['absensisiswa' => $absensisiswa]);
    }

    // public function absen()
    // {
    //     $absensi = Absensi::where('id', '=', $this->id())->first();
    //     $mapel = MataPelajaran::where('id', '=', $mapel->id)->get();
    //     return view('siswa.absensi', ['mapel' => $mapel, 'absensi' => $absensi]);
    // }

    public function absen2()
    {
        $absensisiswa = AbsensiSiswa::all();
        return view('guru.absensi', ['absensisiswa' => $absensisiswa]);
    }
//     public function index()
//  {
//  $article = Article::all();
//  return view('manage',['article' => $article]);
//  }
    public function addabsen(){ 
        $mapel = MataPelajaran::all();
        return view('siswa.createAbsensi', ['mapel' => $mapel]);
	}
    public function addAbsensi(Request $request) {   
        AbsensiSiswa::create([ 
			'datetime' => $request->datetime, 
			'status' => $request->status,
            'id_mapel' => $request->mapel,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas
        ]); 
        return redirect('siswa/absensi');      
	}
    public function edit($id)
    {
        $absensisiswa = AbsensiSiswa::find($id);
        $mapel = MataPelajaran::all();
        return view('guru.editAbsensi', ['mapel' => $mapel, 'absensisiswa' => $absensisiswa]);
    }

    public function update(Request $request, $id)
    {
        $absensisiswa = Absensi::find($id);
        $absensisiswa->datetime = $request->datetime;
        $absensisiswa->status = $request->status;
        $absensisiswa->id_mapel = $request->mapel;
        $absensisiswa->nama_siswa = $request->nama_siswa;
        $absensisiswa->kelas = $request->kelas;
        $absensisiswa->save();
        return redirect('guru/absensi2');
    }

    public function destroy($id)
    {
        $absensisiswa = AbsensiSiswa::find($id);
        $absensisiswa->delete();
        return redirect('guru/absensi2');
    } 
}