<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        
        <h2>Coach Name&nbsp; <?php echo ucfirst($first_name) ;?> <?php echo $last_name ;?></h2>
        <div><br>
			<b>Email address:</b>&nbsp;<?php echo $email ; ?><br>
			<b>County:</b>&nbsp;<?php echo $country ; ?><br>
			<b>State:</b>&nbsp;<?php echo $state ; ?><br>
			<b>City:</b>&nbsp;<?php echo $city ; ?><br>
			<a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a><br><br>
			 
			 
        </div>
	</body>
</html>
