@extends('app')

@section('keywords', ucfirst($coach->first_name) .', '.$coach->Info['tennis_qualification'] . ' in ' .$coach->city)
@section('description', ucfirst($coach->first_name) .', '.$coach->Info['tennis_qualification'] . ' in ' .$coach->city)

@section('content')
<?php
//echo '<pre>'; print_r($coach);
$currency=Session::get('myCurrency');
if(!isset($currency))
	$currency='USD'; 
$get_price = round(Helper::get_price('USD',$currency,$coach->Info['price']));
  // $get_price = $coach->Info['price'];
$currency_flag='';
if($currency=='EUR')
	$currency_flag='fa fa-eur';
else if($currency=='USD')
	$currency_flag='fa fa-usd';
else if($currency=='GBP')
	$currency_flag='fa fa-gbp';


?>
<section class="banner-content" id="profile-coaches">
	<div class="container">
		<div class="section-profile col-lg-8 col-md-8 col-sm-8 col-xs-12 padding-top-bottom-5">
			<div class="coaches-left-side left-side1">
				@if($coach->Info['profile_image'])
				<img src="{{ url('/coach-thumb/')}}/{{$coach->Info['profile_image']}}/200/200" alt="" /> 
				
				@else
				<img src="{{url('/coach-thumb/no-image.jpg')}}/150/150" alt=""   width="150" height="150" alt=""/>
				@endif
			</div>
			<div class="coaches-right-side">
				<div class="iconn1">
					<ul class="list-inline reviews-list">
					    <li>
						<h3>{{ucfirst($coach->first_name) }} {{ucfirst( substr($coach->last_name,0,1))}}.</h3>
						</li>
						
						<li><div class="ratebox" style="color:#ff00ff;" data-id="1" data-rating="{{round($coach->Info['rating'],1)}}"></div>
						</li>
						
						<li><a class="btn btn-success review" data-toggle="tab" href="#reviews">{{$coach->Info['reviews']}} Reviews</a></li>
					</ul>
					<p class="location-bar"><i class="glyphicon glyphicon-map-marker"></i> {{$coach->city}}, {{$coach->state}}, {{$coach->country}}</p>
					<div class="coach-moto"> 
					 “{{ucfirst($coach->Info['motto'])}}”
					</div>
					
				</div>
			</div>
		</div><!-- section profile ends here -->
		<div class="section-profile-right col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="charges">
				<h4>
					<i class="{{$currency_flag}}" aria-hidden="true"></i>{{$get_price}}<span class="hour">/Hr</span>
				</h4>
			</div>
		</div>
	</div><!-- container section ends -->
</section><!-- banner content section ends -->


<!-- tabs section starts here -->


