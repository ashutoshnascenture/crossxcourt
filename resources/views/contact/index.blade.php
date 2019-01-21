 @extends('app')
@section('content')
<section class="address-map">
    <div id="map"></div>
</section><!-- apply coaches section ends here -->
<!-- middle white section starts here -->
<section class="margin-top-bottom-5" id="services-area-section">
    <div class="container" id="contact">
	     <h3 class="contact-title"><?php echo Lang::get('contactUs.send_message'); ?></h3>
        <div class="contact-form col-md-8" > 
			<div>
				<?php
                if (Session::get('success')) {
                    ?>
                    <div class="alert alert-success">
                        <?php echo Session::get('success'); ?>
                    </div>
                    <?php
                }
                ?>
				
				
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif 
			</div>
       
            <div class="inner-form">
            <form class="form" method="POST" action="{{ LaravelLocalization::localizeURL('/contactus/store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group required">
                        <label for="name"><?php echo Lang::get('contactUs.name'); ?></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="<?php echo Lang::get('contactUs.name'); ?>">
                    </div>
                    <div class="form-group required">
                        <label for="email"><?php echo Lang::get('contactUs.email'); ?></label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}"  placeholder="<?php echo Lang::get('contactUs.email'); ?>">
                    </div>
                    <div class="form-group required">
                        <label for="msg"><?php echo Lang::get('contactUs.message'); ?></label>
                        <textarea rows="5" cols="" class="message-box form-control" id="msg" name="message">{{ old('message') }}</textarea >
                    </div>
                    <input type="submit" name="Send" value="Send" class="btn my-buttons">
            </form>
			</div>
        </div>
        <div class="contact-address col-md-4"> 
            <div class="inner-address">
                <h4 class="address-title"> <?php echo Lang::get('contactUs.contact_information'); ?></h4>
                <p><?php echo Lang::get('contactUs.para_contact'); ?></p>
                <ul class="addres-box">
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{ Config::get('constants.ADDRESS') }}</li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i>+1 (349) 589 9939 (USA)</li>
					<li><i class="fa fa-phone" aria-hidden="true"></i>+44 7476 40 96 94 (UK)</li>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ Config::get('constants.SITE_EMAIL') }} </li>
                    <li><i class="fa fa-globe" aria-hidden="true"></i> {{config::get('constants.SITE_ADDRESS')}} </li>
                    <li><i class="fa fa-skype" aria-hidden="true"></i> {{config::get('constants.SKYPE')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="clr"></div>
<script>
      function initMap() {
        var uluru = {lat: -4.653714, lng: 55.487322};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initMap">
    </script>
</script>
 <style>
       #map {
        height: 300px;
        width: 100%;
       }
</style>
 @include('includes.footer')
@endsection


