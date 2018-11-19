<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juz extends Model
{
    public function starting_surah()
    {
    	return $this->belongsTo('App\Surah' , 'start_surah_id' , 'id');
    }

    public function starting_surah_verse()
    {
    	return $this->belongsTo('App\Verses' , 'start_verse_id' , 'id');
    }

    public function ending_surah()
    {
    	return $this->belongsTo('App\Surah' , 'end_surah_id' , 'id');
    }

    public function ending_surah_verse()
    {
    	return $this->belongsTo('App\Verses' , 'end_verse_id' , 'id');
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
