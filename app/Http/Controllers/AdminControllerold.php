<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use\App\Users;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->paginator = 30;
        $this->middleware('AdminRoleJson' , ['only' => [
            'delete_verse'
        ]]);
    }

    public function showLoginForm()
    {
        if(Auth::check())
        {
            return redirect()->route('dashboard');
        }
        $data['title'] = 'Login';
        return view('admin.auth.login')->with($data);
    }

    public function login()
    {
        if(Auth::check())
        {
            $data['url'] = admin();
            $data['feedback'] = 'true';
            return json_encode($data);
        }
        $messages = array(
            'email.required'  => 'This Field is Required',
            'password.required'  => 'This Field is Required',
        );
        $rules = array(
            'email'    => 'required',
            'password' => 'required'
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
        }
        else
        {
            $text = request('email', 'test');
            if(substr($text , 0 , 1) == '+')
            {
                $text = substr($text, 1);
            }
            elseif(substr($text , 0 , 1) == '0')
            {
                $text = '92'.substr($text, 1);
            }
            elseif(substr($text , 0 , 1) == '3')
            {
                $text = '92'.substr($text, 0);   
            }
            if (Auth::attempt(['username' => $text , 'password' => request('password' , 'test'), 'status' => 1 , 'is_admin' => 1 , 'is_blocked' => 0]) OR Auth::attempt(['email' => $text , 'password' => request('password' , 'test'), 'status' => 1 , 'is_admin' => 1 , 'is_blocked' => 0]) OR Auth::attempt(['phone' => $text , 'password' => request('password' , 'test'), 'status' => 1 , 'is_admin' => 1 , 'is_blocked' => 0])) {
                $data['url'] = admin();
                $data['feedback'] = 'true';
            }else{
                $data['msg'] = "<div class='alert alert-danger'><strong>Error!</strong> Invalid Credentials</div>";
                $data['feedback'] = 'invalid';
            }
        }
        return json_encode($data);

    }

    public function add_admin()
    {
         $data['title'] = 'Add Admin';
        return view('admin.add-admin')->with($data);
    }

    public function post_admin(Request $request)
    {
        $id=$request->id;
        if(empty($id))
           {
        $messages = array(
       
          'name.required' => 'You must enter your name',
          'username.required' => 'You must enter your username',
          'email.required' => 'You must enter your email', 
           'password.required' => 'You must enter your password',
           'phone.required' => 'You must enter your phone number',
            'password_confirmation.required' => 'You must enter your confirm password',
           'email.unique' => 'Email address already exist',
           
           'phone.unique' => 'phone number already exist',
           'username.unique' => 'User name already exist',
           'username.unique' => 'Phone number already exist',
            'password.confirmed' => 'Your passwords dont match please try again!',
       
         
         );
         $rules = array(
            'username' =>'bail|required|unique:users,username|min:3',
               'email' => 'bail|required|unique:users,email',
             'phone' => 'bail|unique:users,phone',
          
           
        
         'name' => 'required',
          'password' => 'bail|required|confirmed|min:3',
          'password_confirmation' => 'bail|required|min:3',
                

         );
     }


     else
     {
         $messages = array(
       
          'name.required' => 'You must enter your name',
          'username.required' => 'You must enter your username',
          'email.required' => 'You must enter your email', 
           'password.required' => 'You must enter your password',
           'phone.required' => 'You must enter your phone number',
            'password_confirmation.required' => 'You must enter your confirm password',
           'email.unique' => 'Email address already exist',
           
           
       
         
         );
         $rules = array(
           
            'username'=>'required',
            'phone'=>'required',
            'email'=>'required', 
        
         'name' => 'required',
          'password' => 'bail|required|confirmed|min:3',
          'password_confirmation' => 'bail|required|min:3',
                

         );
     }
            
         $validator = \Validator::make($request->all(), $rules , $messages);
          if ($validator->fails())
          {
             return redirect()->back()->withInput()->withErrors($validator);
              // return redirect()->back()->withErrors($validator->errors());
          }

           else
          {

          if(empty($id))
          {


        $user=new Users();
        } 
        else
        {
         $user=Users::find($id);
        }
        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $passwords=$request->password;
        $enc_password=bcrypt($passwords);
        $user->password=$enc_password;
        $user->role=1;
        $user->is_admin=1;
        $user->save();

    }
        return redirect()->route('all-admin');
        // return redirect('all_admins');

    }

      public function all_admin()
    {
       $data['admin_view']=Users::where('role',1)->orderBy('id','desc')->paginate('12');
       $data['title'] = 'All Admin';
        return view('admin.all-admin')->with($data);
       // dd($admin_view);
    }

    public function dashboard()
    {

        $data['title'] = 'Dashboard';
        return view('admin.dashboard')->with($data);
    }

    public function edit_admin($id)
    {
        $user_id=decrypt($id);
        $data['edit']=Users::find($user_id);
        $data['title'] = 'Edit Admin';
        return view('admin.edit-admin')->with($data);
    }

    /////////////// User ///////////////

    public function block_user()
    {
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $user = \App\User::find($user_id);
            if($user)
            {
                $user->is_blocked = 1;
                $user->save();
                $data['user_id'] = $user_id;
                $data['feedback'] = 'true';
                $data['msg'] = 'User Blocked Successfully';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    /////////////// User ///////////////

    /////////////// Surah ///////////////

    public function add_surah()
    {
        $data['title'] = 'Add Surah';
        return view('admin.surah.add')->with($data);
    }

    public function post_surah()
    {
        $messages = array(
            'nsurahname.required' => 'This Field is Required',
            'nsurahname.unique' => 'This name already exists',
            'nsurahnamearabic.required' => 'This Field is Required',
            'nsurahnamearabic.unique' => 'This name already exists',
            'nsurahnumber.required' => 'This Field is Required',
            'nsurahnumber.numeric' => 'Must be a number',
            'nsurahnumber.min' => 'Minimum allowed Surah number is 1',
            'nsurahnumber.max' => 'Maximum allowed Surah number is 114',
            'nsurahnumber.unique' => 'This Surah Number already exists',
            'nsurahjuznumber.required' => 'This Field is Required',
            'nsurahjuznumber.numeric' => 'Must be a number',
            'nsurahjuznumber.min' => 'Minimum allowed Juz number is 1',
            'nsurahjuznumber.max' => 'Maximum allowed Juz number is 30',
            'nsurahendjuznumber.required' => 'This Field is Required',
            'nsurahendjuznumber.numeric' => 'Must be a number',
            'nsurahendjuznumber.min' => 'Minimum allowed Juz number is 1',
            'nsurahendjuznumber.max' => 'Maximum allowed Juz number is 30',
            'ntotalverses.required' => 'This Field is Required',
            'ntotalverses.numeric' => 'Must be a number',
            'ntotalverses.min' => 'Minimum allowed number is 1',
            'ntotalruku.required' => 'This Field is Required',
            'ntotalruku.numeric' => 'Must be a number',
            'ntotalruku.min' => 'Minimum allowed number is 1',
            'nsurahtype.required' => 'This Field is Required',
            'nsurahintro.required' => 'This Field is Required',
            'nsurahdescription.required' => 'This Field is Required',
        );
        $rules = array(
            'nsurahname' => 'required|unique:surahs,surah_name',
            'nsurahnamearabic' => 'required|unique:surahs,surah_name_arabic',
            'nsurahnumber' => 'required|numeric|min:1|max:114|unique:surahs,surah_number',
            'nsurahjuznumber' => 'required|numeric|min:1|max:30',
            'nsurahendjuznumber' => 'required|numeric|min:1|max:30',
            'ntotalverses' => 'required|numeric|min:1',
            'ntotalruku' => 'required|numeric|min:1',
            'nsurahtype' => 'required',
            'nsurahintro' => 'required',
            // 'nsurahdescription' => 'required',
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            $data['msg'] = form_error_message();
        }
        else
        {
            $surah = new \App\Surah();
            $surah->surah_name = request('nsurahname');
            $surah->surah_name_arabic = request('nsurahnamearabic');
            $surah->type_id = request('nsurahtype');
            $surah->surah_number = request('nsurahnumber');
            $surah->juz_id = request('nsurahjuznumber');
            $surah->juz_ending_id = request('nsurahendjuznumber');
            $surah->raku = request('ntotalruku');
            $surah->verses = request('ntotalverses');
            $surah->introduction = request('nsurahintro' , '');
            $surah->description = request('nsurahdescription' , '');
            $surah->created_by = Auth::user()->id;
            $surah->updated_by = Auth::user()->id;
            $surah->save();
            $data['url'] = route('all-surahs');
            $data['feedback'] = 'true';
            $data['msg'] = 'Surah Added Successfully';
        }
        return json_encode($data);
    }

    public function all_surahs()
    {
        $data['title'] = 'All Surahs';
        $data['listing'] = \App\Surah::orderBy('surah_number' , 'asc')->paginate(30);
        return view('admin.surah.all')->with($data);
    }

    public function edit_surah($surah_id)
    {
        try {
            $surah_id = decrypt($surah_id);
        } catch (\RuntimeException $e) {
            return redirect()->route('all-surahs');
        }
        $data['d'] = \App\Surah::find($surah_id);
        $data['surah'] = $data['d'];
        $data['title'] = 'Update Surah | ' . $data['d']->surah_name;
        return view('admin.surah.edit')->with($data);
    }

    public function update_surah()
    {
        $messages = array(
            'nsurahname.required' => 'This Field is Required',
            'nsurahname.unique' => 'This name already exists',
            'nsurahnamearabic.required' => 'This Field is Required',
            'nsurahnamearabic.unique' => 'This name already exists',
            'nsurahnumber.required' => 'This Field is Required',
            'nsurahnumber.numeric' => 'Must be a number',
            'nsurahnumber.min' => 'Minimum allowed Surah number is 1',
            'nsurahnumber.max' => 'Maximum allowed Surah number is 114',
            'nsurahjuznumber.required' => 'This Field is Required',
            'nsurahjuznumber.numeric' => 'Must be a number',
            'nsurahjuznumber.min' => 'Minimum allowed Juz number is 1',
            'nsurahjuznumber.max' => 'Maximum allowed Juz number is 30',
            'nsurahendjuznumber.required' => 'This Field is Required',
            'nsurahendjuznumber.numeric' => 'Must be a number',
            'nsurahendjuznumber.min' => 'Minimum allowed Juz number is 1',
            'nsurahendjuznumber.max' => 'Maximum allowed Juz number is 30',
            'ntotalverses.required' => 'This Field is Required',
            'ntotalverses.numeric' => 'Must be a number',
            'ntotalverses.min' => 'Minimum allowed number is 1',
            'ntotalruku.required' => 'This Field is Required',
            'ntotalruku.numeric' => 'Must be a number',
            'ntotalruku.min' => 'Minimum allowed number is 1',
            'nsurahtype.required' => 'This Field is Required',
            'nsurahintro.required' => 'This Field is Required',
            'nsurahdescription.required' => 'This Field is Required',
        );
        $rules = array(
            'nsurahname' => 'required|unique:surahs,surah_name,' . request('surah_id') . ',id',
            'surah_id' => 'required',
            'nsurahnamearabic' => 'required|unique:surahs,surah_name_arabic,' . request('surah_id') . ',id',
            'nsurahnumber' => 'required|numeric|min:1|max:114',
            'nsurahjuznumber' => 'required|numeric|min:1|max:30',
            'nsurahendjuznumber' => 'required|numeric|min:1|max:30',
            'ntotalverses' => 'required|numeric|min:1',
            'ntotalruku' => 'required|numeric|min:1',
            'nsurahtype' => 'required',
            'nsurahintro' => 'required',
            // 'nsurahdescription' => 'required',
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            $data['msg'] = form_error_message();
        }
        else
        {
            $surah = \App\Surah::find(request('surah_id'));
            $surah->surah_name = request('nsurahname');
            $surah->surah_name_arabic = request('nsurahnamearabic');
            $surah->type_id = request('nsurahtype');
            $surah->surah_number = request('nsurahnumber');
            $surah->juz_id = request('nsurahjuznumber');
            $surah->juz_ending_id = request('nsurahendjuznumber');
            $surah->raku = request('ntotalruku');
            $surah->verses = request('ntotalverses');
            $surah->introduction = request('nsurahintro' , '');
            $surah->description = request('nsurahdescription' , '');
            $surah->updated_by = Auth::user()->id;
            $surah->save();
            $data['url'] = route('all-surahs');
            $data['feedback'] = 'true';
            $data['msg'] = 'Surah Updated Successfully';
        }
        return json_encode($data);
    }

    /////////////// Surah ///////////////


    /////////////// Juz ///////////////

    public function add_juz()
    {
        $data['title'] = 'Add Juz';
        $data['surahs'] = \App\Surah::orderBy('surah_number' , 'asc')->get();
        return view('admin.juz.add')->with($data);
    }

    public function post_juz()
    {
        $messages = array(
            'njuzname.required' => 'This Field is Required',
            'njuzname.unique' => 'This name already exists',
            'njuznumber.required' => 'This Field is Required',
            'njuznumber.unique' => 'This juz already exists',
            'nstartsurah.required' => 'This Field is Required',
            'nstartsurahverse.required' => 'This Field is Required',
            'nendsurah.required' => 'This Field is Required',
            'nendsurahverse.required' => 'This Field is Required',
        );
        $rules = array(
            'njuzname' => 'required|unique:juzs,juz_name',
            'njuznumber' => 'required|unique:juzs,juz_number',
            'nstartsurah' => 'required',
            'nstartsurahverse' => 'required',
            'nendsurah' => 'required',
            'nendsurahverse' => 'required',
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            $data['msg'] = form_error_message();
        }
        else
        {
            $starting_verse = \App\Verses::where(['surah_id' => request('nstartsurah') , 'verse' => request('nstartsurahverse')])->first();
            if(count((array)$starting_verse) == 0){
                $data['feedback'] = 'other_error';
                $data['msg'] = form_error_message();
                $data['custom_msg'] = 'This Verse has not been added yet, <a target="_blank" href="'.route('add-verse' , ['surah_id' => encrypt(request('nstartsurah'))]).'">Add Verse</a>';
                $data['id'] = 'nstartsurahverse';
                return json_encode($data);
            }
            $ending_verse = \App\Verses::where(['surah_id' => request('nendsurah') , 'verse' => request('nendsurahverse')])->first();
            if(count((array)$ending_verse) == 0){
                $data['feedback'] = 'other_error';
                $data['msg'] = form_error_message();
                $data['custom_msg'] = 'This Verse has not been added yet, <a target="_blank" href="'.route('add-verse' , ['surah_id' => encrypt(request('nendsurah'))]).'">Add Verse</a>';
                $data['id'] = 'nendsurahverse';
                return json_encode($data);
            }
            $juz = new \App\Juz();
            $juz->juz_name = request('njuzname');
            $juz->juz_number = request('njuznumber');
            $juz->start_surah_id = request('nstartsurah');
            $juz->start_verse_id = $starting_verse->id;
            $juz->end_surah_id = request('nendsurah');
            $juz->end_verse_id = $ending_verse->id;
            $juz->created_by = Auth::user()->id;
            $juz->updated_by = Auth::user()->id;
            $juz->Save();
            $data['url'] = route('all-juzs');
            $data['feedback'] = 'true';
            $data['msg'] = 'Juz Added Successfully';
        }
        return json_encode($data);
    }

    public function all_juzs()
    {
        $data['title'] = 'All Juz';
        $data['listing'] = \App\Juz::orderBy('juz_number' , 'asc')->paginate(50);
        return view('admin.juz.all')->with($data);
    }

    public function edit_juz($juz_id)
    {
        try {
            $juz_id = decrypt($juz_id);
        } catch (\RuntimeException $e) {
            return redirect()->route('all-surahs');
        }

        $data['juz'] = \App\Juz::find($juz_id);
        $data['surahs'] = \App\Surah::orderBy('surah_number' , 'asc')->get();
        $data['title'] = 'Update Juz';
        return view('admin.juz.edit')->with($data);
    }

    public function update_juz()
    {
        $messages = array(
            'njuzname.required' => 'This Field is Required',
            'njuzname.unique' => 'This name already exists',
            'njuznumber.required' => 'This Field is Required',
            'njuznumber.unique' => 'This juz already exists',
            'nstartsurah.required' => 'This Field is Required',
            'nstartsurahverse.required' => 'This Field is Required',
            'nendsurah.required' => 'This Field is Required',
            'nendsurahverse.required' => 'This Field is Required',
        );
        $rules = array(
            'njuzname' => 'required|unique:juzs,juz_name,' . request('juz_id') . ',id',
            'njuznumber' => 'required|unique:juzs,juz_number,' . request('juz_id') . ',id',
            'nstartsurah' => 'required',
            'nstartsurahverse' => 'required',
            'nendsurah' => 'required',
            'nendsurahverse' => 'required',
            'juz_id' => 'required',
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            $data['msg'] = form_error_message();
        }
        else
        {
            $starting_verse = \App\Verses::where(['surah_id' => request('nstartsurah') , 'verse' => request('nstartsurahverse')])->first();
            if(count((array)$starting_verse) == 0){
                $data['feedback'] = 'other_error';
                $data['msg'] = form_error_message();
                $data['custom_msg'] = 'This Verse has not been added yet, <a target="_blank" href="'.route('add-verse' , ['surah_id' => encrypt(request('nstartsurah'))]).'">Add Verse</a>';
                $data['id'] = 'nstartsurahverse';
                return json_encode($data);
            }
            $ending_verse = \App\Verses::where(['surah_id' => request('nendsurah') , 'verse' => request('nendsurahverse')])->first();
            if(count((array)$ending_verse) == 0){
                $data['feedback'] = 'other_error';
                $data['msg'] = form_error_message();
                $data['custom_msg'] = 'This Verse has not been added yet, <a target="_blank" href="'.route('add-verse' , ['surah_id' => encrypt(request('nendsurah'))]).'">Add Verse</a>';
                $data['id'] = 'nendsurahverse';
                return json_encode($data);
            }
            $juz = \App\Juz::find(request('juz_id'));
            $juz->juz_name = request('njuzname');
            $juz->juz_number = request('njuznumber');
            $juz->start_surah_id = request('nstartsurah');
            $juz->start_verse_id = $starting_verse->id;
            $juz->end_surah_id = request('nendsurah');
            $juz->end_verse_id = $ending_verse->id;
            $juz->updated_by = Auth::user()->id;
            $juz->Save();
            $data['url'] = route('all-juzs');
            $data['feedback'] = 'true';
            $data['msg'] = 'Juz Updated Successfully';
        }
        return json_encode($data);
    }


    /////////////// Juz ///////////////

    /////////////// Verse ///////////////

    public function add_verse($surah_id)
    {
        try {
            $surah_id = decrypt($surah_id);
        } catch (\RuntimeException $e) {
            return redirect()->route('all-surahs');
        }
        $data['surah'] = \App\Surah::find($surah_id);
        $data['translators'] = \App\Role::select('*')->where(['role' => 'translator' , 'status' => 'active'])->get();
        $data['recitors'] = \App\Role::select('*')->where(['role' => 'recitor' , 'status' => 'active'])->get();
        $data['title'] = 'Add Verse';
        return view('admin.verse.add')->with($data);
    }

    public function post_verse()
    {
        $messages = array(
            'nversearabic.required' => 'This Field is Required',
            'nversearabicwithoutimmune.required' => 'This Field is Required',
            'nnortrans.required' => 'This Field is Required',
            'nrecname.required' => 'This Field is Required',
            'narabicaudiolink.required' => 'This Audio is Required',
            'narabicaudiolink.mimes' => 'Allowed Types are mp3,mpga,wav',
            'ntranname.required' => 'This Field is Required',
            'nartransaudiolink.required' => 'This Audio is Required',
            'nartransaudiolink.mimes' => 'Allowed Types are mp3,mpga,wav',
            'nversenum.required' => 'This Field is Required',
            'nversenum.numeric' => 'Must be a number',
            'nversenum.min' => 'Minimum allowed Verse is 1',
            'njuzzid.required' => 'This Field is Required',
            'njuzzid.numeric' => 'Must be a number',
            'njuzzid.min' => 'Minimum allowed Juz is 1',
            'njuzzid.max' => 'Maximum allowed Juz is 30',
            'nruku.required' => 'This Field is Required',
            'nruku.numeric' => 'Must be a number',
            'nversedesc.required' => 'This Field is Required',
        );
        $rules = array(
            'nversearabic' => 'required',
            'surah_id' => 'required',
            'nversearabicwithoutimmune' => 'required',
            'nnortrans' => 'required',
            'nrecname' => 'required',
            'narabicaudiolink' => 'required|mimes:mp3,mpga,wav',
            'ntranname' => 'required',
            // 'nartransaudiolink' => 'required|mimes:mp3,mpga,wav',
            'nversenum' => ['required' , 'numeric' , 'min:1'],
            'njuzzid' => 'required|numeric|min:1|max:30',
            'nruku' => 'required|numeric',
            'nversedesc' => 'required',
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            $data['msg'] = form_error_message();
        }
        else
        {
            $nversearabic=str_ireplace('<p>','', request('nversearabic', ''));
            $nversearabic=str_ireplace('</p>','', $nversearabic);   
            $verse = new \App\Verses();
            $verse->arabic_immune = $nversearabic;
            $verse->arabic_no_immune = request('nversearabicwithoutimmune', '');
            $verse->translation = request('nnortrans', '');
            $verse->translator_id = request('ntranname', '');
            $destinationPath = 'public/admin_assets/audios';
            if(request()->file('narabicaudiolink'))
            {
                $file = request()->file('narabicaudiolink');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture1 = date('His').$filename;
                $arabic = str_replace(' ', '_', $picture1);
                $file->move($destinationPath, $arabic);
                $verse->link_to_audio = $arabic;
            }
            if(request()->file('nartransaudiolink'))
            {
                $file = request()->file('nartransaudiolink');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture1 = date('His').$filename;
                $trans = str_replace(' ', '_', $picture1);
                $file->move($destinationPath, $trans);
                $verse->link_to_translation_audio = $trans;
            }
            $verse->recitor_id = request('nrecname', '');
            $verse->raku = request('nruku', '');
            $verse->verse = request('nversenum', '');
            $verse->surah_id = request('surah_id', '');
            $verse->juzz_number = request('njuzzid', '');
            $verse->description = request('nversedesc', '');
            $verse->created_by = Auth::user()->id;
            $verse->updated_by = Auth::user()->id;
            $verse->save();
            $data['url'] = route('all-surahs');
            $data['feedback'] = 'true';
            $data['msg'] = 'Verse Added Successfully';
        }
        return json_encode($data);
    }

    public function all_verses($surah_id)
    {
        try {
            $surah_id = decrypt($surah_id);
        } catch (\RuntimeException $e) {
            return redirect()->route('all-surahs');
        }
        $data['surah'] = \App\Surah::find($surah_id);
        $data['title'] = 'All Verses in ' . $data['surah']->surah_name;
        $data['listing'] = \App\Verses::where('surah_id' , $surah_id)->orderBy('verse' , 'asc')->paginate(50);
        return view('admin.verse.all')->with($data);
    }

    public function edit_verses($verse_id)
    {
        try {
            $verse_id = decrypt($verse_id);
        } catch (\RuntimeException $e) {
            return redirect()->route('all-surahs');
        }
        $data['d'] = \App\Verses::find($verse_id);
        $data['surah'] = \App\Surah::find($data['d']->surah_id);
        $data['translators'] = \App\Role::select('*')->where(['role' => 'translator' , 'status' => 'active'])->get();
        $data['recitors'] = \App\Role::select('*')->where(['role' => 'recitor' , 'status' => 'active'])->get();
        $data['title'] = 'Update Verse';
        return view('admin.verse.edit')->with($data);
    }

    public function update_verse()
    {
        $messages = array(
            'nversearabic.required' => 'This Field is Required',
            'nversearabicwithoutimmune.required' => 'This Field is Required',
            'nnortrans.required' => 'This Field is Required',
            'nrecname.required' => 'This Field is Required',
            'narabicaudiolink.required' => 'This Audio is Required',
            'narabicaudiolink.mimes' => 'Allowed Types are mp3,mpga,wav',
            'ntranname.required' => 'This Field is Required',
            'nartransaudiolink.required' => 'This Audio is Required',
            'nartransaudiolink.mimes' => 'Allowed Types are mp3,mpga,wav',
            'nversenum.required' => 'This Field is Required',
            'nversenum.numeric' => 'Must be a number',
            'nversenum.min' => 'Minimum allowed Verse is 1',
            'njuzzid.required' => 'This Field is Required',
            'njuzzid.numeric' => 'Must be a number',
            'njuzzid.min' => 'Minimum allowed Juz is 1',
            'njuzzid.max' => 'Maximum allowed Juz is 30',
            'nruku.required' => 'This Field is Required',
            'nruku.numeric' => 'Must be a number',
            'nversedesc.required' => 'This Field is Required',
        );
        $rules = array(
            'nversearabic' => 'required',
            'surah_id' => 'required',
            'verse_id' => 'required',
            'nversearabicwithoutimmune' => 'required',
            'nnortrans' => 'required',
            'nrecname' => 'required',
            'narabicaudiolink' => '|mimes:mp3,mpga,wav',
            'ntranname' => 'required',
            // 'nartransaudiolink' => '|mimes:mp3,mpga,wav',
            'nversenum' => ['required' , 'numeric' , 'min:1'],
            'njuzzid' => 'required|numeric|min:1|max:30',
            'nruku' => 'required|numeric',
            'nversedesc' => 'required',
        );
        $validator = \Validator::make(request()->all(), $rules , $messages);
        if ($validator->fails())
        {
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            $data['msg'] = form_error_message();
        }
        else
        {
            $nversearabic=str_ireplace('<p>','', request('nversearabic', ''));
            $nversearabic=str_ireplace('</p>','', $nversearabic); 
            $verse = \App\Verses::find(request('verse_id'));
            $verse->arabic_immune = $nversearabic;
            $verse->arabic_no_immune = request('nversearabicwithoutimmune', '');
            $verse->translation = request('nnortrans', '');
            $verse->translator_id = request('ntranname', '');
            $destinationPath = 'public/admin_assets/audios';
            $arabic = $verse->link_to_audio;
            if(request()->file('narabicaudiolink'))
            {
                $file = request()->file('narabicaudiolink');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture1 = date('His').$filename;
                $arabic = str_replace(' ', '_', $picture1);
                $file->move($destinationPath, $arabic);
                $filename = $destinationPath . "/" . $verse->link_to_audio;
                \File::delete($filename);
                $verse->link_to_audio = $arabic;
            }
            $trans = $verse->link_to_translation_audio;
            if(request()->file('nartransaudiolink'))
            {
                $file = request()->file('nartransaudiolink');
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture1 = date('His').$filename;
                $trans = str_replace(' ', '_', $picture1);
                $file->move($destinationPath, $trans);
                $filename = $destinationPath . "/" . $verse->link_to_translation_audio;
                \File::delete($filename);
                $verse->link_to_translation_audio = $trans;
            }
            $verse->recitor_id = request('nrecname', '');
            $verse->raku = request('nruku', '');
            $verse->verse = request('nversenum', '');
            $verse->surah_id = request('surah_id', '');
            $verse->juzz_number = request('njuzzid', '');
            $verse->description = request('nversedesc', '');
            $verse->updated_by = Auth::user()->id;
            $verse->save();
            $data['url'] = route('all-verses' , ['surah_id' => encrypt(request('surah_id'))]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Verse Updated Successfully';
        }
        return json_encode($data);
    }

    public function delete_verse()
    {
        try {
            $verse_id = decrypt(request('verse_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong!']);
        }
        \App\Verses::find($verse_id)->forceDelete();
        $data['verse_id'] = $verse_id;
        $data['feedback'] = 'true';
        $data['msg'] = 'Verse Deleted Successfully';
        return json_encode($data);
    }

    /////////////// Verse ///////////////

    /////////////// Bug ///////////////

    public function bug_reports()
    {
        $data['title'] = 'Bug Reports';
        $data['listing'] = \App\Bugs::orderBy('id' , 'desc')->paginate(50);
        return view('admin.bug_report.all')->with($data);
    }

    public function delete_bug_report($bug_id)
    {
        try {
            $bug_id = decrypt($bug_id);
        } catch (\RuntimeException $e) {
            return redirect()->route('all-bug-reports');
        }
        \App\Bugs::where('id' , $bug_id)->delete();
        \Session::flash('action_feedback_type' , 'success');
        \Session::flash('action_feedback' , '<strong>Success!</strong> Report Deleted Successfully');
        return redirect()->route('all-bug-reports');
    }

    /////////////// Bug ///////////////

    
}