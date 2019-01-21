@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
       <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right">
            <div class="panel panel-default clearfix">
                <div class="panel-heading"><?php echo Lang::get('changePassword.Change_Password'); ?></div>
				<div class="col-md-9 col-md-offset-1 form-container">
                <div class="panel-body">
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

                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/users/change') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
<!--
                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('first_name') }}">
                            </div>
                        </div>
-->
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo Lang::get('changePassword.current_password') ?></label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="current_password">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo Lang::get('changePassword.new_password') ?></label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"><?php echo Lang::get('changePassword.password_confirmation') ?></label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        
                        

                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-success my-buttons">
                                    <?php echo Lang::get('changePassword.Change_Password') ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
