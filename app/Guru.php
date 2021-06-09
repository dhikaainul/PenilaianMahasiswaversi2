<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Guru extends Model
{
    protected $fillable = ['nip', 'nama','jenis_kelamin', 'alamat', 'no_telp', 'id_mapel'];
    
    public function mapel()
    {
        return $this->belongsTo('App\MataPelajaran', 'id_mapel');
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
