 @extends('admin')
@section('content')

<link href="{{ asset('/css/cropper.css') }}" rel="stylesheet">
<script src="{{asset('/js/cropper.js') }}"></script>
<script src="{{asset('/js/main.js') }}"></script>

<div class="content-wrapper">   
 
        <section class="content-header">
            <h2>Crop image</h2>
            </section>
		<section class="content">
        <div class="inner-content">
            <form method="post" action="{{URL::to('admin/coaches/save-crop')}}" accept-charset="UTF-8" >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="input-group input-group-sm">
					<label class="input-group-addon" for="dataWidth">Width</label>
					<input type="text" class="form-control" id="dataWidth" placeholder="width">
					<span class="input-group-addon">px</span>
				</div>
				  <div class="input-group input-group-sm">
					<label class="input-group-addon" for="dataHeight">Height</label>
					<input type="text" class="form-control" id="dataHeight" placeholder="height">
					<span class="input-group-addon">px</span>
				</div>
				 
				<div class="img-container">
					<img id="image" src="{{asset('images/coaches')}}/{{$coach->profile_image}}"   alt="No Image" >
					 
				</div>
				<input type="hidden" name="image" id="imageData">
				<input type="hidden" name="id" value="{{$coach->user_id}}">
				<input type="hidden" name="realImage" value="{{$coach->profile_image}}">
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 btns-section">
                        <button type="submit" class="btn btn-primary save">Save
                        </button>
                         <a href="{{URL::to('admin/coaches')}}" class="btn btn-success">Cancel</a>
                    </div>
                </div>
            </form>	 

	</div>

</div>
 

@endsection
