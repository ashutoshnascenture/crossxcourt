<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachPackage extends Model {

	 

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'coach_packages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['lessons','description'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	 
	
	public static $rules = array( 'lessons' => 'required');
    
    function package(){
		return $this->belongsTo('App\Package');	
	} 
	
}

