 @extends('app')

 @section('content')
 
 <div class="container">
 	<div class="contact-form messages-form col-md-8 col-sm-12 col-xs-12 margin-top-bottom-5"> 
 		<h3 class="contact-title"><?php echo Lang::get('registerCoach.message_to_admin');?> 
 			
 		</h3>
 		
 		&nbsp;
 		<?php 
 		$name = strtolower($coach->name);
 		$name = str_replace('-',' ',$name);
 		$fullname =   Lang::get('registerCoach.book_appointment') . '&nbsp;'  . $name ;
 		
 		?>
 		<h3 class="contact-title"> 
 		{{ $fullname }}
 		</h3>
 		
 		<?php 

 		$action = URL::to('customer/login');
 		if(Auth::user()){
 			$action = URL::to('message/add');
 		}
 		
 		?>
 		
 		@if(count($errors) > 0)
 		<br><br>
 		<div class="alert alert-danger">
 			<strong><?php echo Lang::get('registerCoach.Whoops!'); ?></strong> <?php echo Lang::get('registerCoach.error'); ?>.<br><br>
 			<ul>
 				@foreach ($errors->all() as $error)
 				<li>{{ $error }}</li>
 				@endforeach
 			</ul>
 		</div>
 		@endif
 		
 		@if(Auth::user())	
 		
 		<form action="{{LaravelLocalization::localizeURL('send_message')}}" method="POST" class="messageForm">
 			
 			<input type="hidden" name="_token" value="{{ csrf_token() }}">
 			<input type="hidden" name="to" value="{{ $admin->id }}">
 			 
 			<div class="form-group">
 				
 				<textarea name="message" id="msg" class="message-box form-control" cols="" rows="5">{{{ $fullname or ''  }}}</textarea>
 			</div>
 			
 			<input type="submit" class="btn my-buttons" value="Send" name="Send">
 			
 		</form>	
 		
 		@else 
 		<div id="login-data" class="customerInfo">
 			
 			<form class="" role="form" method="POST" action="{{ LaravelLocalization::localizeURL('/customer/login') }}">
 				
 				<div class="form-group">
 					
 					<textarea name="message" id="msg" class="message-box form-control" cols="" rows="5">{{old('message')}}</textarea>
 				</div>
 				
 				<br/>
 				<h3><?php echo Lang::get('registerCoach.login_details'); ?></h3>
 				<br/>
 				<input type="hidden" name="coach_id" value="{{ $coach->id }}">
 				<input type="hidden" name="_token" value="{{ csrf_token() }}">
 				
 				<div class="form-group">
 					<label><?php echo Lang::get('registerCoach.email'); ?></label>
 					<div class="label-text">
 						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
 					</div>
 				</div>
 				

 				<div class="form-group">
 					<label><?php echo Lang::get('registerCoach.password'); ?></label>
 					<div class="label-text">
 						<input type="password" class="form-control" name="password">
 					</div>
 				</div>
 				
 				<div class="form-group">
 					<button type="submit" class="btn btn-success join sign">
 						<?php echo Lang::get('registerCoach.sign_in_send'); ?>
 					</button>
 					<a href="javascript:void(0)" id="register" class="customerOption"><b><?php echo Lang::get('registerCoach.donot_have_account'); ?></b></a> 
 					
 				</div>
 			</form>
 			
 		</div>
 		
 		<div id="register-data" style="display:none" class="customerInfo">
 			
 			<div class="form-group">
 				
 				<textarea name="message" id="msg" class="message-box form-control" cols="" rows="5">{{old('message')}}</textarea>
 			</div>
 			
 			<br/>
 			<h2><?php echo Lang::get('registerCoach.sign_up'); ?></h2>
 			<br/>
 			
 			<form class="" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/customer/store') }}">
 				<input type="hidden" name="_token" value="{{ csrf_token() }}">
 				
 				<div class="form-group required">
 					<label><?php echo Lang::get('registerCoach.first_name'); ?></label>
 					<div class="label-text">
 						<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}">
 					</div>
 				</div>

 				<div class="form-group required">
 					<label><?php echo Lang::get('registerCoach.last_name'); ?></label>
 					<div class="label-text">
 						<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
 					</div>
 				</div>
 				

 				<div class="form-group required">
 					<label><?php echo Lang::get('registerCoach.email'); ?></label>
 					<div class="label-text">
 						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
 					</div>
 				</div>
				
				 <div class="form-group required">
                        <label for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
				</div>
                    
 				<div class="form-group required">
 					<label><?php echo Lang::get('registerCoach.password'); ?></label>
 					<div class="label-text">
 						<input type="password" class="form-control" name="password">
 					</div>
 				</div>

 				<div class="form-group required">
 					<label><?php echo Lang::get('registerCoach.password_confirmation'); ?></label>
 					<div class="label-text">
 						<input type="password" class="form-control" name="password_confirmation">
 					</div>
 				</div>

 				<div class="form-group">
 					
 					<button type="submit" class="btn btn-success join sign">
 						Sign up and send
 					</button>
 					<a href="javascript:void(0)" id="login" class="customerOption"><b><?php echo Lang::get('registerCoach.already_register_login'); ?></b></a> 
 				</div>
 			</form>
 		</div>
 		@endif
 		
 	</div>
 	
 	<div class="contact-address messages-right-section col-md-4  col-sm-12 col-xs-12 margin-top-bottom-5"> 
 		<h4><?php echo Lang::get('registerCoach.frequently_questions'); ?></h4>
 		<div class="accordian-left-section">
 			
 			<div class="panel-group" id="accordion">
 				<div class="panel panel-default">
 					<div class="panel-heading">
 						<h4 class="panel-title" style="font-size:15px;text-align: justify;">
 							<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
 								<?php echo Lang::get('registerCoach.how_do_i_know_available'); ?>
 								
 							</a>
 						</h4>
 					</div>
 					<div id="collapseOne" class="panel-collapse collapse in">
 						<div class="panel-body" style="text-align: justify;">
 							<?php echo Lang::get('registerCoach.how_do_i_know_available_text'); ?>

 						</div>
 					</div>
 				</div>
 				<div class="panel panel-default">
 					<div class="panel-heading">
 						<h4 class="panel-title" style="font-size:15px ; text-align: justify;">
 							<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
 								<?php echo Lang::get('registerCoach.how_do_i_know_the_price'); ?>
 								
 							</a>
 						</h4>
 					</div>
 					<div id="collapseTwo" class="panel-collapse collapse">
 						<div class="panel-body" style="text-align: justify;">
 						<?php echo Lang::get('registerCoach.how_do_i_know_the_price_text'); ?>

 						</div>
 					</div>
 				</div>
 				<div class="panel panel-default">
 					<div class="panel-heading">
 						<h4 class="panel-title" style="font-size:15px ; text-align: justify;">
 							<a class="accordion-toggle coaches-togle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
 								
 								<?php echo Lang::get('registerCoach.is_not_available'); ?> 	
 								
 							</a>
 						</h4>
 					</div>
 					<div id="collapseThree" class="panel-collapse collapse">
 						<div class="panel-body" style="text-align: justify;">
 							<?php echo Lang::get('registerCoach.is_not_available_text'); ?> 	

 						</div>
 					</div>
 				</div>
 			</div>
 		</div><!-- section accordian left ends -->
 		<div class="well mesage-well text-center">
 			  <h4> <?php echo Lang::get('registerCoach.no-questions'); ?></h4>
 			<a href="{{LaravelLocalization::localizeURL('customer/register')}}" class="btn btn-danger get-started-btn margin-top-5"><?php echo Lang::get('registerCoach.get_started'); ?></a>
 		</div>
 		
