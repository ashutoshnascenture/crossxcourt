<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Welcome to {{ Config::get('constants.SITE_NAME') }}!</h2>
        <div>
			
				<p>Our aim is to link players with high quality tennis coaches globally so you can play whenever, wherever.</p>

				<p>We understand that finding good tennis coaches is not always easy, particularly if you are in a new area or new country. We built this platform to make this process easier. {{ Config::get('constants.SITE_NAME') }} enables you to:</p>

				<ul><li>Find good and experienced coaches wherever your travel for you and/or your family.</ul></li>
				<ul><li>Book in advance to suit your busy schedule</ul></li>
				<ul><li>Introduce your children to a fun and healthy activity that at the same time teaches control and discipline.</ul></li>
				<ul><li>Use a secure method of payment, no need for cash with recourse if your lesson does not take place.</ul></li>
				<ul><li>Have confidence that we will work to resolve all issues to your satisfaction.</ul></li>


				<p>Click below to make your first booking or contact us on {{ Config::get('constants.SITE_EMAIL') }} +1 (347) 589 9939
				+44 7476 40 96 93
				Skype: {{ Config::get('constants.SKYPE') }}</p>

				<p>We look forward to working with you!</p>

				 <a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a>

			 
			<p>&nbsp;</p>
        </div>
	</body>
</html>
