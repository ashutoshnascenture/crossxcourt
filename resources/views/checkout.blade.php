@extends('app')
@section('title','Checkout')
@section('content')
<?php

//phpinfo();

$currency=Session::get('myCurrency');
if(!isset($currency))
  $currency='USD'; 

//..............price according to additional player.............
$friend_price="";
//echo '<pre>'; print_r($rate);
if(isset($rate))
  $friend_price=$rate->rate;

$player_price = Helper::get_price('USD',$currency,$friend_price); 
//..............price according to additional player.............
//echo '<pre>'; print_r($coach_packages);
$coach_package_price = Helper::get_price('USD',$currency,$coach_packages[0]->price);
$coach_package_rate = Helper::get_price('USD',$currency,$coach_packages[0]->rate);  

$before_discounts = $coach_package_price * $coach_packages[0]->lessons;
$after_discounts = $coach_package_rate * $coach_packages[0]->lessons;
$package_discounts = $before_discounts - $after_discounts;

$currency_flag='';
if($currency=='EUR')
  $currency_flag='&euro;';
else if($currency=='USD')
  $currency_flag='$';
else if($currency=='GBP')
  $currency_flag='&pound;';	  

?>
<section id="checkout-section" class="checkout-packages">
  <div class="container">
    <div class="container-fluid"> @if (session()->has('msg'))
      <div class="alert alert-danger">
        <?php  echo session('msg'); ?>
      </div>
      @endif </div>
      <div class="packages-info col-lg-8 col-md-8 col-sm-7 col-xs-12">
        
        @if(Auth::guest())

        <div class="safs">
          <h2 class="packages-title"><?php echo Lang::get('registerCoach.customer_details'); ?></h2>
          
          <div class="customer-forms-details">
            <div class="btns-radio">
             <label class="radio-inline">
               <input type="radio" name="customerOption" value="login" class="customerOption" checked id="login"> <?php echo Lang::get('registerCoach.login'); ?>
             </label>
             <label class="radio-inline">
               <input type="radio" name="customerOption" value="register" class="customerOption" id="register"> <?php echo Lang::get('registerCoach.register'); ?>
             </label>
             
             @if(count($errors) > 0)
             <br><br>
             <div class="alert alert-danger">
              <strong><?php echo Lang::get('registerCoach.Whoops!'); ?></strong> <?php echo Lang::get('registerCoach.error'); ?>.<br><br>
              <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
             </ul>
           </div>
           @endif
           
           <div id="login-data" class="customerInfo">
             
             <h2><?php echo Lang::get('registerCoach.login_details'); ?></h2>
             <br/>
             <form class="" role="form" method="POST" action="{{ LaravelLocalization::localizeURL('/customer/login') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
              <div class="form-group">
               <label for="customer_mail"><?php echo Lang::get('registerCoach.email'); ?></label>
               <div class="label-text">
                 <input type="email" class="form-control" name="email" id="customer_mail" value="{{ old('email') }}">
               </div>
             </div>
             

             <div class="form-group">
               <label for="passwrd"><?php echo Lang::get('registerCoach.password'); ?></label>
               <div class="label-text">
                <input type="password" class="form-control" name="password" id="passwrd">
              </div>
            </div>
            
            <div class="form-group">
             
              <button type="submit" class="btn btn-success join sign"><?php echo Lang::get('registerCoach.sign_in'); ?></button>
              
              
            </div>
          </form>
          
        </div>
        <div id="register-data" style="display:none" class="customerInfo">
         
         
         <h2><?php echo Lang::get('registerCoach.sign_up'); ?></h2>
         <br/>
         
         <form class="" role="form" method="POST" enctype="multipart/form-data" action="{{LaravelLocalization::localizeURL('/customer/store') }}">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           
           <div class="form-group required">
            <label for="first_name"><?php echo Lang::get('registerCoach.first_name'); ?></label>
            <div class="label-text">
             <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
           </div>
         </div>

         <div class="form-group required">
          <label for="last_name"><?php echo Lang::get('registerCoach.last_name'); ?></label>
          <div class="label-text">
           <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
         </div>
       </div>
       

       <div class="form-group required">
        <label for="email"><?php echo Lang::get('registerCoach.email'); ?></label>
        <div class="label-text">
         <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
       </div>
     </div>

     <div class="form-group required">
      <label for="mobile"><?php echo Lang::get('registerCoach.mobile'); ?></label>
      <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}">
    </div>

    <div class="form-group required">
      <label for="passwrd1"><?php echo Lang::get('registerCoach.password'); ?></label>
      <div class="label-text">
       <input type="password" class="form-control" name="password" id="passwrd1">
     </div>
   </div>

   <div class="form-group required">
    <label for="password-confrm"><?php echo Lang::get('registerCoach.password_confirmation'); ?></label>
    <div class="label-text">
     <input type="password" class="form-control" name="password_confirmation" id="password-confrm">
   </div>


 <div class="form-group required">
  
   <button type="submit" class="btn btn-success join sign">
    <?php echo Lang::get('registerCoach.sign_up'); ?>
  </button>
  
