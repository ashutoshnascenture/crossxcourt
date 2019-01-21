@extends('admin')
@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h2>View customer detail</h2>
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
							<th>First name</th>
							<td>{{ucfirst($customer->first_name)}}</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Last name</th>
							<td>{{ucfirst($customer->last_name)}}</td>
						</tr>
					
						<tr>
							<th>Email</th>
							<td>{{ ($customer->email)}}</td>
						</tr>
					</tbody>
				</table>
				</div>
				<div class="form-group" style="margin-left: -5px;">
					<div class="col-md-10">

					<a href="{{URL::to('admin/users')}}" class="btn btn-primary">Cancel</a>

					</div>
				</div>
			</form>

		</div>
	</section>
</div>

@endsection
