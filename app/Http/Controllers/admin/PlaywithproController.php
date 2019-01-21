<?php namespace App\Http\Controllers\Admin;
	
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Validator;	 
	use App\Playwithpro;
	use DB;
	use Input;
	use Session;
	
class PlaywithproController extends Controller {

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
		 
		 
		$play_with_pros = DB::table('playwithpros')->paginate();
		 
		return view('admin.playwithpros.index')->with(compact('play_with_pros'));	 
	}
	
	public function create()
	{
		 
		return view('admin.playwithpros.create');
	}
	 
	function store(Request $request){
		 
		$input = $request->all();
		$rules = Playwithpro
		::$rules;	 
				
		$validator = Validator::make($input,$rules);
		
		
				
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors());	
		}
		
		$image = $request->file('profile_image');

        if (!empty($image)) {

            $input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'images/coaches';
            $image->move($destinationPath, $input['profile_image']);
        }
		
		$pro = new Playwithpro;
				
		$pro::create($input); 
		Session::flash('flash_message', 'Pro user has been created successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/play-with-pro'); 
	   
	}
	
	public function destroy(Request $request, $id){
		
		if($id){
			
			Playwithpro::destroy($id);
			Session::flash('flash_message', 'Pro user has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/play-with-pro'); 
		
	}
	
	function edit($id){
	
		$pro = Playwithpro::find($id);
		
        if (is_null($pro))
        {
            return redirect('admin/play-with-pro');
        }
		return view('admin.playwithpros.edit')->with('pro',$pro);
	}
	
	function update(Request $request, $id ){
		
		 
		$input = $request->all();
		$image = $request->file('profile_image');

        if (!empty($image)) {

            $input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = 'images/coaches';
             
            $image->move($destinationPath, $input['profile_image']);
        }
		$rules = Playwithpro::$rules;
		 		 
		$validator = Validator::make($input,$rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors()); 	
		}
						 
		
		$pro_user =  Playwithpro::find($id);
		$pro_user->update($input);
		Session::flash('flash_message', 'Pro user has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/play-with-pro');
	}



	public function show($id) {
		 
		 
		$pro = Playwithpro::where('id', '=', $id)->first();
		return view('admin.playwithpros.view')->with('pro',$pro);	
	
	}



}
