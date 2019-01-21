@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Service Area</div>
                <div class="panel-body">
                     
                    <div class="">
                       <h3><?php echo Lang::get('coach_schedule.heading'); ?></h3>
						<form class="form-horizontal" id ='formSubmit' method="POST" action="{{ url('/coaches/schedule') }}">
						 <input type="hidden" name="_token" value="{{ csrf_token() }}">
							  
							<input type="hidden" id="schedules" name="schedules" value="" />
							
						<button type="submit" class="btn btn-primary">
                            Save
                        </button>	
						</form>
						 
						<div id="day-schedule"></div>
                    </div>
                </div>
            </div>
        </div>
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
		 
        var schedules = new Array();
		$('.time-slot').click(function(){
			console.log('okok');
			var slot = $(this);
			var time = slot.attr('data-time');
			var day  = slot.attr('data-day');
			var deDelected = slot.attr('data-selected');
			var times = new Array();
			if(typeof deDelected == 'undefined'){
				if(day in schedules){
					var times =  schedules[day];
					times.push(time);
					schedules[day] = times; 
				}
				else{
					times.push(time);
					schedules[day] = times;
				}
			}
			else {
				var index = schedules[day].indexOf(time);
				schedules[day].splice(index, 1);
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
		
			//alert('dd');
			//console.log(schedules);
			//return false;
			//if(schedules.length < 1){
			//	alert('Please ');
			//	return false;
			//}
				
		});
	      
		
    })($); 
 </script>
@endsection
