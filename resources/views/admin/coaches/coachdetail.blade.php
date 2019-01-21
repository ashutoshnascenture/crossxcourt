@extends('admin')

@section('content')
<div class="content-wrapper">
    
                <section class="content-header"><?php echo Lang::get('coachProfile.coach_profile'); ?></section>
			<section class="content">     
				<div class="inner-content">
               
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                     
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('admin/coaches/coachdetail')}}/{{$id}}" name ="myform" onSubmit="document.getElementById('submit').disabled=true;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
 
                        
<!--
                        <div class="form-group">
                            <label class="col-md-3">Coach type</label>
                            <div class="col-md-9">
                                <select class="form-control" id="" name="coach">
									<option value="">---Please select coach type---</option>
                                    <option value="coach">Coach</option>
                                    <option value="featured_coach">Featured Coach</option>             
                                </select>
                            </div>
                        </div>      
-->
                        
                        <div class="form-group">
                            <label class="col-md-3"><?php echo Lang::get('coachProfile.profile_image'); ?></label>
                            <div class="col-md-8 browse">
                                <input type="file" class="form-control" name="profile_image" value="">
                            </div>
                        </div>
                        
                        
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="nation"><?php echo Lang::get('coachProfile.nationality'); ?> </label>
                            <div class="col-md-8">
                             <input type="text" class="form-control" name="nationality" value="{{old('nationality')}}" id="nation">
                            
                               
                            </div>
                        </div>
                        
                         <div class="form-group required">
                            <label class="col-md-3 control-label" for="tennis"><?php echo Lang::get('coachProfile.tennis_qualification'); ?> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="tennis_qualification" value="{{old('tennis_qualification')}}" id="tennis">
                            </div>
                        </div>
                            
                            
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="tennis_experience"><?php echo Lang::get('coachProfile.tennis_experience'); ?> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="tennis_experience" id="tennis_experience" value="{{ old('tennis_experience') }}" i>
                                <em><?php echo Lang::get('coachProfile.example_tennis_experience'); ?></em><br>
								<span id="errmsg" style="color:red;"></span>
                            </div>
                        </div>
                            
                            
                         <div class="form-group required">
                            <label class="col-md-3 control-label" for="lang"><?php echo Lang::get('coachProfile.languages'); ?> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="languages" value="{{ old('languages') }}" id="lang">
                            </div>
                        </div>
                             
                            

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo Lang::get('coachProfile.teaching_level'); ?></label>
                            <div class="col-md-8">
                                 
                                  
                               <div class="checkbox">
                                     <label><input type="checkbox" name="teaching_level[]" value="Young_beginner"><?php echo Lang::get('coachProfile.young_beginner'); ?></label>
                                </div>
                                 <div class="checkbox">
                                     <label><input type="checkbox" name="teaching_level[]" value="Intermediate"><?php echo Lang::get('coachProfile.intermediate'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label> <input type="checkbox" name="teaching_level[]" value="Advanced"><?php echo Lang::get('coachProfile.advance'); ?> </label>
                                </div>
                                
                                <div class="checkbox">
                                    <label> <input type="checkbox" name="teaching_level[]" value="Professional"><?php echo Lang::get('coachProfile.professional'); ?> </label>
                                </div>
                                
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teaching_level[]" value="All_levels"><?php echo Lang::get('coachProfile.all_level'); ?></label>
                                </div>
                                 <div class="col-md-8">
									<em><?php echo Lang::get('coachProfile.example_teaching_level'); ?></em>
                                 </div>
                            </div>
                        </div>
                            
                            
                            
                        <div class="form-group">
                            <label class="col-md-3"><?php echo Lang::get('coachProfile.teach_age_player'); ?></label>
                            <div class="col-md-8">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teach_age_player[]"  value="Young_children"><?php echo Lang::get('coachProfile.young_children'); ?></label>
                                </div>
                                <div class="checkbox">
                                   <label><input type="checkbox" name="teach_age_player[]" value="Juniors"><?php echo Lang::get('coachProfile.juniors'); ?></label>
                               </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teach_age_player[]" value="Adults"><?php echo Lang::get('coachProfile.adults'); ?></label>
                                </div>
                                <div class="checkbox">
                                   <label><input type="checkbox" name="teach_age_player[]" value="All_ages"><?php echo Lang::get('coachProfile.all_ages'); ?></label>
                               </div>   
                               <div class="col-md-9">
									<em><?php echo Lang::get('coachProfile.example_teach_age_player'); ?></em>
                                 </div>
                            </div>
                        </div>   
                        
                        
                        
                        
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="comment"><?php echo Lang::get('coachProfile.motto'); ?> </label>
                            <div class="col-md-8">
                                
                                 <textarea class="form-control" rows="5" id="comment" name="motto"  >{{old('motto')}} </textarea>
                            </div>
                        </div>    
                        
                        
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="player"><?php echo Lang::get('coachProfile.favourite_player'); ?> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="favourite_player" value="{{old('favourite_player')}}" id="player">
                            </div>
                        </div>
                            
                        
                        
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="comment1"><?php echo Lang::get('coachProfile.coaching_style'); ?> </label>
                            <div class="col-md-8">
                                 
                                <textarea class="form-control" rows="5" id="comment1" name="coaching_style"  >{{old('coaching_style')}}</textarea>
                                <em><?php echo Lang::get('coachProfile.example_coaching_style'); ?></em>
                            </div>
                        </div>
                            
                            
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="comment2"><?php echo Lang::get('coachProfile.playing_abliltiy'); ?></label>
                            <div class="col-md-8">
                                 
                                <textarea class="form-control" rows="5" id="comment2" name="playing_abliltiy" value="">{{old('playing_abliltiy')}}</textarea>
                                <em><?php echo Lang::get('coachProfile.example_playing_abliltiy'); ?></em>
                            </div>
                        </div>
                        
                        
                        <div class="form-group required ">
                            <label class="col-md-3 control-label" for="about"><?php echo Lang::get('coachProfile.about_me'); ?> </label>
                            <div class="col-md-8">
                               <textarea class="form-control" rows="5" name="about_me" id="about"onkeyup="countChar(this)">{{old('about_me')}}</textarea>
                               <div id="charNum" style="color:red;"></div>
                              <em><?php echo Lang::get('coachProfile.about_us_text'); ?></em>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-3"><?php echo Lang::get('coachProfile.court_details'); ?></label>
                            <div class="col-md-9">
                               <textarea class="form-control" rows="5" name="court_details"value="">{{ old('court_details') }}</textarea>
                            </div>
                        </div>
								
                                                                      

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">
                                  <?php echo Lang::get('coachProfile.save'); ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
			</section>
</div>



<script>
	$(":submit").closest("form").submit(function(){
		$(':submit').attr('disabled', 'disabled');
	});
   
   
   
    function countChar(val) {
        var len = val.value.length;
        
        if (len > 2000) {
            val.value = val.value.substring(0, 2000);
       
        } else {
            
            if (len < 50) {
                $('#charNum').text(50 - len);

            } else {

                $('#charNum').text(len);
            }

        }
    }
    ;
    
    
    $(document).ready(function () {
	   
		$("#tennis_experience").keypress(function (e) {
		 
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				 
				$("#errmsg").html("Please enter only numbers").show();
					   return false;
			}
		});
	}); 
	
</script>
@endsection


 




 













