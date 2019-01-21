@extends('app')
@section('title','Customer Register')
@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-md-6 col-md-offset-3 forms-outer-container register-form-section margin-top-bottom-5">
        <div class="panel panel-default">
            <div class="panel-heading"> <h3><?php echo Lang::get('registerCoach.customer_register'); ?></h3></div>
            <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong><?php echo Lang::get('registerCoach.Whoops!'); ?></strong> <?php echo Lang::get('registerCoach.error'); ?>.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="" role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/customer/store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="url" value="1">

                    <div class="form-group required">
                        <label for="First_name"><?php echo Lang::get('registerCoach.first_name'); ?></label>

                        <input type="text" class="form-control" name="first_name" id="First_name" placeholder="<?php echo Lang::get('registerCoach.placeholder_firstname'); ?>" value="{{ old('first_name') }}">

                    </div>

                    <div class="form-group required">
                        <label for="Last_name"><?php echo Lang::get('registerCoach.last_name'); ?></label>

                        <input type="text" class="form-control" name="last_name" id="Last_name" placeholder="<?php echo Lang::get('registerCoach.placeholder_lastName'); ?>" value="{{ old('last_name') }}">

                    </div>


                    <div class="form-group required">
                        <label for="Emaill"><?php echo Lang::get('registerCoach.email'); ?></label>

                        <input type="email" class="form-control" id="Emaill" name="email" placeholder="<?php echo Lang::get('registerCoach.placeholder_email'); ?>"  value="{{ old('email') }}">

                    </div>

                    <div class="form-group required">
                        <label for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_contact'); ?>">
                    </div>

                    <div class="form-group required">
                        <label for="passwrd"><?php echo Lang::get('registerCoach.password'); ?></label>

                        <input type="password" class="form-control" name="password" id="passwrd" placeholder="<?php echo Lang::get('registerCoach.placeholder_password'); ?>">

                    </div>

                    <div class="form-group required">
                        <label for="password_confirmation"><?php echo Lang::get('registerCoach.password_confirmation'); ?></label>

                        <input type="password" class="form-control" name="password_confirmation" placeholder="<?php echo Lang::get('registerCoach.placeholder_confirm_password'); ?>" id="password_confirmation">

                    </div>

                    <div class="form-group">

                        <button type="submit" class="btn btn-success">
                            <?php echo Lang::get('registerCoach.crossxcourt'); ?>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
