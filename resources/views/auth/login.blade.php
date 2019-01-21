@extends('app')
<?php //$meta['title'] = 'crossXcourt | sign in'; ?>
@section('content')


<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 forms-outer-container login-form-section margin-top-bottom-5">
			<div class="panel panel-default">
				<div class="panel-heading"><h3><?php echo Lang::get('registerCoach.login'); ?></h3></div>
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

					<form class="" role="form" method="POST" action="{{ LaravelLocalization::localizeURL('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label for="email"><?php echo Lang::get('registerCoach.email'); ?></label>
							<input type="email" class="form-control" name="email" id="email"placeholder="<?php echo Lang::get('registerCoach.placeholder_email'); ?>" value="{{ old('email') }}">
						</div>

						<div class="form-group">
							<label for="password"><?php echo Lang::get('registerCoach.password'); ?></label>
							<input type="password" class="form-control" name="password" id="password" placeholder="<?php echo Lang::get('registerCoach.placeholder_password'); ?>">
						</div>

						<div class="form-group">
							
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> <?php echo Lang::get('registerCoach.remember_me'); ?>
									</label>
								</div>
							
						</div>

						<div class="form-group">
							
								<button type="submit" class="btn btn-success"><?php echo Lang::get('registerCoach.login'); ?></button>

								<a class="btn btn-link pull-right" href="{{ url('/password/email') }}"><?php echo Lang::get('registerCoach.forgot_passsword'); ?></a>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
