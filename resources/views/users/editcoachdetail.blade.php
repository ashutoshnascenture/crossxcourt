@extends('app')
@section('title','Profile')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
		
			
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('coachProfile.heading_update'); ?>
			</h2>
            <hr>
			 <p>
                    <?php echo Lang::get('coachProfile.coach_profile'); ?>
              </p>
            <div class="col-md-9 form-container">

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
               
                <form  role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/users/updatecoachprofile')}}/{{$coach->user_id}}" onSubmit="document.getElementById('submit').disabled=true;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 

                    

                    <div class="form-group required label-text-area">
                        <label for="nationality"><?php echo Lang::get('coachProfile.nationality'); ?></label>

                        <input type="text" class="form-control" name="nationality" id="nationality" value="{{ ucfirst($coach->nationality) }}">

                    </div>

                    <div class="form-group required label-text-area">
                        <label for="tennis_qualification"><?php echo Lang::get('coachProfile.tennis_qualification'); ?></label>

                        <input type="text" class="form-control" name="tennis_qualification" id="tennis_qualification" value="{{ ucfirst($coach->tennis_qualification) }}">

                    </div>


                    <div class="form-group required label-text-area">
                        <label for="tennis_experience"><?php echo Lang::get('coachProfile.tennis_experience'); ?></label>

                        <input type="text" class="form-control" name="tennis_experience" id="tennis_experience" value="{{ $coach->tennis_experience }}">
                        <em><?php echo Lang::get('coachProfile.example_tennis_experience'); ?></em><br>
                        <span id="errmsg" style="color:red;"></span>
                    </div>


                    <div class="form-group required label-text-area">
                        <label for="languages"><?php echo Lang::get('coachProfile.languages'); ?></label>

                        <input type="text" class="form-control" name="languages" id="languages" value ="{{ ucfirst($coach->languages) }}">

                    </div>

                    <?php $teaching_level = array(); ?>

                    @if ($coach->teaching_level != "")
                    <?php
                    $teaching_level = explode(',', $coach->teaching_level);
                    ?>

                    @endif



                    <div class="form-group label-text-area teaching-level">
                        <label for=" "><?php echo Lang::get('coachProfile.teaching_level'); ?></label>

                        <div class="checkbox">
                            <label><input type="checkbox" name="teaching_level[]" value="Young_beginner" @if(in_array('Young_beginner',$teaching_level)) checked @endif ><?php echo Lang::get('coachProfile.young_beginner'); ?></label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="teaching_level[]" value="Intermediate" @if(in_array('Intermediate',$teaching_level)) checked @endif ><?php echo Lang::get('coachProfile.intermediate'); ?></label>
                        </div>
                        <div class="checkbox">
                            <label> <input type="checkbox" name="teaching_level[]" value="Advance" @if(in_array('Advance',$teaching_level)) checked @endif ><?php echo Lang::get('coachProfile.advance'); ?> </label>
                        </div>

                        <div class="checkbox">
                            <label> <input type="checkbox" name="teaching_level[]" value="Professional" @if(in_array('Professional',$teaching_level)) checked @endif ><?php echo Lang::get('coachProfile.professional'); ?> </label>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox" name="teaching_level[]" value="All_level"  @if(in_array('All_level',$teaching_level)) checked @endif ><?php echo Lang::get('coachProfile.all_level'); ?></label>
                        </div>
                        <em><?php echo Lang::get('coachProfile.example_teaching_level'); ?></em>
                    </div>

                    <?php $teach_age_player = array(); ?>

                    @if ($coach->teach_age_player != "")
                    <?php
                    $teach_age_player = explode(',', $coach->teach_age_player);
                    ?>

                    @endif


                    <div class="form-group label-text-area teach-age-player">
                        <label><?php echo Lang::get('coachProfile.teach_age_player'); ?></label>

                        <div class="checkbox">
                            <label><input type="checkbox" name="teach_age_player[]"  value="Young_children" @if(in_array('Young_children',$teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.young_children'); ?></label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="teach_age_player[]" value="Juniors" @if(in_array('Juniors',$teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.juniors'); ?></label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="teach_age_player[]" value="Adults" @if(in_array('Adults',$teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.adults'); ?></label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="teach_age_player[]" value="All_ages" @if(in_array('All_ages',$teach_age_player)) checked @endif ><?php echo Lang::get('coachProfile.all_ages'); ?></label>
                        </div>   
                        <em><?php echo Lang::get('coachProfile.example_teach_age_player'); ?></em>
                    </div>   




                    <div class="form-group required label-text-area label-text-area">
                        <label for="comment"><?php echo Lang::get('coachProfile.motto'); ?></label>


                        <textarea class="form-control" rows="5" id="comment" name="motto">{{ ucfirst($coach->motto) }}</textarea>

                    </div>    


                    <div class="form-group required label-text-area">
                        <label for="favourite_player"><?php echo Lang::get('coachProfile.favourite_player'); ?></label>

                        <input type="text" class="form-control" name="favourite_player" id="favourite_player" value="{{ ucfirst($coach->favourite_player) }}">

                    </div>


                    <div class="form-group required label-text-area ">
                        <label for="comment"><?php echo Lang::get('coachProfile.coaching_style'); ?></label>

                        <textarea class="form-control" rows="5" id="comment" name="coaching_style">{{ ucfirst($coach->coaching_style) }}</textarea>

                        <em><?php echo Lang::get('coachProfile.example_coaching_style'); ?></em>
                    </div>



                    <div class="form-group label-text-area">
                        <label for="comment"><?php echo Lang::get('coachProfile.playing_abliltiy'); ?></label>
                        <div>

                            <textarea class="form-control" rows="5" id="comment" name="playing_abliltiy">{{ ucfirst($coach->playing_abliltiy) }}</textarea>
                        </div>
                        <em><?php echo Lang::get('coachProfile.example_playing_abliltiy'); ?></em>
                    </div>


                    <div class="form-group required label-text-area">
                        <label for="about_me"><?php echo Lang::get('coachProfile.about_me'); ?></label>

                        <textarea class="form-control" rows="5" name="about_me" id="about_me"  onkeyup="countChar(this)" >{{ ucfirst($coach->about_me) }}</textarea>
                        <div id="charNum" style="color:red;"></div>
						<em><?php echo Lang::get('coachProfile.about_us_text'); ?></em>

                    </div>


                    <div class="form-group  label-text-area">
                        <label for="court_details"><?php echo Lang::get('coachProfile.court_details'); ?></label>

                        <textarea class="form-control" rows="5" name="court_details" id="court_details">{{ ucfirst($coach->court_details) }}</textarea>

                    </div>

                    <div class="form-group label-text-area">

                        <button type="submit" class="btn btn-success my-buttons submit-btn">
                            <?php echo Lang::get('coachProfile.save'); ?>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#profile_image').change(function () {
        $(this).parents('form').submit();
    });


</script>


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
@include('includes.footer')
@endsection
