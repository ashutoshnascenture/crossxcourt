@extends('app')
 @section('content')
 
 		
 <div class="container-fluid">
	 
    <div class="row">
		 
		@if(empty($data->user_id)) 
		 @include('includes.step_sidebar')
		   <div class="col-md-10 right-content-form-section col-md-offset-1 profile-content">
            <h2 class="student-title"><?php echo Lang::get('service_area.heading1'); ?></h2>
            <hr/>
            <p><?php echo Lang::get('service_area.text_sec'); ?></p>
            <ul class="list-info">
                <li>
                  <i class="fa fa-angle-double-right right-list-arrows"></i>
                  <?php echo Lang::get('service_area.click'); ?>
              </li>
              <li>
                  <i class="fa fa-angle-double-right right-list-arrows"></i>
                  <?php echo Lang::get('service_area.click2'); ?>
              </li>
          </ul>
          <p><?php echo Lang::get('service_area.para'); ?></p>

          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
		
		<?php
        $service_area = null;
        if(Session::get('service_area')){
			$service_area = Session::get('service_area');
        }
        elseif($data && $data->service_area){
			$service_area = $data->service_area;
        } ?>

       <form class="" role="form" method="POST" action = "{{LaravelLocalization::localizeURL('coaches/coacharea')}}">
        <div class="form-group label-text-area">
            <label for="coverage_area"><?php echo Lang::get('service_area.label'); ?></label>
            <select class="selectpicker form-control box-select" id="coverage_area" name = "service_area">
				<?php $miles = Lang::get('service_area.coverage_area'); 
				 
				if($service_area && !in_array($service_area,$miles)){
					$miles[] = $service_area;
					 
				}
				 
				?>
				
                @foreach($miles as $area)
                
                <option @if($service_area == $area) selected="selected" @endif>{{$area}}</option>
                @endforeach
            </select>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="latitude" name="latitude" value="{{$address['lat']}}" />
            <input type="hidden" id="longitude" name="longitude" value="{{$address['lng']}}" />
        </div>
        <div class="col-md-12 google-map">

            <div id="map-canvas" style="width:100%; height:350px;"></div>

        </div>
        <p>&nbsp;</p>

        <div class="form-group">
            <div class="">
                <button type="submit" class="btn btn-success my-buttons save-btnnn">
                 <?php echo Lang::get('service_area.save'); ?>
             </button>

         </div>
     </div>


 </form>
</div>
</div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initialize"
type="text/javascript"></script>
		@else 
		@include('includes.sidebar')
		  <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('service_area.heading1'); ?></h2>
            <hr/>
            <p><?php echo Lang::get('service_area.text_sec'); ?></p>
            <ul class="list-info">
                <li>
                  <i class="fa fa-angle-double-right right-list-arrows"></i>
                  <?php echo Lang::get('service_area.click'); ?>
              </li>
              <li>
                  <i class="fa fa-angle-double-right right-list-arrows"></i>
                  <?php echo Lang::get('service_area.click2'); ?>
              </li>
          </ul>
          <p><?php echo Lang::get('service_area.para'); ?></p>

          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
		
		<?php
        $service_area = null;
        if(Session::get('service_area')){
			$service_area = Session::get('service_area');
        }
        elseif($data && $data->service_area){
			$service_area = $data->service_area;
        } ?>
		<?php //echo $service_area ; die; ?>
       <form class="" role="form" method="POST" action = "{{LaravelLocalization::localizeURL('coaches/coacharea')}}">
        <div class="form-group label-text-area">
            <label for="coverage_area"><?php echo Lang::get('service_area.label'); ?></label>
            <select class="selectpicker form-control box-select" id="coverage_area" name = "service_area">
				<?php $miles = Lang::get('service_area.coverage_area'); 
				 
				if($service_area && !in_array($service_area,$miles)){
					$miles[] = $service_area;
				}
				 
				?>
				
                @foreach($miles as $area)
                
                <option @if($service_area == $area) selected="selected" @endif>{{$area}}</option>
                @endforeach
            </select>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="latitude" name="latitude" value="{{$address['lat']}}" />
            <input type="hidden" id="longitude" name="longitude" value="{{$address['lng']}}" />
        </div>
        <div class="col-md-12 google-map">

            <div id="map-canvas" style="width:100%; height:350px;"></div>

        </div>
        <p>&nbsp;</p>

        <div class="form-group">
            <div class="">
                <button type="submit" class="btn btn-success my-buttons save-btnnn">
                 <?php echo Lang::get('service_area.save'); ?>
             </button>

         </div>
     </div>


 </form>
</div>
</div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initialize"
type="text/javascript"></script>
		@endif 
			
      



<script>

var default_area = $("#coverage_area").val();//miles
 //alert(default_area);
var number = parseInt(default_area, 10);
var default_area = number ; 
//alert(default_area);
var zoom = 8;

function initialize() {

    if (default_area < 15){
        zoom = 10;
    }
    else if (default_area >= 15 && default_area < 21){
        zoom = 9;
    }
    else if (default_area > 25){
        zoom = 8;
    }

    default_area *= 1600;
    var mapDiv = document.getElementById('map-canvas');
    philly = new google.maps.LatLng({{$address['lat']}}, {{$address['lng']}})

    map = new google.maps.Map(mapDiv, {
		center: philly,
		zoom: zoom,
		scrollwheel: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		navigationControl: true,
		navigationControlOptions: {
			style: google.maps.NavigationControlStyle.SMALL
		}
		
	});
	
    var circle = {
        strokeColor: "#ff0000",
        strokeOpacity: 0.8,
        strokeWeight: 1,
        fillColor: "#ff0000",
        fillOpacity: 0.20,
		editable: true,
        map: map,
        center: philly,
        radius: default_area
    };
    
	var drawCirle = new google.maps.Circle(circle);
	
	google.maps.event.addListener(drawCirle,'center_changed', function() {
		 
		$('#latitude').val(drawCirle.getCenter().lat());
		$('#longitude').val(drawCirle.getCenter().lng());
	}); 
	 
	google.maps.event.addListener(drawCirle,'radius_changed', function() {
		var newRadius = getMiles(drawCirle.getRadius()) + ' miles';
		$('#coverage_area :selected').text(newRadius).val(newRadius);
		
	});  
	
}

$(function(){
    $('#coverage_area').change(function(){
        default_area = $(this).val().split(' ');
        default_area = default_area[0];
        initialize();
    });
});
	
function getMiles(i) {
    return (i*0.000621371192).toFixed(2);
}

</script>
</div>
</div>
@include('includes.footer')
@endsection
