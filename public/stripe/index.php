<?php 
$base = __DIR__;
require_once $base.'/stripe/init.php';
\Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");
\Stripe\Stripe::$apiBase = "https://api-tls12.stripe.com";
try {
  \Stripe\Charge::all();
  echo "TLS 1.2 supported, no action required.";
} catch (\Stripe\Error\ApiConnection $e) {
   //echo '<pre>'; print_r($e);
  echo "TLS 1.2 is not supported. You will need to upgrade your integration.";
}
?>