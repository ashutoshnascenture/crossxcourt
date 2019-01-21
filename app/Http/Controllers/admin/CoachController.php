<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Coachdetail;
use App\CoachPackage;
use App\Lesson;
use DB;
use Input;
use Auth;
use Session; 
use Helper;

 class CoachController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getIndex(Request $request) {

        $query = User::with('Info')->where('role_id', '=', 2)->orderBy('id','DESC');
	 	
		if($request->has('q')){
			$q = $request->q;
			$query->where(function($query) use($q){
				$query->orWhere('first_name','like', "%$q%")
				->orWhere('last_name','like', "%$q%")
				->orWhere('email','like', "%$q%");
			});
			
		}
		$coaches = $query->paginate();
		
		
		$countries = \Cache::remember('countries',43200, function(){
			return DB::table('countries')
				->select('sortname','name')
				->orderBy('name')->get();
		});
        return view('admin.coaches.index')->with(compact('coaches','countries'));
    }

    //// coach approve
    public function getApprove($id) {

        $id = $id;
    $check = DB::table('coach')
            ->where("user_id", $id)->pluck('price');
           
            
            
        if(!empty($check[0]) && $check[0] === '0.00') {
            Session::flash('flash_message', 'coach cannot be approved profile, rates and availability needs to be completed');
             Session::flash('flash_type', 'alert-danger');
             return redirect()->back();

        }  else if (!empty($check[0]) && $check[0] === '0') {
			
			Session::flash('flash_message', 'coach cannot be approved profile, rates and availability needs to be completed');
             Session::flash('flash_type', 'alert-danger');
             return redirect()->back();
					
		} elseif(empty($check[0])){
			
			Session::flash('flash_message', 'coach cannot be approved profile, rates and availability needs to be completed');
             Session::flash('flash_type', 'alert-danger');
             return redirect()->back();
			
		}
         
              
		$is_active = DB::table('coach')
            ->where("user_id", $id)->pluck('is_active');
		//echo "<pre>"; print_r($is_active); die;
		
		if($is_active[0] == '0'){
		
        $coach = DB::table('coach')->where("user_id", $id)->update(array("is_active" => 1));
		Session::flash('flash_message', 'Coach has been Approved successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect()->back();
		
		} else {
			
		$coach = DB::table('coach')->where("user_id", $id)->update(array("is_active" => 0));	
			Session::flash('flash_message', 'Coach has been unapproved successfully.');
            Session::flash('flash_type', 'alert-success');
            return redirect()->back();
		}

        //~ if(!empty($coach)) {
            //~ Session::flash('flash_message', 'Coach has been Approved successfully.');
            //~ Session::flash('flash_type', 'alert-success');
            //~ return redirect()->back();
        
        //~ } else {
            //~ Session::flash('flash_message', 'coach cannot be approved profile, rates and availability needs to be completed');
            //~ Session::flash('flash_type', 'alert-danger');
            //~ return redirect()->back();
            
        //~ }

        
  
    }

    // price functionality
    public function getPrice($coach_id) {

        $packages = DB::table('packages')->get();
        $data = CoachPackage::where('coach_id', '=', $coach_id)->get();

        $coachpackages = array();
        if ($data) {
            foreach ($data as $val) {

                $coachpackages[$val->package_id] = $val->rate;
            }
        }

        return view('admin.coaches.price')->with(compact('packages', 'coach_id', 'coachpackages'));
    }

    //// Save lesson price 
    public function postSave(Request $request) {


        $input = $request->all();
        $input_data = array();

        foreach ($request->price as $package_id => $val) {

            if ($val) {
                $data = array('coach_id' => $request->coach_id, 'package_id' => $package_id, 'rate' => $val);
                $input_data[] = $data;
            }
        }



        if ($request->has('action')) {
            DB::table('coach_packages')->where('coach_id', $request->coach_id)->delete();
        }


        if ($input_data) {

            DB::table('coach_packages')->insert($input_data);

            ///// update rate in coach table
            $value = (array_values($input_data[0]));
            $rate = $value['2'];

           $priceing = Coachdetail::where('user_id', $request->coach_id)->update(array('price' => $rate));
            
            if(empty($priceing)) {
                Session::flash('flash_message', 'coach cannot be approved profile, rates and availability needs to be completed');
            Session::flash('flash_type', 'alert-danger');
            return redirect('admin/coaches/');

            }

            Session::flash('flash_message', 'Package has been updated successfully.');
            Session::flash('flash_type', 'alert-success');

            return redirect('admin/coaches/');
      
        } else {
        
            Session::flash('flash_message', 'please provide at least one input.');
            Session::flash('flash_type', 'alert-danger');   
            return redirect('admin/coaches/');

        }
    }

    // create coaches   
    public function getCreate() {
        $countries = DB::table('countries')
                        ->select('sortname', 'name')
                        ->orderBy('name')->get();
        return view('admin.coaches.create')->with('countries', $countries);
    }

    function getStates($country) {

        if (is_null($country)) {
            return false;
        }

        $states = DB::table('countries')
                        ->join('states', 'countries.id', '=', 'states.country_id')
                        ->select('states.name')
                        ->where('countries.sortname', '=', $country)
                        ->orderBy('name')->get();

        return json_encode($states);
    }

    //// save coaches profile details
    public function postStore(Request $request) {

        $input = $request->all();
        $input['role_id'] = 2;

        $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }

        $address = $request->post_code . ', ' . $request->country;
        $lat_log = Helper::getLatLog($address);

        $input['latitude'] = $lat_log['lat'];
        $input['longitude'] = $lat_log['lng'];


        $user = new User;
        
        $input['password'] = bcrypt($request->password);
        
        $user::create($input);
        $id = DB::getPdo()->lastInsertId();

        return redirect('admin/coaches/createcoachdetail/' . $id);
    }

    public function getCreatecoachdetail($id) {

        return view('admin.coaches.coachdetail')->with('id', $id);
    }

    //save coaches
    public function postCoachdetail(Request $request, $id) {

		
		$input = $request->all();
		
        $validator = Validator::make(Input::all(), Coachdetail::$rules);


        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
                
        $input['user_id'] = $id;
        $user_id = $id;
        $input['is_active'] = 0;
		$input['featured_coach'] = $request->coach;
         
        $image = $request->file('profile_image');

        if (!empty($image)) {

            $input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'images/coaches';
            $image->move($destinationPath, $input['profile_image']);
        }

        $teaching_level = $request->teaching_level;
        $input['teaching_level'] = implode(',', (array)$teaching_level);

        $collection = $request->teach_age_player;
        $input['teach_age_player'] = implode(',', (array)$collection);

        $coach = new Coachdetail;
        $coaches = Coachdetail::where('user_id', '=', $user_id)->first();
        $coach::create($input);
     


        Session::flash('flash_message', 'Coach profile has been created successfully.');
        Session::flash('flash_type', 'alert-success');

        return redirect('admin/coaches');
    }

    //delete coaches
    public function getDestroy($id){
	 
        if ($id) {
            Coachdetail::where('user_id', '=', $id)->delete();
            User::destroy($id);

            Session::flash('flash_message', 'Coach has been deleted successfully.');
            Session::flash('flash_type', 'alert-success');
        }
        return redirect('admin/coaches/');
    }

    function getServicearea($id) {


        $data = DB::table('coach')->select('service_area')
                        ->whereUserId(Auth::user()->$id)->first();

        $address = array(
            'lat' => Auth::user()->latitude,
            'lng' => Auth::user()->longitude
        );

        return view('admin.coaches.service_area')->with(compact('address', 'data', 'id'));
    }

    public function getEditprofile($id) {

        $user = User::find($id);
        if (is_null($user)) {
            return redirect('admin/users');
        }
        $countries = DB::table('countries')
                        ->select('sortname', 'name')
                        ->orderBy('name')->get();

        return view('admin.coaches.editprofile')->with(compact('user', 'countries'));
    }

    public function postUpdateprofile(Request $request, $id) {

        $input = $request->all();
        $input =  array_map('trim', $input); 
        $rules = User::$rules;
         

        if (empty($input['email']) && empty($input['password']) && empty($input['password_confirmation'])) {
            unset($rules['password'], $rules['password_confirmation'], $rules['email'], $input['password'], $input['password_confirmation'], $input['email']);
        }
        
        if(!empty($input['password']) && !empty($input['password_confirmation'])) {
            unset($rules['email'], $input['email']);
            
		}

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
        
        if(!empty($request->password)) {
        $input['password'] = bcrypt($request->password);
		}
        $user = User::find($id);
        $user->update($input);
        Session::flash('flash_message', 'Account information has been updated successfully.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
        //return redirect('admin/coaches/editcoachdetail/'.$id);     
    }

    public function getEditcoachdetail($id) {

        $coach = Coachdetail::where('user_id', '=', $id)->first();

        if (empty($coach)) {

            return redirect('admin/coaches/createcoachdetail/' . $id);
        }

        return view('admin.coaches.editcoachdetail')->with(compact('id', 'coach'));
    }

    public function postUpdatecoachprofile(Request $request, $id) {



        $input = $request->all();
        $rules = Coachdetail::$rules;
        $user_id = $id;
        $input = $request->except('_token');
        $input['nationality'] = trim($input['nationality']);
		$input['tennis_qualification'] = trim($input['tennis_qualification']);
		$input['languages'] = trim($input['languages']);
		$input['motto'] = trim($input['motto']);
		$input['favourite_player'] = trim($input['favourite_player']);
		$input['coaching_style'] = trim($input['coaching_style']);

        if (empty($input['profile_image'])) {
            unset($rules['profile_image'], $input['profile_image']);
        }

 
        $validator = Validator::make($input, Coachdetail::$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }


        $image = $request->file('profile_image');
        if(!empty($image)) {
        
              $input['profile_image'] = time().'.'.$image->getClientOriginalExtension();  
            $destinationPath = 'images/coaches';
            $image->move($destinationPath, $input['profile_image']);
        
        } 



        $teaching_level = $request->teaching_level;
        $input['teaching_level'] = implode(',', (array)$teaching_level);


        $collection = $request->teach_age_player;
        $input['teach_age_player'] = implode(',', (array)$collection);


		
		//echo "<pre>";print_r($input); 
        $coach = Coachdetail::where('user_id', '=', $user_id);
        $coach->update($input);

        Session::flash('flash_message', 'Profile has been updated successfully.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
        //return redirect('admin/coaches');
    }

    function getHoursLog($id) {

        //~ $hours_log = DB::table('bookings')
                //~ //->join('users','bookings.customer_id','=','users.id')
                //~ ->join('view_lessons', 'bookings.id', '=', 'view_lessons.booking_id')
                //~ ->select('view_lessons.date', DB::raw('SUM(bookings.lessons) as hours'), DB::raw('SUM(bookings.total) as amount'))
                //~ ->where('bookings.coach_id', $id)
                //~ ->groupBy(DB::raw('YEAR(view_lessons.date)'), DB::raw('MONTH(view_lessons.date)'))
                //~ ->orderBy('bookings.id', 'DESC')
                //~ ->paginate(10);

       // return view('admin/coaches.hours_log')->with('hours_log', $hours_log);
    }
    
    
    ///show booking data
    public function getBooking($id){
        
        $bookings = DB::table('bookings')
        ->join('users', 'users.id', '=', 'bookings.customer_id')     
        ->select('users.first_name','users.last_name', 'bookings.*')        
        ->where('coach_id',$id)->get();
          
        return view('admin/coaches/booking')->with('bookings', $bookings);
    
    }
    
   
   
   ////ajax request booking cancel
    public function postCancelbooking(Request $request){
       
        $detail = $request->detail;
        $id = $request->id; /// coach_id
        
         

        DB::table('bookings')->where('id', $id)
            ->update(array('detail'=> $detail,'status'=>'cancel'));
            
 
		 $users = DB::table('bookings')
		->leftjoin('users as customer','bookings.customer_id','=','customer.id')
		->leftjoin('users as coach','bookings.coach_id','=','coach.id')
		->select('customer.email as cus_email','coach.email as coach_email','coach.first_name as coach_first_name','coach.last_name as coach_last_name','bookings.created_at as booking_date')
		->where('bookings.id','=',$id)
		->first(); 
			 
       
       $coach_first_name = $users->coach_first_name;
       $coach_last_name = $users->coach_last_name;
       $booking_date = $users->booking_date;
             
   
		$data = array('booking_date'=>$booking_date,'coach_first_name'=>$coach_first_name,'coach_last_name'=>$coach_last_name);
	  
   
		\Mail::send('emails.bookingcancel',$data, function ($message) use($users){ 
			$message->to(array($users->cus_email,$users->coach_email))->subject(' cancel Booking');
		});
        
        Session::flash('flash_message', 'Your booking has been canceled');
        Session::flash('flash_type', 'alert-success');
    }
 
 
    public function getShow($id){

     $coach = User::where('id', $id)->first();
     
     $countries = \Cache::remember('countries',43200, function(){
            return DB::table('countries')
                ->select('sortname','name')
                ->orderBy('name')->get();
        });
     return view('admin/coaches/viewprofile')->with(compact('countries', 'coach'));

    }

    public function getViewcoachdetail($id){

     $coach = Coachdetail::where('user_id', '=', $id)->first();
     
     return view('admin/coaches/viewcoachdetail')->with('coach', $coach);

    }
	
	function getCrop($id){
		
		$coach = Coachdetail::where('user_id', '=', $id)->first();
		return view('admin/coaches/crop')->with('coach', $coach);
	}
	
	function postSaveCrop(Request $request){
		 
		if($request->image){
			
			$destinationPath = 'images/coaches/';
			$file = str_replace('data:image/png;base64,', '', $request->image);
			$img = str_replace(' ', '+', $file);
			$data = base64_decode($img);
			$filename = date('ymdhis'). ".png";
			$file = $destinationPath . $filename;
			$success = file_put_contents($file, $data);
			if($success){
				
				Coachdetail::where('user_id',$request->id)
					->update(array('profile_image' => $filename ));
				unlink($destinationPath.$request->realImage);
				Session::flash('flash_message', 'Image has been cropped successfully.');
				Session::flash('flash_type', 'alert-success');
			}
		}
		
		return redirect('admin/coaches/editcoachdetail/'.$request->id);
	}

    function getPendingPayments(){
		
		 
		$credits = DB::table('lessons')
		->select('lessons.id as lesson_id','cu.first_name as cu_first_name','cu.last_name as cu_last_name','cu.email as cu_email', 'co.first_name as co_first_name','co.last_name as co_last_name','co.email as co_email' ,'lessons.customer_id','cu.mobile','lessons.lesson_duration','lessons.date','lessons.start_time','lessons.id as lesson_id')
		->join('users as cu','lessons.customer_id','=','cu.id')
		->join('users as co','lessons.coach_id','=','co.id')
		//~ ->join('lessons','bookings.id','=','lessons.booking_id')
		->where('lessons.status','=','Completed')
		->where('lessons.admin_paid','=',0)
		->paginate(10);
		
		return view('admin/coaches/pending_payments')->with('credits', $credits);
		 	
	}
	
	//......Mark lesson as paid function.......//
	function getMarkPaid($id){
		
		if(is_null($id)){
			return redirect()->back();
		}
		
		DB::table('lessons')->where("id", $id)->update(array("admin_paid" => 1));
		
		Session::flash('flash_message', 'Lesson marked as paid successfully.');
		Session::flash('flash_type', 'alert-success'); 
		
		return redirect()->back();
	}
	
	public function getDeletephoto($id){
    
         
      
        $coach = Coachdetail::where('user_id','=',$id)->first();
         
        DB::table('coach')->where("user_id",$id)->update(array("profile_image" => ''));
             
        $destinationPath = unlink(base_path().'/images/coaches/'.$coach->profile_image) ;
         
        
        Session::flash('flash_message', 'Image has been deleted successfully.');
        Session::flash('flash_type', 'alert-success');
        
        return redirect()->back();  
        
    }
    
    
    public function getPaymentinfo($id){
	 	 
		 
		$payment_information = DB::table('coach_payment_details')
			->select('email','address','city','state','postalcode','ssn'
			         ,'route_num','account_num')
			->where('coach_id',$id)
			->first();
		 
		return view('admin/coaches/paymentinfo')->with(compact('payment_information'));
	 
		 
		 
	}
	
	
	 
	
	public function getFeatured($id){
 		
 		  
 		$count = DB::table('coach')
            ->where("user_id", $id)->count();
        
        if(!empty($count)) {
			
			$check = DB::table('coach')
            ->where("user_id", $id)->pluck('is_featured');	
			 
				 
			if($check[0] === 0) {
				$coach = DB::table('coach')->where("user_id", $id)->update(array("is_featured" => 1));	
				Session::flash('flash_message', 'Featured coach added successfully');
				Session::flash('flash_type', 'alert-success');	
				return redirect()->back();	
			
			} 
			
			else {
				
				$coach = DB::table('coach')->where("user_id", $id)->update(array("is_featured" => 0));
				Session::flash('flash_message', 'Coach added successfully');
				Session::flash('flash_type', 'alert-success');	
				return redirect()->back();	
						 
			}
		}
		Session::flash('flash_message', 'Your profile needs to be completed for Featured coach ');
		Session::flash('flash_type', 'alert-danger');	
		return redirect()->back();	
		 
		
		
	}
	
	public function getOptions($id) {
		//die($id);
		return view('admin/coaches/options')->with('id', $id);
	
		
	}
	
	public function getViewprice($coach_id) {
		 
		$packages = DB::table('packages')->get();
        $data = CoachPackage::where('coach_id', '=', $coach_id)->get();

        $coachpackages = array();
        if ($data) {
            foreach ($data as $val) {

                $coachpackages[$val->package_id] = $val->rate;
            }
        }

        return view('admin.coaches.viewprice')->with(compact('packages', 'coach_id', 'coachpackages'));
		
	}
	
	public function getLessons(){
	
	 
	
	$lessons = DB::table('lessons')
        // ->join('bookings', 'lessons.booking_id', '=', 'bookings.id')     
        ->join('users as customer', 'lessons.customer_id', '=', 'customer.id')     
        ->join('users as coach', 'lessons.coach_id', '=', 'coach.id')     
        ->join('coach_courts', 'coach_courts.id', '=', 'lessons.court_id')     
        ->select('coach.first_name as coach_first_name','coach.last_name as coach_last_name','customer.first_name as customer_first_name ','customer.last_name as customer_last_name', 'lessons.*','coach_courts.name')        
        ->paginate();
        
		
 
	
	return view('admin.coaches.lessons')->with('lessons' , $lessons);
		
	}



     function getPaymentstatus($id){
     // die("hi");

        $lesson = Lesson::find($id);
        if (empty($lesson)) {
            return redirect()->back();
        }

            Lesson::where('id', $id)->update(array('payment_status' => 1 ));    
            Session::flash('flash_message', 'Payment status has been updated successfully.');
            Session::flash('flash_type', 'alert-success');
       
        return redirect('admin/coaches/lessons');

    }

		

}

