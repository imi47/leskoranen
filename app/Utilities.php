<?php
namespace App;


/**
 * 
 */
class Utilities 
{
	
	public static function get_surah_name($surah_id)
	{
		$obj=Surah::select('surah_name')->where('id',$surah_id)->first();
		if($obj)
		{
			echo $obj->surah_name;
		}
		
	}
}

?>