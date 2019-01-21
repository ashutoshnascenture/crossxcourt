<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Lang;
 
class Lesson extends Model {
 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lessons';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['customer_id','coach_id','date','start_time','lesson_duration','court_id','number_of_students','status'];

	/**
		* The attributes excluded from the model's JSON form.
		*
		* @var array
	*/
	public static $rules = array( 
		'member'             => 'required',
		'date'               => 'required',
		'start_time'         => 'required',
		'lesson_duration'    => 'required',
		'court_id'           => 'required',
		'number_of_students' => 'required'
		 
		
	);
	
	 
	public static function messages(){
		return [
			'date.required' =>   Lang::get('validation.date'),
			'court_id.required' => Lang::get('validation.court_id'),
			'number_of_students.required' => Lang::get('validation.number_of_students'),
			'lesson_duration.required' => Lang::get('validation.lesson_duration'),
			'start_time.required'  => Lang::get('validation.start_time')
		];
	}
	 
	 
}

