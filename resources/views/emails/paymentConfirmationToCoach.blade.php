<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <div>
            <h2>Hi <?php echo ucfirst($coach_first_name); ?>&nbsp;<?php echo $coach_last_name; ?></h2>

            <p>
                Customer Details	
            </p><br>

            Customer name:&nbsp;<?php echo ucfirst($customer_first_name); ?>&nbsp;<?php echo $customer_last_name ?><br>	
            Customer’s email address:&nbsp;<?php echo $cus_email; ?><br>
            Customer’s phone number:&nbsp;<?php echo $cus_mobile; ?><br>
            Customer’s preferred day:&nbsp;<?php echo $preferred_day; ?><br>
            Customer’s preferred time:&nbsp;<?php echo $preferred_day; ?><br>
            Additional Players:&nbsp;<?php echo $additional_players; ?><br>
            Lessons:&nbsp;<?php echo $lessons; ?><br>



            <br>Raymond Diez<br>
            CEO and Founder<br>
            {{ Config::get('constants.SITE_NAME') }}<br>
            raymond@crossXcourt.com<br>
            tel: {{ Config::get('constants.USA_NO') }}<br>
            tel: {{ Config::get('constants.UK_NO1') }}<br>
            Skype: {{ Config::get('constants.SKYPE') }}<br>

            {{ Config::get('constants.SITE_NAME') }}<br>

            <a href="www.crossXcourt.com">{{ Config::get('constants.SITE_ADDRESS') }}</a><br>
            <br>
        </div>
        <!-- Contact my coach button (should link to the email of the coach) --><br>
    </body>
</html>
