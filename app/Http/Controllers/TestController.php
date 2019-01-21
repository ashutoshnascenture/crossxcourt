<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Helper;
use Session;
use DB;
use App\User; 

class TestController extends Controller {

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
		 
		
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	
	 
	 
	public function index() { 	
		// the message
		echo '<meta name="google-site-verification" content="3hm8fMMPduCbCyEyh36_SYdVcJ9oimiw0p3WNpyx28c" />';
		$msg = "First line of text\nSecond line of text";
		
		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		
		// send email
		mail("vivek@nascenture.com","My subject",$msg);
		  
	}
	
	 
	 

}
