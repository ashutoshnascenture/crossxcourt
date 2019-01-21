@extends('userLayout')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('user/store') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group required">
							<label class="col-md-4 control-label" for="name">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
							</div>
						</div>

						<div class="form-group required">
							<label class="col-md-4 control-label" for="email">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
							</div>
						</div>

						<div class="form-group required">
							<label class="col-md-4 control-label" for="password">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" id="password">
							</div>
						</div>

						<div class="form-group required">
							<label class="col-md-4 control-label" for="password_confirmation">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label" for="country">Country</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="country" id="country">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="age">Age</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="age" id="age">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label" for="sex">Sex </label>
							<div class="col-md-6">
								<select class="form-control" name="sex " id="sex">
									<option value="">-select-</option>
									<option>Male</option>
									<option>Semale</option>
								</select> 
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label" for="investing_skill_level">Investing skill level </label>
							<div class="col-md-6">
								<select class="form-control" name="investing_skill_level " id="investing_skill_level">
									<option value="">-select-</option>
									<option>Beginner</option>
									<option>Intermediate</option>
									<option>Advanced</option>
								</select> 
							</div>
						</div>
						 
						<div class="form-group">
							<label class="col-md-4 control-label" for="Investment">Investment</label>
							<div class="col-md-7">
								<label class="checkbox-inline">
								  <input type="checkbox" value="index funds" name="investment[]"> Index funds
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline">
								  <input type="checkbox" value="mutual funds" name="investment[]"> Mutual funds
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline">
								  <input type="checkbox" value="stocks" name="investment[]"> Stocks
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline" name="investment[]">
								  <input type="checkbox" value="ETFs" name="investment[]"> ETFs
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline">
								  <input type="checkbox" value="Commodities" name="investment[]"> Commodities
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline">
								  <input type="checkbox" value="currencies" name="investment[]"> Currencies
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline">
								  <input type="checkbox" value="binary options" name="investment[]"> Binary options
								</label>
								&nbsp;&nbsp;
								<label class="checkbox-inline">
								  <input type="checkbox" value="real estate" name="investment[]"> Real estate
								</label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-4 control-label" for="subscribe_newsletter">Subscribe newsletter</label>
							<div class="col-md-6">
								<input type="checkbox" name="subscribe_newsletter" id="subscribe_newsletter">
							</div>
						</div>
						 
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.checkbox-inline{margin-left:0px!important;}
</style>
@endsection
