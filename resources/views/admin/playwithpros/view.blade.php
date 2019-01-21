@extends('admin')
@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h2>View Pro User detail</h2>
		<p class="pull-right">
			<!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
		</p>
	</section>
	<!-- Main content -->
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
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Profile Image</th>
							@if(!empty($pro->profile_image))
							<td><img src="{{url('/coach-thumb/'.$pro->profile_image)}}/200/200" alt="" /></td>
							@else
							<td></td>
							@endif
						</tr>
					</thead>
									
					<tbody>
					
						<tr>
							<th>Name</th>
							<td>{{ucfirst($pro->name)}}</td>
						</tr>
					
						<tr>
							<th>Nationality</th>
							<td>{{ucfirst($pro->nationality)}}</td>
						</tr>
					

						<tr>
							<th>Age</th>
							<td>{{ ($pro->age)}}</td>
						</tr>

				
						<tr>
							<th>Highest Career Ranking</th>
							<td>{{ ($pro->highest_career_ranking)}}</td>
						</tr>
					
				
						<tr>
							<th>Link</th>
							<td>{{ ($pro->link)}}</td>
						</tr>
					
					
						<tr>
							<th>Playing Style</th>
							<td>{{ ($pro->playing_style)}}</td>
						</tr>
					
					
						<tr>
							<th>Turned Pro</th>
							<td>{{ ($pro->turned_pro)}}</td>
						</tr>
				
					 
				</thead>	
				</table>
				</div>
				<div class="form-group" style="margin-left: -5px;">
					<div class="col-md-10">

					<a href="{{URL::to('admin/play-with-pro')}}" class="btn btn-primary">Cancel</a>

					</div>
				</div>
			</form>

		</div>
	</section>
</div>

@endsection
