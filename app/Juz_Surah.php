<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juz_Surah extends Model
{
    protected $table = 'surahs_juzs';
     protected $primaryKey = 'id';
     public $timestamps = false;

    public function verse()
    {
        return $this->hasMany('App\Surah_Juzz');
    }
}
