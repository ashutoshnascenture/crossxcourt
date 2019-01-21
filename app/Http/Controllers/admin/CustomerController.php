<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Coachdetail;
use DB;
use Input;
use Auth;
use Session;
use Helper;




class CustomerController extends Controller {
	
	
	
	public function __construct()
	{
		$this->middleware( 'auth' );
	}
    
    
    public function getIndex() {

        $customers = User::with('Info')->where('role_id', '=', 3)->get();
        $users = User::paginate(20);
        return view('admin.customers.index')->with(compact('customers','users'));
    }
    
    
    public function getView($id){
        
        $customer = User::with('Info')->where('role_id', '=', 3)->where('id', '=', $id)->first();
        
        //$customer = DB::table('users')
        //    ->join('coach', 'users.id', '=', 'coach.user_id')
        //    ->select('users.*', 'coach.*')
        //    ->where('role_id', '=', 3)
        //    ->where('users.id', '=', $id)
        //    ->first();
            
        return view('admin.customers.view')->with('customer',$customer);
         
    
    }
    
    
    public function getEdit($id){
        
        $customer = User::with('Info')->where('role_id', '=', 3)->where('id', '=', $id)->first();
        return view('admin.customers.edit')->with('customer',$customer);
        
    }
    
    
    
    public function postUpdate(Request $request ,$id){
       
        $input = $request->all();
        
        
		$rules = array( 
			'first_name'  => 'required',                     
			'last_name'   => 'required',   
			'email'       => 'required|email|unique:users',      
			'password'    => 'required',
			'password_confirmation' => 'required|same:password'  
		);
        
		
        unset($rules['email'], $rules['password'], $rules['password_confirmation'], $input['password'], $input['password_confirmation'], $input['email']);
		$validator = Validator::make($input,$rules);
        
        
		if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
		  //$input['email'] .= ",email,$id";
		  //echo "<pre>";
		  //print_r($input);
		  //die;
		$input['role_id'] = 3;
        
		 
			 
        if(isset($input['password'])){
		$input['password'] = bcrypt($request->password); 
		}
        $user = User::find($id);
        $user->update($input);
        
		
		Session::flash('flash_message', 'Your account has been updated successfully.');
        Session::flash('flash_type', 'alert-success');
		return redirect('admin/customers/index');
    }
    
    
    public function getDestroy($id){
        
        if ($id) {
            User::where('id', '=', $id)->delete();
            User::destroy($id);


            Session::flash('flash_message', 'customer has been deleted successfully.');
            Session::flash('flash_type', 'alert-success');
        }
        return redirect('admin/customers/index');
        
        
    }
    
	function getMassEmail()
	{	
		return view('admin/customers.mass_email');
	}
    
	//send mass email to customer or coach
    function postSendEmail(Request $request){
		 
		$input = $request->all();

		$rules = array( 
			'to'        => 'required',                     
			'subject'   => 'required',   
			'message'   => 'required',      
		);
		
		$validator = Validator::make($input,$rules);
		if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        }
		
		$query = DB::table('users')
				->select('first_name','email');
		
		//for customer
		if($request->to == 3){	
			$query->where('users.role_id', '=',3); 
		}
		else{
			$query->leftJoin('coach','users.id','=','coach.user_id')
				->where('users.role_id', '=', 2)
				->where('coach.is_active', '=',1);
		}
		 
		$customers = $query->get();
		
		$subject = $request->subject;
		 
		if($customers){
			
			foreach($customers as $val){
				  
				$data = array('name' => $val->first_name,
					'body' => $request->message);
				$to = $val->email;
				
				\Mail::queue('emails.promotions',$data, function ($message) use($to,$subject) { 
					$message->to($to)->subject($subject);
				});
				  
			}
			
			Session::flash('flash_message', 'Email has been sent successfully.');
            Session::flash('flash_type', 'alert-success');
			 
			
		}
		
		return redirect('admin/customers/mass-email');
		 
	}
	
	public function getAddRate() {

        $getrate = DB::table('friend_rate')
			->select('rate')
			->first();
		
		 return view('admin/customers/add-rate')->with(compact('getrate'));
    }
	
	public function postSaveRate(Request $request) {
		$value_exist = DB::table('friend_rate')
		->select('id')
		->count();
		
		$inputs=$request->all();
		unset($inputs['_token']);
		if($value_exist>0)
		{
			  $inputs['updated_at']=date('Y-m-d h:i:s');
			  DB::table('friend_rate')->update($inputs);
			  Session::flash('flash_message', 'Rate has been updated successfully.');				
		  
		}
		else
		{
			
			  $inputs['created_at']=date('Y-m-d h:i:s');
			  Session::flash('flash_message', 'Rate has been added successfully.');
		      DB::table('friend_rate')->insert($inputs);	
		}
		      Session::flash('flash_type', 'alert-success');
        return redirect('admin/customers/add-rate');
    }
    
}