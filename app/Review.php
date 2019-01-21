<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	public $timestamps = false;
   
	protected $table = 'coach_reviews';
	
	protected $fillable = ['review','rating','lesson_id','created_at'];
   
	public static $rules = array(
		'review'  => 'required',
		'rating'  => 'required',
	);
}



