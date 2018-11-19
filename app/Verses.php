<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Verses extends Model
{
    use SoftDeletes;
    protected $table = 'verses';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function surah()
    {
    	return $this->belongsTo('App\Surah','surah_id','id');
    }

    public function recitor()
    {
    	return $this->belongsTo('App\Role','recitor_id','id')->where('role' , 'recitor');
    }

    public function translator()
    {
    	return $this->belongsTo('App\Role','translator_id','id')->where('role' , 'translator');
    }

    public function getDescriptionAttribute($v)
    {
        return nl2br($v);
    }

    public function added_by()
    {
        return $this->belongsTo('App\User' , 'created_by' , 'id');
    }

    public function edited_by()
    {
    	return $this->belongsTo('App\User' , 'updated_by' , 'id');
    }

    // public function getArabicImmuneAttribute()
    // {
    //     return $this->attributes['arabic_immune'];
    // }
}
