@extends('app')
@section('content')
      <script>
  
		function rateAlert(id, rating)
		{ 
			document.getElementById('rating').value = rating;
		}
		$(function() {
			$('.ratebox' ).raterater( { 
				submitFunction: 'rateAlert', 
				allowChange: true,
				starWidth: 30,
				spaceWidth: 5,
				numStars: 5
			});
		});
      </script>
	 
   	  
	<div class="container-fluid">
	 <div class="row">
	 @include('includes.sidebar')
	  <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section profile-content pull-right">
	 
		<h2 class="student-title review">Review</h2>
		<hr>
		 <div class="col-md-9 col-md-offset-1 form-container">
		<div class="panel-body">
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
		 
		   @if(session('message'))
		   <div class="alert alert-success">
		   {{session('message')}}
		   </div>
		  @endif
		 
		<form class="form-horizontal" role="form" method="POST" action="{{ LaravelLocalization::localizeURL('customer/store-review')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
 
			<div class="form-group label-text-area">
		   <label class="">Rating</label>
		
		  <!-- Lets add some rating boxes -->
		  <!----------hidden fields---------------->
		   <input type="hidden" id="rating" name="rating" value="">
		   <input type="hidden" name="booking_id" value="{{$id}}">
		  <!----------hidden fields------------------>
		  <div class="ratebox" data-id="1" data-rating="0"></div>
		</div>
	   <!--rating-->
	   
	   
	   
	   
		  <div class="form-group">
		   <label class="">Review</label>
		   <input type="hidden" name="coach_id" value="{{$coach_id->coach_id}}">
		   <input type="hidden" name="lesson_id" value="{{$coach_id->id}}">
		   <div class="">
			<textarea name="review" rows="5" class="form-control"></textarea>
		   </div>
		  </div>


		  <div class="form-group">
		   <div class="">
			<button type="submit" class="btn btn-success my-buttons">Submit</button>

		  
		   </div>
		  </div>
		 </form>
		</div>
		</div>
	  
	  </div>
	 </div>
	</div>
@include('includes.footer')
@endsection
