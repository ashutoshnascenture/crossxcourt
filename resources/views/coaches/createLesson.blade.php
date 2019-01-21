@extends('app')
@section('title','Create-Lesson')
@section('content')
<div class="container-fluid">
    <div class="row">
    @include('includes.sidebar')
          <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
				<h2 class="student-title"><?php echo Lang::get('lesson.create_lesson'); ?></h2>
				<hr>
				
				<p><?php echo Lang::get('lesson.worked_details'); ?></p>
				<p><?php echo Lang::get('lesson.client_confirm'); ?>.</p>
				<div class="col-md-9 form-container">   
				@if (count($errors) > 0)
					<div class="alert alert-danger">
						<strong><?php echo Lang::get('lesson.whoops'); ?></strong> <?php echo Lang::get('lesson.alert_msg'); ?>.<br><br>
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
                </div>
                @endif
				<form method="post" class=""  action="{{LaravelLocalization::localizeURL('coaches/coachlesson')}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="customer_id" value="$client->id">
					  
					<div class="form-group required label-text-area image-area">
							<div><label for="duration"><?php echo Lang::get('lesson.member'); ?></label></div>
							<select class="selectpicker form-control box-select" id="duration" name="member" >
								
							<option value=""><?php echo Lang::get('lesson.select_option'); ?></option>
						@foreach($client as $client )	
							<option value={{$client->id}}>{{ucfirst($client->first_name)}}&nbsp;{{ucfirst($client->last_name)}}</option>
						@endforeach 		 
						</select>
					</div>
							
							
					<div class="form-group required label-text-area image-area">
						<div class="cust-title-bar">

							<h3> </h3>
						</div>
						<div><label for="date"><?php echo Lang::get('lesson.date'); ?></label></div>
						<div class="input-group date" data-provide="datepicker">
						
							<input type="text" class="form-control" name="date" value="{{ old('date') }}" id="date">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-th"></span>
							</div>
						</div>
 
						 
					</div>
					
					<div class="form-group label-text-area image-area">
						
							<div><label for="start_time"><?php echo Lang::get('lesson.start_time'); ?></label></div>
							 
							<select name="start_time" class="selectpicker form-control box-select" id="start_time">
							<?php 
							$start = strtotime('6:00');
							$end = strtotime('20:00');
							$range = array();
							while ($start !== $end) {
								
								$start = strtotime('+15 minutes',$start);
								$time = date('h:i A', $start);
								echo '<option>'.$time.'</option>';
							} ?>
							</select>
							 
						<br>
						<div class="form-group label-text-area image-area">
							<div><label for="duration"><?php echo Lang::get('lesson.lesson_duration'); ?></label></div>
							<select class="selectpicker form-control box-select" id="duration" name="lesson_duration">
							<option value="1">1 <?php echo Lang::get('lesson.hour'); ?> </option>
							<option value="2">2 <?php echo Lang::get('lesson.hours'); ?></option>
							<option value="3">3 <?php echo Lang::get('lesson.hours'); ?></option>
							<option value="4">4 <?php echo Lang::get('lesson.hours'); ?></option>
							<option value="8">8 <?php echo Lang::get('lesson.hours'); ?></option>
							</select>
						</div>
						 
					</div>
					<div class="form-group label-text-area image-area">
						
						
							<div>
							 <label for="ddate"><?php echo Lang::get('lesson.number_of_student'); ?></label>
							</div>
							<select class="selectpicker form-control box-select" id="ddate" name="number_of_students">
							<?php
							$students = range(1,Config::get('constants.NUMBEROFSTUDENT'));
							$players = 1;
							 
							
							foreach($students as $val){
								$selected  = '';
								if($players == $val)
									$selected = 'selected="selected"';
								
								echo '<option '.$selected.'>'.$val.'</option>';
							
							} ?>
							</select>
					
						
						 
					</div> 

					<div class="form-group required label-text-area image-area">
						<label for="courtList"><?php echo Lang::get('lesson.Court'); ?></label> 
						<div class="add-bar">
						 
						<select name="court_id" class="form-control box-select" id="courtList">
						<option value="">-- <?php echo Lang::get('lesson.select'); ?> --</option>
						@if(count($courts))
							@foreach($courts as $court )
								<?php 
								$name = $court->name.', '.$court->city.', '.$court->state.', '.$court->country;
								?>
								<option value="{{$court->id}}">{{$name}}</option>
							@endforeach
						@endif	
						</select>
						<input type="button" class="btn btn-info add-btn " value="<?php echo Lang::get('lesson.add'); ?>" data-toggle="modal" data-target="#myCourts" /> 
						</div>
						
					</div>


					<button type="submit" class="btn btn-success my-buttons"> <?php echo Lang::get('lesson.save'); ?> </button>
					</form>
                </div>
            </div>
      
    </div>
