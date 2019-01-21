@extends('app')
@section('title','Change-Password')
@section('content')
@include('includes.sidebar')
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
            <h2><?php echo Lang::get('changePassword.Change_Password'); ?></h2>
            <hr>
				<div class="col-md-9 form-container">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong><?php echo Lang::get('changePassword.Whoops') ?></strong><?php echo Lang::get('changePassword.error') ?><br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif 

                    <form class="" role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('customer/change') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                         

                        <div class="form-group required label-text-area">
                            <label for="current_password"><?php echo Lang::get('changePassword.current_password') ?></label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="<?php echo Lang::get('changePassword.current_password') ?>">
                        </div>
                        <div class="form-group required label-text-area">
                            <label for="new_password"><?php echo Lang::get('changePassword.new_password') ?></label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="<?php echo Lang::get('changePassword.new_password') ?>">
                        </div>
                        <div class="form-group required label-text-area">
                            <label for="password_confirmation"><?php echo Lang::get('changePassword.password_confirmation') ?></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="<?php echo Lang::get('changePassword.password_confirmation') ?>" >
                        </div>
                        <button type="submit" class="btn btn-success my-buttons">
                            <?php echo Lang::get('changePassword.save') ?>
                        </button>
                    </form>
				</div>
        </div>
    </div>
</div>
</div>
 @include('includes.footer')
@endsection
