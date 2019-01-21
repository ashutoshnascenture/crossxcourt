 @extends('app')
@section('title','Price')
@section('content')
<?php
$currency=Session::get('myCurrency');
if(!isset($currency))
$currency='USD'; 
 
  // $get_price = $coach->Info['price'];
$currency_flag='';
if($currency=='EUR')
	$currency_flag='fa fa-eur';
else if($currency=='USD')
	$currency_flag='fa fa-usd';
else if($currency=='GBP')
	$currency_flag='fa fa-gbp';


?>

<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title"> My Rates</h2>
                <hr/>
            <div class="alert alert-success my-alert" role="alert">
                <p>These are the standard rates listed on the site, but they do not take into account special coupons or promotions that PYC may be running.</p>
            </div>
                
            <div class="row">
				 @if(count($packages))
                        @foreach($packages as $key => $package)
												
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pricing-boxes">
                                <div class="well">
									<?php if($package->package['lessons'] == 1) { 
										
										echo "<h4>" . $package->package['lessons'] ." Hour Package" ."</h4>" ;  
										
										} else {
										 
										echo "<h4>" . $package->package['lessons'] . " Lesson Package" . "</h4>" ;
										} 
									?> 
									
                                      
                                    <div class="cost"><h3>{{round(Helper::get_price('USD',$currency,$package->rate))}}</h3><i class="{{$currency_flag}}" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        @endforeach	
                    @else

                    @endif
                </div>
            </div>

    </div>
</div>
@include('includes.footer')
@endsection
