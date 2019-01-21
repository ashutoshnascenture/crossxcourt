<?php namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use App\Credit;


class CheckoutController extends Controller {

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
		$this->middleware( 'auth',['except' => ['index']]);
		if($request->has('cur')) {
			\Helper::setCurrency($request->cur);
		}
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index($id)
	{		 
		if(\Auth::user() &&  !\Auth::user()->hasRole('Customer')){
			
			\Session::flash('flash_message', 'You are not logged in as a customer.');
			\Session::flash('flash_type', 'alert-danger');
			return redirect('/users/success');
			
		}
	 
		
		$coach_packages = DB::table('coach_packages')
			->Join('packages', 'coach_packages.package_id', '=', 'packages.id')
			->Join('coach', 'coach_packages.coach_id', '=', 'coach.user_id')
			->where('coach_packages.coach_id', $id)->get();
		 	
		$coach_data = DB::table('coach')
			->Join('users', 'coach.user_id', '=', 'users.id')
			->where('coach.user_id', $id)->first();
		
		/* Friend rate  */
		$rate =DB::table('friend_rate')
			->select('rate')->first();
		 
		if(!empty($coach_packages))
			return view('checkout', array('coach_packages' => $coach_packages, 'coach_data' => $coach_data,'rate'=>$rate));
	    else {
			return redirect()->back();	
		}
	}
	
