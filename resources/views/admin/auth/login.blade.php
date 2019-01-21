<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>crossXcourt</title>

	<link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/font-awsome/css/font-awesome.css') }}">
	
	<script src="{{asset('/js/2.1.3_jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
	
	<script> var siteUrl = '{{ url("/") }}'; </script>
</head>
<body>
<!--<div class="wrapper-login">
			<span class="logo-sec-small"><img src="{{ url('/') }}/images/admin-logo.png" alt="logo"></span>
			<div class="box-container container">
					<h1>Login</h1>
				<div class="form-section">	
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
				<form class="form-horizontal" role="form" method="POST" action="{{ url('admin/auth/dologin') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
					<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
				  </div>
				  <div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password">
				  </div>
				   <div class="form-group">
					<button type="submit" class="btn btn-success login">Submit</button>
					</div>
					<span class="checkbox">
						<label><input type="checkbox" value="" name="remember">Remember</label>
					</span>
					<a class="forgot" href="{{ url('/password/email') }}">Forgot Password ?</a>
				</form>
				</div>
			</div>
			
</div>-->
<div class="col-md-4 col-md-offset-4 forms-outer-container margin-top-bottom-5">
<span class="logo-sec-small"><img src="{{ url('/') }}/images/admin-logo.png" alt="logo"></span>
			<div class="panel panel-default  margin-top-5">
				<div class="panel-heading"><h3>Login</h3></div>
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
			<div class="form-section padding-all">
				<form class="" role="form" method="POST" action="{{ url('admin/auth/dologin') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="form-group">
					<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
				  </div>
				  <div class="form-group">
					<input type="password" class="form-control" placeholder="Password" name="password">
				  </div>
				   <div class="form-group">
					<button type="submit" class="btn btn-success login">Submit</button>
					</div>
					<span class="checkbox">
						<label><input type="checkbox" value="" name="remember">Remember</label>
					</span>
					<a class="forgot" href="{{ url('/password/email') }}">Forgot Password ?</a>
				</form>
				</div>
				</div>
			</div>
		</div>

	</body>
</html>		
