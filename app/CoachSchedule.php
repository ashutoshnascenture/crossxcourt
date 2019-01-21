<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachSchedule extends Model {
 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'coach_schedules';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['coach_id','day','time'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	  
	public static $rules = array(
		'coach_id' => 'required',
		'day' => 'required',
		'time' => 'required'
	);
     
	
}