<!--
 		<p>Questions for coachup ?</p>
 		<p>Need Help for finding or booking coach ?</p>
-->
 		<address> 
<!--
 			<a href="#">87657890</a>.<br>
-->
 			<p><?php echo Lang::get('registerCoach.Contact_us_with_any_questions'); ?></p>
 			 
 			<p><a href="tel:+44 7476 40 96 93">{{ Config::get('constants.UK_NO1') }}</a>&nbsp;&nbsp;&nbsp;<a href="tel:+1 (347) 589 9939">{{ Config::get('constants.USA_NO') }}</a></p>
 			<p><a href="skype:{{ Config::get('constants.SKYPE') }}?chat">Skype: {{ Config::get('constants.SKYPE') }}</a></p>
 			<p><a href="mailto:{{ Config::get('constants.SITE_EMAIL') }}"><i class="fa fa-envelope envelp" aria-hidden="true"></i> Send us a message</a></p>
 			
 		</address> 
 		 

 	</div>   
 </div>
 
 <script>
 	$(function(){
 		$('.customerOption').click(function(){
 			var id = $(this).attr('id');
 			$('.customerInfo').hide();
 			$('#'+id+'-data').show();
 			if(id != 'login'){
 				var action = siteUrl+'/customer/store';
 			}
 			else{
 				var action = siteUrl+'/customer/login';
 			}
 			$('.messageForm').attr('action',action);
 			
 		});
 		
 		
 		<?php if(Session::get('action')){ ?>
 			var id =  '<?php echo Session::get('action') ?>';
 			$('#'+id).trigger('click'); 
 			<?php } ?>
 		});
 	</script>
 	@include('includes.footer')
 	@endsection
