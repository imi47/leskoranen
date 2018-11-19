<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test','UserController@test');
Route::get('/','UserController@index');
Route::post('/get-surah','UserController@get_surah');
Route::post('/get-surah-from-verse','UserController@get_surah_form_verse');
Route::post('/get-surah-to-verse','UserController@get_surah_to_verse');
Route::post('/get-surah-audio','UserController@get_audio_source');
Route::post('/get-juzz','UserController@get_juz');
Route::post('/get-next-audio','UserController@get_next_audio');
Route::post('/get-search','UserController@get_search');
Route::post('/send_invitation','UserController@send_invitation');
Route::post('/save_bookmarks','UserController@save_bookmarks');
Route::post('/get_bookmarks','UserController@get_bookmarks');
Route::post('/save_bug_report','UserController@save_bug_report');

Route::get(admin().'/' , 'AdminController@showLoginForm')->name('login');
Route::post(admin().'/login' , 'AdminController@login')->name('admin-login');

Route::group(['prefix' => admin() , 'middleware' => 'Admin'] , function(){

	Route::get('dashboard' , 'AdminController@dashboard')->name('dashboard');
	
	Route::post('post-admin' , 'AdminController@post_admin')->name('post-admin')->middleware('SuperAdmin');
	Route::get('add-admin' , 'AdminController@add_admin')->name('add-admin')->middleware('SuperAdmin');
	Route::get('all-admins' , 'AdminController@all_admin')->name('all-admin')->middleware('SuperAdmin');
	Route::get('edit-admin/{id}' , 'AdminController@edit_admin')->name('edit-admin')->middleware('SuperAdmin');
	
	Route::get('add-surah' , 'AdminController@add_surah')->name('add-surah');
	Route::post('post-surah' , 'AdminController@post_surah')->name('post-surah');
	Route::get('all-surahs' , 'AdminController@all_surahs')->name('all-surahs');
	Route::get('edit-surah/{surah_id}' , 'AdminController@edit_surah')->name('edit-surah');
	Route::post('update-surah' , 'AdminController@update_surah')->name('update-surah');

	Route::get('add-verse/{surah_id}' , 'AdminController@add_verse')->name('add-verse');
	Route::post('post-verse' , 'AdminController@post_verse')->name('post-verse');
	Route::get('all-verses/{surah_id}' , 'AdminController@all_verses')->name('all-verses');
	Route::get('edit-verse/{verse_id}' , 'AdminController@edit_verses')->name('edit-verse');
	Route::post('update-verse' , 'AdminController@update_verse')->name('update-verse');
	Route::post('delete-verse' , 'AdminController@delete_verse')->name('delete-verse');

	Route::get('add-juz' , 'AdminController@add_juz')->name('add-juz');
	Route::post('post-juz' , 'AdminController@post_juz')->name('post-juz');
	Route::get('all-juzs' , 'AdminController@all_juzs')->name('all-juzs');
	Route::get('edit-juz/{juz_id}' , 'AdminController@edit_juz')->name('edit-juz');
	Route::post('update-juz' , 'AdminController@update_juz')->name('update-juz');

	Route::get('all-bug-reports' , 'AdminController@bug_reports')->name('all-bug-reports');
	Route::get('delete-bug-report/{bug_id}' , 'AdminController@delete_bug_report')->name('delete-bug-report');

	Route::post('logout' , function(){
	 \Auth::logout();
	 return back();
	})->name('admin-logout');
});

// Route::group(['prefix' => "admin"], function(){
// 	Route::get('/','AdminController@login');
// 	Route::post('/login/authenticate','AdminController@login_authenticate');
// 	Route::get('/dashboard','AdminController@dashboard');
// 	Route::get('/logout','AdminController@logout');

// //juzz
// 	Route::get('/all-juz','AdminController@all_juz');
// 	Route::get('/create-juz','AdminController@create_juz');
// 	Route::post('/save-juz','AdminController@save_juz');  
// 	Route::get('/juz/{action}/{id}','AdminController@juz_action');
// 	Route::post('/get-surah','AdminController@get_surah');  

// // surah 
// 	Route::get('/add-surah','AdminController@add_surah');
// 	Route::post('/save-surah','AdminController@save_surah');
// 	Route::get('/all-surah','AdminController@all_surah');
// 	Route::get('/surah-edit/{id}','AdminController@edit_surah');
// 	Route::get('/surah-details/{id}','AdminController@surah_details');
// 	Route::post('/get-surah-details','AdminController@get_surah_details');

// //verses 
// 	Route::get('/add-verse','AdminController@add_verse');
// 	Route::post('/save-verse','AdminController@save_verse');
// 	Route::get('/all-verses','AdminController@all_verses');
// 	Route::get('/verse-edit/{id}','AdminController@verse_edit');
// 	Route::post('/update-verse','AdminController@update_verse');
	
// //roles
// 	Route::get('/add-recitors','AdminController@add_recitors');
// 	Route::post('/save-recitor','AdminController@save_recitor');
// 	Route::post('/save-translators','AdminController@save_translators');
// 	Route::get('/{role}/{action}/{id}','AdminController@role_action');
// 	Route::get('/add-translators','AdminController@add_translators');
// 	Route::get('/all-roles','AdminController@all_roles');
// 	Route::post('/update-role','AdminController@update_role');

// //test 
// 	Route::get('/test','AdminController@test');
// });
