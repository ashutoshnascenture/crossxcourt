@extends('app')
@section('title','Profile')
@section('content')
<section class="banner-content" id="profile-coaches">

	<div class="container">
		<div class="section-profile col-lg-9 col-md-9 col-sm-9 col-xs-12">
		<div class="coaches-left-side left-side">
		@if($coach->Info['profile_image'])
			<img src="{{ url('/coach-thumb/')}}/{{$coach->Info['profile_image']}}/200/200" alt="" /> 
					
		@else
			<img src="{{asset('/images/no-image.jpg')}}" alt=""   width="150" height="150" alt=""/>
		@endif
	
		</div>
		<div class="coaches-right-side">
		<div class="iconn1">
			<ul class="list-inline reviews-list">
				<li>
					<h3>{{ucfirst($coach->first_name) }} {{ucfirst( substr($coach->last_name),0,1)}}.</h3>
				</li>
				<li>
				   <div class="ratebox" style="color:#ff00ff;" data-id="1" data-rating="{{round($coach->Info['rating'],1)}}"></div>
				</li>
				
				<li><a class="btn btn-success review" data-toggle="tab" href="#reviews">{{$coach->Info['reviews']}} Reviews</a></li>
			</ul>
			<ul class="location-text location-list list-inline">
			<li><i class="fa fa-map-marker location-mark"></i> {{$coach->city}}, {{$coach->state}}, {{$coach->country}}</li>
			</ul>
		
		</div>
		</div>
		</div><!-- section profile ends here -->
		<div class="section-profile-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="charges">
				<h4>
					<i class="fa fa-usd doller" aria-hidden="true"></i>{{$coach->Info['price']}}<span class="hour">/Hr</span>
				</h4>
			</div>
		</div>
	</div><!-- container section ends -->
	</section><!-- banner content section ends -->
			
			
			<!-- tabs section starts here -->
			  
			
				<section class="my-tabs-section" id="section-tabs">
				<div class=" my-nav">
					<div class="container">
					<ul class="nav coaches-tabs">
						<li><a data-toggle="tab" href="#home">About</a></li>
						<li><a data-toggle="tab" href="#map-canvas">Location</a></li>
						<li><a data-toggle="tab" href="#availability">Availabilty</a></li>
						<li><a data-toggle="tab" href="#pricing">Pricing</a></li>
					</ul>
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
					<div id="home" class="tab-pane fade in active">
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tabs-left-content">
							
								
								<ul class="list-group tabs-listing-sec">
									<li><span class="left-1">NATIONALITY </span><span class="right-1">  {{$coach->Info['nationality']}} </span></li>
									<li><span class="left-1">QUALIFICATIONS</span><span class="right-1">{{$coach->Info['tennis_qualification']}} </span></li>
									<li><span class="left-1">EXPERIENCE</span><span class="right-1">{{$coach->Info['tennis_experience']}}</span></li>
									<li><span class="left-1">LANGUAGES</span><span class="right-1">{{$coach->Info['languages']}}</span></li>
								
								</ul>
								<aside class="about-section">
									<h2>ABOUT ME</h2>
									<p>
									 
									  {{$coach->Info['about_me']}}
									</p>
								
								</aside>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 tabs-right-section-form">
						<div class="coaches-form">
						<form method="get" class="form-horizontal"  action="{{URL::to('checkout/'.$coach->id)}}">
						<fieldset class="form-group">
							<label>Preferred Day</label>
							<div class="label-text">
							<select class="form-control box-select" id="preferred_day" name="preferred_day">
								 <option selected="selected" value=""></option>
								 <option>Monday</option>
								 <option>Tuesday</option>
								 <option>Wednesday</option>
								 <option>Thursday</option>
								 <option>Friday</option>
								 <option>Saturday</option>
								 <option>Sunday</option>
								 <option>Weekdays</option>
								 <option>Weekends</option>
								 <option>Flexible</option>
							</select>
							
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label>Preferred Time</label>
							<div class="label-text">
							<select class="form-control box-select" id="preferred_time" name="preferred_time">
								<option selected="selected" value=""></option>
								<option value="Morning">Morning (7am-12pm)</option>
								<option value="Afternoon">Afternoon (12pm-5pm)</option>
								<option value="Evening">Evening (5pm-10pm)</option>
								<option value="Flexible">Flexible</option>
					      </select>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label>Lesson Location</label>
							<div class="label-text">
							<select class=" form-control box-select" id="lesson_location" name="lesson_location"><option selected="selected" value=""></option><option value="0">I know where I want my lesson</option><option value="1">I want my instructor to suggest one</option></select>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<label>Email</label>
							<div class="label-text">
							<input type="email" class="form-control" name="email"> 
							</div>
						</fieldset>
						<fieldset class="form-group">
						  <button class="proceed btn btn-info" type="submit">Proceed to Checkout</button>
						</fieldset>
						</form><!-- form ends here -->
						</div>
						</div>
					</div><!-- tabs active div ends-->
				</div>
				</div>
				 
				</section><!-- tabs section ends here -->
			
			
			
			
			<!-- map section starts here -->
			<div id="map-canvas" style="with:500px; height:400px;"></div>
			<!-- map section ends here -->
			
			<section class="coaches-middle-section" id="coaches-middle">
			<div class="container">
				<div id="pricing" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pricing-left pull-left">
					
					<h3>PRICING<span class="hr-line hr-line1"></span></h3>
					<table class="table pricing-table">
					

					<tbody>
					<tr>
						<thead>
							<th>Package Amount</th>
							<th>Per Lesson Price</th>
						</thead>
					</tr>
						@if(count($packages))
								
								@foreach($packages as $package)
									<tr>
										<td>{{$package->package['lessons']}} Lesson Package</td>
										<td class="price"><span>${{$package->rate}} </span>per hour</td>
									</tr>
								@endforeach	
							@else
						
								<tr>
									<td colspan="2">Packages not available yet.</td>
								</tr>
							
							@endif
					
					</tbody>
					</table>
				</div>
				<div id='availability' class="col-lg-6 col-md-6 col-sm-12 col-xs-12 avalibilty-right pull-right">
					<h3>AVAILABILTY<span class="hr-line"></span></h3>
					<div class="table-responsive">
					<table class="table table-bordered availabilty-table">
					<thead>
						<th>&nbsp;</th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri &nbsp;</th>
						<th>Sat</th>
						<th>Sun</th>
					</thead>
					<tbody>
					
					<?php $days = array('Mon','Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');  
					$times = array('Mornings','Afternoons','Evenings');  ?>
					
					@foreach($times as $time)
							<tr>
							<td> {{$time}} </td>
							<td class="text-center"> <?php echo (isset($schedules['Mon'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
							<td class="text-center"> <?php echo (isset($schedules['Tue'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
							<td class="text-center"> <?php echo (isset($schedules['Wed'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
							<td class="text-center"> <?php echo (isset($schedules['Thu'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
							<td class="text-center"> <?php echo (isset($schedules['Fri'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
							<td class="text-center"> <?php echo (isset($schedules['Sat'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
							<td class="text-center"> <?php echo (isset($schedules['Sun'][$time])) ? '<i class="fa fa-check tick-chk" aria-hidden="true"></i>' : ''; ?> </td>
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
				<section class="light-blue-container" id="light-blue-section">
					<div class="container">
						<h2>WHAT HAPPENS NEXT</h2>
						<hr class="main">
						<div class="coaches-1 booking-section1">
							<img src="{{asset('images/tennis1.png')}}" alt="tennis">
							<h3>BOOK YOUR LESSONS</h3>
							<p>Long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The poi Iphe </p>
						</div>
						<div class="coaches-1 booking-section2">
							<img src="{{asset('images/tennis2.png')}}" alt="tennis">
							<h3>IMPROVE YOUR GAME</h3>
							<p>Long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The poi Iphe </p>
						</div>
						<div class="coaches-1 booking-section3">
							<img src="{{asset('images/tennis3.png')}}" alt="tennis">
							<h3>BOOK YOUR COACHES</h3>
							<p>Long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The poi Iphe </p>
						</div>
					</div>
				</section>

<!-- light blue section starts here -->
			<!-- Customer wordings here -->
				<section class="testimonials-customers" id="customer-section">
					<div class="container">
						<h2>WHAT YOUR CUSTMORS SAYS</h2>
						<hr class="main">
						 @if(count($packages))
						@foreach($reviews as $review)
						
						<div class="wording">
							<p>{{$review->review}}</p>
							
						<ul class="list-inline reviews-list">
						
							 <div class="ratebox" style="color:#ff00ff;" data-id="{{$review->review_id}}" data-rating="{{round($review->rating,1)}}"></div>
							
						</ul>
						<h5>{{$review->first_name}} {{$review->last_name}} </h5>
						<span class="time">{{ Helper::ago($review->created_at)}}</span>
						</div>
						@endforeach	
						@else
						<div class="wording">
					
							
							<span class="client-says">“No Review for this Coach“</span>
						
						</div>
						@endif
						<!--<div class="wording">
							<p>Desktop publishing software like 
							Aldus PageMaker including.</p>
							
							<span class="client-says">“ It is a long established fact that a reader will be distracted “</span>
								
						<ul class="list-inline reviews-list">
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i></a></li>
							<li class="grey-star"><a href="#"><i class="fa fa-star"></i></a></li>
						</ul>
						<h5>Mrs Catherine White</h5>
						<span class="time">45 hours ago</span>
						</div>-->
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
								 How do I know I’ll love my coach?
								
								</a>
							  </h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
							  <div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. you probably haven't heard of them accusamus labore sustainable VHS.
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								 How do I know I’ll love my coach?
								 
								</a>
							  </h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
							  <div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
							  </div>
							</div>
						  </div>
						  <div class="panel panel-default">
							<div class="panel-heading">
							  <h4 class="panel-title">
								<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								  
								  How do I know I’ll love my coach?
								 
								</a>
							  </h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse">
							  <div class="panel-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. 
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
      .raterater-rating-layer {
       color: rgba( 255, 155, 0, 0.75 );
      }
      .raterater-outline-layer {
        color: rgba( 0, 0, 0, 0.25 );
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
	</script>
		<script>
		 
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
			starWidth:15,
			spaceWidth: 5,
			numStars: 5,
			isStatic: true
		});

	});
   //............rating...................
		 
</script>	



@endsection
