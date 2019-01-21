<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Find a tennis coach near you. CrossXcourt provides tennis coaching around the world for players of all abilities as well as group lessons and tennis vacations.">
	<meta name="author" content="">
	<title>Tennis wherever you travel. crossXcourt provides tennis coaches around the world</title>
	<meta name="image" content="http://crossxcourt.dieztennis.com/images/share.jpg" />
	
	
	<!-- facebook property	-->	

		<meta property="og:url" content="http://www.crossxcourt.com" />
		<meta property="og:title" content="crossXcourt: Tennis Wherever you Travel" />	
		<meta property="og:image" content="http://crossxcourt.dieztennis.com/images/share.jpg" />
		
		<meta property="og:description" content="Tennis Wherever you Travel: crossXcourt links players with coaches around the world so you can play tennis whenever, wherever." />	
		<meta property="og:site_name" content="www.crossxcourt.com" />
		
		
  <!-- facebook property	-->				
	

	<!-- <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet"> -->
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/font-awsome/css/font-awesome.css') }}">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,700italic,800' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/slick.css') }}">
	 
	<script src="{{asset('/js/2.1.3_jquery.min.js')}}" type="text/javascript"></script>
	 
	<script> var siteUrl = '{{ url("/") }}';</script>
	 
	<meta name="google-site-verification" content="OBr_miKakwqe7gGUslW9MyCdpTPDlqwMZFWPjOLjfE0" />
