 @extends('admin')
 @section('content')
 <style>

 </style>
 <div class="content-wrapper">

 	<section class="content-header">

<a href="{{URL::to('admin/coaches/show')}}/{{$coach->id}}">View account information</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ url('admin/coaches/viewcoachdetail')}}/{{$coach->id}}">Profile</a>
&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="{{URL::to('admin/coaches/paymentinfo')}}/{{$coach->id}}">Payment information</a>
&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="{{URL::to('admin/coaches/viewprice')}}/{{$coach->id}}">Price</a>
&nbsp;&nbsp;|&nbsp;&nbsp; 
<a href="{{URL::to('admin/coaches/booking')}}/{{$coach->id}}">Bookings</a>
<!--
&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="{{URL::to('admin/coaches/hours-log')}}/{{$coach->id}}">Hours logged</a>
-->

    </section>
 	</section>
 	<section class="content">     
 		<div class="inner-content">


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
					<tbody>
						<tr>
							<td><?php echo Lang::get('registerCoach.first_name'); ?></td>
							<td>{{ucfirst($coach->first_name)}}</th>
						</tr>
					
				
						<tr>
							<td><?php echo Lang::get('registerCoach.last_name'); ?></td>
							<td>{{ucfirst($coach->last_name)}}</td>
						</tr>
				
					
						<tr>
							<td><?php echo Lang::get('registerCoach.email'); ?></td>
							<td>{{ ($coach->email)}}</td>
						</tr>
				
		


						<tr>
							<td><?php echo Lang::get('registerCoach.mobile'); ?></td>
							<td>{{ ($coach->mobile)}}</td>
						</tr>
				


				
						<tr>
							<td><?php echo Lang::get('registerCoach.address'); ?></td>
							<td>{{ ($coach->address)}}</td>
						</tr>
					

					
						<tr>
							<td><?php echo Lang::get('registerCoach.post_code'); ?></td>
							<td>{{ ($coach->post_code)}}</td>
						</tr>
				


					
						<tr>
							<td><?php echo Lang::get('registerCoach.country'); ?></td>
							  
									@foreach($countries as $country)
										@if($country->sortname == $coach->country  )
											<td>{{$country->name}}</td>
										@endif
									@endforeach
							 
							  
						</tr>
					



			
						<tr>
							<td><?php echo Lang::get('registerCoach.state'); ?></td>
							<td>{{ ($coach->state)}}</td>
						</tr>
				


						<tr>
							<td><?php echo Lang::get('registerCoach.city'); ?></td>
							<td>{{ ($coach->city)}}</td>
						</tr>
					</tbody>
				</table>
				</div>
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
