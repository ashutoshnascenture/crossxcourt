<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Lesson {{ $create }}.</h2>
        <div>
			<p>
			Coach name:&nbsp;<?php echo ucfirst($coach_first_name); ?>&nbsp;<?php echo ucfirst($coach_last_name); ?><br>
			Date:&nbsp;<?php echo $date ;?><br>
			Start time:&nbsp;<?php echo  $start_time ;  ?><br>
			Coach email:&nbsp;<?php echo  $coach_email ;  ?><br>
			Coach telephone number:&nbsp;<?php echo  $coach_mobile ;  ?><br>
			Lesson duration:&nbsp;@if($lesson_duration == 1){{ $lesson_duration }} hour  @else {{ $lesson_duration }} hours @endif <br>

		 
			Number of students:&nbsp;<?php echo  $number_of_students ;  ?><br>
			Lesson credits remaining:&nbsp;<?php echo  $used_hours ;  ?><br>
			Court name:&nbsp;<?php echo  ucfirst($court) . "&nbsp;<br>" .  ucfirst($court_address) . "&nbsp;<br>" .  ucfirst($court_city)   ."," ."&nbsp;" .  ucfirst($court_state) ?><br>
			 
 
			</p>
			<p>
			   Lesson cancellation policy:</p> 48 hours in advance of the first lesson with a coach, 24 hours thereafter <p>Court fees:</p> Not included unless otherwise specified 
			   <p>Equipment:</p> 
			   Player to provide own racquet unless pre-agreed with coach. If new balls are required please agree with the coach in advance. The player will be expected to reimburse the coach for new balls.
			   <p> Weather:</p> In the case of inclement weather lessons can be cancelled by mutual agreement. Please refer to our full terms and conditions 


			</p><br>
			
			 {{ Config::get('constants.SITE_NAME') }}<br>
			 <a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a>
			<p>&nbsp;</p>
        </div>
	</body>
</html>

 