</div>
<!-- coort Modal -->
<div id="myCourts" class="modal fade" role="dialog">
  <div class="modal-dialog" style="z-index:9999;">
 
    <div class="modal-content">
	<form method="post" action="{{LaravelLocalization::localizeURL('coaches/add-court')}}" id="addcourt">
	   <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo Lang::get('lesson.add_location'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="map-box padding-left-right-2">
				<div id="coachLoaction" style="height:300px"> </div>
				<div class="checkbox">
				  <label>
					<input type="checkbox" value="1" name="student_pays_equipment_fee">
					<?php echo Lang::get('lesson.Equipment_free'); ?>
				  </label>
				</div>
				<div class="checkbox">
				  <label>
					<input type="checkbox" value="1" name="student_pays_facility_fee">
					<?php echo Lang::get('lesson.facility_fee'); ?>
				  </label>
				</div>
			</div>
			<div class="col-md-6 form-bar">
			
				  <div class="form-group label-text-area">
					<label for="name"><?php echo Lang::get('lesson.court_name'); ?></label>
					<input type="text" class="form-control" id="name" placeholder="<?php echo Lang::get('lesson.placeholder_court_name'); ?>" name="name">
				  </div>
				   <div class="form-grouplabel-text-area">
					<label for="address"><?php echo Lang::get('lesson.address'); ?></label>
					<textarea name="address" id="address" class="form-control" placeholder="<?php echo Lang::get('lesson.placeholder_address'); ?>"></textarea>
				  </div>
				   <div class="form-group label-text-area">
					<label for="zip_code"><?php echo Lang::get('lesson.zip_code'); ?></label>
					<input type="text" class="form-control" id="zip_code" placeholder="<?php echo Lang::get('lesson.placeholder_zip_code'); ?>" name="zip_code">
					
				  </div>
				   <div class="form-group label-text-area">
					
					<label for="city"><?php echo Lang::get('lesson.city'); ?></label>
					<input type="text" class="form-control" id="city" placeholder="<?php echo Lang::get('lesson.placeholder_city'); ?>" name="city">
					
				  </div>
				   
				   <div class="form-group label-text-area">
					<div class="form-left-box">
					<label for="country_list"><?php echo Lang::get('lesson.country'); ?></label>
					<select class="form-control box-select" id="country_list" name="country">
					<option value=""><?php echo Lang::get('lesson.placeholder_country'); ?></option>
						@foreach($countries as $country)
							<option value="{{$country->sortname}}">
								{{$country->name}}
							</option>
						@endforeach
					</select>
					&nbsp;
					</div>
					<div class="form-right-box ">
						<label for="state_list"><?php echo Lang::get('lesson.state'); ?></label>
						<select class="selectpicker form-control box-select" id="state_list" name="state">
							<option value=""><?php echo Lang::get('lesson.placeholder_state'); ?></option>	
						</select>
					</div>
					
				  </div>
				 </button>
				
			</div>
		</div>
      </div>
      <div class="modal-footer">
		 <button type="submit" class="btn btn-success  my-buttons"><?php echo Lang::get('lesson.save_changes'); ?>
		 
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Lang::get('lesson.close'); ?></button>
      </div>
	  
	  </form>
    </div>

  </div>
</div>
<style>
.modal-dialog {
  width: 45%;
}
</style>
<!-- modal end here-->


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initMap"
type="text/javascript"></script> 

<script type="text/javascript">
	 
	var map;
	function initMap() {
        var myLatLng = {lat: {{Auth::user()->latitude}}, lng: {{Auth::user()->longitude}}};

        map = new google.maps.Map(document.getElementById('coachLoaction'), {
          zoom: 13,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
    }
	
	 
	$("#myCourts").on("shown.bs.modal",function(){
		//google.maps.event.trigger(map, 'resize');
		initMap();
    });

	
</script>
@include('includes.footer')
</div>
@endsection
