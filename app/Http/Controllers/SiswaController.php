<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Kelas;
use App\User;
use App\MataPelajaran;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function model()
    {
        $data = new Siswa();
        return $data;
    }
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.siswa.index', ['siswa' => $siswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_kelas' => $request->kelas
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->nis . '@mail.com',
            'password' => Hash::make($request->nis),
            'roles' => 'Siswa'
        ]);

        return redirect('siswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($nis)
    {
        $siswa = Siswa::where('nis', '=', $nis)->first();
        return view('siswa.biodata', ['siswa' => $siswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        return view('admin.siswa.edit', ['siswa' => $siswa, 'kelas' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->id_kelas = $request->kelas;
        $siswa->save();
        return redirect('siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect('siswa');
    }

    /**
     * Custom function for Mahasiswa
     */

    public function editBiodata($id) 
    {
        $siswa = Siswa::find($id);
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function updateBiodata(Request $request, $id) 
    {
        $img='photo';
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->save();

         //user 
        $user = User::find(Auth::user()->id);
        if ($request->file('photo') != null) 
        {
            $user->photo = $this->model()->uploadFile($request,$img);
        }else
        {
            $user->photo = $request->old_photo;
        }
        $user->save();

        return redirect('siswa/biodata/' . $siswa->nis);
    }
}
