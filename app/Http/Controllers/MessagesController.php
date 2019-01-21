<?php namespace App\Http\Controllers;
 
 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use Validator;
 use App\Message;
 use App\Messagedetail;
 use DB;
 use Session;
 use Auth;
 use Lang;
 Use App\User;
 
class MessagesController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->middleware('auth', ['except' => ['message_coach']]);

        if ($request->has('cur')) {
            \Helper::setCurrency($request->cur);
        }
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        $to = Auth::user()->id;

        $messages = DB::table('messages')
                ->Select('messages.id as message_id', 'messages.*', 'to.first_name as to_first_name', 'from.first_name as from_first_name')
                ->join('users as from', 'messages.from', '=', 'from.id')
                ->join('users as to', 'messages.to', '=', 'to.id')
                ->where('messages.to', '=', $to)
                ->orWhere('messages.from', '=', $to)
                ->orderBy('messages.created_at', 'DESC')
                ->paginate(15);
        return view('messages.index')->with('messages', $messages);
    }

    public function outbox() {
        $from = Auth::user()->id;

        $messages = DB::table('messages')
                ->Select('messages.id as message_id', 'messages.*', 'users.first_name as to_first_name')
                ->join('users', 'messages.to', '=', 'users.id')
                ->where('from', '=', $from)
                ->orderBy('messages.id', 'DESC')
                ->paginate(15);

		//echo "<pre>"; print_r($messages); die;
         //return view('messages.outbox')->with('messages', $messages);
        return view('messages.index')->with('messages', $messages);
    }

    public function reply_message($id) {
        if (Auth::user()->role_id == '2') {
            $update = Message::find($id);
            if ($update) {
                $update->read_coach = '0';
                $update->save();
            }
        } else if (Auth::user()->role_id == '3') {
            $update = Message::find($id);
            if ($update) {
                $update->read_customer = '0';
                $update->save();
            }
        }

        $messages = DB::table('messages')->where('id', '=', $id)->first();

        $messages_detail = DB::table('message_detail')
                ->join('users', 'message_detail.user_id', '=', 'users.id')
                ->where('message_detail.message_id', '=', $id)->orderBy('message_detail.id', 'DESC')
                ->select('users.first_name', 'users.last_name', 'message_detail.*')
                ->get();

        $data = array(
            'messages' => $messages,
            'messages_detail' => $messages_detail,
        );

        return view('messages.reply_message')->with('data', $data);
    }

    public function postReply_message(Request $request) {
        $field_name = '';

        $role_id_to = DB::table('users')
                ->select('users.role_id')
                ->join('messages', 'messages.to', '=', 'users.id')
                ->where('messages.id', '=', $request->message_id)
                ->first();

        $role_id_from = DB::table('users')
                ->select('users.role_id')
                ->join('messages', 'messages.from', '=', 'users.id')
                ->where('messages.id', '=', $request->message_id)
                ->first();

        if ($role_id_to->role_id == 1 || $role_id_from->role_id == 1)
            $field_name = 'read_admin';
        else {
            if (Auth::user()->role_id == '2') {
                $field_name = 'read_customer';
            } else if (Auth::user()->role_id == '3') {
                $field_name = 'read_coach';
            }
        }

        $update = Message::find($request->message_id);
        if ($update) {
            $update->$field_name = '1';
            $update->reply = '1';
            $update->save();
        }

        $input = $request->all();

        $date = date('Y-m-d H:i:s');
        $input['created_at'] = $date;
        $input['user_id'] = Auth::user()->id;


        $query = Message::find($request->message_id);

        $user = DB::table('users')->where('id', '=', $query->from)->first();
        $user->email;

        $validator = Validator::make($request->all(), Messagedetail::$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        } else {
            //echo "<pre>" ; print_r($input); die; 
            $save = Messagedetail::create($input);


            $Message_update = Message::where("id", '=', $request->message_id)->update(array('message' => $request->message_reply));

            if ($save) {

                $data = array(
                    'body' => $request->message_reply,
                    'date' => $date
                );


                \Mail::send('emails.message', $data, function ($message) use($user) {
                    $message->to($user->email)->subject(' Message Notification');
                });


                return redirect('reply_message/' . $request->message_id)->with('message', Lang::get('usersMessage.sent_message'));
            } else {
                Session::flash('flash_message', Lang::get('usersMessage.failed_message'));
                Session::flash('flash_type', 'alert-danger');
                return redirect()->back()->withInput($input);
            }
        }
    }

    public function add(Request $request) {

        $customers = array();
        $customers_admin = array();
        $customers_admin = DB::table('users')
                ->select('users.first_name', 'users.id')
                ->where('users.role_id', '=', 1)
                ->get();

        if (Auth::user()->role_id == '2') {
            $customers = DB::table('users')
                    ->select('users.first_name', 'users.id')
                    ->join('bookings as b', 'b.customer_id', '=', 'users.id')
                    ->where('b.coach_id', '=', Auth::user()->id)
                    ->orderBy('users.first_name')
                    ->groupBy('b.coach_id')
                    ->get();
        } elseif (Auth::user()->role_id == '3') {
            $customers = DB::table('users')
                            ->select('users.first_name', 'users.id')
                            ->join('coach as c', 'c.user_id', '=', 'users.id')
                            ->where('c.is_active', '=', '1')
                            ->where('users.role_id', '=', '2')
                            ->orderBy('users.first_name')->get();
        }

        $to = null;
        if ($request->has('c')) {
            $to = $request->c;
        }

        return View('messages.add')->with(
                        compact('customers', 'customers_admin', 'to')
        );
    }

    public function send_message(Request $request) {
        $read_coach = 0;
        $read_customer = 0;
        $read_admin = 0;

        $role_id = DB::table('users')
                ->select('users.role_id')
                ->where('users.id', '=', $request->to)
                ->first();

        if ($role_id->role_id == 1)
            $read_admin = 1;
        else {
            if (Auth::user()->role_id == '2')
                $read_customer = 1;
            elseif (Auth::user()->role_id == '3')
                $read_coach = 1;
        }

        $input = $request->all();

        $input['read_coach'] = $read_coach;
        $input['read_customer'] = $read_customer;
        $input['read_admin'] = $read_admin;
        $date = date('Y-m-d H:i:s');
        $input['created_at'] = $date;
        $input['from'] = Auth::user()->id;
        $input['email'] = Auth::user()->email;

        //echo "<pre>";	print_r($input); die; 
        $user = DB::table('users')->where('id', '=', $request->to)->first();

        $input['to_email'] = $user->email;

        $validator = Validator::make($request->all(), Message::$rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput($input)->withErrors($validator->errors());
        } else {
            $save = Message::create($input);
            $getid = DB::getPdo()->lastInsertId();
            DB::table('message_detail')->insert([
                ['user_id' => Auth::user()->id, 'message_reply' => $request->message, 'created_at' => $date, 'message_id' => $getid]]);


            if ($save) {

                $data = array(
                    'body' => $request->message,
                    'date' => $date
                );


                \Mail::send('emails.message', $data, function ($message) use($user) {
                    $message->to($user->email)->subject(' Message Notification');
                });

                \Mail::send('emails.message', $data, function ($message) use($user) {
                    $message->to(Auth::user()->email)->subject(' Message Notification');
                });

                Session::flash('flash_message', Lang::get('usersMessage.sent_message'));
                Session::flash('flash_type', 'alert-success');
                return redirect('/messages');
            } else {
                Session::flash('flash_message', Lang::get('usersMessage.failed_message'));
                Session::flash('flash_type', 'alert-danger');
                return redirect()->back()->withInput($input);
            }
        }
    }

    public function edit($message_id) {
        $message = DB::table('messages')->where('id', $message_id)->first();
        return View('messages.edit')->with('message', $message);
    }

    public function edit_post(Request $request) {
        $input = $request->all();
        $date = date('Y-m-d H:i:s');
        $input['updated_at'] = $date;

        $user = Message::find($input['id']);
        $user->update($input);
        return redirect('outbox/')->with('message', 'Your message has been updated');
    }

    function message_coach($coach, $id) {

        $coach = User::find($id);

        if (!$coach) {
            return redirect()->back();
        }

        return view('messages.message_coach')->with(compact('coach'));
    }

    public function show($id) {

        $message = Message::where('id', '=', $id)->first();

        return view('messages.show')->with('message', $message);
    }

    public function delete($id) {

        if (!empty($id)) {
            $message = Message::where('id', '=', $id)->delete();
        }

        return redirect('outbox')->with('message', 'Message has been deleted successfully.');
    }

}
