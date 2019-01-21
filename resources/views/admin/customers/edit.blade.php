@extends('admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit customer</div>
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

                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{URL::to('admin/customers/update')}}/{{$customer->id}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">



                        <div class="form-group">
                            <label class="col-md-3">First name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="first_name" value="{{ $customer->first_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3">Last name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="last_name" value="{{ $customer->last_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3">E-mail address</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mobile" value="{{ $customer->email }}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-3">Confirm password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="confirm_password" value="">
                            </div>
                        </div>

                        



                    <div class="form-group">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Update
                            </button>
                            <!--
							<a href="{{URL::to('users/success')}}" class="btn btn-primary"><?php echo Lang::get('registerCoach.cancel'); ?></a>
-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

 
@endsection
