<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\User;
use App\Lesson;
use App\Review;
use App\Message;
use DB;
use Hash;
use Session;
use Lang;

  
class CustomerController extends Controller {
  
	public function __construct(Request $request)
	{
		$this->middleware( 'auth',['except' => ['getRegister','postStore','getAction','postLogin']]);
		if($request->has('cur')) {
			\Helper::setCurrency($request->cur);
		}
	}
	 
	
	function getRegister(){
		 
		return view('customers.register');
		
	}
	
	function postLogin(Request $request){
		 
		$this->validate($request, [
		  'email' => 'required|email', 'password' => 'required',
		]);
		 
		$credentials = $request->only('email', 'password');
		$credentials['role_id'] = 3;
		
		if (Auth::attempt($credentials )) {
			Session::forget('action');
			if($request->has('message')){
				
				$date = date('Y-m-d H:i:s');
				$coach = User::Find($request->coach_id);
				
				$message = array(
					'from' => Auth::user()->id,
					'to' => $request->coach_id,
					'to_email'=>$coach->email,
					'message' => $request->message,
					'created_at' => $date,
					'read_coach' => 1
				);
				
				Message::create($message);
				$getid = DB::getPdo()->lastInsertId();
				DB::table('message_detail')->insert([
                ['user_id' => Auth::user()->id, 'message_reply' => $request->message, 'created_at' => $date, 'message_id' => $getid]]);
                
                
				return redirect('outbox/')->with('message',Lang::get('usersMessage.sent_message'));
			}
			return redirect()->back();
		}
		
		Session::put('action', 'login');
		return redirect()->back()
			->withInput($request->all())
			->withErrors([
			  'email' => 'Invalid credentials.',
			]);
	}
	
