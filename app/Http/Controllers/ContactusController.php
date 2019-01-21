<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Validator;
use Session;



class ContactusController extends Controller {
    
	public function __construct(Request $request)
	{
		if($request->has('cur')) {
			\Helper::setCurrency($request->cur);
		}
	
	}
	
	
	
	public function index(){

		return view('contact/index');


	}

	public function store(Request $request){

		$input = $request->all();
		
	//	print_r($input); die;
		$rules = array(
			'name' => 'required',
			'email' => 'required',
			'message' => 'required',
		);	


		$validator = Validator::make($input,$rules);

        if ($validator->fails()) {

			//return redirect()->back()->withInput($input)->withErrors($validator->errors());
				return Redirect::to(URL::previous() . '#contact')
                    ->withInput($input)
                    ->withErrors($validator);
       
        }
        
        
        
        $data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'bodyMessage'=>$request->message
        );  
        
        //print_r($data);die;
                      

 		\Mail::send('emails.contactUs',$data, function ($message) { 
	        $message->to('info@crossXcourt.com')->subject(' New Enquiry');
	    });
	    //Session::flash('flash_message', 'Thanks for contacting us');
        //Session::flash('flash_type', 'alert-success');
        //return redirect()->back();
        return Redirect::to(URL::previous() . '#contact')->with('success','Thanks for contacting us.');
	
	}



}
