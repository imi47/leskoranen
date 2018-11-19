<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
	protected $table = 'bookmarks';
	protected $primaryKey = 'id';
	public $timestamps = false;
}
