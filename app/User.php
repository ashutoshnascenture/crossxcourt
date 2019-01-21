<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name','last_name','email','password','mobile','address','post_code','city','state','country','role_id','latitude','longitude'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];
	
	public static $rules = array(
	
        'first_name'  => 'required',                     
        'last_name'   => 'required',                     
        'email'       => 'required|email|unique:users',      
        'password'    => 'required',
        'password_confirmation' => 'required|same:password',
        'address'=> 'required',
        'post_code'=> 'required',
        'country'=> 'required',
        'state'=> 'required',
			'city'=> 'required',
    );
	
	function Info(){
		return $this->hasOne('App\Coachdetail','user_id');	
	}
	
	function CoachSchedules(){
		return $this->hasMany('App\CoachSchedule','coach_id');	
	}
	
	public function role()
    {
        return $this->belongsTo('App\Role');
    }
	
	
	public function hasRole($roleName)
    {	
		 
		if ($this->role()->first()->title == $roleName)
		{
			return true;
		}
        return false;
    }

    /*
    *Always trim the last name when we save it to the database 
    */

    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = trim($value);
    }

     
    public function setLastNameAttribute($value) {
        $this->attributes['last_name'] = trim($value);
    }
	
}
