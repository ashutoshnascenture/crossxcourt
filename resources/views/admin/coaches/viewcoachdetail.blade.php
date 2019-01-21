 @extends('admin')
 @section('content')
 <style>

 </style>
 <div class="content-wrapper">

 	<section class="content-header">
 		<!-- <a href="">View account information</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="">Profile</a> -->
    </section>
 	</section>
 	<section class="content">     
 		<div class="inner-content">
<?php //echo "<pre>"; print_r($coach) ; die;  ?>

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
 			
 			<form class="form-horizontal" role="form" method="" action="">
				<div class="table-responsive">
				<table class="table table-bordered product-create-table table-striped">
				@if(!empty($coach))
					<thead>
						<tr>
							<th style="width:60%"><?php echo Lang::get('coachProfile.image'); ?></th>
							@if(!empty($coach->profile_image))
							<td><img src="{{url('/coach-thumb/'.$coach->profile_image)}}/100/100" alt="" width="100px;" height="100px;"/></td>
							@else
							<td><?php echo Lang::get('coachProfile.no_image'); ?></td>
							@endif
						</tr>
					</thead>
					<tbody>
						<tr>
							<th><?php echo Lang::get('coachProfile.nationality'); ?></th>
							<td>{{ucfirst($coach->nationality)}}</td>
						</tr>
					
				
						<tr>
							<th><?php echo Lang::get('coachProfile.tennis_qualification'); ?></th>
							<td>{{ ($coach->tennis_qualification)}}</td>
						</tr>
					
		


				
						<tr>
							<th><?php echo Lang::get('coachProfile.tennis_experience'); ?></th>
							<td>{{ ($coach->tennis_experience)}}</td>
						</tr>
					


				
						<tr>
							<th><?php echo Lang::get('coachProfile.languages'); ?></th>
							<td>{{ ($coach->languages)}}</td>
						</tr>
					

					
						<tr>
							<th><?php echo Lang::get('coachProfile.teaching_level'); ?></th>
							<?php    $teaching_level =  str_replace('_',' ',$coach->teaching_level) ; ?>
							<td>@if(!empty($teaching_level)) {{ ($teaching_level)}}@endif</td>
						</tr>
					


					
						<tr>
							<th><?php echo Lang::get('coachProfile.teach_age_player'); ?></th>
							<?php    $teach_age_player =  str_replace('_',' ',$coach->teach_age_player) ; ?>
							<td>@if(!empty($teach_age_player)){{ ($teach_age_player)}}@endif</td>
						</tr>
			



			
						<tr>
							<th><?php echo Lang::get('coachProfile.motto'); ?></th>
							<td>{{ ($coach->motto)}}</td>
						</tr>
				


			
						<tr>
							<th><?php echo Lang::get('coachProfile.favourite_player'); ?></th>
							<td>{{ ($coach->favourite_player)}}</td>
						</tr>
				


				
						<tr>
							<th><?php echo Lang::get('coachProfile.coaching_style'); ?></th>
							<td>{{ ($coach->coaching_style)}}</td>
						</tr>
				


					
						<tr>
							<th><?php echo Lang::get('coachProfile.playing_abliltiy'); ?></th>
							<td>{{ ($coach->playing_abliltiy)}}</td>
						</tr>
				

					
						<tr>
							<th><?php echo Lang::get('coachProfile.about_me'); ?></th>
							<td>{{ ($coach->about_me)}}</td>
						</tr>
					

						<tr>
							<th>Service area</th>
							<td>{{ ($coach->service_area)}}</td>
						</tr>
					

					
						<tr>
							<th><?php echo Lang::get('coachProfile.court_details'); ?></th>
							<td>{{ ($coach->court_details)}}</td>
						</tr>
					

				
						<tr>
							<th>Price</th>
							<td>{{ ($coach->price)}}</td>
						</tr>
				
						</tbody>
					<!-- <thead>
						<tr>
							<th>Reviews</th>
							<th>{{ ($coach->reviews)}}</th>
						</tr>
					</thead>

					<thead>
						<tr>
							<th>Reviews</th>
							<th>{{ ($coach->reviews)}}</th>
						</tr>
					</thead> -->


					@else
					No record found
					@endif
				</table>
				<div class="form-group" style="margin-left: -5px;">
					<div class="col-md-10">

					<a href="{{URL::to('admin/coaches')}}" class="btn btn-primary">Cancel</a>

					</div>
				</div>
			</form>
			
 		</div>
 	</section>
 </div>

 @endsection
