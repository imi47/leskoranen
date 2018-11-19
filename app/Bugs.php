<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bugs extends Model
{
	protected $table = 'bugs';
	protected $primaryKey = 'id';

	public function surah()
    {
    	return $this->belongsTo('App\Surah','surah_id','id');
    }

    public function recitor()
    {
    	return $this->belongsTo('App\Role','recitor_id','id')->where('role' , 'recitor');
    }
}
