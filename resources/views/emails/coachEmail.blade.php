<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        
        <h2>Dear&nbsp; <?php echo ucfirst($first_name) ;?> <?php echo $last_name ;?></h2>
        <div>
			<p>
			 Thank you for registering as a coach on {{ Config::get('constants.SITE_NAME') }}. You are joining a global network of high quality coaches.</p>

				<b>What happens next?</b>
				<p>
				Before your profile goes live we will be in contact with you to introduce ourselves, to discuss how the booking system works, give you tips on how to improve your profile page and to answer any questions you may have. Please read our terms and conditions below.</p>

				What, how and when do I get paid?

				You tell us the minimum you want to get paid an hour. We will then discuss with you your external hourly rate. Remember to set your rate so that you attract as many bookings as possible while being paid fairly for your work.  

				We will pay you every two weeks in arrears for the lessons that have been completed satisfactorily in the prior two weeks. We will discuss the best payment options with you during your introductory call. </p>

				<p>We look forward to working with you,</p><br>

				Raymond Diez<br>
				CEO and Founder<br>
				{{ Config::get('constants.SITE_NAME') }}<br>
				raymond@crossXcourt.com<br>
				tel:  USA +1 (347) 589 9939<br>
				UK +44 7476 409693<br>
				Skype: {{ Config::get('constants.SKYPE') }}<br>
				 
				<a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a><br><br>


				<b>Terms and Conditions</b>

				<p>In becoming a coach on {{ Config::get('constants.SITE_NAME') }} you agree to the following terms and conditions.</p>

				<b>Your are your own boss….</b>

				 <ul> <li>You are responsible for setting your own schedule and work patterns. {{ Config::get('constants.SITE_NAME') }} does not guarantee a minimum level of work and you are not an employee of {{ Config::get('constants.SITE_NAME') }} and are therefore not entitled to any social security benefits, medical insurance or payments for sickness. </li></ul> 
				 <ul> <li>You agree to purchase your own personal liability insurance and agree not to hold {{ Config::get('constants.SITE_NAME') }} responsible for any injuries or accidents occurring during coaching sessions contracted through {{ Config::get('constants.SITE_NAME') }}. </li></ul> 

				<b>Weather is a hazard of the job</b>
				 <ul> <li>Lessons can be cancelled and rescheduled by mutual agreement with the client in the case of adverse weather, where the rain and the surface would significantly impact play and/or make it dangerous to play. You will not be paid for weather related cancelations, but the client’s credit will remain valid to use again with you. </ul> </li>

				<b>Mutual respect for your time and your client’s time</b>

				<ul> <li>You agree to give the client a minimum of 24 hours notice to cancel or re-schedule a lesson (except for in the case of rain). Similarly, the client must give you a minimum of 24 hours notice to cancel or re-schedule a lesson otherwise the full hourly charge applies. If a client contacts you directly to cancel you must inform {{ Config::get('constants.SITE_NAME') }} and we will also ask verification from the client.</ul> </li>

				<ul> <li>The full hourly charge applies in the case of lateness by the client. If the client is more than 30 minutes late without notifying the coach of the intention to still make the lesson then s/he forfeits the lesson but is still charged. If the coach is late, the time will be made up after the scheduled end of the lesson or in subsequent lessons. If the coach is more than 15 minutes late and the time is not made up, the client is entitled to request the lesson fee be adjusted by that amount. If the coach is more than 30 minutes late, the lesson is free however {{ Config::get('constants.SITE_NAME') }} will still retain it’s fees which will be deducted from the coach’s balance outstanding.</ul> </li>

				<ul> <li>The client pays for over-runs in 15-minute increments. You can go back and alter the lesson length in retrospect or email us to make the amendment. Make sure the client has enough lesson credits to cover this. When teaching minors you must expressly agree with the parents beforehand.</ul> </li>

				<b>Book a court to reduce uncertainty</b>

				<p>The amount paid by the client excludes court fees. When contacting the client to book the lesson you should, as best practice, discuss court fees and who will make the court booking. We strongly advise that a court is booked in advance. {{ Config::get('constants.SITE_NAME') }} will not be held responsible for any court fees not recouped from a client in the case of a direct court booking by a coach. </p>

				<b>Complaints – try to avoid these!</b>

				<p>We want clients to return to {{ Config::get('constants.SITE_NAME') }} to book again with our coaches. We also want our coaches to feel valued. We therefore take complaints very seriously and make every effort to investigate when complaints are made. You agree to let us to adjudicate the outcome. When and where there are an abnormal number of complaints against a coach, or a single complaint is serious enough we retain the right to withdraw the coach from our site.</p>

				<b>We believe in partnership with our coaches</b>

				<p>We are eager to receive feedback from our coaches on what could be improved, other services that could be offered. We are also happy to listen to complaints from our coaches and work constructively to resolve these. If we believe that a coach is not acting in partnership with {{ Config::get('constants.SITE_NAME') }} to our mutual benefit we retain the right to withdraw the coach from our side and terminate the relationship. We will also vet our coaches and if we become aware of any false claims made or feel that the coaching standard is not sufficient for our clients, we also reserve the right to withdraw the coach from our site.</p>

			</p>
			 
			<p>&nbsp;</p>
        </div>
	</body>
</html>
