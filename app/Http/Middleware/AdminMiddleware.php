<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdminMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{	 
		$url = $request->url(); 
		
		if($request->user()){
			
			if($request->user()->role_id != 1  && strstr($url,'admin'))
			{ 	
				return redirect('/');
			} 
		}
		 
		return $next($request);
	}
	
	

}
