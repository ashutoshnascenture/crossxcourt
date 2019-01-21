@extends('app')
@section('content')

<div class="container-fluid">
	<div class="row">
		@include('includes.sidebar')

		<div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">


			<h2 class="student-title"><?php echo Lang::get('registerCoach.profile_edit'); ?></h2>
			<hr>
			<div class="col-md-9 form-container">
				<div class="panel-body">
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

					<form  role="form" method="POST" enctype="multipart/form-data" action="{{LaravelLocalization::localizeURL('customer/update')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">



						<div class="form-group required label-text-area">
							<label for="first_name"><?php echo Lang::get('registerCoach.first_name'); ?></label>
							<input type="text" class="form-control" name="first_name" id="first_name" value="{{ $customer->first_name }}">

						</div>

						<div class="form-group required label-text-area">
							<label for="last_name"><?php echo Lang::get('registerCoach.last_name'); ?></label>
							<input type="text" class="form-control" name="last_name"id="last_name" value="{{ $customer->last_name }}">

						</div>
<!-- 
						<div class="form-group required label-text-area">
							<label for="mobile"><?php //echo Lang::get('registerCoach.email'); ?></label>
							<input type="text" class="form-control" name="email" id="email" value="{{ $customer->email }}">

						</div> -->

						<div class="form-group required">
                        <label for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $customer->mobile }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_contact'); ?>">
                  		  </div>

							<div class="form-group">								
								<button type="submit" class="btn btn-success my-buttons">Save
								</button>									
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	@include('includes.footer')

	@endsection
