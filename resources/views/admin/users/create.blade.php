 @extends('admin')
@section('content')
<style>

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Create Customer</h2>
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

            <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/users')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">




                <div class="form-group required">
                    <label class="col-md-3 control-label" for="first_name">First Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first_name">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label" for="last_name">Last Name</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" id="last_name">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label" for="email">Email</label>
                    <div class="col-md-8">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label" for="password">Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label" for="password_confirmation">Password Confirm</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>

           
                <div class="form-group required">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary add">
                            Add
                        </button>
                        <a href="{{URL::to('admin/users')}}" class="btn btn-edit btn-success cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


@endsection
