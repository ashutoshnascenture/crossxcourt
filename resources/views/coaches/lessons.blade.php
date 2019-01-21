 @extends('app')
@section('title','Lessons')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('lesson.my_lessons'); ?> </h2>
            <hr/>
            <div class="alert alert-success my-alert" role="alert">
                <p><?php echo Lang::get('lesson.text_section'); ?> 
                    <span class="label label-info"><?php echo Lang::get('lesson.text_section2'); ?></span> 
                    <?php echo Lang::get('lesson.text_section3'); ?> 
                </p>
            </div>

            @if($bookings)
            <div>
                <?php //echo "<pre>"; print_r($bookings) ?>
                @foreach($bookings as $booking)
                <p class="alert alert-danger my-danger">{{ucfirst($booking->first_name)}} {{ucfirst($booking->last_name)}} <?php echo Lang::get('lesson.has_purchased '); ?> {{$booking->lessons}}  <?php echo Lang::get('lesson.lessons_with'); ?>
                    @if($booking->additional_players) 
                    {{$booking->additional_players}}	
                    @else
                    1 
                    @endif	
                    <?php 
                    if(!empty($booking->additional_players)) {
                    echo  Lang::get('lesson.students'); 
                    } else {
                     echo Lang::get('lesson.student');
                   } ?>.
                   <a class="label label-info" href="{{URL::to('coaches/create-lesson/'.$booking->id)}}"><?php echo Lang::get('lesson.create_lesson'); ?></a>
                </p>
                @endforeach
            </div>
            @endif	
            <ul class="lessons list-group clint-list">
                <?php //echo "<pre>";print_r($lessons) ?>
                @if($lessons) 
                @foreach($lessons as $lesson)
                <li class="lessons list-group-item client-list-item clearfix"> 

                    <div class="col-md-12 prof-player">
                         
                            <div class="col-md-4 col-sm-4 col-xs-12 address-box">
                                <strong>{{ucfirst($lesson->first_name)}} {{ucfirst($lesson->last_name)}} </strong>
                                <address>
                                {{date('D F d, Y', strtotime($lesson->date))}}<br>
                                {{ $lesson->start_time }}, {{ $lesson->lesson_duration }} Hour<br>
                                
                                {{ $lesson->number_of_students }} Player<br>
                                </address>
                            </div>

                            <div class="col-md-5 col-sm-4 col-xs-12 location-map">
                                <img src="https://maps.googleapis.com/maps/api/staticmap?center={{$lesson->latitude}},{{$lesson->longitude}}&zoom=12&size=80x80&&markers=color:blue%7C{{$lesson->latitude}},{{$lesson->longitude}}&key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U">
                                <div class="map-info">
                                <address>
									<?php //echo "<pre>" ; print_r($lesson); die; ?>
								@if(!empty($lesson->court_name))	
                                    {{ucfirst($lesson->court_name)}}<br> 
                                    {{$lesson->address}}<br>
                                    {{$lesson->city}}, 
									   @if(!empty($lesson->state))
									   {{$lesson->state}},
									   @endif 
                                   @if(!empty($lesson->country))
										@foreach($countries as $country)
											@if($country->sortname == $lesson->country  )
													{{$country->name}}
											@endif
										@endforeach
									@endif 
                                @endif    
                                     
                                </address>
                                </div>
                            </div>
                              <div class="col-md-3 col-sm-4 col-xs-12 pull-right">
                                    <div class="row">
                                        @if($lesson->status == 'Pending')
                                        <a href="{{URL::to('coaches/mark-completed/'.$lesson->id)}}" class="btn btn-success mark-completed"><?php echo Lang::get('lesson.mark_completed'); ?></a>  
                                        <a href="{{URL::to('coaches/edit-lesson/'.$lesson->id)}}" class="btn btn-danger reschedule-lesson"><?php echo Lang::get('lesson.reschedule'); ?></a>
                                        @endif
                                    </div>
                                </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 status">
								<form method="" action="{{URL::to('coaches/deletelesson')}}/{{$lesson->id}}" id="{{$lesson->id }}" accept-charset="UTF-8" id="">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">
                                <span>ID: {{$lesson->id}}</span>
                                <span><?php echo Lang::get('lesson.lesson_status'); ?>:
                                        @if($lesson->status == 'Pending') 
                                        Lesson Created 
                                        @else 
                                        Lesson Completed
                                        @endif 

                                    </span>
                                <span><?php echo Lang::get('lesson.payment_status'); ?>: 
                                    
                                @if(!empty($lesson->payment_status))                                 
                                   Paid
                                @else 
                                Awaiting Payment
                                @endif         
                                </span>
                                <span>
								
                                 @if($lesson->status == 'Pending')
                                  
                                <a data-href="{{$lesson->id}}" data-toggle="modal" data-target="#confirm-lesson" href="#"> <i class="glyphicon glyphicon-trash" aria-hidden="true"></i> Cancel Lesson</a>   
                                
                                 </form>
                                
                                 @endif
                                </span>
                            </div>
                         
                    </div>

                </li>

                 
         

                @endforeach
                @else
                <p class="alert alert-info"><?php echo Lang::get('lesson.alert-box'); ?></p>	
                @endif
            </ul>  
            <?php echo $lessons->appends(Input::except('page'))->render(); ?>

        </div>
    </div>
</div>
<div class="modal fade" id="confirm-lesson" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Cancel Lesson</h4>
			</div>
		
			  <div class="modal-body">
				Are you sure want to cancel? 
			  </div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Lang::get('usersMessage.cancel_button') ?></button>
				<a href="#" class="btn btn-danger" id="danger_lesson">Cancel Lesson</a>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	$('#confirm-lesson').on('show.bs.modal', function (e) {
		var form = $(e.relatedTarget).data('href');
		$('#danger_lesson').click(function () {
		 
			$('#' + form).submit();
		});
	})
	});
</script>

@include('includes.footer')
@endsection
