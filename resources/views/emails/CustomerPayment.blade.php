<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	
	<div>
		<h2>Dear <?php echo ucfirst($customer_first_name) ; ?>&nbsp;<?php echo $customer_last_name ;  ?></h2>

		<p>
			Thank you for booking with {{ Config::get('constants.SITE_NAME') }}. Please find below the details of your booking
		</p><br>
		
		Coach name:&nbsp;<?php echo $coach_first_name ; ?>&nbsp;<?php echo $coach_last_name ?><br>	
		Coach’s email address:&nbsp;<?php echo $coach_email ; ?><br>
		Coach’s phone number:&nbsp;<?php echo $coach_mobile ; ?><br>
		 
		 
	 
		<!-- Contact my coach button (should link to the email of the coach) --><br>

		<p><b>What happens next?</b></p>

		<p>Your coach will soon be in touch to arrange your lesson. If you know where you want your session to be held let him or her know. Otherwise your coach should be able to suggest some places. Once you have agreed on a day and time your coach will make a booking in the crossXcourt system and you will receive an email confirmation of the booking. Remember to ask about court costs (as these are not included in the crossXcourt fee) and to agree who will make the court booking. We strongly advise you book a court in advance of the lesson to avoid disappointment and to help guarantee the lesson will take place.</p>

		<p>We truly hope that you will have fun during your lessons and will continue to use crossXcourt. Please read our terms and conditions below which also answer some frequently asked questions. Feel free to contact us with any further questions that you may have.</p> 

		<br>Raymond Diez<br>
		CEO and Founder<br>
		{{ Config::get('constants.SITE_NAME') }}<br>
		raymond@crossXcourt.com<br>
		tel:  USA +1 (347) 589 9939<br>
		UK +44 7476 409693<br>
		Skype: {{ Config::get('constants.SKYPE') }}<br>
		
		{{ Config::get('constants.SITE_NAME') }}<br>
			 
		<a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a><br>
		<br>
		<p><b>Terms and Conditions</b></p>


		<p><b>Weather is a hazard of the game….</b></p>

		We are not weather gods and cannot control the weather. Our coaches are instructed to make judgments based on the safety of and satisfaction our customers. In the case of inclement weather we ask the coach and customer to individually agree as to whether the lesson should proceed. In the case of a mutually agreed cancellation the lesson will be re-credited to your account. If a lesson starts and is abandoned the customer will be credited the remainder of the lesson (rounded down to the nearest 15 minutes).

		<p><b>Mutual respect for your time and your coach’s time</b></p>

		<ul><li>Due to differences in time zones you agree to give a minimum of 48 hours to cancel or reschedule your first booking with a specific coach and 24 hours thereafter (except in the case of rain) otherwise the full hourly charge applies.  We ask our coaches to adhere to the same principles. In the case that this does not occur and you have not reached a reasonable outcome with the coach, please inform us and we will investigate. </ul></li>

		<ul><li>We pick our coaches because they are good and they are therefore in demand. We understand that sometime lateness cannot be helped and we ask our coaches to be as flexible as possible. However please understand that in the case of lateness the full hourly charge applies even if our coaches cannot accommodate an hour lesson. If you are more than 30 mins late without notifying the coach you forfeit the lesson but will still be charged. Conversely,  if the coach is late, the time will be made up after the scheduled end of the lesson or in subsequent lessons. If the coach is more than 15 minutes late and the time is not made up, you are entitled to request the lesson fee be adjusted by that amount. If the coach is more than 30 minutes late, the lesson is free.</ul></li>

		<ul><li>You agree to pay for over-runs in 15-minute increments subject to you having enough lesson credit availability. If you wish to restrict this option (for unaccompanied children etc.) please notify the coach.</ul></li> 

		<p><b>Complaints – let us know!</b></p>

		<p>We want you to be happy with your coach. We pride ourselves on our global selection of high quality coaches so we encourage feedback and you can review your coach after your lesson. If you feel there is something we can do better please let us know. We aim to resolve all complaints to the satisfaction of our customers and if we believe you have been given a substandard service we will refund your money without hesitation.</p> 

		<p><b>Liability waiver</b></p>

		We act as a coaching exchange linking coaches with players. We do not have control over where you play and when you play. Therefore we do not accept any liability for any injuries sustained during lessons facilitated by crossXcourt and you agree not to hold crossXcourt liable.</p>

		<p><b>Refunds</b></p>
		<p>We will keep any unused hours on account or you can request a refund. Your hours never expire.</p>
		 {{ Config::get('constants.SITE_NAME') }}<br>
		 {{ Config::get('constants.SITE_ADDRESS') }}
		
		<p>&nbsp;</p>
	</div>
</body>
</html>
