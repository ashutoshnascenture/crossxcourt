<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use Input;
use Session;

class BookingController extends Controller {


	public function __construct() {
		$this->middleware('auth');
	}


	public function getIndex(Request $request){
		
		$bookings = DB::table('bookings')
		->join('users as b' ,'bookings.customer_id' ,'=' ,'b.id') 
		->join('users as c', 'bookings.coach_id', '=', 'c.id')	 
		->select('bookings.*' , 'b.first_name as constomer_first_name' ,'b.last_name as constomer_last_name', 'c.first_name as coach_first_name','c.last_name as coach_last_name')
		->orderBy('bookings.id','DESC');		
		
		
		if($request->has('q')){
			$q = $request->q;
			$bookings->where(function($bookings) use($q){
				$bookings->orWhere('bookings.payment_info','like', "%$q%")
				->orWhere('bookings.id','like', "%$q%");
			});
						
		}
		
		 $bookings = $bookings->paginate();	

		return view('admin/bookings/index')->with('bookings', $bookings);

	}


	public function getDestroy($id) {

		if ($id) {
			DB::table('bookings')->where('id', '=', $id)->delete();

			Session::flash('flash_message', 'Booking has been deleted successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/bookings/');
	}


	public function getPaymentstatus($id){
	//	die("hi");
		if(!empty($id)) {

			DB::table('bookings')->where("id", $id)->update(array('payment_status' => 'Paid'));
			Session::flash('flash_message', 'Payment status has been updated successfully.');
			Session::flash('flash_type', 'alert-success');
		}
		return redirect('admin/bookings/');

	}


}

