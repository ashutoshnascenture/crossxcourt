@extends('app')
@section('content')
 
<section class="secion-working margin-top-bottom-5">
		<div class="container working-sec">
			<h2 class=" text-center"><?php echo $page->title; ?></h2>
				<?php  echo $page->content; ?>
		</div>
	</section>
<section class="featured-section padding-top-bottom-5">
	<div class="container featured-coaches">
		<h2 class="text-center">professional tennis players</h2>
		<hr class="main-heading"/>
		<div class="row">
			
			@foreach($coaches as $coach)
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 coaches-icons">
				<div class="single-portfolio play_pro_coaches">
					<?php $name = strtolower($coach->name);
					$name = str_replace(' ','-',$name);  
					
					?>
					
					 
					@if($coach->profile_image)
					 
						<img src="{{url('/coach-thumb/'.$coach->profile_image)}}/265/264" alt="" width="265px;" height="264px;"/>
					 
					@else
 
						<img src="{{url('/coach-thumb/no-image.jpg')}}/265/264" alt="" width="265px;" height="264px;" />  
					@endif
							 				
						<div class="portfolio-link">
							<ul class="coache-title">
								<?php 
								
									if(!empty($coach->name)) {
										$full_name_coach = ucfirst($coach->name) ;
									}				
											 	
									$pro_message_url = str_replace(' ','-',$full_name_coach)
									?>
										<li class="name" ><b>{{$full_name_coach}}</b></li>
										
										<li class="city-name">Nationality: <b>{{$coach->nationality}}</b></li>	
										<a class="pro-link" href="{{$coach->link}}" target="_blank"><b>Click for full bio</b></a>
									</ul>
									 

							<a href="{{LaravelLocalization::localizeURL('book-appointment')}}/{{strtolower($pro_message_url)}}/{{$coach->id}}" class="view-btn">Check availability</a>
								</div>
							</div>
						</div>
						@endforeach 
					</div>
					
				</div><!-- coaches -->
			</section>
@include('includes.footer')
@endsection
