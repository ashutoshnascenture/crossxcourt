<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>You have received a new message from the enquiries from on your website.</h2>
        <div>
			<p>
			 Registration success.<br>
			 Name: <?php echo ucfirst($name) ;?><br>
			 Email: <?php echo $email ;?><br>
			 message: <?php echo ucfirst($bodyMessage) ;?><br>
			  
			</p>
			 {{ Config::get('constants.SITE_NAME') }}<br>
			 <a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a>
			<p>&nbsp;</p>
        </div>
	</body>
</html>