	public function doDirectPayment(Request $request)
	{	
 		try {
			
			require_once base_path().'/vendor/paypal/PPBootStrap.php';
			
			$package = DB::table('packages')
				->Join('coach_packages', 'packages.id', '=', 'coach_packages.package_id')
				->where('coach_packages.coach_id',$request->coach)  
				->where('lessons', $request->lesson)->first();
		
			if($request->coach != $package->coach_id){
				return redirect()->back();
			}
			
			$max_students = $request->max_students;
			
			$rate =DB::table('friend_rate')
			->select('rate')->first();
			$friend_price = $rate->rate;
			$per_hours = $friend_price;
			
			if($max_students > 0){
				$total_with_students = $request->lesson * $per_hours * $max_students;
				$total_amount = $package->rate * $package->lessons + $total_with_students;
			}
			else{
				$total_amount = $package->rate * $package->lessons;
			}
			
			$p_price = $total_amount;
			
			$p_currency = 'USD';
			$p_name = $package->lessons . ' Lessons';

		 	$firstName = $request->firstName;
		  //	$lastName = $request->lastName;
			 
			$orderTotal = new \BasicAmountType();
			$orderTotal->currencyID = $p_currency;
			$orderTotal->value = $p_price;
			
			$paymentDetails = new \PaymentDetailsType();
			//$paymentDetails->ShipToAddress = $address;

			$itemDetails = new \PaymentDetailsItemType();
			$itemDetails->Name = $p_name;

			$itemDetails->Amount = $orderTotal;
			
			$itemDetails->Quantity = 1;
			
			$itemDetails->ItemCategory = 'Physical';

			$paymentDetails->PaymentDetailsItem[0] = $itemDetails;
			$paymentDetails->OrderTotal = $orderTotal;
			
			if (isset($_REQUEST['notifyURL'])) {
				$paymentDetails->NotifyURL = $_REQUEST['notifyURL'];
			}

			$personName = new \PersonNameType();
			$personName->FirstName = $firstName;
			//$personName->LastName = $lastName;

			//information about the payer
			$payer = new \PayerInfoType();
			$payer->PayerName = $personName;
			 
			//$payer->Address = $address;
			//$payer->PayerCountry = $_POST['country'];

			$cardDetails = new \CreditCardDetailsType();
			$cardDetails->CreditCardNumber = $request->creditCardNumber;
			
			$cardDetails->CreditCardType = $request->creditCardType;
			$cardDetails->ExpMonth = $request->expDateMonth;
			$cardDetails->ExpYear = $request->expDateYear;
			$cardDetails->CVV2 = $request->cvv2Number;
			$cardDetails->CardOwner = $payer;
			
			//echo '<pre>'; print_r($cardDetails); die;
			
			$ddReqDetails = new \DoDirectPaymentRequestDetailsType();
			$ddReqDetails->CreditCard = $cardDetails;
			$ddReqDetails->PaymentDetails = $paymentDetails;
			$ddReqDetails->PaymentAction = $_REQUEST['paymentType'];
			 
			$doDirectPaymentReq = new \DoDirectPaymentReq();
			$doDirectPaymentReq->DoDirectPaymentRequest = new \DoDirectPaymentRequestType($ddReqDetails);
			$Configuration = \Configuration::getAcctAndConfig();
			$paypalService = new \PayPalAPIInterfaceServiceService($Configuration);
		 
			try {
				$doDirectPaymentResponse = $paypalService->DoDirectPayment($doDirectPaymentReq);
			} 
			catch (Exception $ex) {
				include_once( base_path().'/vendor/paypal/Error.php' );
				exit;
			}
			$serialized_data = serialize($doDirectPaymentResponse); 
			 
			$error = '';
			if(isset($doDirectPaymentResponse->Errors)){
				
				foreach($doDirectPaymentResponse->Errors as $errors){
					$error .= $errors->LongMessage . '<br>';
				}
				return redirect()->back()->with('msg', $error);
			}
			 
			if (isset($doDirectPaymentResponse)) {
				
				$status = $doDirectPaymentResponse->Ack;
				$created_at = date("Y-m-d H:i:s");  
				
				
				$credit = Credit::whereCustomerId(\Auth::user()->id)
					->whereCoachId($package->coach_id)->first();
				
				if(is_null($credit)){
					
					$credit = new Credit;
					$credit->customer_id = \Auth::user()->id;
					$credit->coach_id = $package->coach_id;
					$credit->remaining_credits = $request->lesson;
					$credit->save();
				}
				else{
					$remaining_credits = $credit->remaining_credits + $request->lesson;
					$credit->remaining_credits = $remaining_credits;
					$credit->save();
				}
				
				
				$query = DB::table('bookings')->insert([
					'customer_id' => \Auth::user()->id,
					'coach_id' => $package->coach_id,
					'preferred_day' =>  $request->preferred_day,
					'preferred_time' => $request->preferred_time,
					'email' => $request->email,
					'lesson_location' => $request->lesson_location,
					'lesson_location_description' => $request->lesson_location_description,
					'additional_players' => $request->max_students,
					'payment_info' => $serialized_data,
					'lessons' => $request->lesson,
					'rate' => $package->rate,
					'total' => $total_amount,
					'payment_status' => ($status != 'Success')? : 'Awaiting Payment',
					'created_at' => $created_at
					]);
				 	
				 
				$getid = DB::getPdo()->lastInsertId();
 
				$users = DB::table('bookings')
					->leftjoin('users as customer','bookings.customer_id','=','customer.id')
					->leftjoin('users as coach','bookings.coach_id','=','coach.id')
					->select('customer.email as cus_email','customer.first_name as customer_first_name','customer.last_name as customer_last_name','customer.email as cus_email','customer.mobile as cus_mobile','coach.id as coach_id','coach.first_name as coach_first_name','coach.last_name as coach_last_name','coach.email as coach_email','coach.mobile as coach_mobile','bookings.created_at as booking_date')
					->where('bookings.id','=',$getid)
					->first(); 
						
				$coach_id = $users->coach_id;
				$coach_first_name = $users->coach_first_name;
				$coach_last_name = $users->coach_last_name;
				$customer_first_name = $users->customer_first_name;
				$customer_last_name = $users->customer_last_name;
				$cus_email = $users->cus_email;
				$cus_mobile = $users->cus_mobile;
				$coach_email = $users->coach_email;
				$coach_mobile = $users->coach_mobile;
				$booking_date = $users->booking_date;
				
				 
				$name = strtolower($coach_first_name).'-'.strtolower($coach_last_name);
				 

				$data = array('preferred_day'=>$request->preferred_day ,'preferred_time'=>$request->preferred_time,'email'=>$request->email,'lesson_location'=>$request->lesson_location,'additional_players'=>$request->max_students,'rate' => $request->package_rate,'total' => $total_amount,'coach_mobile'=>$coach_mobile,'coach_email'=>$coach_email,'lessons' => $request->lesson,'customer_first_name'=>$customer_first_name,'customer_last_name'=>$customer_last_name,'cus_email'=>$cus_email,'cus_mobile'=>$cus_mobile,'coach_first_name'=>$coach_first_name,'coach_last_name'=>$coach_last_name,'name'=>$name,'coach_id'=>$coach_id);
				
				//echo "<pre>"; print_r($data); die;
 
				\Mail::send('emails.paymentConfirmation',$data, function ($message) use($users){ 
					$message->to($users->cus_email)->subject(' Your Payment has been successful');
				});	
				
				\Mail::send('emails.paymentConfirmationToCoach',$data, function ($message) use($users){ 
					$message->to($users->coach_email)->subject(' Customer details');
				});	
				
				Session::put('doDirectPaymentResponse', $doDirectPaymentResponse);
				return redirect('checkout/payment-response');
				
			}
			
		}
		catch (\Exception $e) {
			return redirect()->back()->with('msg', $e->getMessage());
		}
		
	}
	
