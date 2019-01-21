@extends('app')
@section('title','Schedule')
@section('content')


<div class="container-fluid">
    <div class="row">
		
		 
		@if(empty($user_exist))
			 @include('includes.step_sidebar')
			 <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12 right-content-form-section  profile-content">
          	<h2 class="student-title"><?php echo Lang::get('availablity.available'); ?></h2>
                <hr/>
                <p><?php echo Lang::get('availablity.para_content'); ?></p>
                   	<h3 class="schedule-text"><?php echo Lang::get('availablity.heading'); ?></h3>
					<div class="table-responsive scheduling-tb">
						<div id="day-schedule"></div>
					</div>
					<form class="form-horizontal" id ='formSubmit' method="POST" action="{{ LaravelLocalization::localizeURL('/coaches/schedule') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="schedules" name="schedules" value="" />
							
							<?php $action = 'add'; ?>
							@if(json_decode($schedules))
								<?php $action = 'update'; ?>
							
							@endif
							 
							<input type="hidden" name="action" value="{{$action}}">
							
							<button type="submit" class="btn btn-primary my-buttons save-btn">
                            <?php echo Lang::get('availablity.save'); ?>	
                        	</button>	
					</form>
        </div>
			 @else
			 @include('includes.sidebar')
			 <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
          	<h2 class="student-title"><?php echo Lang::get('availablity.available'); ?></h2>
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
                <hr/>
                <p><?php echo Lang::get('availablity.para_content'); ?></p>
                   	<h3 class="schedule-text"><?php echo Lang::get('availablity.heading'); ?></h3>
					<div class="table-responsive scheduling-tb">
						<div id="day-schedule"></div>
					</div>
					<form class="form-horizontal" id ='formSubmit' method="POST" action="{{ LaravelLocalization::localizeURL('/coaches/schedule') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="schedules" name="schedules" value="" />
							
							<?php $action = 'add'; ?>
							@if(json_decode($schedules))
								<?php $action = 'update'; ?>
							
							@endif
							 
							<input type="hidden" name="action" value="{{$action}}">
							
							<button type="submit" class="btn btn-primary my-buttons save-btn">
                            <?php echo Lang::get('availablity.save'); ?>	
                        	</button>	
					</form>
        </div>
			@endif 
			
          	
    </div>
</div>
 <script src="{{asset('/js/schedule.js')}}" type="text/javascript"></script>
 
 <script>
	 
	(function ($) {
	
	 
		var coachSchedules = $.parseJSON(' <?php echo $schedules ?>');
		$("#day-schedule").dayScheduleSelector({     
			days: [1, 2, 3, 4, 5, 6,7],
			interval: 60,
			startTime: '07:00',
			endTime: '21:00'
		});
		 
        var schedules = {};
		
		$('.time-slot').click(function(){
			 
			var slot = $(this);
			var time = slot.attr('data-time');
			var day  = slot.attr('data-day');
			var deDelected = slot.attr('data-selected');
		 
			if(typeof deDelected == 'undefined'){
				if(day in schedules){
					schedules[day].push(time);
				}
				else{
					schedules[day] = [time];
				}
			}
			else {
			
				var index = schedules[day].indexOf(time); 
				schedules[day].splice(index, 1);
				if(schedules[day].length == 0){
					delete schedules[day];
				} 
			}
			$('#schedules').val(JSON.stringify(schedules));
			 
		});
		 
		 
		if(coachSchedules.length > 0){
			for(i in coachSchedules){
				$('.schedule-rows td').each (function() {
					var time = parseInt($(this).attr('data-time'));
					var day  = $(this).attr('data-day');
					 
					if(parseInt(coachSchedules[i].time) == time && coachSchedules[i].day_num  == day){
						$(this).trigger('click');
					}
					
				});  
			} 
		}
		
		$('#formSubmit').submit(function(){
				
			var total_schedules = 0;
			for(i in schedules){
				total_schedules++;
			}
			if(total_schedules == 0){
				alert('<?php echo Lang::get('usersMessage.schedule_input') ?>');
				return false;
			}
			 
				
		}); 
		
	      
		
    })($); 
 </script>
  
@include('includes.footer')
@endsection
