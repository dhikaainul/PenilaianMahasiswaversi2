<?php

namespace App\Http\Controllers;

use App\Guru;
use App\MataPelajaran;
use App\User;
use Auth;
use App\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use PDF;
class GuruController extends Controller
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

    //instansiasi model
    public function model()
    {
        $data = new Guru();
        return $data;
    }
    public function index()
    {
        $guru = Guru::all();
        return view('admin.guru.index', ['guru' => $guru]);
    }


        public function id() {
        $id = str_replace('@mail.com', '', Auth::user()->email);
        return $id;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $mapel = MataPelajaran::all();
        return view('admin.guru.create', ['mapel' => $mapel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Guru::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_mapel' => $request->mapel
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->nip . '@mail.com',
            'password' => Hash::make($request->nip),
            'roles' => 'Guru'
        ]);

        return redirect('guru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
     
    public function show($nip)
    {
        $guru = Guru::where('nip', '=', $nip)->first();
        return view('guru.biodata', ['guru' => $guru]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::find($id);
        $mapel = MataPelajaran::all();
        return view('admin.guru.edit', ['guru' => $guru, 'mapel' => $mapel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::find($id);
        $guru->nip = $request->nip;
        $guru->nama = $request->nama;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->alamat = $request->alamat;
        $guru->no_telp = $request->no_telp;
        $guru->id_mapel = $request->mapel;
        $guru->save();
        return redirect('guru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::find($id);
        $guru->delete();
        return redirect('guru');
    }

    /**
     * Custom function for Dosen
     */

    public function editBiodata($id) 
    {
        $guru = Guru::find($id);
        return view('guru.editBiodata', ['guru' => $guru]);
    }

    public function updateBiodata(Request $request, $id) 
    {
        $img = 'photo';
        $guru = Guru::find($id);
        $guru->nama = $request->nama;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->alamat = $request->alamat;
        $guru->no_telp = $request->no_telp;
        $guru->save();

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
        return redirect('guru/biodata/' . $guru->nip);
    }

    public function indexGuru()
    {
        $guru = Guru::all();
        return view('admin.guru.manage_schedule',compact('guru'));
    }

    public function indexJadwal($id)
    {
        $guru = DB::table('gurus as gs')->join('schedules as ss','ss.guru_id','=','gs.id')
        ->select('ss.id as schedule_id','ss.day','ss.start_time','ss.end_time','gs.*')
        ->where('gs.nip',$id)->get();
        return view('admin.guru.list_jadwal',compact('guru'));
    }

    public function indexEdit($id)
    {
        $guru = DB::table('gurus as gs')->join('schedules as ss','ss.guru_id','=','gs.id')
        ->select('ss.id as schedule_id','ss.day','ss.start_time','ss.end_time','gs.*')
        ->where('ss.id',$id)
        ->first();
        $matkul = MataPelajaran::find($guru->id_mapel);
        return view('admin.guru.manage_schedule_edit',compact('guru','matkul'));
    }

    public function getMatkulByIdGuru($id)
    {
        $data = Guru::find($id);
       
        if($data)
        {
             $matkul = MataPelajaran::find($data->id_mapel);
            return response()->json(['data' => $matkul->nama_mapel]);
        }else
        {
            return response()->json(['data' => 'Mohon Untuk Memilih Guru Dulu!']);
        }
    }

    public function insertJadwal(Request $request)
    {
        DB::table('schedules')->insert(
            [
                'guru_id'=>$request->guru_id
                ,'day'=>$request->day
                ,'start_time'=>$request->start_time
                ,'end_time'=>$request->end_time
            ]
        );

        return redirect('guru');
    }

    public function updateJadwal(Request $request,$id)
    {
        DB::table('schedules')->where('id',$id)->update(
            [
                'day'=>$request->day
                ,'start_time'=>$request->start_time
                ,'end_time'=>$request->end_time
            ]
        );

        return redirect()->back();
    }

      public function deleteJadwal($id)
    {
        DB::table('schedules')->where('id',$id)->delete();

        return redirect()->back();
    }

    public function jadwal()
    {
        $guru = DB::table('gurus as gs')->join('schedules as ss','ss.guru_id','=','gs.id')
        ->select('ss.id as schedule_id','ss.day','ss.start_time','ss.end_time','gs.*')
        ->where('gs.nip',$this->id())->get();
        $guru_s = Guru::where('nip',$this->id())->first();
        $mapel = MataPelajaran::find($guru_s->id_mapel);
        $pdf = PDF::loadview('siswa.jadwal', ['guru' => $guru,'mapel'=>$mapel,'guru_s'=>$guru_s]);
        return $pdf->stream();
    }

    public function lihat_absen($word=null)
    {
        $guru_s =null;
        if($word == null)
        {
            $absensi = [];
        }else
        {
            $absensi = Absensi::orderBy('datetime','DESC')->where('id_guru',$word)->get();
            $guru_s = Guru::find($word);
        }
        $guru = Guru::all();
        return view('admin.guru.manage_absen',compact('guru','absensi','guru_s'));
    }

    public function lihat_absen_ada($word=null)
    {
        $guru_s =null;
        if($word == null)
        {
            $absensi = [];
        }else
        {
            $absensi = Absensi::orderBy('datetime','DESC')->where('id_guru',$word)->get();
            $guru_s = Guru::find($word);
        }
        $guru = Guru::all();
        return view('admin.guru.manage_absen',compact('guru','absensi','guru_s'));
    }

    public function filter_absen(Request $request)
    {
        $absensi = Absensi::orderBy('datetime','DESC')->where('id_guru',$request->id_guru)->get();
        $word =$request->id_guru;
        return redirect('absen_guru/'.$word);
    }
   
}
