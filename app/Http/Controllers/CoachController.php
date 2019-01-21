<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Coachdetail;
use App\CoachPackage;
use App\Lesson;
use App\Credit;
use DB;
use Session;
use Lang;

class CoachController extends Controller {

    public $schedule_days = array(1 => 'Sun', 2 => 'Mon', 3 => 'Tue', 4 => 'Wed', 5 => 'Thu', 6 => 'Fri', 7 => 'Sat');

    public function __construct(Request $request) {
        $this->middleware('auth', ['except' => ['getProfile', 'getMyCurrency']]);

        if ($request->has('cur')) {
            \Helper::setCurrency($request->cur);
        }
    }
    
    /*
     * Service area view
     */
    function getServiceArea() {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $data = DB::table('coach')->select('service_area', 'user_id')
                        ->whereUserId(Auth::user()->id)->first();

        $address = array(
            'lat' => Auth::user()->latitude,
            'lng' => Auth::user()->longitude
        );



        return view('coaches.service_area')->with(compact('address', 'data'));
    }
    
    /*
     *  Availabiitly view
     */
    function getSchedule() {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $schedules = array();

        $data = DB::table('coach_schedules')
                        ->whereCoachId(Auth::user()->id)->get();

        if ($data) {
            foreach ($data as $val) {
                $day_num = array_search($val->day, $this->schedule_days);
                $val->day_num = $day_num;
                $schedules[] = (array) $val;
            }
        }

        $user_exist = DB::table('coach')
                ->select('user_id')
                ->where('user_id', Auth::user()->id)
                ->count();

        if (empty($user_exist)) {

            $user_exist = "";
        }
        $schedules = json_encode($schedules);

        return view('coaches.schedule')
                        ->with(compact('schedules', 'user_exist'));
    }
  
    /*
     * Save Availabiltity 
     */
    function postSchedule(Request $request) {

        $coach_id = Auth::user()->id;

        $schedules = json_decode($request->schedules, true);

        if (is_array($schedules) && !empty($schedules)) {

            if (isset($schedules[0])) {
                unset($schedules[0]);
            }

            $data = array();
            foreach ($schedules as $day => $times) {

                if (is_array($times) && isset($this->schedule_days[$day])) {

                    foreach ($times as $time) {
                        $data[] = array(
                            'coach_id' => $coach_id,
                            'day' => $this->schedule_days[$day],
                            'time' => $time
                        );
                    }
                }
            }


            if ($data) {

                if ($request->action == 'update') {

                    DB::table('coach_schedules')
                            ->where('coach_id', $coach_id)->delete();

                    DB::table('coach_schedules')->insert($data);

                    $user_exist = DB::table('coach')
                            ->select('user_id')
                            ->where('user_id', Auth::user()->id)
                            ->count();

                    if (empty($user_exist)) {

                        //Session::flash('flash_message', 'Your schedule has been updated successfully.');
                        //Session::flash('flash_type', 'alert-success');    
                        return redirect('users/detail');
                    } else {

                        Session::flash('flash_message', Lang::get('usersMessage.schedule'));
                        Session::flash('flash_type', 'alert-success');

                        return redirect()->back();
                    }
                } else {

                    DB::table('coach_schedules')->insert($data);
                    return redirect('users/detail');
                }
            }
        } else {

            return redirect()->back()->withErrors(['schedule' => Lang::get('usersMessage.schedule_input')]);
        }
    }
    
    /*
     * Save Service Area
     */
    public function postCoacharea(Request $request) {

        $user_id = Auth::user()->id;
        $input = $request->all();
        $rules = Coachdetail::$rules;
        $request->session()->forget('service_area');

        $data = DB::table('coach')->whereUserId(Auth::user()->id)->first();

        if ($request->has('latitude')) {
            DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->update(['latitude' => $request->latitude, 'longitude' => $request->longitude]);
        }

        if ($data) {
            $coach = Coachdetail::where('user_id', '=', $user_id);
            $coach->update(array('service_area' => $request->service_area));

            Session::flash('flash_message', Lang::get('usersMessage.service_area'));
            Session::flash('flash_type', 'alert-success');

            return redirect('coaches/service-area');
        } else {
            Session::put('service_area', $request->service_area);
            return redirect('coaches/schedule');
        }
    }
    
