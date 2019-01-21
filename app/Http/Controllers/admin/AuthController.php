<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
     
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		//$this->registrar = $registrar;

		$this->middleware('guest', ['except' => ['Logout','getLogin']]);
	}
	

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
	public function getLogin()
	{ 	 
		if(\Auth::user() && \Auth::user()->role_id == 1){
			return redirect('admin/home');		
		}
		
		return view('admin.auth.login');
	}

  /**
   * Handle a login request.
   *
   * @param  Request  $request
   * @return Response
   */
	public function dologin(Request $request){ 
		
		$this->validate($request, [
		  'email' => 'required|email', 'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');
		$credentials['role_id'] = 1;
		
		if (\Auth::attempt($credentials, $request->has('remember'))) {
		  return redirect()->intended('admin/home');
		}

		return redirect('admin/')
			->withInput($request->only('email', 'remember'))
			->withErrors([
			  'email' => 'Invalid credentials.',
			]);
	}

	  /**
	   * Log the user out of the application.
	   *
	   * @return Response
	   */
	public function Logout()
	{	  
		$this->auth->logout();
		\Session::flush();
		return redirect('/auth/login');
	}
	
}
