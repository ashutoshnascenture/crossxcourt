<?php namespace App\Http\Controllers\Admin;
 
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Validator;
 use App\Message;
 use App\Messagedetail;
 use DB;
 use Session;
 use Auth;

class MessagesController extends Controller {

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
  
 public function index($role)
 {
    
	$to=Auth::user()->id;
	$messages = DB::table('messages')
	->Select('messages.id as message_id','messages.*','to.first_name as to_first_name','from.first_name as from_first_name')
	->join('users as from','messages.from','=','from.id')
	->join('users as to','messages.to','=','to.id')
	->where('messages.to', '=',$to)
	->where('from.role_id', '=',$role) 
	->orWhere('messages.from', '=',$to)
	->where('to.role_id', '=',$role) 
	 //->get()
	 ->paginate(15);
	return view('admin/messages.index')->with(compact('messages','role'));    
   
  
 } 
 
  public function outbox($role)
 {  
     $from=Auth::user()->id;
	 $messages = DB::table('messages')
	 ->Select('messages.id as message_id','messages.*','users.*')
	 ->join('users','messages.to','=','users.id')
	 ->where('role_id', '=',$role)
	 ->where('from', '=',$from)
	  ->paginate(15);
	return view('admin/messages.outbox')->with(compact('messages','role'));  
	
 } 
 
  
  public function reply_message($id,$role)
 {  
     
    
	  $update = Message::find($id);
			   if($update) {
					$update->read_admin = '0';
					$update->save();
					}
    
    
	$messages = DB::table('messages')->where('id', '=',$id)->first();
	$messages_detail = DB::table('message_detail')->where('message_id', '=',$id)->get();
	$data=array('messages'=>$messages,
	            'messages_detail'=>$messages_detail,
				'role'=>$role);
	
	 return view('admin/messages.reply_message')->with(compact('data','role'));  
  
 } 
 
 
 public function postReply_message(Request $request,$role)
 {  
   
     $field_name='';
     if($role=='2')
     {
	  $field_name='read_coach';
     }
	 else if($role=='3')
	 {
	  $field_name='read_customer';
	 }	
     $update = Message::find($request->message_id);
			   if($update) {
					$update->$field_name = '1';
					$update->reply = '1';
					$update->save();
					}	 
   
	$input = $request->all();
	$date = date('Y-m-d H:i:s');
	$input['created_at'] = $date;
	$input['user_id'] =Auth::user()->id;
	
	$validator  = Validator::make($request->all(), Messagedetail::$rules );
	  if ($validator->fails()){
	   return redirect()->back()->withInput($input)->withErrors($validator->errors()); 
	  }
    
		else
		{
			
			$save= Messagedetail::create($input);
			if($save){
			  return redirect('admin/reply_message/'.$request->message_id.'/'.$role)->with('message','Your message has been send');
			}
			
			else{
			 Session::flash('flash_message', 'Message could not be send please try again');
			 Session::flash('flash_type', 'alert-danger');
			 return redirect()->back()->withInput($input);
			}
	   
		} 
  
 } 
 
 
  
 public function add($role)
 {
	
	 $customers = array();
	 if($role==2)
	 {
		 $customers = DB::table('users')
				->select('users.first_name','users.id')
				->join('coach as c','c.user_id','=','users.id')
				->where('c.is_active', '=',1)
				->orderBy('users.first_name')->get();
			
		
	 }
	 elseif($role==3)
	 {
	           $customers = DB::table('users')
				->select('users.first_name','users.id')
				->where('users.role_id', '=','3')
				->orderBy('users.first_name')->get();
		
				
	 }
    
				
    return View('admin/messages.add')->with(compact('customers','role'));   
	
 }

 
 public function send_message(Request $request)
 { 
  
    $read_coach=0;
	$read_customer=0;
    if($request->role=='2')
	  $read_coach=1;
    elseif($request->role=='3') 
      $read_customer=1;
  
		
    $input = $request->all();
	$input['read_coach'] = $read_coach;
	$input['read_customer'] = $read_customer;
	$date = date('Y-m-d H:i:s');
	$input['created_at'] = $date;
	$input['from'] =Auth::user()->id;
    $validator  = Validator::make($request->all(), Message::$rules );
	  if ($validator->fails()){
	   return redirect()->back()->withInput($input)->withErrors($validator->errors()); 
	  }
    
		else
		{
			$save= Message::create($input);
			if($save){
			 return redirect('admin/outbox/'.$request->role)->with('message','Your message has been send');
			}
			
			else{
			 Session::flash('flash_message', 'Message could not be send please try again');
			 Session::flash('flash_type', 'alert-danger');
			 return redirect()->back()->withInput($input);
			}
	   
		}
   
 }
 
}
