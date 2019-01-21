<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       <p><B>Your lesson has been cancelled.</b></P>
	<p>
			Date:&nbsp;<?php echo $date ; ?>
		<br>Time:&nbsp;<?php echo $start_time ;?>
		<br>Location:&nbsp;<?php echo $name . ",&nbsp;" . $address . ",&nbsp;" . $city ; ?>
		<br>Coach:&nbsp;<?php echo ucfirst($coach_first_name) . ',&nbsp;' . ucfirst($coach_last_name); ?>
	</p>
	 
	<p>If you need to reschedule the lesson please contact your coach to do so. If you need our assistance or believe that the lesson has been cancelled in error, please do not hesitate to contact us.</p>
	
		<p>We look forward to working with you,</p><br>

	Raymond Diez<br>
	CEO and Founder<br>
	{{ Config::get('constants.SITE_NAME') }}<br>
	raymond@crossXcourt.com<br>
	tel:  USA +1 (347) 589 9939<br>
	UK +44 7476 409693<br>
	Skype: {{ Config::get('constants.SKYPE') }}<br>
	 
	<a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a><br><br>
	</body>
</html>

 

