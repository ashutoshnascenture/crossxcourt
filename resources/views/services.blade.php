@extends('app')
@section('title','Services')
@section('content')

<?php
$currency=Session::get('myCurrency');
if(!isset($currency))
$currency='USD'; 
 
  // $get_price = $coach->Info['price'];
$currency_flag='';
if($currency=='EUR')
	$currency_flag='fa fa-eur';
else if($currency=='USD')
	$currency_flag='fa fa-usd';
else if($currency=='GBP')
	$currency_flag='fa fa-gbp';


?>
 
<section class="middle-section-search">
	<div id="section-top-container">
		<div class="container">
		 
		@if(count($services))
			@if(!empty($state))
			<h2 class="search-title padding-top-bottom-5"><?php echo Lang::get('service.heading_services'); ?>, {{strtoupper($zip_code)}}, {{strtoupper($state)}}, {{strtoupper($country)}}</h2>
			@else
			<h2 class="search-title padding-top-bottom-5"><?php echo Lang::get('service.heading_services'); ?>, {{strtoupper($zip_code)}}, {{strtoupper($country)}}</h2>
			@endif
		
			
			@if($nearBy)
			<span class="service-alrt"><?php echo Lang::get('service.message_service'); ?> '{{ $zip_code }}' <?php echo Lang::get('service.postal_code'); ?>.
			 <?php echo Lang::get('service.near_coaches'); ?>.</span> 
			@endif
			
			@foreach($services as $val)
				<div class="search-container">
				<div class="section-search col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="left-side">
					 
					@if($val->profile_image)
						<img src="{{url('/coach-thumb/'.$val->profile_image)}}/200/200" alt="" />
					@else 
						<img src="{{url('/coach-thumb/no-image.jpg')}}/200/200" alt=""  />
					@endif	
					 
					</div>
					<div class="right-side">
					<div class="icon1">
						<h3>{{ucfirst($val->first_name)}}  {{substr($val->last_name,0,1)}}.</h3>
						 
						<ul class="list-inline reviews-list">
							<li>
								<div class="ratebox" style="color:#ff00ff;" data-id="{{$val->id}}" data-rating="{{round($val->rating,1)}}"></div>
							</li>
							<li><a class="btn btn-success review">{{$val->reviews}} <?php echo Lang::get('service.reviews'); ?></a></li>
						</ul>
						<ul class="list-group search-listing-section">
							@if($val->tennis_experience)
								<li>
									<span class="icons"><i class="fa fa-chevron-right left-chev"></i></span> {{$val->tennis_experience}} <?php echo Lang::get('service.years_experience'); ?>
								</li>
							@endif	
							@if($val->tennis_qualification)
								<li>
									<span class="icons"><i class="fa fa-chevron-right left-chev"></i></span> {{$val->tennis_qualification}}
								</li>
							@endif
							@if($val->motto)
								<li>
									<span class="icons"><i class="fa fa-chevron-right left-chev"></i></span> {{$val->motto}}
								</li>
							@endif
							
							
							 
						</ul>
					</div>
					</div>
				</div>
				<div class="section-search-right col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="cost-section">
						
						<h4><i class="{{$currency_flag}} fa-icn" aria-hidden="true"></i>{{round(Helper::get_price('USD',$currency,$val->price))}}</h4>
						<span><?php echo Lang::get('service.per_hour'); ?></span>
						<p>&nbsp;</p>
						<?php $name = strtolower($val->first_name).'-'.strtolower($val->last_name);
						$name = str_replace(' ','-',$name);
						?>
						<a href="{{URL::to('coaches/profile')}}/{{$name}}/{{$val->id}}" class="view-profiles view-btn"><?php echo Lang::get('service.view_profile'); ?></a>
						 
					</div>
					<div class="map-section">
						
						<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?center={{$val->latitude}},{{$val->longitude}}&zoom=12&size=235x295&&markers=color:blue%7C{{$val->latitude}},{{$val->longitude}}&key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U">
						
						<!--
						<div id="canvas_{{$val->id}}" class="map-canvas" onload="initialize({{$val->	id}},{{$val->latitude}},{{$val->longitude}})" style="width:235px; height:295px;"></div>
						-->
					</div>
				</div>
			</div><!-- search container -->
			@endforeach	
		@else
			<div class="alert alert-info margin-top-bottom-5">
				<?php echo Lang::get('service.no_result'); ?>
			</div> 
			<a href="javascript:history.go(-1)" class="btn btn-info">Go back</a>
		@endif		
		
		<?php 
		if(!$nearBy)
			echo $services->appends(Input::except('page'))->render(); ?>
		
	</div><!-- section top container ends -->
    </section> 
 
  
  <!--
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initialize"
type="text/javascript"></script> -->

 <script type="text/javascript">
	/*
	function initialize(event_id, lat,lng) { 
		var myOptions  = {
			zoom: 14,
			center: new google.maps.LatLng(lat, lng),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		var map = new google.maps.Map(document.getElementById('canvas_'+ event_id),myOptions);
	}
	
	window.onload = function(){
		var maps = document.querySelectorAll('div[id^="canvas_"]');
		for(var i  =0; i < maps.length; ++i ){
			maps[i].onload();
		}
	}
	*/
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
		
</script> 
@include('includes.footer')
@endsection
