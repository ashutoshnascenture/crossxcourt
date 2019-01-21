<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   public $timestamps = false;
 
   protected $table = 'messages';
   
   protected $fillable =['message','from','to','to_email','created_at','updated_at','parent_id','read_admin','read_coach','read_customer'];
   
   public static $rules = array(
	   'message'  => 'required',
	   'to'  => 'required',
	);
}