	function postStore(Request $request){
		
		$input = $request->all();
        
		$rules = array( 
			'first_name'  => 'required',                     
			'last_name'   => 'required',   
			'mobile'   => 'required',   
			'email'       => 'required|email|unique:users',      
			'password'    => 'required',
			'password_confirmation' => 'required|min:6|same:password'  
			 
		);
		
		$validator = Validator::make($input,$rules);
        
		if ($validator->fails()) {
			Session::put('action', 'register');
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
		
		Session::forget('action');
		$input['role_id'] = 3;
		 
		$user = new User;	
			 
        $input['password'] = bcrypt($request->password);
        $user::create($input);
		
		Auth::attempt(array('email' => $request->email,'password' => $request->password ));
		
		Session::flash('flash_message', Lang::get('usersMessage.account_successful'));
        Session::flash('flash_type', 'alert-success');
              
		$data = array();
		$users = array('email' => $request->email); 
         
        \Mail::send('emails.customerRegister',$data, function ($message) use($users){ 
	        $message->to($users['email'])->subject(' New Enquiry');
	    });
	     
		if($request->has('message')){
				 
			$message = array(
				'from' => Auth::user()->id,
				'to' => $request->coach_id,
				'message' => $request->message,
				'read_coach' => 1
			);
			Message::create($message);
			return redirect('outbox/')->with('message',Lang::get('usersMessage.sent_message'));
		}
		
		if($request->has('url')){
			return redirect('customer/edit');
		}
		return redirect()->back();
		 
		
	}
	
	
    function getIndex(Request $request){
		 
		if(!Auth::user()->hasRole('Customer')){
			return response()->view('errors.401');
		}
		 
		$query = DB::table('lessons')
			->join('users','lessons.coach_id','=','users.id')			
			->leftJoin('coach_reviews','coach_reviews.lesson_id','=','lessons.id')
			->leftjoin('coach_courts','coach_courts.id','=','lessons.court_id')
			->leftjoin('coach','lessons.coach_id','=' ,'coach.user_id')
			->select('lessons.*','users.id as user_id','users.first_name','users.last_name','users.address','users.mobile','users.email','coach.profile_image','lessons.id','coach_reviews.id as review','lessons.id as lesson_id','coach_courts.name as court_name','coach_courts.city','coach_courts.longitude','coach_courts.latitude','coach_courts.address as court_address')
			->where('lessons.status', '!=', 'Cancelled')
			->where('lessons.customer_id',Auth::user()->id);
			 
		 

			
		if($request->has('lesson') && $request->lesson == 'completed') 
 			$query->where('lessons.status','Completed');	
			

		else if($request->has('lesson') && $request->lesson == 'booked')
		 
			$query->where(DB::raw('lessons.date'), '>', DB::raw('NOW()'))
			->where('lessons.status','Pending');	
		
		else if($request->has('lesson') && $request->lesson == 'credits')
			$query->where('lessons.status','Pending');
			
			$remaining_credits = DB::table('credits')
			->join('users','credits.coach_id','=','users.id')
			->where('credits.customer_id', '=', Auth::user()->id)
			->first();		 		 
		
		$lessons = $query->orderBy('lessons.id','DESC')->paginate(10);

	 
		return view('customers.lessons')->with(compact('lessons','remaining_credits'));
		
		
	}
	
	public function getAddReview($id)
	{	
		$review = DB::table('coach_reviews')->whereLessonId($id)->first();
		//get coach id
		$coach_id = Lesson::whereId($id)->first();
		//echo"<pre>";print_r($coach_id);

		if($review){
			return redirect()->back();
		}
		return view('customers.review')->with(compact('id','coach_id')); 
	}
	
	public function postStoreReview(Request $request)
	{ 
	    
		$input = $request->all();
		$input['lesson_id'] = $request->lesson_id;
		$input['created_at'] = date('Y-m-d h:i:s'); 
		$validator  = Validator::make($request->all(), Review::$rules );
	    if ($validator->fails()){
			return redirect()->back()
			->withInput($input)->withErrors($validator->errors()); 
	    }
    	
		$save = Review::create($input);
		$review_id = DB::getPdo()->lastInsertId();

		DB::table('coach')->whereUser_id($request->coach_id)->increment('reviews');
		DB::table('coach')->whereUser_id($request->coach_id)->update(array('rating' => $request->rating));
		
		if($save){			
			return redirect('customer/success/'.$review_id);			 
		} 
		
		Session::flash('flash_message', Lang::get('usersMessage.rating_error'));
		Session::flash('flash_type', 'alert-danger');
		return redirect()->back()->withInput($input);
		
	    
	}
	
	public function getEdit(){
	 
	  $id	= Auth::user()->id ; 
        
        $customer = User::with('Info')->where('role_id', '=', 3)->where('id', '=', $id)->first();
        return view('customers.edit')->with('customer',$customer);
        
    }


    public function postUpdate(Request $request){
       
        $input = $request->all();
        $id	= Auth::user()->id ;
		 
		$rules = array(
			'first_name'  => 'required',                     
			'last_name'   => 'required',   
			'mobile'   => 'required',   
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            
        );
		//$rules['email'].= ",email,$id";
		 
		 
		if(empty($input['password']) && empty($input['password_confirmation'])) {
			unset($rules['password'],$rules['password_confirmation'],$input['password'],$input['password_confirmation']);
		}
		 
		$validator = Validator::make($input,$rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors()); 	
		}
		
		if(isset($input['password'])){
		$input['password'] = bcrypt($request->password); 
		}
		 


        $user = User::find($id);

        $user->update($input);
        
		
		Session::flash('flash_message', Lang::get('usersMessage.update_account'));
        Session::flash('flash_type', 'alert-success');
		 
		return redirect()->back()->withInput($input);

    }
    
    public function getSuccess($id){
		 
		$users = DB::table('coach_reviews')
            ->join('lessons', 'coach_reviews.lesson_id', '=', 'lessons.id')
            ->join('users', 'lessons.coach_id', '=', 'users.id')
            ->select('users.id', 'users.first_name' ,'users.last_name')
            ->where('coach_reviews.id', $id)
            ->first();
		
		if(!empty($users)) {
		
		  return view('customers.success')->with('users',$users); 

		}
		
		
	}
	
	
	 public function getPassword() {

        $user = User::find(Auth::user()->id);
        return view('customers/password')->with('user',$user);
		
    }

    public function postChange(Request $request) {

        $user = Auth::user();
        $user_id = Auth::user()->id;
        
		$rules = array(
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|same:new_password'
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
	 
	 
}
