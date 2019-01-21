<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Coachdetail extends Model {

	 

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'coach';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id','profile_image','tennis_qualification','tennis_experience','languages','teaching_level','teach_age_player','motto','favourite_player','coaching_style','playing_abliltiy','about_me','is_active','service_area','nationality','court_details','paypal_email'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	 
	
	public static $rules = array(
		'nationality'=>'required',
        'tennis_qualification'  => 'required',
        'tennis_experience'  => 'required|numeric',
        'languages' =>  'required',
        'motto'  => 'required',
        'favourite_player'  => 'required',
        'coaching_style'  => 'required',
		'about_me' => 'required|min:50',
	 
		 
    );
    
    function members(){

		return $this->hasMany('App\User');
	}
	
	
	public function setNationalityAttribute($value) {
        $this->attributes['nationality'] = trim($value);
    }
    
    public function setTennisQualificationAttribute($value) {
        $this->attributes['tennis_qualification'] = trim($value);
    }
	
	//~ public function setTennisExperienceAttribute($value) {
        //~ $this->attributes['tennis_experience'] = trim($value);
    //~ }
	
	
	public function setLanguagesAttribute($value) {
        $this->attributes['languages'] = trim($value);
    }
    
    public function setMottoAttribute($value) {
        $this->attributes['motto'] = trim($value);
    }
    
    public function setFavouritePlayerAttribute($value) {
        $this->attributes['favourite_player'] = trim($value);
    }
    
    public function setCoachingStyleAttribute($value) {
        $this->attributes['coaching_style'] = trim($value);
    }
    
    
	
	
}

