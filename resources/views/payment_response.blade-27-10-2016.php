@extends('app')
@section('title','Payment')
@section('content')

<?php 
$doDirectPaymentResponse = Session::get('doDirectPaymentResponse');
$data = json_encode($doDirectPaymentResponse);
$doDirectPaymentResponse = json_decode($data);
//echo '<pre>'; print_r($doDirectPaymentResponse);
if(isset($doDirectPaymentResponse)){
?>
<div class="container">

			<div class="col-xs-12 top-section text-center margin-top-bottom-5">
			<!--<h2 class="payment-text margin-bottom-5">PayPal Payments via Credit Card</h2>-->
           
			<div id="return" class="col-md-12 return-box">
			
				<?php
				//Rechecking the product price and currency details
				echo '<div class="inner-section">'; 
				if ($doDirectPaymentResponse->Ack == 'Success') {
					?>
					
					<?php
					echo "<div class='right-section col-md-6 col-md-offset-3 col-sm-9 col-xs-8'>"; 
					echo"<i class='fa fa-check-circle checking' aria-hidden='true'></i>"; ?>
					<h4 id='success'><?php echo Lang::get('paymentResponse.paymentSuccess'); ?></h4>
					<?php echo "<P> ". Lang::get('paymentResponse.amount') .":<span>". $doDirectPaymentResponse->Amount->value . " (" . $doDirectPaymentResponse->Amount->currencyID . ") </span></P>";
					echo "<P class='transaction'>". Lang::get('paymentResponse.transactionId') .":<span>". $doDirectPaymentResponse->TransactionID . "</span></P>";
					
					echo "<br><div class='btn btn-default back_btn'><a  href='".URL::to('/')."' id= 'btn'><< ". Lang::get('paymentResponse.continue') ." </a></div>";
				} else {
				    echo "<h3 id='fail'>". Lang::get('paymentResponse.paymentFailed') ."</h3>";
					echo "<p>". Lang::get('paymentResponse.ErrorMsg') ."</p>";
					echo "<div class='btn btn-default back_btn'><a  href='".URL::to('users/success')."' id= 'btn'><< ". Lang::get('paymentResponse.back') ." </a></div>";
				}
				echo '</div>';
				echo '</div>';
				?>
			</div>
	</div>
</div>
<?php 
   //Session::forget('doDirectPaymentResponse');
}else{ ?>
   <script type="text/javascript">
       window.location = "{{ url('/') }}";
   </script> 
<?php } ?>

<style>
.payment-text {font-size: 35px;}
.fa-check-circle{ font-size: 50px; color:#08c26d; }
#success {
    color: #08c26d;
    font-size: 25px;
    font-weight: bold;
    margin-bottom: 2%;
    margin-top: 1%;
    }
.right-section p{    font-size: 20px;
    font-weight: normal;
    margin-bottom: 0;
    margin-top: 4%; }
.right-section p span{ color: #08c26d;
    font-weight: 600; margin-left: 10px;}
    .right-section {
    background-color: #f8f8f8;
    border: 1px solid #f1f1f1;
    border-radius: 2px;
    padding: 35px 0;
}

@media only screen and (max-width:480px)
.right-section {
    font-size: 12px;
    padding-bottom: 40px;
}
</style>
@endsection