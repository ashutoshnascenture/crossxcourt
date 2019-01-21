@extends('app')
@section('content')
 
 <div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')

        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('review.prefered_location'); ?></h2>
			<hr>
            <p><?php echo Lang::get('review.click'); ?>&nbsp;<strong><?php echo Lang::get('review.add_court'); ?></strong> <?php echo Lang::get('review.select'); ?></p>
            <p><?php echo Lang::get('review.selected_maps'); ?></p>
            <p><?php echo Lang::get('review.content'); ?>&nbsp;<a href="">{{ Config::get('constants.SITE_EMAIL') }}</a>&nbsp;<?php echo Lang::get('review.details'); ?></p>
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content add_cart_section">
            <div class="col-md-6 col-sm-12 col-xs-12 pull-left">
                <a href="#" class="btn btn-success click-add btn-block" data-toggle="modal" data-target="#myCourts"><?php echo Lang::get('review.add_cart'); ?></a>

                <div class="map_section1" >
                    <div id="map-canvas" style="with:500px; height:400px; "></div>
                </div>
            </div>
            <?php // echo "<pre>"; print_r($courts); die; ?>

            <div class="col-md-6 col-sm-12 col-xs-12 pull-right address-right" id="courtLists">
               @if(count($courts))


					@foreach($courts as $court)	

						<form method="" action="{{URL::to('coaches/deletecourt')}}/{{$court->id}}" id="{{$court->id }}" accept-charset="UTF-8" id="courtLists">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_method" value="DELETE">
						</form>

					@endforeach

				@else
				 
				@endif
				
            </div>
           
        </div>
    </div>
</div>
<!-- coort Modal -->
<div id="myCourts" class="modal fade" role="dialog">
  <div class="modal-dialog" style="z-index:9999;">
 
    <div class="modal-content">
	<form method="post" action="{{LaravelLocalization::localizeURL('coaches/store-court')}}" id="addcourts">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		 <input type="hidden" name="latlng" id="latlng">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo Lang::get('lesson.add_location'); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="map-box padding-left-right-2">
				<div id="coachLoaction" style="height:300px"> </div>
				<div class="checkbox">
				  <label>
					<input type="checkbox" value="1" name="student_pays_equipment_fee">
					<?php echo Lang::get('lesson.Equipment_free'); ?>
				  </label>
				</div>
				<div class="checkbox">
				  <label>
					<input type="checkbox" value="1" name="student_pays_facility_fee">
					<?php echo Lang::get('lesson.facility_fee'); ?>
				  </label>
				</div>
			</div>
			<div class="col-md-6 form-bar">
			
				  <div class="form-group label-text-area">
					<label for="name"><?php echo Lang::get('lesson.court_name'); ?></label>
					<input type="text" class="form-control" id="name" placeholder="<?php echo Lang::get('lesson.placeholder_court_name'); ?>" name="name">
				  </div>
				  
				   <div class="form-grouplabel-text-area">
					<label for="address"><?php echo Lang::get('lesson.address'); ?></label>
					<textarea name="address" id="address" class="form-control" placeholder="<?php echo Lang::get('lesson.placeholder_address'); ?>"></textarea>
				  </div>
					
					<div class="form-group label-text-area">
					<div class="form-left-box">
					<label for="country_list"><?php echo Lang::get('lesson.country'); ?></label>
					<select class="form-control box-select" id="country_list" name="country">
					<option value=""><?php echo Lang::get('lesson.placeholder_country'); ?></option>
						@foreach($countries as $country)
							<option value="{{$country->sortname}}">
								{{$country->name}}
							</option>
						@endforeach
					</select>
					&nbsp;
					</div>
					<div class="form-right-box">
						<label for="state_list"><?php echo Lang::get('lesson.state'); ?></label>
						<select class="selectpicker form-control box-select" id="state_list" name="state">
							<option value=""><?php echo Lang::get('lesson.placeholder_state'); ?></option>	
						</select>
					</div>
					<div class="clearfix"></div>
				  </div>
				  
				   <div class="form-group label-text-area">
					
					<label for="city"><?php echo Lang::get('lesson.city'); ?></label>
					<input type="text" class="form-control" id="city" placeholder="<?php echo Lang::get('lesson.placeholder_city'); ?>" name="city">
					
				  </div>
				  
					
				   <div class="form-group label-text-area">
					<label for="zip_code"><?php echo Lang::get('lesson.zip_code'); ?></label>
					<input type="text" class="form-control" id="zip_code" placeholder="<?php echo Lang::get('lesson.placeholder_zip_code'); ?>" name="zip_code">
					
				  </div>

				    
				  
			</div>
		</div>
      </div>
      <div class="modal-footer">
		 <button type="submit" class="btn btn-success  my-buttons"><?php echo Lang::get('lesson.save_changes'); ?>
		 
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Lang::get('lesson.close'); ?></button>
      </div>
	  
	  </form>
    </div>

  </div>
