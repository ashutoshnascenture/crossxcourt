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
            <h2 class="student-title"><?php echo Lang::get('price.my_rates'); ?></h2>
                <hr/>
            <div class="alert alert-success my-alert" role="alert">
                <p><?php echo Lang::get('price.text'); ?></p>
            </div>
                
            <div class="row">
				 @if(count($packages))
                        @foreach($packages as $key => $package)
												
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pricing-boxes">
                                <div class="well">
									<?php if($package->package['lessons'] == 1) { 
										
										echo "<h4>" . $package->package['lessons'] ."&nbsp;".Lang::get('price.hour_package') ."</h4>" ;  
										
										} else {
										 
										echo "<h4>" . $package->package['lessons'] ."&nbsp;".Lang::get('price.lesson_package')."</h4>" ;
										} 
									?> 
									
                                      
                                    <div class="cost"><h3><i class="{{$currency_flag}} fa-icn" aria-hidden="true"></i>{{round(Helper::get_price('USD',$currency,$package->rate))}}</h3></div>
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