<section class="my-tabs-section" id="section-tabs">
	<div class=" my-nav">
		<div class="container">
		<div class="row">
			<ul class="nav coaches-tabs">
				<li class="active"><a data-toggle="tab" href="#home" class="active"><?php echo Lang::get('coachProfile.about'); ?></a></li>
				<li><a data-toggle="tab" href="#map-canvas"><?php echo Lang::get('coachProfile.location'); ?></a></li>
				<li><a data-toggle="tab" href="#availability"><?php echo Lang::get('coachProfile.availabilty'); ?></a></li>
				<li><a data-toggle="tab" href="#pricing"><?php echo Lang::get('coachProfile.pricing'); ?></a></li>
				
				<li><a data-toggle="tab" href="#reviews"><?php echo Lang::get('coachProfile.reviews'); ?></a></li>
			</ul>
		</div>
		</div>
	</div>
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
	
	<div class="tab-content">
		<div class="container">

			<div id="home" class="col-md-12 about-me margin-bottom-5">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tabs-left-content">

					<ul class="list-group tabs-listing-sec">
						
						@if($coach->Info['nationality'])

						<li><span class="left-1"><?php echo Lang::get('coachProfile.nationality'); ?></span><span class="right-1"> {{ucfirst($coach->Info['nationality'])}} </span></li>

						@else 
						
						@endif

						@if($coach->Info['tennis_qualification'])

						<li><span class="left-1"><?php echo Lang::get('coachProfile.qualification'); ?></span><span class="right-1">{{ucfirst($coach->Info['tennis_qualification'])}} </span></li>

						@else 
						  
						@endif
						
						@if($coach->Info['tennis_experience'])

						<li><span class="left-1"><?php echo Lang::get('coachProfile.experience'); ?></span><span class="right-1">{{$coach->Info['tennis_experience']}}&nbsp;years of coaching experience</span></li>

						@else 

						@endif
						
						@if($coach->Info['languages'])
						 <?php $lang = str_replace(',',', ',$coach->Info['languages']) ?>
                        <li><span class="left-1"><?php echo Lang::get('coachProfile.languages'); ?></span><span class="right-1"> @if(!empty($lang)){{ucfirst($lang)}}@endif </span></li>

                        @else
                        
                        @endif
						
					</ul>
					<aside class="about-section">
						<p>{{$coach->Info['about_me']}}</p>
						<div class="que-box">
							<p class="que"> <?php echo Lang::get('coachProfile.my_coaching_style'); ?></p>
							<p class="ans"> {{ucfirst($coach->Info['coaching_style'])}} </p>
							<p class="que"><?php echo Lang::get('coachProfile.favourite_tennis_player'); ?></p>
							<p class="ans"> {{ucfirst($coach->Info['favourite_player'])}} </p>
							
							@if($coach->Info['court_details'])
							<p class="que">Where can you play?</p>
							<p class="ans">@if($coach->Info['court_details']){{ucfirst($coach->Info['court_details'])}} @endif </p>
							@endif
							
							<p class="que"><?php echo Lang::get('coachProfile.playing_abliltiy'); ?></p>
							<p class="ans">@if($coach->Info['playing_abliltiy']){{ucfirst($coach->Info['playing_abliltiy'])}} @endif </p>
						</div>
						
					</aside>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 tabs-right-section-form">
					<h3 class="form-title"> <?php echo Lang::get('coachProfile.checkout_form'); ?> </h3>
					<div class="coaches-form clearfix">
						<form method="get" class="form" action="{{URL::to('checkout/'.$coach->id)}}">
							<div class="form-group">
								<label for="preferred_day"><?php echo Lang::get('coachProfile.preferred_day'); ?></label>
								<div class="form-group">
									<select class="form-control box-select" id="preferred_day" name="preferred_day">
<!--
										<option selected="selected" value=""></option>
-->
										<option><?php echo Lang::get('coachProfile.monday'); ?></option>
										<option><?php echo Lang::get('coachProfile.tuesday'); ?></option>
										<option><?php echo Lang::get('coachProfile.wednesday'); ?></option>
										<option><?php echo Lang::get('coachProfile.thursday'); ?></option>
										<option><?php echo Lang::get('coachProfile.friday'); ?></option>
										<option><?php echo Lang::get('coachProfile.saturday'); ?></option>
										<option><?php echo Lang::get('coachProfile.sunday'); ?></option>
										<option><?php echo Lang::get('coachProfile.weekdays'); ?></option>
										<option><?php echo Lang::get('coachProfile.weekends'); ?></option>
										<option><?php echo Lang::get('coachProfile.flexible'); ?></option>
									</select>
									
								</div>
							</div>
							<div class="form-group">
								<label for="preferred_time"><?php echo Lang::get('coachProfile.preferred_time'); ?></label>
								<select class="form-control box-select" id="preferred_time" name="preferred_time">
<!--
									<option selected="selected" value=""></option>