</div>


<div class="modal fade" id="confirm-court" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel"><?php echo Lang::get('usersMessage.del_court'); ?></h4>
			</div>
		
			  <div class="modal-body">
				<?php echo Lang::get('usersMessage.delete'); ?>
			  </div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Lang::get('usersMessage.cancel_button') ?></button>
				<a href="#" class="btn btn-danger" id="danger_court"><?php echo Lang::get('usersMessage.delete_button') ?></a>
			</div>
		</div>
	</div>
</div>

<style>
.modal-dialog {
  width: 45%;
}

</style>
<!-- modal end here-->
 
<script type="text/javascript">
      
	var map1;
	
	function initMap(myLatLng,zoom){
		  
        map1 = new google.maps.Map(document.getElementById('coachLoaction'), {
          zoom: zoom,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
			position: myLatLng,
			map: map1,
			title: '',
			draggable:true,
        });

		$('#latlng').val(marker.position.lat() + ','+ marker.position.lng());
		
		google.maps.event.addListener(marker, 'dragend', function() {
			  
			var latLng = marker.position.lat() + ','+ marker.position.lng();
			$('#latlng').val(latLng);
		});

                 
    }
    
    
 function bindInfoWindow(marker, map, infoWindow, html) {
		var event  = google.maps.event.addListener(marker, 'click', function() {
		map.panTo(marker.getPosition());
		map.setZoom(17);
		infoWindow.setContent(html);
		infoWindow.open(map, marker);      });
    }

	
	 
	$("#myCourts").on("shown.bs.modal",function(){
		//google.maps.event.trigger(map, 'resize');
		var myLatLng = {lat: {{$coach->latitude}}, lng: {{$coach->longitude}} };
		initMap(myLatLng,7);
    });

	
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initialize"

type="text/javascript"></script>
<script>
//..........slide_form...............	
jQuery('li > a[href^="#"]').click(function(e) {
	
	jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top}, 1000);
	
	return false;
	
	e.preventDefault();
	
});
//..........slide_form...............

var default_area =  "{{$coach->Info['service_area']}}"; //miles
default_area = default_area.split(' ');
default_area = default_area[0]; 
console.log(default_area);
default_area *= 1600;



var gmarkers = []; 

