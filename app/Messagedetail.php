<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Messagedetail extends Model
{
   public $timestamps = false;
 
   protected $table = 'message_detail';
   
   protected $fillable =['message_reply','user_id','created_at','message_id'];
   
   public static $rules = array(
		'message_reply'  => 'required',
   );
}