</head>
<body>
	<!--*******************header*****************-->
	<div class="wrapper" id="main-container">
		<header class="header">
			<div class="banner">
				<div class="container">
			
					<div class="menu-section navbar navbar-default">
						<div class="logo-box-top navbar-header pull-left">
							<a class="navbar-brand logo-img" href="">
								<img class="img-responsive" alt="logo" src="images/crossXcourt-logo.png" width="190" height="37"></a>
							</div>

							<ul class="toplisting top-section-menu pull-right ring">


								@if (Auth::guest())
								<li><a class="sing" href="{{ url('/users/register') }}"> <?php echo Lang::get('homeNavbar.become_a_coach'); ?> </a></li>
								<li><a href="{{URL::to('/how-it-work')}}"><?php echo Lang::get('homeNavbar.how_it_works'); ?></a></li>
								<li><a role="button" href="{{ url('/customer/register') }}"><?php echo Lang::get('homeNavbar.sign_up'); ?></a></li>
								<li><a role="button" href="{{ url('/auth/login') }}"><?php echo Lang::get('homeNavbar.log_in'); ?> </a></li>



								@elseif(Auth::check() && Auth::user()->role_id == 2)
								<?php 
								$coach = Helper::profile_image();	 
				 			
								?>
								@if(!empty($coach->user_id)) 
								
								@if(!empty($coach->is_active)) 
								<li><a href="{{ url('/coaches/lessons')}}" id="setting"><?php echo Lang::get('homeNavbar.lessons'); ?></a></li>
								@else
								<li><a href="{{ url('/coaches/pending-review')}}" id="setting"><?php echo Lang::get('homeNavbar.lessons'); ?></a></li>
								@endif
								<li><a href="{{ url('/users/profile')}}" id="setting"><?php echo Lang::get('homeNavbar.profile'); ?></a></li>
								<li><a href="{{ url('/users/account-information/')}}"><?php echo Lang::get('homeNavbar.account'); ?></a></li>

                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ ucfirst(Auth::user()->first_name) }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu"> -->
                        	<!--<li><a href="{{ url('/users/changepassword/')}}"> Change Password</a></li>-->
                        	<!--<li><a href="{{ url('/users/editprofile/')}}"> Edit Profile</a></li>-->
                        	<li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>
                     <!--    </ul>
                 </li> -->
                  @else
                   <li><a href="{{ url('/users/profile')}}" id="setting"><?php echo Lang::get('homeNavbar.profile'); ?></a></li>
					
                    <li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>  
                 
                   @endif 

                 @elseif(Auth::check() && Auth::user()->role_id == 3)	
                 <li><a href="{{ url('/customer')}}" id="setting"><?php echo Lang::get('homeNavbar.lessons'); ?></a></li>

                 <li><a href="{{ url('/customer/edit')}}" id="setting"><?php echo Lang::get('homeNavbar.profile'); ?></a></li>

                 <li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>


                 @elseif(Auth::check() && Auth::user()->role_id == 1)

                 <!-- <li><a href="{{ url('/admin/home')}}" id="setting">Home</a></li> -->
                 <li><a href="{{ url('/admin/home')}}" id="setting">admin</a></li>
                 <li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li></a></li>
                
                 @endif
				  <li class="dropdown language">
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Lang
					<span class="caret"></span>
				</button>
			<?php
			$current_url = parse_url(LaravelLocalization::getNonLocalizedURL(Request::url()));       
    ?>

       
      <ul id="languageSwitcher" class="dropdown-menu language-down" role="menu" aria-labelledby="menu1">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
           
          @if ($localeCode == 'en') 
              <li>
                  <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ url('/en'.$current_url['path'])}}">
			<!--  {{{ $properties['native'] }}} -->Eng
                  </a>
              </li>
          @else
              <li>
                  <a rel="alternate" hreflang="<% $localeCode %>" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                      <!-- {{{ $properties['native'] }}} -->Esp
                  </a>
              </li>
          @endif
      @endforeach
      </ul>
				</li>
				

				  
				  <li class="dropdown currency">
				@if(!empty(Session::get('myCurrency')))		 
					
					@if(Session::get('myCurrency') == 'USD') 
					<button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><i class="fa fa-usd" aria-hidden="true"></i>
					<span class="caret"></span></button>
					 
					@elseif(Session::get('myCurrency') == 'EUR')
					
					<button class="btn btn-default dropdown-toggle" type="button" id="menu2" data-toggle="dropdown"><i class="fa fa-eur" aria-hidden="true"></i>
					<span class="caret"></span></button>
					 
					@elseif(Session::get('myCurrency') == 'GBP')
					 
					<button class="btn btn-default dropdown-toggle" type="button" id="menu3" data-toggle="dropdown"><i class="fa fa-gbp" aria-hidden="true"></i>
					<span class="caret"></span></button>
					@endif
					
				@endif 
				
				
				 <ul class="dropdown-menu currency-down" role="menu" aria-labelledby="menu1">
					     <!--..............currency links..............-->
						<!--<li><a href="<?php echo URL::to('coaches/my-currency/EUR');?>"><i class="fa fa-eur" aria-hidden="true"></i></a></li>
						<li><a href="<?php echo URL::to('coaches/my-currency/USD');?>"><i class="fa fa-usd" aria-hidden="true"></i></a></li>
						<li><a href="<?php echo URL::to('coaches/my-currency/GBP');?>"><i class="fa fa-gbp" aria-hidden="true"></i></a></li>-->
						
						<?php 
						
						if(Request::input('cur')){
							$url =  Request::fullUrl();	
							$url = preg_replace('/([?&])cur=[^&]+(&|$)/','$1',$url);
					
							if(count(Request::all()) == 1){
								$url = $url.'cur=';
							}else{
								$url = $url.'&cur=';
							}							
						}
						else{
							$url = strstr(Request::fullUrl(),  '?')  ? Request::fullUrl().'&cur=' : Request::fullUrl().'?cur=';	
						}
						
						
						?>
						
						<li><a href="{{$url}}EUR"><i class="fa fa-eur" aria-hidden="true"></i></a></li>
						<li><a href="{{$url}}USD"><i class="fa fa-usd" aria-hidden="true"></i></a></li>
						<li><a href="{{$url}}GBP"><i class="fa fa-gbp" aria-hidden="true"></i></a></li>
						</ul>
					<!--..............currency links..............-->
					 <?php
      $current_url = parse_url(LaravelLocalization::getNonLocalizedURL(Request::url()));
			?>
			</ul>
				</li>
				

					
        </ul><!-- main ul -->	
						 

         </div>
		 
		 

         <!--header-->
         <!--content-->
         @yield('content')
         <!--content-->
         <!--footer-->
         @include('includes.footer')
         <!--footer-->		
	
	
	
	<script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/custom.js')}}" defer></script>
	<script src="{{asset('/js/slick.js')}}" type="text/javascript" charset="utf-8" defer></script>
	
	<script type="text/javascript">
		$(document).on('ready', function() {
			$(".regular").slick({
				dots: true,
				infinite: true,
				slidesToShow: 3,
				slidesToScroll: 3
			});
		});
	</script>
     </body>
     </html>
