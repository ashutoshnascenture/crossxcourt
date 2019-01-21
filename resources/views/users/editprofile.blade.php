@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
	
         <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
                <h2 class="student-title"><?php echo Lang::get('registerCoach.profile_edit'); ?></h2>
				<div class="col-md-9 col-md-offset-1 form-container">
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

                    <form class="" role="form" method="POST" enctype="multipart/form-data" action="{{URL::to('users/updateprofile')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                     


                        <div class="form-group label-text-area">
                            <label for="first_name"><?php echo Lang::get('registerCoach.first_name'); ?></label>
                            
                                <input type="text" class="form-control"  name="first_name" id="first_name" value="{{ $user->first_name }}">
                          
                        </div>

                        <div class="form-group label-text-area">
                            <label for="last_name"><?php echo Lang::get('registerCoach.last_name'); ?></label>
                           
                                <input type="text" class="form-control" name="last_name" id="last_nam"value="{{ $user->last_name }}">
                          
                        </div>

                       

                        <div class="form-group label-text-area">
                            <label for="address"><?php echo Lang::get('registerCoach.address'); ?></label>
                          
                                <textarea class="form-control" rows="5" name="address" id="address">{{ $user->address }}</textarea>

                        </div>


                        <div class="form-group label-text-area">
                            <label for="post_code-1"><?php echo Lang::get('registerCoach.post_code'); ?></label>
                           
                                <input type="text" class="form-control" name="post_code" id="post_code-1" value="{{ $user->post_code }}">
                           
                        </div>

						<?php
						//~ print_r($user->country);
						//~ echo "<pre>";
                        //~ print_r($countries);  ?>
	
                        <div class="form-group label-text-area">
                            <label for="country_list"><?php echo Lang::get('registerCoach.country'); ?></label>
                           
                                <select class="form-control box-select" id="country_list" name="country">
                                    <option value="{{ $user->country }}" >{{ $user->country }}</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->sortname}}" @if($country->sortname == $user->country) selected @endif >
                                        {{$country->name}}
                                    </option>
                                    @endforeach

                                </select>
                            
                        </div>
                       
                       
                        <div class="form-group">
                            <label for="state_list"><?php echo Lang::get('registerCoach.state'); ?></label>
                           
                                <select class="form-control box-select" id="state_list" name="state">
                                    <option value="{{ $user->state }}">--Select State---</option>	
                                </select>
                           
                        </div>
						
						
						<div class="form-group">
                            <label for="city"><?php echo Lang::get('registerCoach.city'); ?></label>
                           
                                <input type="text" class="form-control" name="city" value="{{ $user->city }}">
                           
                        </div>
                        
                        
                        <div class="form-group">
                           
                                <button type="submit" class="btn btn-success my-buttons">
                                   <?php echo Lang::get('registerCoach.update'); ?>
                                </button>
<!--
                                <a href="{{URL::to('users/success')}}" class="btn btn-primary"><?php echo Lang::get('registerCoach.cancel'); ?></a>
-->
                            
                        </div>
                    </form>
				</div>
        </div>
    </div>
</div>

<script>
$(function(){
	$('#country_list').trigger('change');
	
  
});

 
var ajaxCount = 0;
$( document ).ajaxComplete(function( event,request, settings ) {
    if(ajaxCount == 0){
		var name = '{{$user->state}}';
		$("#state_list").val(name);
	}
	ajaxCount++;
    
});

 
</script>
@endsection
