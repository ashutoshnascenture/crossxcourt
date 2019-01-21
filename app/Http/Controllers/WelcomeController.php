<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Helper;
use Session;
use DB;
use App\User; 

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(Request $request){
		
		if($request->has('cur')) {
			Helper::setCurrency($request->cur);
		}
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	
	public function setCurrency($cur){
		 
		$currencies = unserialize(\Config::get('constants.CURRENCIES'));
		 
		if(in_array($cur,$currencies))
			Session::set('myCurrency',$cur);
		
	} 
	 
	public function index() { 	
	
		$coaches = DB::table('users')
				->where('users.role_id',2)
				->where('coach.is_active',1)
				->where('coach.is_featured',1)
				->join('coach','coach.user_id','=','users.id')
				->join('countries','countries.sortname','=','users.country')
				->select('coach.user_id', 'coach.profile_image','coach.motto', 'users.first_name', 'users.last_name','users.city','countries.name as countryname')
			   ->orderBy('rating','DESC')
			   ->groupBy('users.id')
			   ->get();
			   
		/* 
		 * 		->take(8)		
		$coaches = \Cache::remember('coaches',1500, function(){
			
			return  DB::table('users')
				->where('users.role_id',2)
				->where('coach.is_active',1)
				->join('coach','coach.user_id','=','users.id')
				->select('coach.user_id', 'coach.profile_image','coach.motto', 'users.first_name', 'users.last_name','users.city')
			   ->orderBy('rating','DESC')
			   ->take(8)->get();
		});
		*/
		
		$countries = \Cache::remember('countries',43200, function(){
			return DB::table('countries')
				->select('sortname','name')
				->orderBy('name')->get();
		});
		
		return view('welcome')->with(compact('countries','coaches'));
		  
	}
	
	function getStates($country){
		
		if(is_null($country)){
			 return false;
		}
		
		$states = DB::table('countries')
			->join('states','countries.id','=','states.country_id')
			->select('states.name')
			->where('countries.sortname','=',$country)
			->orderBy('name')->get();
		 
		return json_encode($states);
		
	}
	
	function getCountryName($country){
		
		if(is_null($country)){
			 return false;
		}
		
		$country_name = DB::table('countries')
				->select('countries.name')
				->where('countries.sortname','=',$country)
				->first();
		 
		return json_encode($country_name);
		
	}
	
	function findServices(Request $request){
		
		//find coach 
		$zip_code = $queryString = null;
         
		if($request->has('zip_code')){
			$zip_code = urlencode($request->zip_code);   
		}
		if($request->has('country')){
			$queryString .= '?country='.urlencode($request->country);
		
		}
		if($request->has('state')){
			$queryString .= '&state='.urlencode($request->state);
		}

		return redirect('services/'.$zip_code .$queryString); 
		 
	}
	
	function getServices(Request $request, $zip_code = null){
		 
		$nearBy = false;
		$zip_code = urldecode($zip_code);
		
		$country = urldecode($request->country);
		$sortname = $country;
		
		$country_data = DB::table('countries')
			->select('sortname')
			->where('name','=',$country)->first();
		
		if($country_data) {
			$sortname = $country_data->sortname;
		}
		
		$state = urldecode($request->state);
		 
		$meta['title'] = 'crossxcourt | tennis instructor near '.$zip_code;
		
		$query = DB::table('users')
			->leftJoin('coach','users.id','=','coach.user_id')
			->where('users.role_id','=',2)
			->where('coach.is_active','=',1);
		  
		if(!is_null($zip_code)){
			
			$query->where(function ($q) use($zip_code) {
				$q->wherePostCode($zip_code);
				$q->orWhere('city', 'like', "$zip_code%");	
			});
			
			
		}
		if($request->has('country')){
			$query->where('users.country', $sortname);
			$meta['title'] .= ' '. $country;
		}
		if($request->has('state')){
			$query->where('users.state',$state);
			$meta['title'] .= ' '.$state;			
		}
		 
		$query->select('users.id','users.first_name','users.last_name','users.email','users.address','users.city','users.state','users.country','users.latitude','users.longitude','coach.profile_image','coach.tennis_qualification','coach.tennis_experience','price','coach.motto','coach.reviews','coach.rating');
		
		$query->orderBy('coach.rating','DESC');
		
		$services = $query->paginate(10);
		
		if(!count($services) && $zip_code){
			 
			$address = $zip_code.', '.$request->country;
			$latlng  = Helper::getLatLog($address);
			 
			if($latlng){
				
				$lat = $latlng['lat'];
				$lng = $latlng['lng'];
				$nearBy = true;
				 
				$services = DB::select("select `users`.`id`, `users`.`first_name`, `users`.`last_name`, `users`.`email`, `users`.`address`, `users`.`city`, `users`.`state`, `users`.`country`, `users`.`latitude`, `users`.`longitude`, `coach`.`profile_image`, `coach`.`tennis_qualification`, `coach`.`tennis_experience`, `price`, `coach`.`motto`, `coach`.`reviews`, `coach`.`rating`, 3959 * acos( cos( radians($lat) ) * cos( radians( latitude ) ) 
				* cos( radians( longitude ) - radians($lng)) + sin( radians($lat) ) * 
				sin( radians( latitude ))) AS distance from `users` left join `coach` on `users`.`id` = `coach`.`user_id` where `coach`.`is_active` = 1 and users.country = '".$sortname."' having distance < 10 ORDER BY distance ASC limit 50");
				
			}
			
		}
		
		return view('services')->with(
			compact('services','nearBy','meta','country','state','zip_code')
		);
		
		
	}
	 

}
