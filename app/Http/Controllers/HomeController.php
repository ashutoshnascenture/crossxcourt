<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request)
	{
		$this->middleware('auth');
		if($request->has('cur')) {
			\Helper::setCurrency($request->cur);
		}
		
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		
		$user_exist = DB::table('coach')
			->select('user_id')
			->where('user_id',Auth::user()->id)
			->count();

		if(Auth::user()->hasRole('Coach')){
			
			if($user_exist) {
			
			return redirect('users/account-information');
			
			} else {
			
			return redirect('coaches/service-area');
			
			}
		}
		else if(Auth::user()->hasRole('Customer'))
		{
			return redirect('customer/edit');
		} 
		elseif(Auth::user()->hasRole('Administrator'))
		{
			return redirect('admin/home');	
		}
		else 
		{
			return redirect('/');	
		}
		
	}

}
