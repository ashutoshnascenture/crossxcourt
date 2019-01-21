<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Playwithpro;
use Helper;
use Session;
use DB;
 

class PageController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Page Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the static pages.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	 
	public function __construct(Request $request)
	{
		// $this->middleware('auth');
		 
		if($request->has('cur')) {
			\Helper::setCurrency($request->cur);
		}
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index($slug)
	{ 	

		$page = DB::table('pages')->where('slug','=',$slug)->first();
		if(!$page){
			return response()->view('errors.401');
		}
		
		$meta['title'] = 'crossXcourt | '.$page->title;	
		
		return view('pages.index')->with(compact('page','meta'));
		  
	}
	
	function howItWork(){
		
		$page = DB::table('pages')->where('slug','=','how-it-work')->first();
		if(!$page){
			return response()->view('errors.401');
		}
		
		$countries = \Cache::remember('countries',43200, function(){
			return DB::table('countries')
				->select('sortname','name')
				->orderBy('name')->get();
		});
		 
		$meta['title'] = 'crossXcourt | '.$page->title;	
		
		return view('pages.how_it_work')->with(compact('page','meta','countries'));
		
	}
	
	
	function playWithPro(){
		
		$page = DB::table('pages')->where('slug','=','play-with-pro')->first();
		//print_r($page); die;
		if(!$page){
			return response()->view('errors.401');
		}
		
		$coaches = DB::table('playwithpros')->get();
			   
		//echo "<pre>"; print_r($coaches); die;	   
			   
			   
		$countries = \Cache::remember('countries',43200, function(){
			return DB::table('countries')
				->select('sortname','name')
				->orderBy('name')->get();
		});
		
		 
		 
		$meta['title'] = 'crossXcourt | '.$page->title;	
		
		return view('pages.play_with_pro')->with(compact('page','meta','countries','coaches'));	
		
		
		
	}

	function tennislessons(){
		//echo "string";
		$page = DB::table('pages')->where('slug','=','tennis-lessons')->first();
		if(!$page){
			return response()->view('errors.401');
		}
		
		$countries = \Cache::remember('countries',43200, function(){
			return DB::table('countries')
				->select('sortname','name')
				->orderBy('name')->get();
		});
		 
		$meta['title'] = 'crossxcourt | '.$page->title;	
		
		return view('pages.tennis_lessons')->with(compact('page','meta','countries'));
		
	}

	

	
	public function bookappointment($name ,$id){
		
		$coach = Playwithpro::find($id);
		$admin = User::where('role_id','=',1)->first();
	 
		
		if(!$coach){
			return redirect()->back();
		}
		
		return view('pages.bookappointment')->with(compact('coach','name','admin'));
		
		
		
	}
	
	public function faqs(){
		
	 return view('pages.faqs');	
		
		
	}
	 
}
