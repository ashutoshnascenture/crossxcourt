<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Credit extends Model {
 
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'credits';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['customer_id', 'coach_id', 'remaining_credits'];

	/**
		* The attributes excluded from the model's JSON form.
		*
		* @var array
	*/
	 
	 
	 
}