	public function payment_response()
	{
	   return view('payment_response');
	}
	
	function payment($id){
		
		$booking = DB::table('bookings')
			->join('lessons','bookings.id','=','lessons.booking_id')
			->select('bookings.coach_id','bookings.rate','lessons.booking_id','lessons.pending_payment','lessons.id')
			->where('bookings.customer_id','=', \Auth::user()->id)
			->where('lessons.id','=',$id)->first();
		
		if(is_null($booking )){
			return redirect()->back();
		}
		
		$coach_data = DB::table('coach')
			->Join('users', 'coach.user_id', '=', 'users.id')
			->where('coach.user_id',$booking->coach_id)->first();
		
		$pending_amount = $booking->pending_payment * $booking->rate;
		
		return view('lesson-payment')->with(compact('booking','coach_data','pending_amount')); 
	 
	  
	} 
	
	function doPayment(Request $request,$id){
		
		$booking = DB::table('bookings')
			->join('lessons','bookings.id','=','lessons.booking_id')
			->select('bookings.lessons','bookings.used_hours','bookings.coach_id','bookings.rate','lessons.booking_id','lessons.pending_payment','lessons.id','bookings.payment_info')
			->where('bookings.customer_id','=', \Auth::user()->id)
			->where('lessons.id','=',$id)->first();
		 
		try {
			
			require_once base_path().'/vendor/paypal/PPBootStrap.php';
			
			$total_amount = $booking->pending_payment * $booking->rate;
			  
			$p_currency = 'USD';
			
			$p_name = $booking->pending_payment . ' Lessons';
  
			$orderTotal = new \BasicAmountType();
			$orderTotal->currencyID = $p_currency;
			$orderTotal->value = $total_amount;
			
			$paymentDetails = new \PaymentDetailsType();
			 
			$itemDetails = new \PaymentDetailsItemType();
			$itemDetails->Name = $p_name;

			$itemDetails->Amount = $orderTotal;
			
			$itemDetails->Quantity = 1;
			
			$itemDetails->ItemCategory = 'Physical';

			$paymentDetails->PaymentDetailsItem[0] = $itemDetails;
			$paymentDetails->OrderTotal = $orderTotal;
			
			if (isset($_REQUEST['notifyURL'])) {
				$paymentDetails->NotifyURL = $_REQUEST['notifyURL'];
			}

			$personName = new \PersonNameType();
			$personName->FirstName = \Auth::user()->first_name;
			 
			$payer = new \PayerInfoType();
			$payer->PayerName = $personName;
			  
			$cardDetails = new \CreditCardDetailsType();
			$cardDetails->CreditCardNumber = $request->creditCardNumber;
			
			$cardDetails->CreditCardType = $request->creditCardType;
			$cardDetails->ExpMonth = $request->expDateMonth;
			$cardDetails->ExpYear = $request->expDateYear;
			$cardDetails->CVV2 = $request->cvv2Number;
			$cardDetails->CardOwner = $payer;
			
			$ddReqDetails = new \DoDirectPaymentRequestDetailsType();
			$ddReqDetails->CreditCard = $cardDetails;
			$ddReqDetails->PaymentDetails = $paymentDetails;
			$ddReqDetails->PaymentAction = 'Sale';
			
	 
			$doDirectPaymentReq = new \DoDirectPaymentReq();
			$doDirectPaymentReq->DoDirectPaymentRequest = new \DoDirectPaymentRequestType($ddReqDetails);
			$Configuration = \Configuration::getAcctAndConfig();
			$paypalService = new \PayPalAPIInterfaceServiceService($Configuration);
		 
			try {
				$doDirectPaymentResponse = $paypalService->DoDirectPayment($doDirectPaymentReq);
			} 
			catch (Exception $ex) {
				include_once( base_path().'/vendor/paypal/Error.php' );
				exit;
			}
			
			$serialized_data = serialize($doDirectPaymentResponse); 
			
			$error = '';
			if(isset($doDirectPaymentResponse->Errors)){
				foreach($doDirectPaymentResponse->Errors as $errors){
					$error .= $errors->LongMessage . '<br>';
				}
				return redirect()->back()->with('msg', $error);
			}
			
			if (isset($doDirectPaymentResponse)) {
				
				$status = $doDirectPaymentResponse->Ack;
				$payment_status = ($status != 'Success') ? : 'Completed';
				
				$data = array();
				
				if(!$booking->payment_info){
					$data['payment_status'] = $payment_status;
					$data['payment_info'] = $serialized_data;
				}
	
				if($booking->lessons < $booking->used_hours){
					$data['lessons'] = $booking->used_hours;
					$data['total'] =  $booking->rate * $booking->used_hours;
					 
				}
				
				if($data){
					
					DB::table('bookings')->where('id', $booking->booking_id)
					->update($data);
					
				}
				
				DB::table('lessons')->where('id', $booking->id)
					->update(['pending_payment' => 0]);
				
				
				
			//////////	/////email function/////////////////////////////////////////////
				$users = DB::table('bookings')
					->leftjoin('users as customer','bookings.customer_id','=','customer.id')
					->leftjoin('users as coach','bookings.coach_id','=','coach.id')
					->select('customer.email as cus_email','customer.first_name as customer_first_name','customer.last_name as customer_last_name','customer.email as cus_email','customer.mobile as cus_mobile','coach.id as coach_id','coach.first_name as coach_first_name','coach.last_name as coach_last_name','coach.email as coach_email','coach.mobile as coach_mobile','bookings.created_at as booking_date')
					->where('bookings.id','=',$booking->booking_id)
					->first(); 
					
				//echo "<pre>"; print_r($users);	die;
						
				$coach_id = $users->coach_id;
				$coach_first_name = $users->coach_first_name;
				$coach_last_name = $users->coach_last_name;
				$customer_first_name = $users->customer_first_name;
				$customer_last_name = $users->customer_last_name;
				$cus_email = $users->cus_email;
				$cus_mobile = $users->cus_mobile;
				$coach_email = $users->coach_email;
				$coach_mobile = $users->coach_mobile;
				$booking_date = $users->booking_date;
				
				 
				//$name = strtolower($coach_first_name).'-'.strtolower($coach_last_name);
				 

				$data = array('coach_mobile'=>$coach_mobile,'coach_email'=>$coach_email,'customer_first_name'=>$customer_first_name,'customer_last_name'=>$customer_last_name,'cus_email'=>$cus_email,'cus_mobile'=>$cus_mobile,'coach_first_name'=>$coach_first_name,'coach_last_name'=>$coach_last_name);
				
				 
 
				\Mail::send('emails.CustomerPayment',$data, function ($message) use($users){ 
					$message->to($users->cus_email)->subject(' Your Payment has been successful');
				});	
				
				\Mail::send('emails.CustomerPaymentToCoach',$data, function ($message) use($users){ 
					$message->to($users->coach_email)->subject(' Your Payment has been successful');
				});
				
			///////////////////////email function/////////////////////////////////////

			}
			Session::put('doDirectPaymentResponse', $doDirectPaymentResponse);
			return redirect('checkout/payment-response');
				
			 
		}
		catch (\Exception $e) {
			return redirect()->back()->with('msg', $e->getMessage());
		}
		 
		
	}
	
	

}
