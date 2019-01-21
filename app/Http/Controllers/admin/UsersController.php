<?php namespace App\Http\Controllers\Admin;
	
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Validator;
	use App\User;
	use DB;
	use Input;
	use Session;
	
class UsersController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware( 'auth' );
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	 
	public function index(Request $request)
	{  
		 
		$query = User::with('Info')->where('role_id', '=', 3);
		  
		if($request->has('q')){
			$q = $request->q;
			$query->where(function($query) use($q){
				$query->orWhere('first_name','like', "%$q%")
				->orWhere('last_name','like', "%$q%")
				->orWhere('email','like', "%$q%");
			});
			
			
		}
		$users = $query->paginate();
		return view('admin.users.index')->with(compact('users'));	 
	}
	
	public function create()
	{
		$countries = DB::table('countries')
				->select('sortname','name')
				->orderBy('name')->get();
		 
		 
		return view('admin.users.create')->with('countries',$countries);
	}
	 
	function store(Request $request){
		 
		$input = $request->all();
		$input['password'] = bcrypt($request->password);
		$input['role_id'] = 3; 
	
		$rules = array(
			'first_name'=>'required',
			'last_name'=>'required',
			'email'  => 'required|email|unique:users',      
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
             
        );
				
		$validator = Validator::make($input,$rules);
				
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors());	
		}
		
		$user = new User;
		
		
		$user::create($input); 
		Session::flash('flash_message', 'Customer has been created successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/users'); 
	   
	}
	
	public function destroy(Request $request, $id){
		
		if($id){
			DB::table('bookings')->where('customer_id', '=', $id)->delete();
			User::destroy($id);
			Session::flash('flash_message', 'Customer has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/users'); 
		
	}
	
	function edit($id){
	
		$user = User::find($id);
		
        if (is_null($user))
        {
            return redirect('admin/users');
        }
		return view('admin.users.edit')->with('user',$user);
	}
	
	function update(Request $request, $id ){
		
		$input = $request->all();
		$rules = User::$rules;
		$rules = array(
			'first_name'=>'required',
			'last_name'=>'required',
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
		 
		
		$user =  User::find($id);
		$user->update($input);
		Session::flash('flash_message', 'Customer has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/users');
	}



	public function show($id) {
		 
		 
		$customer = User::where('id', '=', $id)->first();
		return view('admin.users.view')->with('customer',$customer);	
	
	}



}
