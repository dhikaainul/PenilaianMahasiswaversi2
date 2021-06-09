<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Siswa extends Model
{
    protected $fillable = ['nis', 'nama','jenis_kelamin', 'alamat', 'no_telp', 'id_kelas'];
    
    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }

    public function uploadFile(Request $request,$oke)
    {
            $result ='';
            $file = $request->file($oke);
            $name = $file->getClientOriginalName();
            // $tmp_name = $file['tmp_name'];

            $extension = explode('.',$name);
            $extension = strtolower(end($extension));

            $key = rand().'-'.$oke;
            $tmp_file_name = "{$key}.{$extension}";
            $tmp_file_path = "assets/images/";
            $file->move($tmp_file_path,$tmp_file_name);
            // if(move_uploaded_file($tmp_name, $tmp_file_path)){
            $result =url('assets/images').'/'.$tmp_file_name;
            // }
        return $result;
     }
}
