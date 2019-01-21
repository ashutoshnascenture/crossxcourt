@extends('app')
@section('title','Register')
@section('content')

<!--
<script type = "text/javascript" >
       function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 10);
        window.onunload=function(){null};
</script> 
-->

<section class="apply-coaches padding-top-bottom-5" id="coaches-apply-section">
    <div class="container">
        <h2><?php echo Lang::get('registerCoach.become_a_coach'); ?></h2>
         <p> <?php echo Lang::get('registerCoach.coach_text'); ?> </p>
    </div>
</section><!-- apply coaches section ends here -->
<!-- middle white section starts here -->
<section class="services-area become-coach-area" id="become-coach-section"> 
    <div class="container">
        <h2 class="text-center"><?php echo Lang::get('registerCoach.why_join_us'); ?></h2>
        <div class="row">
            <div class="col-md-4 col-sm-3 col-xs-12 text-center join-bar">
                <i class="glyphicon glyphicon-user"></i>
                <h4 class=""> <?php echo Lang::get('registerCoach.clients'); ?> </h4>
                <p> <?php echo Lang::get('registerCoach.clients_text'); ?> </p>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12 text-center join-bar">
                <i class="fa fa-get-pocket" aria-hidden="true"></i>
                <h4 class=""> <?php echo Lang::get('registerCoach.protection'); ?>  </h4>
                <p> <?php echo Lang::get('registerCoach.protection_text'); ?> </p>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12 text-center join-bar">
                <i class="glyphicon glyphicon-link" aria-hidden="true"></i>
                <h4 class=""> <?php echo Lang::get('registerCoach.complement'); ?> </h4>
                <p> <?php echo Lang::get('registerCoach.complement_text'); ?> </p>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12 text-center join-bar">
                <i class="glyphicon glyphicon-tag" aria-hidden="true"></i>
                <h4 class=""> <?php echo Lang::get('registerCoach.price'); ?> </h4>
                <p> <?php echo Lang::get('registerCoach.price_text'); ?> </p>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12 text-center join-bar">
                <i class="fa fa-percent" aria-hidden="true"></i>
                <h4 class=""> <?php echo Lang::get('registerCoach.discounts'); ?>  </h4>
                <p><?php echo Lang::get('registerCoach.discounts_text'); ?></p>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-12 text-center join-bar">
                  <i class="glyphicon glyphicon-usd" aria-hidden="true"></i>
                <h4 class=""> <?php echo Lang::get('registerCoach.payment'); ?> </h4>
                <p> <?php echo Lang::get('registerCoach.payment_text'); ?> </p>
            </div>
            
        </div>     
          
    </div>
</section>
            <div class="container">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 margin-top-bottom-5">
                <div class="panel panel-default"> 
                <div class="panel-heading">
                    <h3><?php echo Lang::get('registerCoach.crossxcourt'); ?></h3>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong><?php echo Lang::get('registerCoach.Whoops!'); ?></strong> <?php echo Lang::get('registerCoach.error'); ?>.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form" role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/users/storeuser') }}" onSubmit="document.getElementById('submit').disabled=true;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 

                                <div class="form-group required ">
                                    <label for="f-name"><?php echo Lang::get('registerCoach.first_name'); ?></label>
                                    <input type="text" class="form-control" id="f-name" name="first_name" value="{{ old('first_name') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_firstname'); ?>">
                                </div>
                                <div class="form-group required">
                                    <label for="l-name"><?php echo Lang::get('registerCoach.last_name'); ?></label>
                                    <input type="text" id="l-name" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_lastName'); ?>">
                                </div>
                                <div class="form-group required">
                                    <label for="email"> <?php echo Lang::get('registerCoach.email'); ?></label>
                                    <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_email'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_contact'); ?>">
                                </div>
                         
                                <div class="form-group required">
                                    <label for="pwd"><?php echo Lang::get('registerCoach.password'); ?></label>
                                    <input type="Password" id="pwd" name="password" class="form-control" value="" placeholder="<?php echo Lang::get('registerCoach.placeholder_password'); ?>">
                                </div> 
                                
                                <div class="form-group required">
                                    <label for="c-pwd"><?php echo Lang::get('registerCoach.password_confirmation'); ?></label>
                                    <input type="Password" id="c-pwd" name="password_confirmation" class="form-control" value="" placeholder="<?php echo Lang::get('registerCoach.placeholder_confirm_password'); ?>">
                                </div>

                                <div class="form-group required">
                                    <label for="address"> <?php echo Lang::get('registerCoach.address'); ?></label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_address'); ?>">
                                </div>
                                <div class="form-group required">
                                    <label for="post-code"> <?php echo Lang::get('registerCoach.post_code'); ?></label>
							        <input type="text" id="post-code" name="post_code" class="form-control" value="{{ old('post_code') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_postal_code'); ?>">
                                </div>
                                
                                
					            <div class="form-group required">  
                                    <label for="country_list"><?php echo Lang::get('registerCoach.country'); ?></label>
                                    <select class="form-control box-select" id="country_list" name="country">
                                        <option value=""><?php echo Lang::get('registerCoach.placeholder_country'); ?></option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->sortname}}" @if (old('country') == $country->sortname) selected="selected" @endif>
                                            {{$country->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                 
                                <div class="form-group required">  
                                    <label for="state_list"> <?php echo Lang::get('registerCoach.state'); ?></label>
                                    <select class="form-control box-select" id="state_list" name="state">
                                        <option value="{{old('state')}}" ><?php echo Lang::get('registerCoach.placeholder_state'); ?></option>	
                                    </select>
                                </div>
                                <div class="form-group required">  
                                    <label for="city"><?php echo Lang::get('registerCoach.city'); ?> </label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="<?php echo Lang::get('registerCoach.placeholder_city'); ?>">
                                </div>
                                <button type="submit" class="btn join-btn join">
                                    <?php echo Lang::get('registerCoach.crossxcourt'); ?>
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

            var name = "{{old('state')}}";            
            $("#state_list").val(name);
        }
        ajaxCount++;

    });
	
	
	$(":submit").closest("form").submit(function(){
		$(':submit').attr('disabled', 'disabled');
	});

</script>           
             
  @include('includes.footer')
@endsection
 

  
