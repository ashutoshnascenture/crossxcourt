 @extends('admin')
@section('content')
<style>

</style>
<div class="content-wrapper">
   
            <section class="content-header">
                <h2>Create coach</h2>
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

                <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/coaches/store')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


 


                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="first_name"><?php echo Lang::get('registerCoach.first_name'); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" id="first_name">
                            </div>
                        </div>

                        <div class="form-group required" >
                            <label class="col-md-3 control-label" for="last_name"><?php echo Lang::get('registerCoach.last_name'); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" id="last_name">
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="email"><?php echo Lang::get('registerCoach.email'); ?></label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                            </div>
                        </div>
 
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="pass"><?php echo Lang::get('registerCoach.password'); ?></label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" id="pass">
                            </div>
                        </div>

                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="confrm"><?php echo Lang::get('registerCoach.password_confirmation'); ?></label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password_confirmation" id="confrm">
                            </div>
                        </div>



                        <!--  <div class="form-group">
                            <label class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div> -->


                        <div class="form-group">
                            <label class="col-md-3 control-label" for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" id="mobile">
                            </div>
                        </div>


                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="address"><?php echo Lang::get('registerCoach.address'); ?></label>
                            <div class="col-md-8">
                                <textarea class="form-control" rows="5" name="address" id="address">{{ old('address') }}</textarea>
                            </div>
                        </div>


                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="post-code"><?php echo Lang::get('registerCoach.post_code'); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="post_code" value="{{ old('post_code') }}" id="post-code">
                            </div>
                        </div>
 

                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="country_list"><?php echo Lang::get('registerCoach.country'); ?></label>
                            <div class="col-md-8">
                                <select class="form-control" id="country_list" name="country">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->sortname}}" @if (old('country') == $country->sortname) selected="selected" @endif>
                                            {{$country->name}}
									</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-3 control-label" for="state_list"><?php echo Lang::get('registerCoach.state'); ?></label>
                            <div class="col-md-8">
                                <select class="form-control box-select" id="state_list" name="state" id="state_list">
                                        <option value="{{old('state')}}" ><?php echo Lang::get('registerCoach.placeholder_state'); ?></option>	
                                    </select>
                            </div>
                        </div>
						
						
						<div class="form-group required">
                            <label class="col-md-3 control-label" for="city"><?php echo Lang::get('registerCoach.city'); ?></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="city">
                            </div>
                        </div>


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">
                                Add
                            </button>
                            <a href="{{URL::to('admin/coaches')}}" class="btn btn-success">Cancel</a>
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

    $(window).load(function () {
        
        $('#country_list').trigger('change');

    });



    var ajaxCount = 0;
    $(document).ajaxComplete(function (event, request, settings) {
        
        if (ajaxCount == 0) {

            var name = "{{old('state')}}";            
            $("#state_list").val(name);
        }
        ajaxCount++;

    });


</script>

@endsection
