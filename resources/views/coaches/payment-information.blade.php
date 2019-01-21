 @extends('app')
@section('title','Paypal-Email')
@section('content')
<?php
$email = "";
$address = "";
$city = "";
$state = "";
$postalcode = "";
$ssn = "";
$route_num = "";
$account_num = "";
if (isset($payment_information)) {
    $email = $payment_information->email;
    $address = $payment_information->address;
    $city = $payment_information->city;
    $state = $payment_information->state;
    $postalcode = $payment_information->postalcode;
    $ssn = $payment_information->ssn;
    $route_num = $payment_information->route_num;
    $account_num = $payment_information->account_num;
}
?>
<div class="container-fluid">

    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('paymentInformation.tax_nformation'); ?></h2>
            <hr>
            <div class="col-md-9 form-container">
			<form method="post" class=""  action="{{LaravelLocalization::localizeURL('coaches/payment-info')}}">
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

                    <input type="hidden" name="_token" value="{{csrf_token() }}">
                    <div class="form-group label-text-area required required">
                        <label for="address"><?php echo Lang::get('paymentInformation.address'); ?></label> 
                        <input type="text" name="address" class="form-control" id="address" value="{{$address}}">
                    </div>
                    <div class="form-group label-text-area required">
                        <label for="city"><?php echo Lang::get('paymentInformation.city'); ?></label> 
                        <input type="text" name="city" class="form-control" id="city" value="{{$city}}">
                    </div>
                    <div class="form-group label-text-area required">
                        <label for="state"><?php echo Lang::get('paymentInformation.state'); ?></label> 
                        <input type="text" name="state" class="form-control" id="state" value="{{$state}}" >
                    </div>
                    <div class="form-group label-text-area required">
                        <label for="postalcode"><?php echo Lang::get('paymentInformation.postal_code'); ?></label> 
                        <input type="text" name="postalcode" class="form-control" id="postalcode" value="{{$postalcode}}" >
                    </div>
                    <div class="form-group label-text-area required">
                        <label for="ssn"><?php echo Lang::get('paymentInformation.social_security_number'); ?></label> 
                        <input type="text" name="ssn" class="form-control" id="ssn" value="{{$ssn}}" >
                    </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content margin-top-2">
            <h2 class="student-title"><?php echo Lang::get('paymentInformation.pro_pay_information'); ?></h2>
            <hr>
            <div class="col-md-9 form-container">
                <div class="form-group label-text-area required"> 
                    <label for="route_num"><?php echo Lang::get('paymentInformation.routing_number'); ?></label> 
                    <input type="text" name="route_num" class="form-control" id="route_num" value="{{$route_num}}" >
                </div>
                <div class="form-group label-text-area required"> 
                    <label for="account_num"><?php echo Lang::get('paymentInformation.account_number'); ?></label> 
                    <input type="text" name="account_num" class="form-control" id="account_num" value="{{$account_num}}" >
                </div>  
            </div>
        </div>  
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content margin-top-2">
            <h2 class="search-title"><?php echo Lang::get('paymentInformation.paypal_information'); ?></h2>
            <hr>
            <div class="col-md-9 form-container">
                <div class="form-group label-text-area">
                    <label for="email"><?php echo Lang::get('paymentInformation.paypal_email'); ?></label> 
                    <input type="email"  value="{{$email}}" id="email" class="form-control" name="email">
                </div>
                
            </div>
            
        </div>
		<div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section btn-save-sec pull-right  margin-top-2">
		<button class="btn btn-success my-buttons" type="submit"> <?php echo Lang::get('paymentInformation.save'); ?> </button>
		</div>
</form>
    </div>
</div>
@include('includes.footer')
@endsection
