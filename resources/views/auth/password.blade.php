@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 forms-outer-container password-section margin-top-bottom-5">
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo Lang::get('registerCoach.reset_password');?></div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

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

					<form class="" role="form" method="POST" action="{{ url('/password/email') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label for="email-1"><?php echo Lang::get('registerCoach.email'); ?></label>
							
							<input type="email" class="form-control" name="email" id="email-1" placeholder="<?php echo Lang::get('registerCoach.placeholder_email'); ?>" value="{{ old('email') }}">
						
						</div>

						<div class="form-group">
							
								<button type="submit" class="btn btn-success">
									<?php echo Lang::get('registerCoach.send_password_reset_link');?>
								</button>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
