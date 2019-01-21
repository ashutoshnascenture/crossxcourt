
  <footer id="footer">
    <div class="footer-wrapper"> 
      
      <!-- Footer Top -->
      <div class="footer-top">
        <div class="footer-top-wrapper">
          <div class="container">
            <div class="row"> 
              <!-- About Block -->
              <div class="col-md-4">
                <div class="block block-about">
                  <div class="block-content"> <!--<img class="footer-logo" src="images/logo-footer.png" alt="" >-->
				  <p class="footer-logo"><img class="img-responsive" alt="logo" src=" {{asset('images/crossXcourt-logo.png')}}" width="190" height="37"></p>
				 
                    <p><?php echo Lang::get('footer.content'); ?></p>
                    <div class="social-links">
                      <ul class="icons-social">
                        <li><a href="https://www.facebook.com/crossxcourt/" target="_blank" class="fb-icon"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://twitter.com/crossxcourt" target="_blank" class="twiter-icon"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="http://www.linkedin.com/company/crossxcourt" target="_blank" class="link-icon"> <i class="fa fa-linkedin "></i></a></li>
                        <!--<li><a href="#" target="_blank" class="rss-icon"><i class="fa fa-rss"></i></a></li>-->
                        <li><a href="https://plus.google.com/+Crossxcourt" target="_blank" class="google-icon"><i class="fa fa-google"></i></a></li>
						<li><a href="skype:{{ Config::get('constants.SKYPE') }}?chat" target="_blank" class="skype-icon"><i class="fa fa-skype " ></i></a></li>
				
                      </ul>
					  
					<!--..............currency links..............-->
					 
					 
					 
					<?php
      $current_url = parse_url(LaravelLocalization::getNonLocalizedURL(Request::url()));

        
      ?>

       
      <ul id="languageSwitcher" class="language_bar_chooser">
		@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)           
			@if ($localeCode == 'en') 
				  <li>
					  <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ url('/en'.$current_url['path'])}}">
						  {{{ $properties['native'] }}}
					  </a>
				  </li>
			@else
				  <li>
					  <a rel="alternate" hreflang="<% $localeCode %>" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
						  {{{ $properties['native'] }}}
					  </a>
				  </li>
			@endif
		@endforeach
					   
                    </div>
                   
                  </div>
                </div>
              </div>
              <!-- End About Block --> 
              
              <!-- Footer Links Block -->
              <div class="col-md-2">
                <div class="block block-links">
                  <h3 class="block-title"><span><?php echo Lang::get('footer.company'); ?></a></li></span></h3>
                  <div class="block-content">
                    <ul class="company-links">
                      <li><a href="{{ url('/') }}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php echo Lang::get('footer.home'); ?></a></li>
                  
                      <!-- <li><a href="{{URL::to('/about-us')}}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php //echo Lang::get('footer.about_us'); ?></a></li> -->
					  
					  <li><a href="{{ url('contactus/') }}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php echo Lang::get('footer.contact_us'); ?></a></li>
					  
					  <li><a href="{{ url('frequently-asked-questions/') }}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php echo Lang::get('footer.faq'); ?></a></li>
					  
					  <li><a href="{{ url('terms-and-conditions/') }}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php echo Lang::get('footer.T&C'); ?></a></li>
					  
					   <!--<li><a href="{{URL::to('/company')}}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php //echo Lang::get('footer.company'); ?></a></li>
                      <li><a href="{{URL::to('/company-services')}}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php //echo Lang::get('footer.services'); ?></a></li>
                      <li><a href="{{URL::to('/privacy-policy')}}"><i class="fa fa-angle-right margin-right-10 footer-fa"></i><?php //echo Lang::get('footer.privacy_policy'); ?></a></li>-->
                     <!-- <li><a href="#."><i class="fa fa-angle-right margin-right-10"></i>Technologies</a></li>-->
                    </ul>
                  </div>
                </div>
              </div>
              <!-- End Footer Links Block --> 
              
              <!-- Twitter Widget Block -->
               <!--<div class="col-md-3">
                <div class="block block-twitter-widget">
                 <h3 class="block-title"><span><?php //echo Lang::get('footer.top_tennis_lesson_locations'); ?></span></h3>
                  <div class="block-content">
                    <ul class="lesson-location">
                      <li> <a href=""> Atlanta, GA </a> </li>
                      <li> <a href=""> Brooklyn, NY </a> </li>
                      <li> <a href=""> Dallas, TX </a> </li>
                      <li> <a href=""> Los Angeles, CA</a> </li>
                      <li> <a href=""> Philadelphia, PA</a> </li>
                      <li> <a href=""> San Diego, CA </a> </li>
                      <li> <a href=""> Santa Monica, CA </a> </li>
                      <li> <a href=""> Charlotte, NC</a> </li>
                      <li> <a href=""> Miami, FL </a> </li>
                      <li> <a href=""> Phoenix, AZ </a> </li>
                      <li> <a href=""> San Francisco, CA </a> </li>
                      <li> <a href=""> Tampa, FL</a> </li>
                      <li> <a href=""> Chicago, IL </a> </li>
                      <li> <a href=""> Boston, MA </a> </li>
                    </ul>
                  </div>
                </div>
              </div>-->
              <!-- End Twitter Widget Block --> 
              
              <!-- Instagram Widget Block -->
             <div class="col-md-2">
                <div class="block block-instagram-widget">
                  <h3 class="block-title"><span><?php echo Lang::get('footer.services'); ?></span></h3>
                  <div class="block-content">
                  <ul class="company-links">
                      <li> <a href="{{URL::to('/tennis-lessons')}}"><?php echo Lang::get('footer.tennis_lesson'); ?></a></li>
                      <li> <a href="{{URL::to('/play-with-pro')}}"><?php echo Lang::get('footer.Play_with_a_Pro'); ?></a></li>
                      <li><a href="http://www.crossxcourt.com/blog/" target="_blank"><?php echo Lang::get('footer.blog'); ?></a></li>
                      <!--<li> <a href="{{URL::to('/tennis-facility-management')}}"><?php //echo Lang::get('footer.tennis_facility_management'); ?></a> </li>
                      <li> <a href="{{URL::to('/group-tennis-lessons')}}"> <?php // echo Lang::get('footer.group_tennis_lessons'); ?></a> </li>
                      <li> <a href="{{URL::to('/tennis-hitting-lessons')}}"><?php //echo Lang::get('footer.tennis_hitting_lessons'); ?></a> </li>
                      <li> <a href="{{URL::to('/beginner-tennis-lessons')}}"><?php // echo Lang::get('footer.beginner_tennis_lessons'); ?></a> </li>
                      <li> <a href="{{URL::to('/adult-tennis-lessons')}}"><?php // echo Lang::get('footer.adult_tennis_lessons'); ?></a> </li>-->
					  
                    </ul>
                </div>
                </div>
              </div>
              <!-- End Instagram Widget Block --> 
              <div class="col-md-4">
                <div class="block block-instagram-widget">
                  <h3 class="block-title"><span>Contact Details</span></h3>
                  <div class="block-content">
                   <p><strong><?php echo Lang::get('footer.location'); ?></strong> : {{ Config::get('constants.ADDRESS') }}</p>
                    <p><strong><?php echo Lang::get('footer.call'); ?></strong> : {{ Config::get('constants.USA_NO') }}, {{ Config::get('constants.UK_NO') }} </p>
                    <p><strong><?php echo Lang::get('footer.email'); ?></strong> : {{ Config::get('constants.SITE_EMAIL') }} </p>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Footer Top --> 
      
      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <div class="footer-bottom-wrapper">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center copyright">
                <p> © [{{date('Y')}}] · crossXcourt</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Footer Bottom --> 
    </div>
  </footer>
  <!-- End Footer --> 
</div><!-- wrapper ends here -->
<script>
 /*  function change_currency(val)
   {
	    $.ajax({
            type: "GET",
            url: siteUrl + '/coaches/my-currency/'+val,
            success: function(showurl) {
			var change_url=window.location.href;
			window.location =change_url;
		   
            }
        });
	   
   }*/
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83643635-1', 'auto');
  ga('send', 'pageview');

</script>
