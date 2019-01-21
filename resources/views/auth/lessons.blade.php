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
  						<p><?php  echo Lang::get('lesson.text_section'); ?> </p>
					</div>

					@if($bookings)
						<div>
							@foreach($bookings as $booking)
								<p class="alert alert-danger my-danger">{{ucfirst($booking->first_name)}} {{ucfirst($booking->last_name)}} <?php //echo Lang::get('lesson.has_purchased '); ?> {{$booking->lessons}}  <?php //echo Lang::get('lesson.lessons_with'); ?>
								@if($booking->additional_players)
									{{$booking->additional_players + 1}}	
								@else
									1
								@endif	
									 <?php echo Lang::get('lesson.student'); ?>. <a class="btn btn-default black-btn" href="{{URL::to('coaches/create-lesson/'.$booking->id)}}"><?php echo Lang::get('lesson.create_lesson'); ?></a>
								</p>
							@endforeach
						</div>
					@endif	
					<ul class="lessons list-group clint-list">
					  
					@if($lessons) 
						@foreach($lessons as $lesson)
							<li class="lessons list-group-item client-list-item clearfix">
								<div class="prof-player">
								<aside class="info-bar">
								<h5 class="player-title">{{ucfirst($lesson->first_name)}} {{ucfirst($lesson->last_name)}} </h5>
									<p class="date">{{date('D F d, Y', strtotime($lesson->date))}}</p>
									<p class="lesson-time">{{ $lesson->start_time }}, {{ $lesson->lesson_duration }} Hour,</p>
									<p class="duration"> </p>
									<p class="student">{{ $lesson->number_of_students }} Player</p>
								</aside>
								<aside class="location-map">
									<img src="https://maps.googleapis.com/maps/api/staticmap?center={{$lesson->latitude}},{{$lesson->longitude}}&zoom=12&size=250x150&&markers=color:blue%7C{{$lesson->latitude}},{{$lesson->longitude}}&key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U">
									<div class="map-info">
								  		<p class="court-name">{{$lesson->court_name}} 
										</p>
										
								  		<p class="court-city-name">
										{{$lesson->address}}
										</p>
								  		 
								  	</div>
								  	
								</aside>
								</div>
								<div class="profile-btn-box">
									@if($lesson->status == 'Pending')
										<a href="{{URL::to('coaches/mark-completed/'.$lesson->id)}}" class="btn completed-btn btn-box"><?php echo Lang::get('lesson.mark_completed'); ?></a>  
										<a href="{{URL::to('coaches/edit-lesson/'.$lesson->id)}}" class="btn reschedule-btn btn-box"><?php echo Lang::get('lesson.reschedule'); ?>Reschedule </a>
									@endif
								</div>
								<div class="status"> 
									<b><?php //echo Lang::get('lesson.lesson_status'); ?></b><span class="lesson-status {{strtolower($lesson->status)}}"> {{$lesson->status}}</span> 
									<b><?php //echo Lang::get('lesson.payment_status'); ?>Payment Status:</b><span class="payment-status {{strtolower($lesson->payment_status)}}"> {{$lesson->payment_status}}</span> 
								</div>   
							</li>	
						@endforeach
					@else
						<p class="alert alert-info">You don't currently have any booked or scheduled lessons.</p>	
					@endif
					</ul>  
					<?php echo $lessons->appends(Input::except('page'))->render(); ?>
					
                </div>
        </div>
    </div>


@include('includes.footer')
@endsection
