@extends('layouts/home')
@section('title', 'Home')
@section('content')


<div class="hero-header-content">
   
	<h1 class="text-center"><?php echo Lang::get('welcome.heading'); ?></h1>
	<p class="text-center"> <a href="#" class="court"><?php echo Lang::get('welcome.crossXcourt'); ?></a> <?php echo Lang::get('welcome.tag_line'); ?></p>
	<form class="form-inline search-form text-center" action="{{ LaravelLocalization::localizeURL('find-services') }}" method="post">
		 
		
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="form-group postal postal-1">
			<input type="text" class="form-control" id="postal" name="zip_code" placeholder="<?php echo Lang::get('welcome.place_holder'); ?>" required>
		</div>
		<div class="form-group postal">
			<select class="selectpicker form-control box-select" id="country_list" name="country_code" required>
				<option value=""><?php echo Lang::get('welcome.country'); ?></option>
				@foreach($countries as $country)
				<option value="{{$country->sortname}}">
					{{$country->name}}
				</option>
				@endforeach
			</select>
			<input type="hidden" name="country" id="countryName" value="">
		</div>
		<div class="form-group postal">
			<select class="selectpicker form-control box-select" id="state_list" name="state">
				<option value=""><?php echo Lang::get('welcome.state'); ?></option>	
			</select>
		</div>
		<button type="submit" class="btn btn-success search-coach"><?php echo Lang::get('welcome.search_coaches'); ?></button>
	</form>
</div>
</div><!--container ends -->

</div><!-- banner ends -->
</header>

<!-- Wrap the rest of the page in another container to center all the content. -->
<!-- Wrap the rest of the page in another container to center all the content. -->
<section class="secion-working">
	<div class="container working-sec padding-top-bottom-5">
		<h2 class="text-center"><?php echo Lang::get('welcome.how_it_works'); ?><br/></h2>
		<hr class="main-heading"/>
		<!-- Three columns of text below the carousel -->
		
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 icon1">
			<div class="blog-section">
				<div class="left-sec">
					<img src="images/icon11.png" alt="icon1">
				</div>
				<h3><?php echo Lang::get('welcome.search'); ?></h3>
				<p><?php echo Lang::get('welcome.search_text'); ?></p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 icon1">
			<div class="blog-section">
				<div class="left-sec left-icon2">
					<img src="images/icon22.png" alt="icon1">
				</div>
				<h3><?php echo Lang::get('welcome.book'); ?></h3>
				<p><?php echo Lang::get('welcome.book_text'); ?></p>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 icon1">
			<div class="blog-section">
				<div class="left-sec left-icon3">
					<img src="images/icon33.png" alt="icon1">
				</div>
				<h3><?php echo Lang::get('welcome.play'); ?></h3>
				<p><?php echo Lang::get('welcome.play_text'); ?></p>
			</div>
		</div>
		
		
		
	</div><!-- /.container -->
</section>

