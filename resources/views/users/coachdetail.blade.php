 @extends('app')
@section('content')

<div class="container-fluid">
    <div class="row">
       
        @include('includes.step_sidebar')
		
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 right-content-form-section profile-content">
            <div>
                <h2 class="student-title"><?php echo Lang::get('coachProfile.heading'); ?></h2>
                <hr>
               <p style="padding-left:12px"><?php echo Lang::get('coachProfile.coach_profile'); ?></p>
                        
				 <div class="col-md-9 form-container">
                    <div class="panel-body">

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong><?php echo Lang::get('coachProfile.Whoops'); ?>!</strong><?php echo Lang::get('coachProfile.alert_msg'); ?><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/users/coachdetail')}}" onSubmit="document.getElementById('submit').disabled=true;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                             
                            <label><?php echo Lang::get('coachProfile.profile_image'); ?></label>
                            <div class="upload-box">
                                <div class="browse my-browes">
                                    <div class="upload-btn"> Upload Image </div>
                                    <input type="file" id="profile_image" name="profile_image" class="form-control">
                                </div>
                            </div>
                            <div class="clr"></div>
                            <div class="form-group required label-text-area margin-top-2">
                                <label for="nation"><?php echo Lang::get('coachProfile.nationality'); ?></label>
                                <div>
                                    <input type="text" class="form-control" name="nationality" value="{{ old('nationality') }}" id="nation">
                                </div>
                            </div>

                            <div class="form-group required label-text-area">
                                <label for="tennis"><?php echo Lang::get('coachProfile.tennis_qualification'); ?></label>
                                <div>
                                    <input type="text" class="form-control" name="tennis_qualification" value="{{ old('tennis_qualification') }}" id="tennis">
                                </div>
                            </div>


                            <div class="form-group required label-text-area">
                                <label for="experience"><?php echo Lang::get('coachProfile.tennis_experience'); ?></label>
                                <div>
                                    <input type="text" class="form-control" name="tennis_experience" value="{{ old('tennis_experience') }}" id="tennis_experience">
                                    <em><?php echo Lang::get('coachProfile.example_tennis_experience'); ?></em><br>
                                    <span id="errmsg" style="color:red;"></span>
                                </div>

                            </div>


                            <div class="form-group required label-text-area">
                                <label for="languages"><?php echo Lang::get('coachProfile.languages'); ?></label>
                                <div>
                                    <input type="text" class="form-control" name="languages" value="{{ old('languages') }}" id="languages">
                                </div>
                            </div>


                            <div class="form-group  label-text-area teaching-level">
                                <label><?php echo Lang::get('coachProfile.teaching_level'); ?></label>
                                 
                                <?php $teaching_levels = (old('teaching_level') ) ? : array() ;
									//print_r($teaching_levels);  
                                 ?> 
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teaching_level[]" value="Young_beginner"  @if(in_array('Young_beginner', $teaching_levels)) checked @endif><?php echo Lang::get('coachProfile.young_beginner'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teaching_level[]" value="Intermediate" @if(in_array('Intermediate', $teaching_levels)) checked @endif><?php echo Lang::get('coachProfile.intermediate'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label> <input type="checkbox" name="teaching_level[]" value="Advanced" @if(in_array('Advanced', $teaching_levels)) checked @endif><?php echo Lang::get('coachProfile.advance'); ?> </label>
                                </div>

                                <div class="checkbox">
                                    <label><input type="checkbox" name="teaching_level[]" value="Professional" @if(in_array('Professional', $teaching_levels)) checked @endif><?php echo Lang::get('coachProfile.professional'); ?> </label>
                                </div>

                                <div class="checkbox">
                                    <label><input type="checkbox" name="teaching_level[]" value="All_level" @if(in_array('All_level', $teaching_levels)) checked @endif><?php echo Lang::get('coachProfile.all_level'); ?></label>
                                </div>
                                <em><?php echo Lang::get('coachProfile.example_teaching_level'); ?></em>
                            </div>
							
							
							
							<?php $teach_age_player = (old('teach_age_player') ) ? : array() ;
									//print_r($teaching_levels);  
                                 ?> 
                            <div class="form-group label-text-area teach-age-player">
                                <label><?php echo Lang::get('coachProfile.teach_age_player'); ?></label>

                                <div class="checkbox">
                                    <label><input type="checkbox" name="teach_age_player[]"  value="Young_children" @if(in_array('Young_children', $teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.young_children'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teach_age_player[]" value="Juniors" @if(in_array('Juniors', $teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.juniors'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teach_age_player[]" value="Adults" @if(in_array('Adults', $teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.adults'); ?></label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="teach_age_player[]" value="All_ages"@if(in_array('All_ages', $teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.all_ages'); ?></label>
                                </div>   
                                <em><?php echo Lang::get('coachProfile.example_teach_age_player'); ?></em>
                            </div>   




                            <div class="form-group required label-text-area">
                                <label for="comment"><?php echo Lang::get('coachProfile.motto'); ?></label>


                                <textarea class="form-control" rows="5" id="comment" name="motto">{{ old('motto') }}</textarea>

                            </div>    


                            <div class="form-group required label-text-area">
                                <label for="favourite_player"><?php echo Lang::get('coachProfile.favourite_player'); ?></label>

                                <input type="text" class="form-control" name="favourite_player"  id="favourite_player" value="{{ old('favourite_player') }}">

                            </div>


                            <div class="form-group required label-text-area">
                                <label for="comment1"><?php echo Lang::get('coachProfile.coaching_style'); ?></label>

                                <textarea class="form-control" rows="5" id="comment1" name="coaching_style" >{{ old('coaching_style') }}</textarea>
                                <em><?php echo Lang::get('coachProfile.example_coaching_style'); ?></em>
                            </div>

                            <div class="form-group label-text-area">
                                <label for="commenttt"><?php echo Lang::get('coachProfile.playing_abliltiy'); ?></label>
                                <textarea class="form-control" rows="5" id="commenttt" name="playing_abliltiy" >{{ old('playing_abliltiy') }}</textarea>
                                <em><?php echo Lang::get('coachProfile.example_playing_abliltiy'); ?></em>
                            </div>
                            <div class="form-group required label-text-area">
                                <label for="about_me"><?php echo Lang::get('coachProfile.about_me'); ?></label>
                                <div>
                                    <textarea class="form-control" rows="5" name="about_me" id="about_me" onkeyup="countChar(this)" >{{ old('about_me') }}</textarea>
                                    <div id="charNum" style="color:red;"></div>
                                    <em><?php echo Lang::get('coachProfile.about_us_text'); ?></em>
                                </div>


                            </div>

                            <div class="form-group label-text-area">
                                <label for="court_details"><?php echo Lang::get('coachProfile.court_details'); ?></label>
                                <div>
                                    <textarea class="form-control" rows="5" name="court_details" id="court_details" >{{ old('court_details') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-success my-buttons">
                                        <?php echo Lang::get('coachProfile.save'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.5.js"></script>
<script>
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
	
	
	
	
	$(":submit").closest("form").submit(function(){
		$(':submit').attr('disabled', 'disabled');
	});
</script>   
<style>
    .my-browes{margin:2% 0;}
</style>
@include('includes.footer')
@endsection
