<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Surah;
use App\Role;
use App\Juz;  
use App\Verses;
use App\Bookmarks;
use App\Bugs;
class UserController extends Controller
{
	public function test()
	{
		$data['title']="Test";
		$data['title']="Quran e Kareem";
		$data['surah']=Surah::with('verse')->where('id','3')->first();
		$data['surahs']=Surah::all();
		return view('user/test',$data);
	}
	public function index()
	{
		$data['title']="Quran e Kareem";
		$data['surah']=Surah::with('verse')->where('id','3')->first();
		$data['recitors']=Role::where([['status','=','active'],['role','=','recitor']])->get();
		//$data['raku'] = Verses::where('surah_id','3')->max('raku')->first();
		// echo $data['raku'];
		// die();
		$data['surahs']=Surah::withCount('verse')->has('verse' , '>' , 0)->orderBy('surah_number' , 'asc')->get();
		return view('user/home',$data);
	}
	public function get_surah(Request $request)
	{
		$messages = array(
			'surah_id.required'   => 'This Field is Required');
		$rules = array(
			'surah_id'=>'required');
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			if(request('get_special') == 'null'){
				$data=Surah::with('verse')->where('id',$request->surah_id)->first();
				$data['feedback'] = 'true';
			}
			elseif(request('get_special') == 'next'){
				$surah=Surah::find($request->surah_id);
				if($surah->surah_number == 114){
					$data=Surah::with('verse')->where('id',$request->surah_id)->first();
					$data['feedback'] = 'false';
				}else{
					$data=Surah::withCount('verse')->has('verse' , '>' , 0)->with('verse')->where('surah_number' , '>' , $surah->surah_number)->orderBy('surah_number' , 'asc')->first();
					$data['feedback'] = 'true';
				}
			}elseif(request('get_special') == 'pre'){
				$surah=Surah::find($request->surah_id);
				if($surah->surah_number == 1){
					$data=Surah::with('verse')->where('id',$request->surah_id)->first();
					$data['feedback'] = 'false';
				}else{
					$data=Surah::withCount('verse')->has('verse' , '>' , 0)->with('verse')->where('surah_number' , '<' , ($surah->surah_number-1))->orderBy('surah_number' , 'desc')->first();
					$data['feedback'] = 'true';
				}
			}
			return json_encode($data);
		}
	}
	public function get_surah_form_verse(Request $request)
	{
		$messages = array(
			'surah_id.required'   => 'This Field is Required',
			'from_verse.required'   => 'This Field is Required',
			'to_verse.required'   => 'This Field is Required',
		);
		$rules = array(
			'surah_id'=>'required',
			'from_verse'=>'required',
			'to_verse'=>'required',
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			$r=$request->from_verse;
			$p=$request->to_verse;
			$data=Surah::with(['verse' =>
				function($q) use($r,$p){
					$q->where([['verses.verse','>=',$r],['verses.verse','<=',$p]])->get();
				}])->where('id',$request->surah_id)->first();
			return json_encode($data);
		}
	}
	public function get_surah_to_verse(Request $request)
	{
		$messages = array(
			'surah_id.required'   => 'This Field is Required',
			'from_verse.required'   => 'This Field is Required',
			'to_verse.required'   => 'This Field is Required',
		);
		$rules = array(
			'surah_id'=>'required',
			'from_verse'=>'required',
			'to_verse'=>'required',
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			$r['from']=$request->from_verse;
			$r['to']=$request->to_verse;
			$data=Surah::with(['verse' =>
				function($q) use($r){
					$q->where([['verses.verse','>=',$r['from']],['verses.verse','<=',$r['to']]])->get();
				}])->where('id',$request->surah_id)->first();
			return json_encode($data);
		}
	}
	public function get_audio_source(Request $request)
	{
		$messages = array(
			'surah_id.required'   => 'This Field is Required',
		);
		$rules = array(
			'surah_id'=>'required',
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			$surah_id=$request->surah_id;
			$data=Verses::select('verse','link_to_audio')->where('surah_id',$request->surah_id)->first();

			return json_encode($data);
		}
	}
	public function get_next_audio(Request $request)
	{
		$messages = array(
			'surah_id.required'   => 'This Field is Required',
		);
		$rules = array(
			'surah_id'=>'required',
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{

			$data=Verses::select('verse','link_to_audio' , 'description')->where([['surah_id','=',$request->surah_id],['verse','=',$request->current_verse_id]])->first();
			if($data){
				$data['f'] = 'true';
			}else{
				$data['f'] = 'false';
			}
			return json_encode($data);
		}
	}
	public function get_juz(Request $request)
	{
		$messages = array(
			'juz_number.required'   => 'This Field is Required'

		);
		$rules = array(
			'juz_number'=>'required'
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{

			$r=$request->juz_number;
			$data=Surah::with(['verse' =>
				function($q) use($r){
					$q->where('verses.juzz_number','=',$r)->get();
				}])->get();
			if($data)
			{
				return json_encode($data);
			}
			else
			{
				return 0;
			}
		}
	}
	public function get_search(Request $request)
	{
		$messages = array(
			'surah_id.required'   => 'This Field is Required',
			'search_text.required'   => 'This Field is Required',
			'search_lang.required'   => 'This Field is Required'

		);
		$rules = array(
			'surah_id'=>'required',
			'search_text'=>'required',
			'search_lang'=>'required'
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			if(request('immn') == 1){
				$data='';
				if($request->surah_id!="all")
				{
					if($request->search_lang=="1")
					{
						$data=Verses::with('surah')->where([['surah_id','=',$request->surah_id],['arabic_immune', 'like', '%' . $request->search_text . '%']])->get();
					}
					elseif($request->search_lang=="2")
					{
						$data=Verses::with('surah')->where([['surah_id','=',$request->surah_id],['translation', 'like', '%' . $request->search_text . '%']])->get();
					}
				}
				else if($request->surah_id=="all")
				{
					
					if($request->search_lang=="1")
					{
						$data=Verses::with('surah')->where([['arabic_immune', 'like', '%' . $request->search_text . '%']])->get();
					}
					elseif($request->search_lang=="2")
					{
						$data=Verses::with('surah')->where([['translation', 'like', '%' . $request->search_text . '%']])->get();
					}
				}
			}
			if(request('immn') == 2){
				$data='';
				if($request->surah_id!="all")
				{
					if($request->search_lang=="1")
					{
						$data=Verses::with('surah')->where([['surah_id','=',$request->surah_id],['arabic_no_immune', 'like', '%' . $request->search_text . '%']])->get();
					}
					elseif($request->search_lang=="2")
					{
						$data=Verses::with('surah')->where([['surah_id','=',$request->surah_id],['translation', 'like', '%' . $request->search_text . '%']])->get();
					}
				}
				else if($request->surah_id=="all")
				{
					
					if($request->search_lang=="1")
					{
						$data=Verses::with('surah')->where([['arabic_no_immune', 'like', '%' . $request->search_text . '%']])->get();
					}
					elseif($request->search_lang=="2")
					{
						$data=Verses::with('surah')->where([['translation', 'like', '%' . $request->search_text . '%']])->get();
					}
				}
			}
			return $data;
		}
	}
	public function send_invitation(Request $request)
	{
		$messages = array(
			'name.required'   => 'This Field is Required',
			'sender_email.required'   => 'This Field is Required',
			'message.required'   => 'This Field is Required',
			'receiver_email.required'   => 'This Field is Required'

		);
		$rules = array(
			'name'=>'required',
			'sender_email'=>'required',
			'message'=>'required',
			'receiver_email'=>'required'
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			$data['name'] =  $request->name;
			$data['sender_email'] =  $request->sender_email;
			$data['msg'] =  $request->message;
			$data['receiver_email'] =  $request->receiver_email;
			$data['subject'] = "Read Quran ";
			\Mail::send('user.email', $data, function($message) use ($data){ 
				$message->to($data['receiver_email'])->from(env(), 'Quran Online' )->subject($data['subject']);
			});
			if(\Mail::failures()){
				return 0;
			}
			else
			{
				return 1;
			}
		}
	}

	public function save_bookmarks(Request $request)
	{
		$messages = array(
			'email.required'   => 'This Field is Required',
			'surah_id.required'   => 'This Field is Required',
			'from_verse.required'   => 'This Field is Required',
			'to_verse.required'   => 'This Field is Required'

		);
		$rules = array(
			'email'=>'required',
			'surah_id'=>'required',
			'from_verse'=>'required',
			'to_verse'=>'required'
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			\Session::forget('book_mark_data');
			\Session::forget('emailed_bookmark_code');
			request()->session()->push('book_mark_data', request()->all());
			$code = mt_rand(10000,99999);
			\Session::put('emailed_bookmark_code' , $code);
			$data['email'] = $request->email;
			$data['msg'] = 'Verification Code is  ' . $code;
			\Mail::send('email.general', $data, function($message) use ($data){ 
				$message->to($data['email'])->from(env('MAIL_USERNAME'), 'Quran Online' )->subject('Bookmark Verification Code');
			});
			if(\Mail::failures()){
				echo 'failed';
			}else
			{
				echo 'success';
			}
			exit();
			$check=Bookmarks::where([['email','=',$request->email],['surah_id','=',$request->surah_id],['from_verse','=',$request->from_verse],['to_verse','=',$request->to_verse]])->first();
			if(empty($check))
			{
				$obj=new Bookmarks();
				$obj->email = $request->email ;
				$obj->surah_id = $request->surah_id ;
				$obj->from_verse = $request->from_verse ;
				$obj->to_verse = $request->to_verse ;

				if($obj->save()){
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return 2;
			}

		}
	}
	public function get_bookmarks(Request $request)
	{
		$messages = array(
			'email.required'   => 'This Field is Required',
			

		);
		$rules = array(
			'email'=>'required',
			
		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 0;
		}
		else
		{
			$check=Bookmarks::where('email',$request->email)->get();
			if(empty($check))
			{
				return 2;
			}
			else
			{
				return json_encode($check);
			}
		}
	}

	public function save_bug_report(Request $request)
	{
		$messages = array(
			'name.required'   => 'This Field is Required',
			'surah_id.required'   => 'This Field is Required',
			'from_verse.required'   => 'This Field is Required',
			'to_verse.required'   => 'This Field is Required',
			'recitor_id.required'   => 'This Field is Required',
			'erorr_script.required'   => 'This Field is Required',
			'summery.required'   => 'This Field is Required',
			'details.required'   => 'This Field is Required',

		);
		$rules = array(
			'name'=>'required',
			'surah_id'=>'required',
			'from_verse'=>'required',
			'to_verse'=>'required',
			'recitor_id'=>'required',
			'erorr_script'=>'required',
			'summery'=>'required',
			'details'=>'required',

		);
		$validator = \Validator::make($request->all(), $rules , $messages);
		if ($validator->fails())
		{
			return 2;
		}
		else
		{	
			$obj=new Bugs();
			$obj->name = $request->name ;
			$obj->surah_id = $request->surah_id ;
			$obj->from_verse = $request->from_verse ;
			$obj->to_verse = $request->to_verse ;
			$obj->recitor_id = $request->recitor_id ;
			$obj->script = $request->erorr_script ;
			$obj->summery = $request->summery ;
			$obj->details = $request->details ;

			if($obj->save()){
				return $obj->id;
			}
			else
			{
				return 0;
			}
		}
	}
}
