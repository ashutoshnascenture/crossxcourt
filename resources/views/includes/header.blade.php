<header>
		
	 <nav class="navbar navbar-inverse my-navigation">
	  <div class="container">		
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand logo-brand" href="{{URL::to('/')}}"><img class="img-responsive" alt="logo" src="{{asset('images/crossXcourt-logo.png')}}">
		  </a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right toplisting">
				 
				
				@if (Auth::guest())
				   <li><a class="sing" href="{{ url('/users/register') }}"> <?php echo Lang::get('homeNavbar.become_a_coach'); ?></a></li>
					<li><a href="{{URL::to('/how-it-work')}}"><?php echo Lang::get('homeNavbar.how_it_works'); ?></a></li>
					<li><a role="button" href="{{ url('/customer/register') }}"><?php echo Lang::get('homeNavbar.sign_up'); ?></a></li>
<!--
					<li><a href="{{ url('/users/register') }}">Apply to coach</a></li>
-->
					<li><a role="button" class="login" href="{{ url('/auth/login') }}"><?php echo Lang::get('homeNavbar.log_in'); ?></a></li> 
				
				@elseif(Auth::check() && Auth::user()->role_id == 2)
				<?php $coach = Helper::profile_image();	 
				 			
				?>
				@if(!empty($coach->user_id))  
					<!-----------------messages------------------> 
					
					<?php
					$field='read_customer';
					if(Auth::user()->hasRole('Coach'))
					{
						$field = 'read_coach';
					}
					   
				    $messages_count = Helper::notification($field);
						
					 ?>

					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('homeNavbar.message'); ?>
						
						@if($messages_count)
							<span class="badge">{{$messages_count}}</span>
							
						@endif
						<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
						    <li><a href="{{ url('add_message/') }}"><?php echo Lang::get('homeNavbar.compose'); ?></a></li>
							<li><a href="{{ url('messages/') }}"><?php echo Lang::get('homeNavbar.inbox'); ?></a></li>
<!--
							<li><a href="{{ url('outbox/') }}"><?php //echo Lang::get('homeNavbar.outbox'); ?></a></li>
-->
						</ul>
					 </li>

					<!------------------------messages------------------>
					@if(!empty($coach->is_active))
					<li><a href="{{ url('/coaches/lessons')}}" id="setting"><?php echo Lang::get('homeNavbar.lessons'); ?></a></li>
					@else
					<li><a href="{{ url('/coaches/pending-review')}}" id="setting"><?php echo Lang::get('homeNavbar.lessons'); ?></a></li>
					@endif
					<li><a href="{{ url('/users/profile')}}" id="setting"><?php echo Lang::get('homeNavbar.profile'); ?></a></li>
					<li><a href="{{ url('/users/account-information/')}}"><?php echo Lang::get('homeNavbar.account'); ?></a></li>
					 
                    
                    <li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>  
                   @else
                   <li><a href="{{ url('/users/profile')}}" id="setting"><?php echo Lang::get('homeNavbar.profile'); ?></a></li>
					
                    <li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>  
                 
                   @endif 
                  @elseif(Auth::check() && Auth::user()->role_id == 3)	
                  <?php
					$field='read_customer';
					if(Auth::user()->hasRole('Customer'))
					{
						$field = 'read_customer';
					}
					   
				    $messages_count = Helper::notification($field);
						
					 ?>

					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo Lang::get('homeNavbar.message'); ?>
						
						@if($messages_count)
							<span class="badge">{{$messages_count}}</span>
							
						@endif
						<span class="caret"></span>
						</a>
						<ul class="dropdown-menu" role="menu">
						    <li><a href="{{ url('add_message/') }}"><?php echo Lang::get('homeNavbar.compose'); ?></a></li>
							<li><a href="{{ url('messages/') }}"><?php echo Lang::get('homeNavbar.inbox'); ?></a></li>
<!--
							<li><a href="{{ url('outbox/') }}"><?php //echo Lang::get('homeNavbar.outbox'); ?></a></li>
-->
						</ul>
					 </li>
				
					<li><a href="{{ url('/customer')}}" id="setting"><?php echo Lang::get('homeNavbar.lessons'); ?></a></li>
					<li><a href="{{ url('/customer/edit')}}" id="setting"><?php echo Lang::get('homeNavbar.profile'); ?></a></li>
					<li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>  
				
				@elseif(Auth::check() && Auth::user()->role_id == 1)
				
				 <li><a href="{{ url('/admin/home')}}" id="setting">Admin</a></li>
				 <li><a href="{{ url('/auth/logout') }}"><?php echo Lang::get('homeNavbar.logout'); ?></a></li>  
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
						<!--<li><a href="<?php //echo URL::to('coaches/my-currency/EUR');?>"><i class="fa fa-eur" aria-hidden="true"></i></a></li>
						<li><a href="<?php //echo URL::to('coaches/my-currency/USD');?>"><i class="fa fa-usd" aria-hidden="true"></i></a></li>
						<li><a href="<?php //echo URL::to('coaches/my-currency/GBP');?>"><i class="fa fa-gbp" aria-hidden="true"></i></a></li>-->
						
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
				
		  </ul><!--main ul ends -->
		  
		  
		  
		</div>
		
	  </div>
	</nav>
</header>
