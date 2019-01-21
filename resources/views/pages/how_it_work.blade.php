@extends('app')
@section('content')
 
	<section class="secion-working margin-top-bottom-5">
		<div class="container working-sec">
			<h2 class=" text-center"><?php echo $page->title; ?></h2>
				<?php  echo $page->content; ?>
		</div>
	</section>
	 
	<section class="apply-coaches padding-top-bottom-5 work-search">
		<div class="container">
		<form class="form-inline search-form text-center" action="{{ LaravelLocalization::localizeURL('find-services') }}" method="post">
		 
		
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-group postal postal-1">
				<input type="text" class="form-control" id="postal" name="zip_code" placeholder="<?php echo Lang::get('welcome.place_holder'); ?>" required>
			</div>
			<div class="form-group postal">
				<select class="selectpicker form-control box-select" id="country_list" name="country_code" required>
					<option value=""><?php echo Lang::get('welcome.country'); ?></option>
					@foreach($countries as $country)
					<option value="{{$country->sortname}}">
						{{$country->name}}
					</option>
					@endforeach
				</select>
				<input type="hidden" name="country" id="countryName" value="">
			</div>
			<div class="form-group postal">
				<select class="selectpicker form-control box-select" id="state_list" name="state">
					<option value=""><?php echo Lang::get('welcome.state'); ?></option>	
				</select>
			</div>
			<button type="submit" class="btn btn-success search-coach"><?php echo Lang::get('welcome.search_coaches'); ?></button>
		</form>
		</div>
    </section> 
 
   <script>

$(function(){
	 
	$('#country_list').change(function(){

		var country_name = $("#country_list option:selected").text().trim();
		document.getElementById('countryName').value=country_name; 
		
		$.get(siteUrl+"/cntname/" + $(this).val(), function( data ) { 
			
			
		});
	});
	
});
 
</script>
@include('includes.footer')
@endsection
