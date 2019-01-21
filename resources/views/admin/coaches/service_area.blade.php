@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Service Area</div>
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
                    <?php
                    if (!$data) {
                        $data = new stdClass();
                        $data->service_area = '';
                    }
                    ?>

                    <form class="form-horizontal" role="form" method="POST" action = "{{URL::to('coaches/coacharea')}}">
                        <div class="from-group">
                            <label for="heading"><?php echo Lang::get('service_area.heading'); ?></label>
                            <select class="form-control" id="coverage_area" name = "service_area">
                                @foreach(Lang::get('service_area.coverage_area') as $area)
                                <?php // $miles = explode(' ', $area); ?>
                                <option @if($data->service_area == $area) selected @endif>{{$area}}</option>
                                @endforeach
                            </select>
                            <p>&nbsp;</p>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="schedules" name="latitude" value="{{$address['lat']}}" />
                            <input type="hidden" id="schedules" name="longitude" value="{{$address['lng']}}" />
                        </div>
                        <div class="from-group">

                            <div id="map-canvas"style="width:100%; height:350px"></div>

                        </div>
                        <p>&nbsp;</p>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxVLUImvXflqMhYs5n1MP8b0gghRKCu9U&callback=initialize"
type="text/javascript"></script>

<script>
	var default_area = 5; //miles
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
        map: map,
        center: philly,
        radius: default_area
};
var drawCirle = new google.maps.Circle(circle);
}

$(function(){
$('#coverage_area').change(function(){
default_area = $(this).val().split(' ');
default_area = default_area[0];
initialize();
});
});
</script>
@endsection
