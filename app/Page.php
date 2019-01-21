<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	 

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('title', 'slug','content','created_at','updated_at');
	
	public static $rules = array(
	
			'title'  => 'required',
			'slug'   => 'required',
			'content'    => 'required',
	);
	
	 
}

