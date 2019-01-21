 @extends('app')
@section('title','Price')
@section('content')


 
      <div class="profile-sec ">
        <div class="col-md-8 col-md-offset-2  profile-content">
            
					<div class ="pending-review ">
						<h2 class="text-center"><?php echo Lang::get('review.almost_done'); ?></h2><br>
						<p><?php echo Lang::get('review.activate'); ?> <b>{{ Config::get('constants.ADMIN_EMAIL') }}</b> <?php echo Lang::get('review.call'); ?>&nbsp;<b>+44 7476 409693</b></p>

						 
					</div>
				

             
        </div>
		</div>
		

</div>
<style>

</style>
@include('includes.footer')
@endsection