<!-- START THE FEATURETTES -->
<section class="featured-section padding-top-bottom-5">
	<div class="container featured-coaches">
		<h2 class="text-center"><?php echo Lang::get('welcome.featured_caoaches'); ?></h2>
		<hr class="main-heading"/>
		<div class="row">
			
			@foreach($coaches as $coach)
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 coaches-icons">
				<div class="single-portfolio">
					<?php $name = strtolower($coach->first_name).'-'.strtolower($coach->last_name);
					$name = str_replace(' ','',$name);
					
					?>
					@if($coach->profile_image)
					<a href="{{URL::to('coaches/profile')}}/{{$name}}/{{$coach->user_id}}">
						<img src="{{url('/coach-thumb/'.$coach->profile_image)}}/265/264" alt="" width="265px;" height="264px;"/>
					</a>
					@else
					<a href="{{URL::to('coaches/profile/')}}/{{$name}}/{{$coach->user_id}}">
						<img src="{{url('/coach-thumb/no-image.jpg')}}/265/264" alt="" width="265px;" height="264px;" />  
						@endif
						
						<div class="portfolio-link">
							<ul class="coache-title">
								
							 
										<li class="name">{{$coach->first_name}}  {{substr($coach->last_name,0,1)}}. </li>
										 
										<li class="city-name">{{$coach->city}}<span>{{$coach->countryname}}</span></li>
										<li class="country-name"> </li>
									</ul>
									<!--<span class="bio">Bio-</span>{{substr($coach->motto,0,80)}}-->
									<a href="{{URL::to('coaches/profile')}}/{{$name}}/{{$coach->user_id}}" class="view-btn"><?php echo Lang::get('welcome.view_profile'); ?></a>
								</div>
							</div>
						</div>
						@endforeach 
					</div>
					
				</div><!-- coaches -->
			</section>

			<!-- testimonial section start here -->


			<div class="container testimonials margin-top-bottom-5">
				<h2 class="text-center"><?php echo Lang::get('welcome.testimonials'); ?><br/></h2>
				<hr class="main-heading"/>
				<section class="regular slider hidden-xs">
					
					
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="section1">
							<p><?php echo Lang::get('welcome.testimonials1'); ?></p> 
							
							<img src="images/commas.png" alt = "images" width="69px" height="69px">
							<div class="green-sec"><h4>Mike Cargill</h4><h5>London</h5></div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="section1">
							<p><?php echo Lang::get('welcome.testimonials2'); ?></p> 
							<img src="images/commas.png" alt="" width="69px" height="69px">
							<div class="green-sec"><h4>Elisabeth R</h4><h5>New York</h5></div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="section1">
							<p><?php echo Lang::get('welcome.testimonials3'); ?>
							</p> 
							<img src="images/commas.png" alt="" width="69px" height="69px">
							<div class="green-sec"><h4>Alastair Smith</h4><h5>Marbella, Spain</h5></div>
						</div>
					</div>
<!--
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="section1">
							<p>I was looking to improve my tennis while on holiday with my family. crossXcourt helped me not only find a fantastic coach for myself but also for my wife and children.</p> 
							<img src="images/commas.png" alt="" width="69px" height="69px">
							<div class="green-sec"><h4>Chris Bowler</h4><h5>Tennis Player</h5></div>
						</div>
					</div>
-->
					
				</section>
			</div>

			<!-- testimonial section ends here -->
			<!-- play section banner -->
			<section class="banner2">
				
				<div class="container play-banner padding-top-bottom-5">
					<h2 class="text-center"><?php echo Lang::get('welcome.play_with_a_pro'); ?></h2>
					<p><?php echo Lang::get('welcome.play_with_a_pro_text'); ?></p>
					<a href="{{URL::to('/play-with-pro')}}" class="find"><?php echo Lang::get('welcome.find_out_more'); ?></a>
				</div>
				
			</section>
			<!-- play section banner ends -->
			<section class="container partners margin-top-bottom-5">
				
				<h2 class="text-center"> <span class="lighter-heading"><?php echo Lang::get('welcome.our'); ?> </span><?php echo Lang::get('welcome.partners'); ?><br/>
				</h2>
				<hr class="main-heading"/>
				
				<div class="logos-section">
					<ul class="list-inline">
						<li><a href=""><img src="images/client-logo-1.jpg" alt="" /></a></li>
						<li><a href=""><img src="images/client-logo-2.jpg" alt="" /></a></li>
					<!--<li><a href=""><img src="images/logo3.png" alt="logo1" width="181px" height="113"></a></li>
					<li><a href=""><img src="images/logo4.png" alt="logo1" width="181px" height="113"></a></li>
					<li><a href=""><img src="images/logo5.png" alt="logo1" width="181px" height="113"></a></li>
					<li><a href=""><img src="images/logo6.png" alt="logo1" width="181px" height="113"></a></li>-->
				</ul>
			</div>
			
		</section>
		
			<!--------
			<div class="content">
				Select Language 
				<select>
				<option>--select--</option>
				@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
					<option value="{{LaravelLocalization::getLocalizedURL($localeCode) }}"> 
						{{ $properties['native'] }}
					</option>
				@endforeach
				</select>
                <div class="title">
					<div>
					<?php echo Lang::get('messages.welcome'); ?>
					</div>
				</div>
			</div> -->
			
			
			<script>

				$(function(){
					
	//bind stats list 
	$('#country_list').change(function(){

		var country_name = $("#country_list option:selected").text().trim();
		document.getElementById('countryName').value=country_name; 
		
		$.get(siteUrl+"/cntname/" + $(this).val(), function( data ) { 
			
			
		});
	});
	
});

	$(function(){
	/*
	$('select').change(function(){
		var url = $(this).val();
		window.location.href = url;
	});
	*/
});
</script>
@endsection