    /*
     * Get Price 
     */
    function getPrice() {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }
        $id = Auth::user()->id;

        $packages = CoachPackage::with('package')->whereCoachId($id)->get();
        return view('coaches.price')->with(compact('coach', 'packages', 'schedules'));
    }
   
    /*
     * Coach profile 
     */
    function getProfile($name, $id) {
        
        $coach = User::with(array('Info', 'CoachSchedules'))
                        ->whereId($id)->first();

        if ($coach) {
            $meta['title'] = ucfirst($coach->first_name) . ', ' . $coach->Info['tennis_qualification'] . ' in ' . $coach->city . ' - Tennis Wherever you Travel';
        }
        if (is_null($coach)) {
            return response()->view('errors.401');
        }

        $schedules = array();
        if (!empty($coach->CoachSchedules)) {

            foreach ($coach->CoachSchedules as $val) {
                if ($val['time'] < 12) {
                    $schedules[$val['day']]['Mornings'] = 1;
                } elseif ($val['time'] > 11 && $val['time'] < 18) {
                    $schedules[$val['day']]['Afternoons'] = 1;
                } elseif ($val['time'] > 17) {
                    $schedules[$val['day']]['Evenings'] = 1;
                }
            }
        }

        $packages = CoachPackage::with('package')->whereCoachId($id)->get();

        //...................reviews.........................
        $reviews = DB::table('lessons')
                        ->Select('coach_reviews.review', 'coach_reviews.created_at', 'coach_reviews.rating', 'coach_reviews.id as review_id', 'users.first_name', 'last_name', 'lessons.id as booking_id')
                        ->join('coach_reviews', 'lessons.id', '=', 'coach_reviews.lesson_id')
                        ->join('users', 'lessons.customer_id', '=', 'users.id')
                        ->where('lessons.coach_id', '=', $id)
                        ->orderBy('coach_reviews.id', 'DESC')
                        ->take(3)->get();

        //...................reviews.........................
        //customer details
        if (Auth::check()) {
            $customer_email = Auth::user()->email;
        } else {

            $customer_email = "";
        }
         if($_SERVER['REMOTE_ADDR']='171.61.201.35'){

             //echo "<pre>"; print_r($coach->toArray()); die;
         }
       
        return view('coaches.profile')->with(compact('coach', 'packages', 'schedules', 'reviews', 'customer_email', 'meta'));
    }

    /*
     * Get Coach Lesson Notification message and Lesson Listing
     */
    function getLessons() {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $bookings = DB::table('bookings')
                ->join('users', 'bookings.customer_id', '=', 'users.id')
                ->select('users.first_name', 'users.last_name', 'bookings.id', 'bookings.lessons', 'bookings.additional_players')
                ->where('bookings.coach_id', Auth::user()->id)
                ->where('bookings.is_inactive', '=', 0)
                ->groupBy('bookings.id')
                ->get();

        $lessons = DB::table('lessons')
                ->join('users', 'lessons.customer_id', '=', 'users.id')                
                ->leftjoin('lesson_courts', 'lesson_courts.id', '=', 'lessons.court_id')
                ->select('lessons.date', 'lessons.start_time', 'lessons.lesson_duration', 'lessons.court_id', 'lessons.number_of_students', 'lessons.status','lessons.payment_status', 'users.first_name', 'users.last_name', 'lessons.id', 'lesson_courts.name as court_name', 'lesson_courts.city', 'lesson_courts.state', 'lesson_courts.country', 'lesson_courts.longitude', 'lesson_courts.latitude', 'lesson_courts.address', 'lessons.status')
                ->where('lessons.coach_id', Auth::user()->id)
                ->where('lessons.status', '!=', 'Cancelled')
                ->orderBy('lessons.id', 'DESC')
                ->paginate(10);

        

        $countries = \Cache::remember('countries', 43200, function() {
                    return DB::table('countries')
                                    ->select('sortname', 'name')
                                    ->orderBy('name')->get();
                });


        return view('coaches.lessons')->with(compact('lessons', 'bookings', 'countries'));
    }

    /*
     * Get Lesson view 
     */
    function getCreateLesson($booking_id) {

        $courts = DB::table('coach_courts')
                        ->select('id', 'name', 'city', 'state', 'country')
                        ->where('coach_id', '=', Auth::user()->id)->get();

        $countries = DB::table('countries')
                        ->select('sortname', 'name')
                        ->orderBy('name')->get();


        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $customer = DB::table('bookings')
                ->join('users', 'bookings.customer_id', '=', 'users.id')
                ->join('credits', 'credits.customer_id', '=', 'bookings.customer_id')
                ->select('users.first_name', 'users.last_name', 'bookings.*', 'credits.remaining_credits')
                ->where('bookings.id', $booking_id)
                ->first();

        if (is_null($booking_id) || empty($customer)) {
            return redirect()->back();
        }


        return view('coaches.create_lesson')
                        ->with(compact('booking_id', 'customer', 'courts', 'countries'));
    }

    /*
     * Save created Lesson 
     */
    function postLesson(Request $request, $id) {

        $inputs = $request->all();
      //   echo "<pre>"; print_r($inputs);  
        $rules = Lesson::$rules;

        unset($rules['member'], $inputs['member']);
        $validator = Validator::make($inputs, $rules, Lesson::messages());

        if ($validator->fails()) {
            return redirect()->back()->withInput($inputs)->withErrors($validator->errors());
        }

        if ($request->lesson_duration > $request->hours_left) {

            return redirect()->back()->withErrors(['lesson_duration' => "Customer has only $request->hours_left credits hour left for this booking. "]);
        }


        //Apply additional_student check 

        if ($request->add_student == 0) {

            $additional_student = 1;
        } else {

            $additional_student = $request->add_student;
        }
        
        // Date check if date is less then today's date
        if ($request->date < date('m/d/Y')) {

            return redirect()->back()->withErrors(['date' => "You cannot create old date lesson."]);
        }
        
        // $additional_student check 
        if ($request->number_of_students > $additional_student) {

            return redirect()->back()->withErrors(['number_of_students' => "Customer has not pay for additional players."]);
        }

        //Update credit table   
        $credits = Credit::where('customer_id', '=', $request->customer_id)
                ->where('coach_id', '=', Auth::User()->id)
                ->first();
        //echo "<pre>"; print_r($credits); die;

       $remaining_credits = ($credits->remaining_credits - $request->lesson_duration); 

        if (!empty($credits)) {
            $credits = DB::table('credits')
                ->where('coach_id', '=', Auth::User()->id)
                ->where('customer_id', '=', $request->customer_id)
                ->update(array('remaining_credits' => $remaining_credits));
        }

        $inputs['customer_id'] = $request->customer_id;
        $inputs['coach_id'] = Auth::User()->id;
        $inputs['date'] = date('Y-m-d', strtotime($request->date));
        $inputs['status'] = 'Pending';
        $lesson = new Lesson;
        $lesson::create($inputs);
        
        //Update Booking Message status
        DB::table('bookings')
        ->where('coach_id', '=', Auth::User()->id)
        ->where('customer_id', '=', $request->customer_id)
        ->update(array('is_inactive' => 1));

        $users = DB::table('bookings')
            ->leftjoin('users as customer', 'bookings.customer_id', '=', 'customer.id')
            ->leftjoin('users as coach', 'bookings.coach_id', '=', 'coach.id')
            ->select('customer.email as cus_email', 'coach.first_name as coach_first_name', 'coach.last_name as coach_last_name', 'coach.email as coach_email', 'coach.mobile as coach_mobile', 'bookings.*')
            ->where('bookings.id', '=', $id)
            ->first();

        $court = DB::table('coach_courts')->where('id', '=', $request->court_id)->first();


        if (!empty($users)) {

            $data = array('start_time' => $request->start_time, 'status' => $users->payment_status, 'lesson_duration' => $request->lesson_duration, 'number_of_students' => $request->number_of_students, 'court' => $court->name, 'court_address' => $court->address, 'court_city' => $court->city, 'court_state' => $court->state, 'date' => $request->date, 'preferred_day' => $users->preferred_day, 'preferred_time' => $users->preferred_time, 'lesson_location_description' => $users->lesson_location_description, 'email' => $users->email, 'coach_email' => $users->coach_email, 'coach_mobile' => $users->coach_mobile, 'lessons' => $users->lessons, 'used_hours' => $remaining_credits, 'additional_players' => $users->additional_players, 'coach_first_name' => $users->coach_first_name, 'coach_last_name' => $users->coach_last_name,'create'=>'Created');



            \Mail::send('emails.createLesson', $data, function ($message) use($users) {
                $message->to($users->cus_email)->subject(' CrossXcourt: Your lesson has been scheduled');
            });
        }

        Session::flash('flash_message', Lang::get('usersMessage.lesson_created'));
        Session::flash('flash_type', 'alert-success');
        return redirect('/coaches/lessons');
    }

    /*
     * Mark completed
     */
    function getMarkCompleted($lesson_id) {


        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $lesson = Lesson::find($lesson_id);

        if ($lesson) {
            $lesson->update(array('status' => 'Completed'));
            Session::flash('flash_message', Lang::get('usersMessage.lesson_marked_successfull'));
            Session::flash('flash_type', 'alert-success');
        }
        return redirect()->back();
    }
    
    /*
     * Get Edit Lesson page 
     */
    function getEditLesson($lesson_id) {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $data = DB::table('lessons')
            ->join('bookings', 'lessons.customer_id', '=', 'bookings.customer_id')
            ->join('users', 'lessons.customer_id', '=', 'users.id')
            ->join('credits', 'lessons.customer_id', '=', 'credits.customer_id')
            ->select('lessons.date', 'lessons.start_time', 'lessons.lesson_duration', 'lessons.court_id', 'lessons.number_of_students', 'lessons.status', 'users.first_name', 'users.last_name', 'lessons.id', 'credits.remaining_credits', 'bookings.additional_players', 'lessons.customer_id')
            ->where('lessons.coach_id', Auth::user()->id)
            ->where('lessons.id', $lesson_id)->first();


        $courts = DB::table('coach_courts')
                        ->select('id', 'name', 'city', 'state', 'country')
                        ->where('coach_id', '=', Auth::user()->id)->get();

        $countries = DB::table('countries')
                        ->select('sortname', 'name')
                        ->orderBy('name')->get();

        if (is_null($lesson_id) || empty($data)) {
            return redirect()->back();
        }


        return view('coaches.edit_lesson')
                        ->with(compact('data', 'countries', 'courts'));
    }
    
    /*
     * Update Lesson page
     */
    function postUpdateLesson(Request $request) {

        $inputs = $request->all();
        //echo "<pre>";print_r($inputs); die;
        $rules = Lesson::$rules;

        unset($rules['member'], $inputs['member']);

        $validator = Validator::make($inputs, $rules, Lesson::messages());


        if ($validator->fails()) {
            return redirect()->back()->withInput($inputs)->withErrors($validator->errors());
        }

        // Validation for lesson_duration

        $remaining_hours =  ($request->hours_left - $request->used_lesson_duration) ;
        if ($request->lesson_duration > $request->hours_left) {

            return redirect()->back()->withErrors(['lesson_duration' => "Customer has only $remaining_hours credits hour left for this booking. "]);
        }

        
        if ($request->add_student == 0) {

            $additional_student = 1;
        } else {

            $additional_student = $request->add_student;
        }

         // Validation for date
        if ($request->date < date('m/d/Y')) {

            return redirect()->back()->withErrors(['date' => "You cannot create old date lesson."]);
        }
        
         // Validation for number_of_students
        if ($request->number_of_students > $additional_student) {

            return redirect()->back()->withErrors(['number_of_students' => "Customer has not pay for additional players."]);
        }


         $credits = Credit::where('customer_id', '=', $request->customer_id)
                ->where('coach_id', '=', Auth::User()->id)
                ->first();


          $remaining_credits = ($request->hours_left - $request->lesson_duration);  

        if (!empty($credits)) {
            $credits = DB::table('credits')
                ->where('coach_id', '=', Auth::User()->id)
                ->where('customer_id', '=', $request->customer_id)
                ->update(array('remaining_credits' => $remaining_credits));
        }



        $inputs['date'] = date('Y-m-d', strtotime($request->date));

        $lesson = Lesson::find($request->id);
        if ($lesson) {
            $lesson->update($inputs);
            Session::flash('flash_message', Lang::get('usersMessage.lesson_rescheduled_successfull'));
            Session::flash('flash_type', 'alert-success');
        }


        $users = DB::table('bookings')
                ->leftjoin('users as customer', 'bookings.customer_id', '=', 'customer.id')
                ->leftjoin('users as coach', 'bookings.coach_id', '=', 'coach.id')
                ->select('customer.email as cus_email', 'coach.first_name as coach_first_name', 'coach.last_name as coach_last_name', 'coach.email as coach_email', 'coach.mobile as coach_mobile', 'bookings.*')
                ->where('bookings.coach_id', '=', Auth::user()->id)
                ->first();


        $court = DB::table('lesson_courts')->where('id', '=', $request->court_id)->first();

        if (!empty($users)) {

            $data = array('start_time' => $request->start_time, 'status' => $users->payment_status, 'lesson_duration' => $request->lesson_duration, 'number_of_students' => $request->number_of_students, 'court' => $court->name, 'court_address' => $court->address, 'court_city' => $court->city, 'court_state' => $court->state, 'date' => $request->date, 'preferred_day' => $users->preferred_day, 'preferred_time' => $users->preferred_time, 'lesson_location_description' => $users->lesson_location_description, 'email' => $users->email, 'coach_email' => $users->coach_email, 'coach_mobile' => $users->coach_mobile, 'lessons' => $users->lessons, 'used_hours' => $remaining_credits, 'additional_players' => $users->additional_players, 'coach_first_name' => $users->coach_first_name, 'coach_last_name' => $users->coach_last_name,'create'=>'Rescheduled');

            \Mail::send('emails.createLesson', $data, function ($message) use($users) {
                $message->to($users->cus_email)->subject(' CrossXcourt: Your lesson has been rescheduled');
            });
        }

        Session::flash('flash_message', Lang::get('usersMessage.lesson_update_successfull'));
        Session::flash('flash_type', 'alert-success');
        return redirect('/coaches/lessons');
    }

    /*
    *  Student page functionatlity
    */
    function getClients(Request $request) {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }
        $query = DB::table('lessons')
                ->select('lessons.customer_id', 'credits.remaining_credits', 'us.first_name', 'us.last_name', 'us.email', 'us.mobile', DB::raw('((select count(id) from lessons where lessons.date > NOW() AND bookings.customer_id = lessons.customer_id AND lessons.status != "Cancelled")) as upcoming_lessons'))
                ->join('credits', 'lessons.customer_id', '=', 'credits.customer_id')
                ->join('bookings', 'lessons.customer_id', '=', 'bookings.customer_id')
                ->join('users as us', 'lessons.customer_id', '=', 'us.id')
                ->where('lessons.coach_id', '=', Auth::user()->id)
                ->where('lessons.status', '!=', 'Completed');



        if ($request->has('sort')) {

            if ($request->sort == 'credits-remaining') {
                $query->orderBy('credits.remaining_credits', 'DESC');
                //    echo "<pre>"; print_r($query); die;
            } else if ($request->sort == 'recent-lessons') {

                $id = Auth::user()->id;
                $ls = DB::select("select bookings.customer_id , lessons.date from bookings left join lessons on bookings.customer_id = lessons.customer_id where lessons.coach_id='$id' and lessons.status != 'Cancelled' AND lessons.date >= CURRENT_DATE group by lessons.customer_id order by lessons.date ASC LIMIT 0,20");
                //print_r($ls); die;

                if ($ls) {
                    foreach ($ls as $l) {
                        $ids[] = $l->customer_id;
                    }

                    $ids = implode(',', $ids);

                    $query->orderBy(DB::raw("FIELD(us.id,$ids)"));
                } else {
                    $query->orderBy('bookings.id', 'DESC');
                }
            }
            if ($request->sort == 'new-students') {
                $query->orderBy('bookings.id', 'DESC');
            }
        }
        if ($request->has('q')) {
            $string = $request->q;
            $query->where(function($q)use($string) {
                $q->orWhere('us.first_name', 'like', "$string")
                        ->orWhere('us.last_name', 'like', "$string")
                        ->orWhere('us.email', 'like', "%$string%");
            });
        } else {
            $query->orderBy('bookings.id', 'DESC');
        }

        $clients = $query->groupBy('us.id')->paginate(10);

        $data = DB::table('bookings')
                        ->where('coach_id', '=', Auth::user()->id)
                        ->select('id', 'customer_id')->groupBy('customer_id')->get();

        $credits = array();
        if ($data) {
            foreach ($data as $val) {
                $credits[$val->customer_id] = $val->id;
            }
        }



        return view('coaches.show_clients')->with(
                        compact('clients', 'credits', 'upcoming_lesssons'));
    }

    // ........ add court ...................
    function postAddCourt(Request $request) {

        $inputs = $request->all();
        $rules = array(
            'name' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        );

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            echo json_encode(array('type' => 'error',
                'errors' => $validator->errors()));
            exit;
        }

        $address = $request->address . ', ' . $request->country;
        $lat_log = \Helper::getLatLog($address);


        if (!$lat_log) {
            $address = $request->zip_code . ', ' . $request->country;

            $lat_log = \Helper::getLatLog($address);
        }

        unset($inputs['_token']);
        $inputs['coach_id'] = Auth::user()->id;
        $inputs['latitude'] = $lat_log['lat'];
        $inputs['longitude'] = $lat_log['lng'];

        $id = DB::table('coach_courts')->insertGetId($inputs);
        //  print_r($id); die;
        $ids = DB::table('lesson_courts')->insertGetId($inputs);
        //print_r($ids); die;

        $name = $request->name . ', ' . $request->city . ', ' . $request->state . ', ' . $request->country;

        echo json_encode(
                array(
                    'type' => 'success', 'name' => $name, 'id' => $id
                )
        );

        exit;
    }

    //...............Payment Information ..........................
    function getPaymentInformation() {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $payment_information = DB::table('coach_payment_details')
                ->select('email', 'address', 'city', 'state', 'postalcode', 'ssn'
                        , 'route_num', 'account_num')
                ->where('coach_id', Auth::user()->id)
                ->first();

        return view('coaches.payment-information')->with(compact('payment_information'));
    }

    //...............Payment Information..........................
    function postPaymentInfo(Request $request) {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $inputs = $request->all();
        $rules = array(
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postalcode' => 'required',
            'ssn' => 'required',
            'route_num' => 'required',
            'account_num' => 'required',
        );

        $validator = Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput($inputs)->withErrors($validator->errors());
        }

        $user_exist = DB::table('coach_payment_details')
                ->select('email')
                ->where('coach_id', Auth::user()->id)
                ->count();


        unset($inputs['_token']);

        if ($user_exist > 0) {
            $inputs['updated_at'] = date('Y-m-d h:i:s');
            DB::table('coach_payment_details')
                    ->where('coach_id', Auth::user()->id)->update($inputs);

            Session::flash('flash_message', Lang::get('usersMessage.payment_update'));
            Session::flash('flash_type', 'alert-success');
        } else {
            $inputs['coach_id'] = Auth::user()->id;
            $inputs['created_at'] = date('Y-m-d h:i:s');

            DB::table('coach_payment_details')->insert($inputs);

            Session::flash('flash_message', 'Payment information has been added successfully.');
            Session::flash('flash_type', 'alert-success');
        }

        return redirect('coaches/payment-information');
    }

    /*
    *Save Coach Lesson .   Lesson creaed by coach
    */
    function postCoachlesson(Request $request) {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $get_customer = DB::table('bookings')
                ->where('coach_id', '=', Auth::user()->id)
                ->where('customer_id', '=', $request->member)
                ->first();



        if (!empty($get_customer)) {

            $packages = CoachPackage::with('package')->whereCoachId(Auth::user()->id)->first();

            $inputs = $request->all();
            $inputs['total'] = $inputs['lesson_duration'] * $packages->rate;
            $inputs['rate'] = $packages->rate;
            //echo"<pre>"; print_r($inputs) ; die;       

            $validator = Validator::make($inputs, Lesson::$rules, Lesson::messages());

            if ($validator->fails()) {
                return redirect()->back()->withInput($inputs)->withErrors($validator->errors());
            }

            $inputs['date'] = date('Y-m-d', strtotime($request->date));
            $inputs['status'] = 'Pending';


            $created_at = date("Y-m-d H:i:s");
            DB::table('bookings')->insert([
                'customer_id' => $request->member,
                'coach_id' => \Auth::user()->id,
                'additional_players' => $request->number_of_students,
                'lessons' => $request->lesson_duration,
                'payment_status' => 'Unpaid',
                'rate' => $packages->rate,
                'total' => $request->lesson_duration * $packages->rate,
                'created_at' => $created_at
            ]);
            $getid = DB::getPdo()->lastInsertId();



            $users = DB::table('bookings')
                    ->leftjoin('users as customer', 'bookings.customer_id', '=', 'customer.id')
                    ->leftjoin('users as coach', 'bookings.coach_id', '=', 'coach.id')
                    ->select('customer.email as cus_email', 'coach.first_name as coach_first_name', 'coach.last_name as coach_last_name', 'coach.email as coach_email', 'coach.mobile as coach_mobile', 'bookings.*')
                    ->where('bookings.id', '=', $getid)
                    ->first();




            $lesson = new Lesson;
            $input['password'] = bcrypt($request->password);
            $inputs['booking_id'] = $getid;
            $inputs['pending_payment'] = $inputs['lesson_duration'];
            $lesson::create($inputs);


            $court = DB::table('coach_courts')->where('id', '=', $request->court_id)->first();
            $courts = DB::table('lesson_courts')->where('id', '=', $request->court_id)->first();



            if (!empty($users)) {

                $data = array('start_time' => $request->start_time, 'status' => $users->payment_status, 'lesson_duration' => $request->lesson_duration, 'number_of_students' => $request->number_of_students, 'court' => $court->name, 'court_address' => $court->address, 'court_city' => $court->city, 'court_state' => $court->state, 'date' => $request->date, 'preferred_day' => $users->preferred_day, 'preferred_time' => $users->preferred_time, 'lesson_location_description' => $users->lesson_location_description, 'email' => $users->email, 'coach_email' => $users->coach_email, 'coach_mobile' => $users->coach_mobile, 'lessons' => $users->lessons, 'additional_players' => $users->additional_players, 'coach_first_name' => $users->coach_first_name, 'coach_last_name' => $users->coach_last_name);



                \Mail::send('emails.createLesson', $data, function ($message) use($users) {
                    $message->to($users->cus_email)->subject(' CrossXcourt: Your lesson has been scheduled');
                });
            }

            Session::flash('flash_message', Lang::get('usersMessage.lesson_created'));
            Session::flash('flash_type', 'alert-success');
            return redirect('/coaches/lessons');
        } else {
            Session::flash('flash_message', Lang::get('usersMessage.faied_to_create_member'));
            Session::flash('flash_type', 'alert-danger');
            return redirect()->back();
        }
    }

    /*
    * Delete Court functionality
    */
    public function getDeletecourt($id) {


        if ($id) {
            $courts = DB::table('coach_courts')->where('id', '=', $id)->delete();

            Session::flash('flash_message', Lang::get('usersMessage.del_success'));
            Session::flash('flash_type', 'alert-success');
        }
        return redirect()->back();
    }

    public function getPendingReview() {

        return view('coaches.pendingreview');
    }

    public function getCourts() {

        if (!Auth::user()->hasRole('Coach')) {
            return response()->view('errors.401');
        }

        $id = Auth::user()->id;

        $coach = User::with(array('Info'))
                        ->whereId($id)->first();


        $courts = DB::table('coach_courts')->where('coach_id', '=', $id)->orderBy('id', 'DESC')->get();

        $countries = \Cache::remember('countries', 43200, function() {
                    return DB::table('countries')
                                    ->select('sortname', 'name')
                                    ->orderBy('name')->get();
                });

        return view('coaches.courts')->with(compact('coach', 'courts', 'countries'));
    }

    function postStoreCourt(Request $request) {

        $inputs = $request->all();

        $rules = array(
            'name' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required'
        );

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            echo json_encode(array('type' => 'error',
                'errors' => $validator->errors()));
            exit;
        }

        if ($request->has('latlng')) {
            $lat_log = explode(',', $request->latlng);
            $latitude = $lat_log[0];
            $longitude = $lat_log[1];
        } else {
            $address = $request->address . ', ' . $request->country;
            $lat_log = \Helper::getLatLog($address);

            if (!$lat_log) {
                $address = $request->zip_code . ', ' . $request->country;
                $lat_log = \Helper::getLatLog($address);
                $latitude = $lat_log['lat'];
                $longitude = $lat_log['lng'];
            }
        }
        unset($inputs['_token'], $inputs['latlng']);

        $inputs['coach_id'] = Auth::user()->id;
        $inputs['latitude'] = $latitude;
        $inputs['longitude'] = $longitude;

        $id = DB::table('coach_courts')->insertGetId($inputs);
        $ids = DB::table('lesson_courts')->insertGetId($inputs);

        $name = ucfirst($request->name);
        $city = $request->city;
        $address = $request->address;
        $state = $request->state;
        $country = $request->country;
        $zip_code = $request->zip_code;

        echo json_encode(
                array(
                    'type' => 'success',
                    'name' => $name,
                    'id' => $id,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'address' => $address,
                    'zip' => $zip_code
                )
        );

        exit;
    }

    /*
    * Cancel Lesson functionatlity
    */
    public function getDeletelesson(Request $request, $id) {

        $lesson = Lesson::find($id);
        if (empty($lesson)) {
            return redirect()->back();
        }

        Lesson::where('id', $id)->update(array('status' => 'Cancelled'));

        $user = Credit::where('customer_id', $lesson->customer_id)
                ->where('coach_id', $lesson->coach_id)
                ->first();

        $total = $user->remaining_credits + $lesson->lesson_duration;

        Credit::where('customer_id', $lesson->customer_id)
                ->where('coach_id', $lesson->coach_id)
                ->update(array('remaining_credits' => $total));


        $users = DB::table('lessons')
                // ->join('bookings', 'lessons.booking_id', '=', 'bookings.id')
                ->join('users as customer', 'lessons.customer_id', '=', 'customer.id')
                ->join('users as coach', 'lessons.coach_id', '=', 'coach.id')
                ->join('lesson_courts', 'lessons.court_id', '=', 'lesson_courts.id')
                ->select('lessons.date', 'lessons.start_time', 'customer.first_name as customer_first_name', 'customer.email as customer_email', 'coach.first_name as coach_first_name', 'coach.last_name as coach_last_name', 'lesson_courts.name', 'lesson_courts.zip_code', 'lesson_courts.address', 'lesson_courts.city')
                ->where('lessons.id', '=', $id)
                ->first();


        if (!empty($users)) {

            $data = array('date' => $users->date, 'start_time' => $users->start_time, 'customer_first_name' => $users->customer_first_name, 'coach_first_name' => $users->coach_first_name, 'coach_last_name' => $users->coach_last_name, 'name' => $users->name, 'zip_code' => $users->zip_code, 'address' => $users->address, 'city' => $users->city);


            \Mail::send('emails.cancelLesson', $data, function ($message) use($users) {

                $message->to($users->customer_email)->subject(' crossXcourt: confirmation of cancellation
                                                    ');
            });
        }

        Session::flash('flash_message', 'Lesson has been Cancelled successfully.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();
    }

    function getLatLng(Request $request) {

        $string = '';
        if ($request->zip_code) {
            $string .= $request->zip_code . ', ';
        }

        if ($request->state) {
            $string .= $request->state . ', ';
        }
        if ($request->country) {
            $string .= $request->country . ', ';
        }

        $address = rtrim($string, ',');

        $lat_log = \Helper::getLatLog($address);
        echo json_encode($lat_log);

        exit;
    }

}
