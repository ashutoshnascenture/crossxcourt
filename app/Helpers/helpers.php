<?php use Illuminate\Support\Str;
   
class Helper {
  
	public static function getLatLog($zip_code) {
		
		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=
		".urlencode($zip_code)."&sensor=false";
		$result_string = file_get_contents($url);
		$result = json_decode($result_string, true);
	 
		if($result['status'] == 'OK'){
			$result1[]=$result['results'][0];
			$result2[]=$result1[0]['geometry'];
			$result3[]=$result2[0]['location'];
			return $result3[0];
		}
		
		return false;
		
	}
	
	public static function ago($date) {

		if(empty($date)) {
			return '';
		}
		
		$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		$lengths = array("60","60","24","7","4.35","12","10");
		$now = time();
		$unix_date = strtotime($date);
		
		// check validity of date
		if(empty($unix_date)) {
			return "Bad date";
		}
		
		// is it future date or past date
		if($now > $unix_date) {
			$difference = $now - $unix_date;
			$tense = "ago";
		} 
		else {
			$difference = $unix_date - $now;
			$tense = "from now";
		}

		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if($difference != 1) {
			$periods[$j].= "s";
		}
		
		return "$difference $periods[$j] {$tense}";
		
	}
	
	
	public static function notification($field){
		
		return \DB::table('messages')
			->whereTo(Auth::user()->id)
			->where($field, '=',1)
			->orWhere('from','=', Auth::user()->id)
			->where($field, '=',1)
			->count();
		
	}
	
	public static function adminNotification(){
		
		$user_id = Auth::user()->id;
		
		return \DB::select("select role_id, count(id) as unread from  
		(SELECT fUser.role_id , messages.id from messages inner join users as fUser on fUser.id = messages.to where messages.from = $user_id  and read_admin = 1
		union all 
		SELECT users.role_id, messages.id from messages inner join users on users.id = messages.from where messages.to = $user_id  and read_admin = 1) as dd group by role_id ");
		
	
	} 
	
	// get price according to selected currency
	public static function get_price($from_Currency, $to_Currency, $amount){
		
			$currencies = unserialize(Config::get('constants.CURRENCIES'));
	
			if(!in_array($to_Currency,$currencies)){
				return $amount; 
			}
				
		    if($amount == 0 || $amount == 0.00)
				return $amount;
			
			else
			{
				/*$amount = urlencode($amount);
				$from_Currency = urlencode($from_Currency);
				$to_Currency = urlencode($to_Currency);

				  $url = "https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";  
				 
				$ch = curl_init();
				$timeout = 0;
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

				curl_setopt ($ch, CURLOPT_USERAGENT,
							 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$rawdata = curl_exec($ch);
				curl_close($ch);
				
				$data = explode('bld>', $rawdata);
				 
				$data1 = explode($to_Currency, $data[1]);
				 
				return round($data1[0], 2);*/
				return $amount;
			}
     }
	 
	 public static function profile_image(){
		
		return \DB::table('coach')
		    ->select('profile_image','user_id','is_active')
			->where('user_id', '=',Auth::user()->id)
		     ->first();
		
	}
	
	public static function setCurrency($cur){
		 
		$currencies = unserialize(Config::get('constants.CURRENCIES'));
		if(in_array($cur,$currencies)){
			\Session::set('myCurrency',$cur);
		}  
	}
	
}
