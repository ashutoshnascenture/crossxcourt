@extends('admin')

@section('content')
 
<div class="content-wrapper">     
    <section class="content-header">
        <?php echo Lang::get('coachProfile.coach_profile'); ?>
    </section>     
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

            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/admin/coaches/updatecoachprofile')}}/{{$id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
  
                <div class="form-group">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.profile_image'); ?></label>
                    <div class="col-md-10 browse">
                        <input type="file" class="form-control " name="profile_image" value="{{ $coach->profile_image }}">
                    </div> <br>
                    @if(!empty($coach->profile_image))
                    <div class="col-md-10">
                         
						<img src="{{url('/coach-thumb/'.$coach->profile_image)}}/200/200" alt="" />

                    </div><br>
					 
                    <div class="col-md-10 delete-image">
<!--
						<a href="{{ url('admin/coaches/crop/'.$id)}}" class="btn btn-success join" role="button">Crop Image</a>
-->
						
                        <a href="{{ url('admin/coaches/deletephoto/'.$id)}}" class="btn btn-danger" role="button">Delete Image</a>
						
                    </div>
                    @endif
                </div>
				
<!--
				<div class="form-group">
					<label class="col-md-10">Coach type</label>
					<div class="col-md-10">
						<select class="form-control" id="" name="featured_coach">
							<option value="">---Please select coach type---</option>
							<option value="Coach" @if($coach->featured_coach == 'Coach' || empty($coach->featured_coach)) selected="selected" @endif>Coach</option>
							<option value="featured_coach" @if($coach->featured_coach == 'featured_coach') selected="selected" @endif>Featured Coach</option>                                    < 
						</select>
					</div>
				</div>  
-->
				
				
				
				

                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.nationality'); ?></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="nationality" value="{{ ucfirst($coach->nationality) }}">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.tennis_qualification'); ?></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="tennis_qualification" value="{{ ucfirst($coach->tennis_qualification) }}">
                    </div>
                </div>


                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.tennis_experience'); ?></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="tennis_experience" id="tennis_experience" value="{{ $coach->tennis_experience }}">
                        <em><?php echo Lang::get('coachProfile.example_tennis_experience'); ?></em><br>
                         <span id="errmsg" style="color:red;"></span>
                    </div>

                </div>


                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.languages'); ?></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="languages" value ="{{ ucfirst($coach->languages) }}">
                    </div>
                </div>

                <?php $teaching_level = array(); ?>

                @if ($coach->teaching_level != "")
                <?php
                $teaching_level = explode(',', $coach->teaching_level);
                ?>

                @endif



                <div class="form-group">
                    <label class="col-md-10 "><?php echo Lang::get('coachProfile.teaching_level'); ?></label>
                    <div class="col-md-10">


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
                            <label><input type="checkbox" name="teaching_level[]" value="All_level"  @if(in_array('All_level',$teaching_level)) checked @endif><?php echo Lang::get('coachProfile.all_level'); ?></label>
                        </div>
                        <div class ="col-md-10">
						 <em><?php echo Lang::get('coachProfile.example_teaching_level'); ?></em>
                     </div> 
                    </div>
                </div>

                <?php $teach_age_player = array(); ?>

                @if ($coach->teach_age_player != "")
                <?php
                $teach_age_player = explode(',', $coach->teach_age_player);
                ?>

                @endif


                <div class="form-group">
                    <label class="col-md-10 "><?php echo Lang::get('coachProfile.teach_age_player'); ?></label>
                    <div class="col-md-10">
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
                            <label><input type="checkbox" name="teach_age_player[]" value="All_ages" @if(in_array('All_ages',$teach_age_player)) checked @endif><?php echo Lang::get('coachProfile.all_ages'); ?></label>
                        </div>   
                     <div class ="col-md-10">
						 <em><?php echo Lang::get('coachProfile.example_teach_age_player'); ?></em>
                     </div>   
                    </div>
                </div>   




                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.motto'); ?></label>
                    <div class="col-md-12">

                        <textarea class="form-control" rows="5" id="comment" name="motto">{{ ucfirst($coach->motto) }}</textarea>
                    </div>
                </div>    


                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.favourite_player'); ?></label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="favourite_player" value="{{ ucfirst($coach->favourite_player) }}">
                    </div>
                </div>


                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.coaching_style'); ?></label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5" id="comment" name="coaching_style">{{ ucfirst($coach->coaching_style) }}</textarea>
                        <em><?php echo Lang::get('coachProfile.example_coaching_style'); ?></em>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.playing_abliltiy'); ?></label>
                    <div class="col-md-10">

                        <textarea class="form-control" rows="5" id="comment" name="playing_abliltiy">{{ ucfirst($coach->playing_abliltiy) }}</textarea>
                         <em><?php echo Lang::get('coachProfile.example_playing_abliltiy'); ?></em>
                    </div>
                    
                </div>


                <div class="form-group required">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.about_me'); ?></label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5" name="about_me" id="about_me"  onkeyup="countChar(this)" >{{ ucfirst($coach->about_me) }}</textarea>
                        <div id="charNum" style="color:red;"></div>
                        <em><?php echo Lang::get('coachProfile.about_us_text'); ?></em>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-10"><?php echo Lang::get('coachProfile.court_details'); ?></label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5" name="court_details">{{ ucfirst($coach->court_details) }}</textarea>
                    </div>
                </div>

                 
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <?php echo Lang::get('coachProfile.save'); ?>
                        </button>
                    </div>
                </div>
            </form>
        </div><!-- inner content ends here -->
    </section>
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
	
	
	 
</script>
@endsection
