@extends('admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Update Customer</h2>
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

            <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/users')}}/{{$user->id}}">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
               
                <div class="form-group required">
                    <label class="col-md-3 control-label" for="firstname">FirstName</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" id="firstname">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label" for="last_name">Last name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" id="last_name">
                    </div>
                </div>            

                <div class="form-group">
                    <label class="col-md-3 control-label" for="password">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="password_confirmation">Confirm password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary update">
                            Update
                        </button>
                        <a href="{{URL::to('admin/users/')}}" class="btn btn-edit btn-success">Cancel </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
