<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surah extends Model
{
	use SoftDeletes;
    public function verse()
    {
        return $this->hasMany('App\Verses');
    }
    
    public function juz()
    {
        return $this->belongsToMany('App\Juz');
    }

    public function added_by()
    {
        return $this->belongsTo('App\User' , 'created_by' , 'id');
    }

    public function edited_by()
    {
    	return $this->belongsTo('App\User' , 'updated_by' , 'id');
    }
}
