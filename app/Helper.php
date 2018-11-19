<?php

	function admin(){
		return 'admin';
	}

	function ext($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit;
	}

	function wext($data)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	function form_error_message()
	{
		return 'Some Errors occured, Please Review the Page and Correct the Errors';
	}

	function admin_uri()
	{
		return \Request::segment(2);
	}

	function surahs_count()
	{
		return \App\Surah::count();
	}
	function users_count()
	{
		return \App\Users::where('role',1)->count();
	}

	function juzs_count()
	{
		return \App\Juz::count();
	}

	function reports_count()
	{
		return \App\Bugs::count();
	}