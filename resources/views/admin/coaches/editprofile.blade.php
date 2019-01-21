@extends('admin')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <a href="">Account information</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ url('admin/coaches/editcoachdetail')}}/{{$user->id}}">Profile</a>
        &nbsp;&nbsp;|&nbsp;&nbsp;
<a href="{{URL::to('admin/coaches/price')}}/{{$user->id}}">Price</a>
    </section>
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

            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{URL::to('admin/coaches/updateprofile')}}/{{$user->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">



                <div class="form-group required">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.first_name'); ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.last_name'); ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                    </div>
                </div>

                <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.password'); ?></label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.password_confirmation'); ?></label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}">
                    </div>
                </div>


                <div class="form-group required">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.address'); ?></label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="5" name="address">{{ $user->address }}</textarea>
                    </div>
                </div>


                <div class="form-group required">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.post_code'); ?></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="post_code" value="{{ $user->post_code }}">
                    </div>
                </div>

                

                <div class="form-group required">
                    <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.country'); ?></label>
                    <div class="col-md-8">
                        <select class="form-control" id="country_list" name="country">
                            <option value="{{ $user->country }}" >{{ $user->country }}</option>
                            @foreach($countries as $country)
                            <option value="{{$country->sortname}}" @if($country->sortname == $user->country) selected @endif >
                                    {{$country->name}}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>


            <div class="form-group required">
                <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.state'); ?></label>
                <div class="col-md-8">
                    <select class="form-control" id="state_list" name="state">
                        <option value="{{ $user->state }}">Select state</option> 
                    </select>
                </div>
            </div>


            <div class="form-group required">
                <label class="col-md-3 control-label"><?php echo Lang::get('registerCoach.city'); ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="city" value="{{ $user->city }}">
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Update
                    </button>
                    <!--
                    <a href="{{URL::to('users/success')}}" class="btn btn-primary"><?php echo Lang::get('registerCoach.cancel'); ?></a>
                    -->
                </div>
            </div>
        </form>
    </div>
</section>
</div>


<script>
    $(function () {
        $('#country_list').trigger('change');


    });


    var ajaxCount = 0;
    $(document).ajaxComplete(function (event, request, settings) {
        if (ajaxCount == 0) {
            var name = '{{$user->state}}';
            $("#state_list").val(name);
        }
        ajaxCount++;

    });


</script>
@endsection
