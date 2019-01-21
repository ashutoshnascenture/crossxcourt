@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Background</div>
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

                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/users/store') }}">
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
                            <label class="col-md-4 control-label">Profile Image</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="profile_image" value="{{ old('first_name') }}">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-4 control-label">Tennis Qualification</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="tennis_qualification" value="{{ old('last_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Tag Line</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="tag_line" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Teaching Level</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="teach_level">
                            </div>
                        </div>

                         

                         <div class="form-group">
                            <label class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>


                        <!-- <div class="form-group">
                            <label class="col-md-4 control-label">Mobile</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mobile">
                            </div>
                        </div>
 -->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-6">
                               <textarea class="form-control" rows="5" name="address"></textarea>
                            </div>
                        </div>


                         <div class="form-group">
                            <label class="col-md-4 control-label">Postal Code</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="post_code">
                            </div>
                        </div>


                        
                        
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">City</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city">
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-md-4 control-label">State</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="state">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-4 control-label">Country</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="country">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Join The PVC Team
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
