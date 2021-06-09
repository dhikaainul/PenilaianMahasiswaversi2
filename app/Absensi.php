<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['datetime', 'status','nama_mapel','id_mapel','id_guru'];
    public function mapel()
    {
        return $this->belongsTo('App\MataPelajaran', 'id_mapel');
    }
    public function guru()
    {
        return $this->belongsTo('App\Guru', 'id_guru');
    }
}