-->
									<option value="Morning">Morning (7am-12pm)</option>
									<option value="Afternoon">Afternoon (12pm-5pm)</option>
									<option value="Evening">Evening (5pm-10pm)</option>
									<option value="Flexible">Flexible</option>
								</select>
							</div>
							<div class="form-group">
								<label for="lesson_location"><?php echo Lang::get('coachProfile.lesson_location'); ?></label>
								<select class=" form-control box-select" id="lesson_location" name="lesson_location"  >	 

									<option selected="selected" value="0"></option>

									<option value="1"><?php echo Lang::get('coachProfile.know_where'); ?></option>
									<option value="2"><?php echo Lang::get('coachProfile.my_instructor'); ?></option>
								</select>	
							</div>
							<div class="form-group" >
								<label for="lesson_location" id="text1" style="display:none;">Court Name or Address</label>
								<label for="lesson_location" id="text2" style="display:none;">What city or neighborhood?</label>
								<input id="id" type="text" class="form-control" name="lesson_location_description" style="display:none;" />
							</div>
							
 

							<!--<div class="form-group">
								<label for="email"><?php //echo Lang::get('coachProfile.email'); ?></label>
									<input id="email" type="email" class="form-control" name="email" value="{{ (isset($customer_email)) ? $customer_email : ""   }}"> 
							</div>-->
							<div class="form-group">
								<button class="proceed btn btn-info" type="submit"><?php echo Lang::get('coachProfile.proceed_to_checkout'); ?></button>
							</div>
						</form><!-- form ends here -->
						

					</div>
					<div class="col-md-12 questio-box margin-top-5">
							<p> <?php echo Lang::get('coachProfile.Ask_question'); ?></p>
							<?php $name = strtolower($coach->first_name).'-'.strtolower($coach->last_name);
							$name = str_replace(' ','-',$name);
							?>
							<a href="{{URL::to('message-coach/'.$name.'/'.$coach->id)}}" class="btn msg-btn"><?php echo Lang::get('coachProfile.message_coach'); ?></a>
							
						</div>
				</div>
			</div><!-- tabs active div ends-->
		</div>
		</div>
	</div>
	
</section><!-- tabs section ends here -->




<!-- map section starts here -->
<div id="map-canvas" style="with:500px; height:400px; "></div>
<!-- map section ends here -->

