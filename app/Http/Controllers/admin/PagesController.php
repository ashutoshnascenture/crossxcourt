<?php namespace App\Http\Controllers\Admin;
	
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Validator;
	use App\User;
	use App\Page;
	use DB;
	use Input;
	use Session;
	
class PagesController extends Controller {

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
	 * Show the application dashboard to the page.
	 *
	 * @return Response
	 */
	 
	public function index()
	{  
		$pages = Page::paginate();
		return view('admin.pages.index')->with('pages',$pages);	 
	}
	
	public function create()
	{
		 
		 
		return view('admin.pages.create');
	}
	 
	function store(Request $request){
		 
		$input = $request->all();
		 
		$validator = Validator::make($input, Page::$rules);
	//	$validator = Validator::make(Input::all(), Page::$rules);
		$input['role_id'] = 2;
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors());	
		}
		
		$page = new Page;
		 
		
		$page::create($input); 
		Session::flash('flash_message', 'Page has been created successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/pages'); 
	   
	}
	
	public function destroy(Request $request, $id){
		
		if($id){
			Page::destroy($id);
			Session::flash('flash_message', 'Page has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/pages'); 
		
	}
	
	function edit($id){
	
		$page = Page::find($id);
		
        if (is_null($page))
        {
            return redirect('admin/pages');
        }
		return view('admin.pages.edit')->with('page',$page);
	}
	
	function update(Request $request, $id ){
		
		$input = $request->all();
		$rules = Page::$rules;
		 
		 
		$validator = Validator::make($input,$rules);
		
		if ($validator->fails()) {
			return redirect()->back()->withInput($input)->withErrors($validator->errors()); 	
		}
	 
		
		$page =  Page::find($id);
		$page->update($input);
		Session::flash('flash_message', 'Page has been updated successfully.');
		Session::flash('flash_type', 'alert-success');
		return redirect('admin/pages');
	}
	function viewPage($id){
	
		$page = Page::find($id);
	
		if (is_null($page))
		{
			return redirect('admin/pages');
		}
		return view('admin.pages.view')->with('page',$page);
	}
}
