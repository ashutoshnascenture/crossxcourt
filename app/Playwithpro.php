<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Playwithpro extends Model {

	 

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'playwithpros';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','nationality','profile_image','age','highest_career_ranking','link','playing_style','turned_pro'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	 
	
	public static $rules = array(
		'name'=>'required',
		'nationality'=>'required',
		'age'  => 'required',      
		'highest_career_ranking' => 'required',
		'playing_style' => 'required',
		'turned_pro' => 'required',
		
		 
    );
    
	
	
}