<section class="coaches-middle-section margin-top-bottom-5" id="coaches-middle">
	<div class="container">
		<div id="pricing" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pricing-left pull-left">
			
			<h2><?php echo Lang::get('coachProfile.pricing'); ?></h2>
			<table class="table pricing-table">
				

				<tbody>
					<tr>
						<thead>
							<th><?php echo Lang::get('coachProfile.package_amount'); ?></th>
							<th><?php echo Lang::get('coachProfile.per_lesson_price'); ?></th>
						</thead>
					</tr>
					@if(count($packages))
					
					@foreach($packages as $package)
					<tr>
						<td>{{$package->package['lessons']}} <?php echo Lang::get('coachProfile.lesson_package'); ?></td>
						<td class="price"><span>
							<i class="{{$currency_flag}}" aria-hidden="true"></i> {{round(Helper::get_price('USD',$currency,$package->rate))}}</span><?php echo Lang::get('coachProfile.per_hour'); ?></td>
							
						</tr>
						
						@endforeach	
						@else
						
						<tr>
							<td colspan="2"><?php echo Lang::get('coachProfile.Packages_not_available_yet'); ?></td>
						</tr>
						
						@endif
						
					</tbody>
				</table>
			</div>
			<div id='availability' class="col-lg-6 col-md-6 col-sm-12 col-xs-12 avalibilty-right pull-right">
				<h2><?php echo Lang::get('coachProfile.availabilty'); ?></h2>
				<div class="table-responsive">
					<table class="table table-bordered availabilty-table">
						<thead>
							<th>&nbsp;</th>
							<th><?php echo Lang::get('coachProfile.mon'); ?></th>
							<th><?php echo Lang::get('coachProfile.tue'); ?></th>
							<th><?php echo Lang::get('coachProfile.wed'); ?></th>
							<th><?php echo Lang::get('coachProfile.thu'); ?></th>
							<th><?php echo Lang::get('coachProfile.fri'); ?></th>
							<th><?php echo Lang::get('coachProfile.sat'); ?></th>
							<th><?php echo Lang::get('coachProfile.sun'); ?></th>
						</thead>
						<tbody>
							
							<?php $days = array('Mon','Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');  
							$times = array('Mornings','Afternoons','Evenings');  ?>
							
							@foreach($times as $time)
							<tr>
								<td> {{$time}} </td>
								<td class="text-center"> <?php echo (isset($schedules['Mon'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
								<td class="text-center"> <?php echo (isset($schedules['Tue'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
								<td class="text-center"> <?php echo (isset($schedules['Wed'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
								<td class="text-center"> <?php echo (isset($schedules['Thu'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
								<td class="text-center"> <?php echo (isset($schedules['Fri'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
								<td class="text-center"> <?php echo (isset($schedules['Sat'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
								<td class="text-center"> <?php echo (isset($schedules['Sun'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : '<i class="fa fa-close tick-close" aria-hidden="true"></i>'; ?> </td>
							</tr>
							
							@endforeach
							
							
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
	</section><!-- coaches-middle-section ends-->
	<!-- reviews section starts here -->
	
	<!-- reviews section ends here -->
	<!-- light blue section starts here -->
	<section class="light-blue-container padding-top-bottom-5" id="light-blue-section">
		<div class="container">
			<h2><?php echo Lang::get('coachProfile.what_happens_next'); ?></h2>
			<hr class="main">
			<div class="col-md-4 col-sm-12 col-xs-12 coaches-1 margin-top-5">
				<i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
				<h3><?php echo Lang::get('coachProfile.book_your_lessons'); ?></h3>
				<p><?php echo Lang::get('coachProfile.what_happened_next_text_1'); ?></p>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 coaches-1 margin-top-5">
				<i class="fa fa-trophy" aria-hidden="true"></i>
				<h3><?php echo Lang::get('coachProfile.improve_your_game'); ?></h3>
				<p><?php echo Lang::get('coachProfile.what_happened_next_text_2'); ?></p>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12 coaches-1 margin-top-5">
				<i class="glyphicon glyphicon-user"></i>
				<h3><?php echo Lang::get('coachProfile.book_your_coaches'); ?></h3>
				<p><?php echo Lang::get('coachProfile.what_happened_next_text_3'); ?></p>
			</div>
		</div>
	</section>

	<!-- light blue section starts here -->
	<!-- Customer wordings here -->
	<section class="testimonials-customers margin-top-bottom-5" id="customer-section">
		<div class="container" id="reviews">
			<h2><?php echo Lang::get('coachProfile.client_reviews'); ?></h2>
			<hr class="main">
			
			@if(count($reviews))
			 <?php
		       $myclass="col-md-4 threereview margin-top-bottom-5 review"; 
		       if(count($reviews)==1)
			     $myclass="col-md-12 onereview margin-top-bottom-5 text-center review";
			   else if(count($reviews)==2)
			     $myclass="col-md-6 col-md-6 onereview margin-top-bottom-5 tworeview review"; 
			 
		      ?>
			@foreach($reviews as $review)
			
			   <div class="<?php echo $myclass;?>">
					<p>
					  <?php echo html_entity_decode($review->review);?>
				    </p>
					<ul class="list-inline reviews-list">
						
						<div class="ratebox" style="color:#ff00ff;" data-id="{{$review->review_id}}" data-rating="{{round($review->rating,1)}}"></div>
						
					</ul>
					<h5>{{$review->first_name}} {{$review->last_name}} </h5>
					<span class="time">{{ Helper::ago($review->created_at)}}</span>
				</div>
			
			@endforeach	
			@else
			<div class="wording"></div>
			<div class="col-md-12 text-center margin-bottom-5">
				<h4><?php echo Lang::get('coachProfile.no_review'); ?></h4>
			</div>
			@endif
		</div>
		<div class="line-hr">
			<ul class="list-inline arrows-bottom">
				<li><span><i class="fa fa-angle-left left-arrws" aria-hidden="true"></i></span></li>
				<li><span><i class="fa fa-angle-right right-arrws" aria-hidden="true"></i></span></li>
			</ul>
		</div>
	</section>
	<!-- customer wordings ends here -->
	<!-- accordian section starts here -->
	<section class="accordian-section">
		<div class="container">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2 accordian-left-section">
				
				<div class="panel-group" id="accordion">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									<?php echo Lang::get('coachProfile.accordian_section_question_1'); ?>
								</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<?php echo Lang::get('coachProfile.accordian_section_answer_1'); ?>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									<?php echo Lang::get('coachProfile.accordian_section_question_2'); ?>
									
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
								<?php echo Lang::get('coachProfile.accordian_section_answer_2'); ?>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									<?php echo Lang::get('coachProfile.accordian_section_question_3'); ?>
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
								<?php echo Lang::get('coachProfile.accordian_section_answer_3'); ?>
							</div>
						</div>
					</div>
					<div class="panel panel-default ">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									<?php echo Lang::get('coachProfile.accordian_section_question_4'); ?>
								</a>
							</h4>
						</div>
						<div id="collapseFour" class="panel-collapse collapse">
							<div class="panel-body">
								<?php echo Lang::get('coachProfile.accordian_section_answer_4'); ?>
							</div>
						</div>
					</div>
				</div>
				
			</div>

		</div>
	</section>
	
	<!-- accordian section ends here -->
</div><!-- wrapper ends here -->


<style>
	.raterater-bg-layer {
		color:white;
	}
	.raterater-hover-layer {
		color: rgba( 255, 255, 0, 0.75 );
	}
	.raterater-hover-layer.rated {
		color: rgba( 255, 255, 0, 1 );
	}
	/*.raterater-rating-layer {
		color: rgba( 255, 155, 0, 0.75 );
	}
	.raterater-outline-layer {
		color: rgba( 0, 0, 0, 0.25 );
	}*/
	.raterater-rating-layer {
		color: #fdb924;
	}
	.raterater-outline-layer {
		color: rgba(0, 0, 0, 0);
	}
	
}
</style>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initialize"
type="text/javascript"></script>
<script>
//..........slide_form...............	
jQuery('li > a[href^="#"]').click(function(e) {
	
	jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top}, 1000);
	
	return false;
	
	e.preventDefault();
	
});
//..........slide_form...............

var default_area =  "{{$coach->Info['service_area']}}"; //miles
default_area = default_area.split(' ');
default_area = default_area[0]; 
console.log(default_area);
default_area *= 1600;

function initialize() {
	var mapDiv = document.getElementById('map-canvas');
	
	philly = new google.maps.LatLng({{$coach->latitude}}, {{$coach->longitude}});
	
	map = new google.maps.Map(mapDiv, {
		center: philly,
		zoom: 9,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		navigationControl: true,
		navigationControlOptions: {
			style: google.maps.NavigationControlStyle.SMALL
		}
	});
	var circle = {
		strokeColor: "#ff0000",
		strokeOpacity: 0.8,
		strokeWeight: 1,
		fillColor: "#ff0000",
		fillOpacity: 0.20,
		map: map,
		center: philly,
		radius: default_area
	};
	var drawCirle = new google.maps.Circle(circle);
	
}	
//............rating...................
$(function() {
	$('.ratebox' ).raterater( { 
		submitFunction: 'rateAlert', 
		allowChange: true,
		starWidth:20,
		spaceWidth: 5,
		numStars: 5,
		isStatic: true
	});

});
//............rating...................
</script>


<script>
$(document).ready(function () {
    $('.coaches-tabs li a').click(function(e) {

        $('.coaches-tabs li').removeClass('active');

        var $parent = $(this).parent();
        if (!$parent.hasClass('active')) {
            $parent.addClass('active');
        }
        e.preventDefault();
    });
});	


</script>
<script>
    $('#lesson_location').change(function(){
		if( $(this).val() == '1'){
			
			$('#id').show();
			$('#text1').show();
			$('#text2').hide();
		
		}else if($(this).val() == '2'){
		
			$('#id').show();	
			$('#text2').show();
			$('#text1').hide();
		
		} else {
			
			$('#id').hide();
			$('#text1').hide();
			$('#text2').hide();
          
		}
	});
	
	
	jQuery(document).ready(function($){
	$('#lesson_location').find('option[value=2]').attr('selected','selected');
	});
</script>
	
@include('includes.footer')
@endsection
