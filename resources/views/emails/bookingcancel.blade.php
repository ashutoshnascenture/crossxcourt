<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>Booking Cancel.</h2>
	<div>
		<p>
		Your booking on date <?php echo $booking_date ; ?> with <?php  echo ucfirst($coach_first_name) ; ?><?php echo ($coach_last_name); ?>  has been cancelled. If you need to reschedule the lesson please contact your coach directly. If you believe that this is an error, please contact the {{ Config::get('constants.SITE_NAME') }} admin team at {{ Config::get('constants.SITE_EMAIL') }} or skype: {{ Config::get('constants.SKYPE') }}

		</p>
		Best wishes<br>
		{{ Config::get('constants.SITE_NAME') }}<br>
		<a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a>
	</p>			 
	<p>&nbsp;</p>
</div>
</body>
</html>
