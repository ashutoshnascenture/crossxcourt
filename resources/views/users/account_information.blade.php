 @extends('app')
@section('title','Account-Information')
@section('content')

@include('includes.sidebar')

 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('registerCoach.profile_edit'); ?></h2>
            <hr>
            <div class="col-md-9 form-container">
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
                <form class="" role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('users/updateprofile')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                     

                    <div class="form-group required label-text-area">
                        <label for="first_name"><?php echo Lang::get('registerCoach.first_name'); ?></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ ucfirst($user->first_name) }}">
                    </div>

                    <div class="form-group required label-text-area">
                        <label for="last_name"><?php echo Lang::get('registerCoach.last_name'); ?></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ ucfirst($user->last_name) }}">
                    </div>

                    <div class="form-group label-text-area">
                        <label for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}">
                    </div>


                    <div class="form-group required label-text-area">
                        <label for="address"><?php echo Lang::get('registerCoach.address'); ?></label>
                        <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">

                    </div>

                    <div class="form-group required label-text-area">
                        <label for="post_code"><?php echo Lang::get('registerCoach.post_code'); ?></label>
                        <input type="text" class="form-control" name="post_code" id="post_code"value="{{ $user->post_code }}">

                    </div>

                    <div class="form-group required label-text-area">
                        <label for="country_list"><?php echo Lang::get('registerCoach.country'); ?></label>

                        <select class="form-control box-select select-box-1" id="country_list" name="country">
                            <option value="{{ $user->country }}" >{{ $user->country }}</option>
                            @foreach($countries as $country)
                            <option value="{{$country->sortname}}" @if($country->sortname == $user->country) selected @endif >
                                    {{$country->name}}
                        </option>
                        @endforeach
                    </select>

                    </div>

                    <div class="form-group required label-text-area">
                        <label for="state_list"><?php echo Lang::get('registerCoach.state'); ?></label>

                        <select class="form-control box-select select-box-1" id="state_list" name="state">
                            <option value="{{ $user->state }}">Select state</option>    
                        </select>

                    </div>

                    <div class="form-group required label-text-area">
                        <label for="city"><?php echo Lang::get('registerCoach.city'); ?></label>

                        <input type="text" class="form-control" id="city" name="city" value="{{ ucfirst($user->city) }}">

                    </div>
                    <button type="submit" class="btn btn-success my-buttons">
                        <?php echo Lang::get('registerCoach.save'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
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

            var name = '{{$user->state}}';            
            $("#state_list").val(name);
        }
        ajaxCount++;

    });


</script>
<style type="text/css">
   

.required label:after{ color: red;
   content: "*";
   position: absolute;
     

}


</style>
</div>
@include('includes.footer')

@endsection

