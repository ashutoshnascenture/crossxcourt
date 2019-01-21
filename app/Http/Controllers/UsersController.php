<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use Lang;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Coachdetail;
use DB;
use Hash;
use Session;
use Redirect;
use Helper;
 

class UsersController extends Controller {


	public function __construct(Request $request)
	{
		$this->middleware( 'auth',['except' => ['register','storeuser']]);
		if($request->has('cur')) {
			Helper::setCurrency($request->cur);
		}
		 
	}

    public function register() {
		
		$countries = DB::table('countries')
			->select('sortname','name')
			->orderBy('name')->get();
				
		return view('users/register')->with('countries',$countries);
    
    }
     
    function storeuser(Request $request) {

      //  $input =  array_map('trim', $request->all() );  
        $input = $request->all();
           
        $input['role_id'] = 2;
        
        $validator = Validator::make($input, User::$rules);
	
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors());	
		}
        
		 
		$address = $request->address.', '.$request->country;
		$lat_log = Helper::getLatLog($address);
		  
		if(!$lat_log){
			$address = $request->post_code.', '.$request->country;
			$lat_log = Helper::getLatLog($address);
		}
        
        $input['latitude'] = $lat_log['lat'];	 
	  	$input['longitude'] = $lat_log['lng'];
	  	 
        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
		
		$user = new User;	
        $input['password'] = bcrypt($request->password);
        $user::create($input);
		
		if(Auth::attempt(array('email' => $request->email,'password' => $request->password ))){
			  
			return redirect('coaches/service-area');
		}
		
		return redirect()->back()->withInput($input);
		 
       
    }
	 
	function detail(){
	
		return view('users.coachdetail');
	} 
	
	public function coachdetail(Request $request){
	
		$input = $request->all();
		
        $validator = Validator::make($input, Coachdetail::$rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
        
		$input['user_id'] = Auth::user()->id;
		$input['service_area'] = Session::get('service_area');
		$input['is_active'] = 0;
		
        $image = $request->file('profile_image');
		 
		if(!empty($image)) {
		
			$input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'images/coaches';
			$image->move($destinationPath, $input['profile_image']);
		
		} 

		$teaching_level = $request->teaching_level;
		$input['teaching_level'] = implode(',',(array)$teaching_level);
		
		$collection = $request->teach_age_player;		
	  	$input['teach_age_player'] = implode(',',(array)$collection);
	      
        
		$coach = new Coachdetail;
		$coach::create($input);
		
		$request->session()->forget('service_area'); 
        //Session::flash('flash_message', 'Coach profile has been created successfully.');
        //Session::flash('flash_type', 'alert-success');
		 

        $user =  Auth::user();
         
		 
		$country = DB::table('users') 
		->select('users.country','countries.name')
		->join('countries','users.country','=','countries.sortname')
		->where('users.id', '=',Auth::user()->id)
		->first();
		
		 // ($country->name); die;
		 
		 
		 
		/*
        *  mail function 
        */

		$data = array(	
			'email' => $user->email,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'city' => $user->city,
			'state' => $user->state,
			'country' => $country->name,
		);
 
		\Mail::send('emails.coachEmail',$data, function ($message) use($user){ 
	        $message->to($user->email)->subject(' Coach register successfully');
	    });
	    
	    
	    \Mail::send('emails.adminCoachemail',$data, function ($message) use($user){ 
	        $message->to('admin@crossXcourt.com')->subject(' Coach register successfully');
	    });
		//Session::flash('flash_message', 'Your profile has been created successfully.');
        //Session::flash('flash_type', 'alert-success');
        return redirect('coaches/pending-review');
		//return redirect('users/profile');
		
	}
	 
    function success() {
 
        return view('users.successful');
    }
    
    /*
     * Change password form   
     * 
     * chnage function for functionality
     * 
     */
    public function accountInformation() {
 
        $user = User::find(Auth::user()->id);
        
        $countries = DB::table('countries')
			->select('sortname','name')
			->orderBy('name')->get();
		 
        return view('users/account_information')->with(compact('user','countries'));
		
    }

	 /*
     * Change password form   
     * 
     * chnage function for functionality
     * 
     */
	 
    public function password() {

        $user = User::find(Auth::user()->id);
        return view('users/password')->with('user',$user);
		
    }

    public function change(Request $request) {

        $user = Auth::user();
        $user_id = Auth::user()->id;
        
		$rules = array(
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password'
        );
        
        $messages = array(
			'current_password.required'    => Lang::get('validation.password'),
			'new_password.required'    => Lang::get('validation.new_password'),
			'password_confirmation.required' => Lang::get('validation.password_confirmation'),
			'current_password.min' => Lang::get('validation.password_confirmation'),
			'new_password.min' => Lang::get('validation.password_confirmation'),
			'password_confirmation.same' => Lang::get('validation.password_confirmation'),
		);

        $input = $request->all();
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
			
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
       
        }  

        if (!Hash::check(Input::get('current_password'), $user->password)) {

                Session::flash('flash_message', Lang::get('usersMessage.error_password'));
                Session::flash('flash_type', 'alert-danger');
                return redirect()->back();
            
        } else {
 
			$user->password = Hash::make(Input::get('new_password'));
			$user->update($input);
			Session::flash('flash_message', Lang::get('usersMessage.update_password'));
			Session::flash('flash_type', 'alert-success');
			return redirect()->back();
			
        }
         
    } 
    
    /*
     * Edit profile functionality
     * 
     * 
     */

    public function updateprofile(Request $request) {

        $input = $request->all();
        $input =  array_map('trim', $input); 
        $rules = User::$rules;
         
        unset($rules['email'], $rules['password'], $rules['password_confirmation'], $input['password'], $input['password_confirmation'], $input['email']);
 
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
		
		$address = $request->post_code.', '.$request->country;
        
		$lat_log = Helper::getLatLog($address);
		if(!$lat_log){
			$address = $request->post_code.', '.$request->country;
			$lat_log = Helper::getLatLog($address);
		}
		
        $input['latitude'] = $lat_log['lat'];	 
	  	$input['longitude'] = $lat_log['lng'];
		
        $user = User::find(Auth::user()->id);
        $user->update($input);
        
        Session::flash('flash_message', Lang::get('usersMessage.profile_update'));
        Session::flash('flash_type', 'alert-success');
      
		return redirect()->back();
		
    }
    
    public function updatecoachprofile(Request $request,$id){
		  
		$rules = Coachdetail::$rules;
		$input = $request->except('_token');
		$input['nationality'] = trim($input['nationality']);
		$input['tennis_qualification'] = trim($input['tennis_qualification']);
		$input['languages'] = trim($input['languages']);
		$input['motto'] = trim($input['motto']);
		$input['favourite_player'] = trim($input['favourite_player']);
		$input['coaching_style'] = trim($input['coaching_style']);
		
		$teaching_level = $request->teaching_level;
		$input['teaching_level'] = implode(',',(array)$teaching_level);
		
		$collection = $request->teach_age_player;		
	  	$input['teach_age_player'] = implode(',',(array)$collection);
	  	
		unset($rules['profile_image'],$input['profile_image'],$input['profile_image']);		 
		
		$validator = Validator::make($input, $rules);
		
		if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
		
		$image = $request->file('profile_image');
		if(!empty($image)) {
		
			$input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'images/coaches';
			$image->move($destinationPath, $input['profile_image']);
			 
		}
		
		$coach = Coachdetail::where('user_id','=',Auth::user()->id);
		$coach->update($input);
	
	
		Session::flash('flash_message', Lang::get('usersMessage.coach_profile_update'));
		Session::flash('flash_type', 'alert-success'); 
		 
		return redirect()->back();
	 
	}
	
	function updateProfileImage(Request $request){
		
		$image = $request->file('profile_image');
		
		 
		$rules = array(
		'image' => 'mimes:jpeg,png,gif' // max 10000kb
        );
        
        $fileArray = array('image' => $image);
        
		$validator = Validator::make($fileArray, $rules);
		
		if ($validator->fails()) {
            return redirect()->back()->withInput($fileArray)->withErrors($validator->errors());
        }
		
		
		if(!empty($image)) {
		
			$input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = 'images/coaches';
			$image->move($destinationPath, $input['profile_image']);
			
			$coach = Coachdetail::where('user_id','=',Auth::user()->id);
			$coach->update($input);
			
			Session::flash('flash_message', Lang::get('usersMessage.profile_image_update'));
			Session::flash('flash_type', 'alert-success'); 
			
		} 
	
		return redirect()->back();
		
	}
		
	public function coachProfile(){
	
		$user_id = Auth::user()->id;
		$coach = Coachdetail::where('user_id','=',$user_id)->first();	
		
		if(empty($coach)){	
			return redirect('users/detail');
		} 
		
		return view('users/editcoachdetail')->with('coach', $coach);	
		
	 
	}
	
	public function deletephoto(){
	
		$user_id = Auth::user()->id;	 
	  
		$coach = Coachdetail::where('user_id','=',$user_id)->first();
		 
		DB::table('coach')->where("user_id",$user_id)->update(array("profile_image" => ''));
			 
		$destinationPath = unlink(base_path().'/images/coaches/'.$coach->profile_image) ;
		 
		
		Session::flash('flash_message', Lang::get('usersMessage.profile_image_delete'));
		Session::flash('flash_type', 'alert-success');
		
		return redirect()->back();	
		
	}	
	 

}
