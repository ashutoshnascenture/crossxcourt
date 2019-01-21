@extends('app')
@section('title','Checkout')
@section('content')
<?php 
	$currency=Session::get('myCurrency');
	
	if(!isset($currency)){
		$currency='USD'; 
	}
	
	$currency_flag='';
	if($currency=='EUR')
		$currency_flag='&euro;';
	else if($currency=='USD')
		$currency_flag='$';
	else if($currency=='GBP')
		$currency_flag='&pound;';
   
	
	$pending_amount = Helper::get_price('USD',$currency,$pending_amount);
	$coach_rate = Helper::get_price('USD',$currency,$booking->rate);
	
	
?> 
<section id="checkout-section" class="checkout-packages">
  <div class="container">
    <div class="container-fluid">
		@if (session()->has('msg'))
		<div class="alert alert-danger">
			<?php  echo session('msg'); ?>
		</div>
		@endif 
	  
	</div>
	
    <div class="packages-info col-lg-8 col-md-8 col-sm-7 col-xs-12">
		 <h2 class="payment-title"><?php echo Lang::get('registerCoach.payment'); ?></h2> 
       
	   <div class="choose-section margin-bottom-5"> 
        <form id="packagesForm" class="packages-form" role="form" method="POST" action="{{LaravelLocalization::localizeURL('checkout/do-payment/'.$booking->id)}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">  
			<div class=" ">
			
          <div class="form-group col-lg-12 required">
			<p>
			Pending payment for {{$booking->pending_payment}} Lessons at {{$currency_flag}} {{ $coach_rate }} <br/>
			Total : {{$currency_flag}} {{$pending_amount}}
			</p>
			
            <label for="firstname"><?php echo Lang::get('registerCoach.card_owner'); ?></label>
            <div class="label-text">
              <input class="form-control" id="firstname" type="text" name="firstName" placeholder="">
            </div>
          </div>
           
          <div class="form-group col-lg-6 required">
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
          <div class="form-group col-lg-6 required">
            <label for="cardno"><?php echo Lang::get('registerCoach.card_number'); ?></label>
            <div class="label-text">
              <input class="form-control" type="text" name="creditCardNumber" id="cardno" placeholder="">
            </div>
          </div>
          <div class="form-group col-lg-6 required">
            <label style="padding-left:0px!important" class="col-lg-12 col-md-12 col-sm-12" for="expiry"><?php echo Lang::get('registerCoach.expiry_date'); ?></label>
            <div class="col-lg-5 col-sm-5 col-xs-12 checkg pull-left  label-text form-group">
              <select class="selectpicker form-control box-select" name="expDateMonth" id="expiry">
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
			<div class="col-lg-6 col-sm-6 col-xs-12 checkg pull-right  label-text form-group">
              <select class="selectpicker form-control box-select" name="expDateYear">
			   <option value=""><?php echo Lang::get('registerCoach.select_year'); ?></option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
              </select>
            </div>
          </div>
          <!--<div class="form-group col-lg-6">
            <label>&nbsp;</label>
            
          </div>-->
          <div class="form-group col-lg-6 required">
            <label for="cvv"><?php echo Lang::get('registerCoach.cvv'); ?></label>
            <div class="label-text">
              <input class="form-control" type="text" name="cvv2Number" id="cvv" placeholder="" >
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
              <li class="grand"> <?php echo Lang::get('registerCoach.total'); ?>:    &nbsp; <?php echo $currency_flag;?><span class="total_price"> {{$pending_amount}} </span></li>
              <input type="submit" id="buynow" name="DoDirectPaymentBtn" value=" <?php echo Lang::get('registerCoach.checkout'); ?>" class="btn btn-success checkout margin-bottom-4">
              <i class="fa fa-long-arrow-right checkout-long"></i>
            </ul>
          </div>
		  
		  </diV>
		  
        </form>
      
	 </diV>   
    </diV>
	
	<!-- coach profile -->
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
</section>
<style>
td, th {
    padding: 10px;
}
</style>
 
@include('includes.footer')
@endsection