</div>
</form>
</div>
</div>
</div>	
</div>
@else 	
<h2 class="packages-title"><?php echo Lang::get('registerCoach.packages_title'); ?></h2>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
var publish_key = "<?php echo $publishable_key ?>";
Stripe.setPublishableKey('{{$publishable_key}}');
function processStripeResponse(status, response){
  var form = $('#packagesForm');

  if(response.error){
	form.find('.errors').text(response.error.message);
	form.find('#buynow').prop('disabled', false);
  }else{
	var token = response.id;
	form.append($('<input type="hidden" name="stripeToken" />').val(token));
	form.get(0).submit();
  }
};

$(function(){
  $('#packagesForm').submit(function(event) {
	var form = $(this);
	form.find('#buynow').prop('disabled', true);

	Stripe.card.createToken(form, processStripeResponse);

	return false;
  });
});	
</script>
<div class="choose-section margin-bottom-5"> 
	
  <form id="packagesForm" class="packages-form" role="form" method="POST" action="{{LaravelLocalization::localizeURL('checkout/doDirectPayment')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="preferred_day" value="{{Request::input('preferred_day')}}">
    <input type="hidden" name="preferred_time" value="{{Request::input('preferred_time')}}">
    <input type="hidden" name="lesson_location" value="{{Request::input('lesson_location')}}">
    <input type="hidden" name="lesson_location_description" value="{{Request::input('lesson_location_description')}}">
    <input type="hidden" name="email" value="{{Request::input('email')}}">
    <input type="hidden" name="coach" value="{{$coach_data->user_id}}">
    <input id="package_rate" type="hidden" name="package_rate" value="">
    <input type="hidden" name="paymentType" value="Sale"/>
    <div class="form-group col-lg-12">
      <label for="id_lesson"><?php echo Lang::get('registerCoach.how_many_lessons'); ?></label>
      <div class="packages">
        <select id="id_lesson" class="selectpicker form-control box-select" name="lesson">
          <!--<option value="0">Less than 6 lessons</option>-->
          
          <?php 
          if(isset($coach_packages)){
            foreach($coach_packages as $coach_package){
              
             $coach_package_rate=Helper::get_price('USD',$currency,$coach_package->rate);
             $coach_package_price=Helper::get_price('USD',$currency,$coach_package->price);
             $save =  100-(($coach_package_rate/$coach_package_price) * 100); 
             
						  //$save =  100-(($coach_package->rate / $coach_package->price ) * 100); 
             if($save > 0){
              echo '<option data-rate="'. $coach_package_rate .'" value="'. $coach_package->lessons .'">' . $coach_package->lessons . ' Lessons at '.$currency_flag.''.$coach_package_rate . '/hr (save '.round($save,0).'%)</option>';
            }else{
              echo '<option data-rate="'. $coach_package_rate .'" value="'. $coach_package->lessons .'">' . $coach_package->lessons . ' Lessons at '.$currency_flag.''.$coach_package_rate . '/hr </option>';
            }
          }
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group col-lg-12">
    <label for="id_max_students"><?php echo Lang::get('registerCoach.add_freind'); ?>  &nbsp;<?php echo $currency_flag. $player_price;?> <?php echo Lang::get('registerCoach.per_hour'); ?>!</label>
    <div class="packages">
      <select name="max_students" id="id_max_students" class="selectpicker form-control box-select">
        <option value="0" selected="selected">+0 <?php echo Lang::get('registerCoach.additional_player'); ?></option>
        <option value="1">+1 <?php echo Lang::get('registerCoach.additional_player'); ?></option>
        <option value="2">+2 <?php echo Lang::get('registerCoach.additional_player'); ?></option>
        <option value="3">+3 <?php echo Lang::get('registerCoach.additional_player'); ?></option>
<!--
                <option value="4">+4 additional players</option>
                <option value="5">+5 additional players</option>
              -->
            </select>
          </div>
        </div>
        
        <div class="totaling form-group col-lg-12">
          <ul>
            <li class="beforediscount"<?php if($package_discounts <= 0){ echo 'style="display:none"'; } ?>><?php echo Lang::get('registerCoach.total_discount'); ?> 
              <div class="total-price"><?php echo $currency_flag;?><span class="before_price"><?php echo $before_discounts; ?> </span></div>
            </li>
            
            <li class="discount" <?php if($package_discounts <= 0){ echo 'style="display:none"'; } ?>><?php echo Lang::get('registerCoach.discount'); ?>: 
              <div class="total-price"><?php echo $currency_flag;?><span class="package_discount"><?php echo abs($package_discounts); ?></span></div> 
            </li>
            
            <li class="grand"><?php echo Lang::get('registerCoach.total'); ?> :
              <div class="total-price"><?php echo $currency_flag;?><span class="total_price"><?php echo $after_discounts; ?></span></div>
            </li>
          </ul>
        </div>
      <h2 class="payment-title pay-title"><?php echo Lang::get('registerCoach.payment'); ?></h2>
      
      
     
	  <div class="errors" style="color: red; padding: 2px 2px 10px 15px;"></div>
	  <div class="form-group col-lg-12 required">
          <label for="firstname"><?php echo Lang::get('registerCoach.card_owner'); ?></label>
          <div class="label-text">
            <input class="form-control" id="firstname" type="text" name="firstName" placeholder="">
          </div>
        </div>
          <!--<div class="form-group col-lg-6 required">
            <label for="lastname"><?php echo Lang::get('registerCoach.last'); ?></label>
            <div class="label-text">
              <input class="form-control" id="lastname" type="text" name="lastName" placeholder="">
            </div>
          </div>-->
            <div class="form-group col-lg-12 required">
            <label for="card"><?php echo Lang::get('registerCoach.card'); ?></label>
            <div class="label-text">
              <select class="selectpicker form-control box-select" name="creditCardType" id="card">
                <option value="">-- <?php echo Lang::get('registerCoach.select_card'); ?> --</option>
                <option value="Visa" selected="selected">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Discover">Discover</option>
                <option value="Amex">American Express</option>
              </select>
            </div>
          </div>
          <div class="form-group col-lg-12 required">
            <label for="cardno"><?php echo Lang::get('registerCoach.card_number'); ?></label>
            <div class="label-text">
              <input class="form-control" data-stripe="number" type="text" name="creditCardNumber" id="cardno" placeholder="">
            </div>
          </div>
          <div class="form-group col-lg-6 required clearfix">
            <label style="padding-left:0px!important" class="col-lg-12 col-md-12 col-sm-12" for="expiry"><?php echo Lang::get('registerCoach.expiry_date'); ?></label>
            <div class="col-lg-5 col-sm-5 col-xs-12 checkg pull-left  label-text form-group">
              <select class="selectpicker form-control box-select" data-stripe="exp-month" name="expDateMonth" id="expiry">
                <option value=""><?php echo Lang::get('registerCoach.select_month'); ?></option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 checkg pull-right  label-text form-group clearfix">
              <select class="selectpicker form-control box-select" data-stripe="exp-year" name="expDateYear">
                <option value=""><?php echo Lang::get('registerCoach.select_year'); ?></option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
              </select>
            </div>
          </div>
          <!--<div class="form-group col-lg-6">
            <label>&nbsp;</label>
            
          </div>-->
         <div class="form-group col-lg-6 required">
            <label for="cvv"><?php echo Lang::get('registerCoach.cvv'); ?></label>
            <div class="label-text">
              <input class="form-control" type="text" name="cvv2Number" data-stripe="cvc" id="cvv" placeholder="" >
            </div>
          </div>
          <!--<div class="form-group col-lg-6">
            <label for="zip"><?php //echo Lang::get('registerCoach.zip'); ?></label>
            <div class="label-text">
              <input class="form-control" type="text" name="zip" placeholder="" id="zip">
            </div>
          </div>-->
          <div class="totaling form-group grand-totaling col-lg-12">
            <ul>
              <li class="grand"> <?php echo Lang::get('registerCoach.total'); ?>:    &nbsp; <?php echo $currency_flag;?><span class="total_price"><?php echo $after_discounts; ?></span></li>
              <input type="submit" id="buynow" name="DoDirectPaymentBtn" value=" <?php echo Lang::get('registerCoach.checkout'); ?>" class="btn btn-success checkout margin-bottom-4">
              <i class="fa fa-long-arrow-right checkout-long"></i>
            </ul>
          </div>
        </form>
   
      @endif	
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12 right-profile-image">
      <h2 class="coach-title">
       <?php echo Lang::get('registerCoach.your_coach'); ?></h2>

       <div class="checkout-profile"> 
        @if($coach_data->profile_image)
        <img src="{{ url('/coach-thumb/'.$coach_data->profile_image)}}/175/175" class="img-thumbnail">
        @else
        <img src="{{asset('/images/no-image.jpg')}}" alt=""   width="150" height="150" alt=""/>
        @endif
        <h3>{{ucfirst($coach_data->first_name)}} {{substr($coach_data->last_name,0,1)}}.</h3>
        <p class="location-text"><i class="fa fa-map-marker"></i> {{$coach_data->city}}, {{$coach_data->state}}, {{$coach_data->country}}</p>
        <ul class="list-inline reviews-list">
         <li>
          <div class="ratebox" style="color:#ff00ff;" data-id="1" data-rating="{{round($coach_data->rating,1)}}"></div>
        </li>
      </ul>
      <div class="content-section-check">
        <div class="section-content1">
          <h3><?php echo Lang::get('registerCoach.next_steps'); ?></h3>
          <p><?php echo Lang::get('registerCoach.next_steps_text'); ?></p>
        </div>
      </div>
      <div class="content-section-check">
        <div class="section-content1">
          <h3><?php echo Lang::get('registerCoach.satisfaction_guaranteed'); ?></h3>
          <p><?php echo Lang::get('registerCoach.satisfaction_guaranteed_text'); ?></p>
          <span class="check-logo"> <img alt="check-logo" src="{{ url('images/check-logo.png')}}"> </span> </div>
        </div>
      </div>
    </diV>
  </div>
   </div>
</section>
<style>
  td, th {
    padding: 10px;
  }
</style>
<script>
  $( "#id_lesson" ).change(function() {
   var qty = $(this).val();
   
   //var package_name = $(this).text();
   var player_price = "<?php echo $player_price;?>"
   var rate = $(this).find(':selected').attr('data-rate');
   var base_price = "<?php echo $coach_package_price;?>";
   var before_discounts = qty*base_price;
   var after_discounts = qty*rate;
   var package_discount = before_discounts - after_discounts;
   var after_dis_price = '';
   var before_dis_price = '';
   var players = $( "#id_max_students").find(':selected').val();
   
   var additional_price = qty * player_price * players;
   
   if(additional_price){
     after_dis_price = parseFloat(after_discounts) + parseFloat(additional_price);
     before_dis_price = parseFloat(before_discounts) + parseFloat(additional_price);
     $('.before_price').text(before_dis_price.toFixed(2));
     $('.total_price').text(after_dis_price.toFixed(2));
   }else{
    $('.before_price').text(before_discounts.toFixed(2));
    $('.total_price').text(after_discounts.toFixed(2));
  }
  
  $('.package_discount').text(package_discount.toFixed(2));
  if(package_discount <= 0){
    $('.discount').hide();
    $('.beforediscount').hide();
  }else{
    $('.discount').show();
    $('.beforediscount').show();
  }
  $('#total_price').val(after_discounts);
  $('#package_rate').val(rate);
  
});

  $( "#id_max_students" ).change(function() {
    var players = $(this).val();
    var player_price="<?php echo $player_price;?>"
    var lessons_qty = $("#id_lesson").find(':selected').val();
    
    var additional_price = lessons_qty * player_price * players;
    
    var rate = $("#id_lesson").find(':selected').attr('data-rate');
    var base_price = "<?php echo $coach_package_price;?>";
    var before_discounts = lessons_qty*base_price;
    var after_discounts = lessons_qty*rate;
    
    after_discounts = parseFloat(after_discounts) + parseFloat(additional_price);
    before_discounts = parseFloat(before_discounts) + parseFloat(additional_price);
    $('.total_price').text(after_discounts.toFixed(2));
    $('.before_price').text(before_discounts.toFixed(2));	
  });
  $( document ).ready(function() {
    var text = $( "#id_lesson option:selected" ).attr('data-rate');
    $('#package_rate').val(text);
    
    $('.customerOption').click(function(){
      var id = $(this).val();
      $('.customerInfo').hide();
      $('#'+id+'-data').show();
      
    });
    
    <?php if(Session::get('action')){ ?>
     var id =  '<?php echo Session::get('action') ?>';
     $('#'+id).trigger('click'); 
     <?php } ?>
     
	/*$('#packagesForm').one('submit', function() { alert('hhh');
		$(this).find('input[type="submit"]').attr('disabled','disabled');
	});*/
	var flag=false;
	if(flag==false){
		$('#buynow').click( function() {
     if($('#cardno').val()!="" && $('#cvv').val()!="" ){
       flag=true;
       $(this).attr('disabled','disabled');
       $('#packagesForm').submit();
     }
   });
	}
});



//............rating...................
$(function() {
	$('.ratebox' ).raterater( { 
		submitFunction: 'rateAlert', 
		allowChange: true,
		starWidth:20,
		spaceWidth: 5,
		numStars: 5,
		isStatic: true
	});
});
   //............rating...................
 </script>
<style>
.pay-title{padding-left:15px}
</style> 
 @include('includes.footer')
 @endsection