function initialize() {
	
	var map = new google.maps.Map(document.getElementById("map-canvas"), {
        center: new google.maps.LatLng({{$coach->latitude}}, {{$coach->longitude}}),
        zoom: 9,
        mapTypeId: 'roadmap'
    });
	   
	var infoWindow = new google.maps.InfoWindow;
	
	var philly = new google.maps.LatLng({{$coach->latitude}}, {{$coach->longitude}});
	
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
	
    <?php 
		foreach($courts as $key =>  $court) { ?>
			
			var address  = '<?php echo $court->address ?>';
			var city  = '<?php echo $court->city ?>';
			var state  = '<?php echo $court->state ?>';
			var name  = '<?php echo ucfirst($court->name) ?>';
			var lat  = '<?php echo $court->latitude ?>';
			var lng  = '<?php echo $court->longitude ?>';
			var zip  = '<?php echo $court->zip_code ?>';
			var i = '{{$key}}';
			
			var marker = new google.maps.Marker({
				map: map,
				position:new google.maps.LatLng(lat,lng),
				title: ""+name+""
			
			});   
			   
			var html = "<b>" + name + "</b> <br/>" + address + "<br/>" + city + ',&nbsp;'  + state + '&nbsp;' + zip;
			
			//console.log(html);
			  
			//$('.address-right').append(html); 
			  
			gmarkers.push(marker);
			
			$('.address-right').append('<p><a class="map-biz"  data='+i+' href="javascript:show(' + i + ')" id="link' + i + '"> ' + html + '</a></p>');
           
			$('.address-right').append('<a class="btn my-btn btn-delete btn-danger" data-href="{{$court->id}}" data-toggle="modal" data-target="#confirm-court" href="#" style="margin-left:16px"><i class="fa fa-trash-o trash" aria-hidden="true"></i><?php echo Lang::get('review.delete'); ?></a>');
            bindInfoWindow(marker, map, infoWindow, html);
           
			 
			<?php 
			
		}
    ?>
        
        
	
}

	function show(i) {
		google.maps.event.trigger(gmarkers[i], 'click');
	}
	
	
	function bindInfoWindow(marker, map, infoWindow, html) {
		 
		var event  = google.maps.event.addListener(marker, 'click', function() {
			map.panTo(marker.getPosition());
			map.setZoom(17);
			infoWindow.setContent(html);
			infoWindow.open(map, marker);
		});
    }
	
		
//............rating...................
$(function() {
		
	$("body").on("click",'.map-biz', function(){
		var i = $(this).attr('data');
		google.maps.event.trigger(gmarkers[i], 'click');
	});
		
		
	$('.ratebox' ).raterater( { 
		submitFunction: 'rateAlert', 
		allowChange: true,
		starWidth:20,
		spaceWidth: 5,
		numStars: 5,
		isStatic: true
	});
	var country, state;
	$('#country_list').change(function(){
		country = $("#country_list option:selected").text();
		var query = 'country='+country;
		getLatLng(query,4);	
		
	});
	
	$('#state_list').change(function(){
		state = $(this).val();
		var query = 'country='+country+'&state='+state;
		getLatLng(query,12);	
	});
	
	$('#zip_code').keyup(function(){
		var zip_code = $(this).val();
		console.log(zip_code.length);
		if(zip_code.length > 3){
			var query = 'country='+country+'&zip_code='+zip_code;
			getLatLng(query,14);
		}
		
	});
	

});

function getLatLng(query,zoom){
	
	$.get(siteUrl+"/coaches/lat-lng?"+query, function( data ) { 
		var data = $.parseJSON(data);
		if(data.lat){
			var myLatLng = {lat: data.lat, lng: data.lng };
			initMap(myLatLng,zoom);	
			 
		}
	});
	
}
//............rating...................

	$(function(){
	$('#confirm-court').on('show.bs.modal', function (e) {
		var form = $(e.relatedTarget).data('href');
		$('#danger_court').click(function () {
		 
			$('#' + form).submit();
		});
	})
	});

</script>

<style>
.add_cart_section{padding-top:40px}
.list-sec-grey{width:100%; float:left; padding:25px}
.list-sec-grey:nth-child(even){background-color:fff!important}
.list-sec-grey:nth-child(odd){background-color:#F9F9F9!important;border-bottom: 1px solid #ccc}
.address-right{border: 1px solid #ccc;height: 400px;overflow-x: hidden;overflow-y: scroll;
padding-left: 0;padding-right: 0}
.click-add {margin-bottom:15px}
.sm-search{margin-left:10px}
.trash{margin-right:5px;}
</style>
<style>
.gm-style-iw{ width:200px; }
 p { margin:12px; }
 .next { margin-left:5px; cursor:pointer; color:blue;}
 .previous { margin-left:10px; cursor:pointer; color:blue;}
</style>

	
@include('includes.footer')
@endsection
