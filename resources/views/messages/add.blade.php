 @extends('app')

@section('content')

<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
          <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('messages.compose_message'); ?></h2>
            <hr>
				<div class="col-md-9 form-container">
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
                    <form class=" " role="form" method="POST" action="{{ LaravelLocalization::localizeURL('/send_message/') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!--hidden fields-->
                        <!--hidden fields-->
                        <div class="form-group label-text-area image-area">
                            <label class=""><?php echo Lang::get('messages.to'); ?></label>
                            <div class=" ">
                                <select class="select picker form-control box-select" id="country_list" name="to" required>
							     <!---to admin-->
								      <option value=""><?php echo Lang::get('messages.select_value'); ?></option>
                                    @foreach($customers_admin as $customers_admin)
                                    <option value="{{$customers_admin->id}}">
									   {{$customers_admin->first_name}}
                                    </option>
                                    @endforeach
								<!--to admin-->                        
                                    @foreach($customers as $customers)
                                    <option value="{{$customers->id}}"
									@if($to == $customers->id) selected @endif >
                                        {{$customers->first_name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group label-text-area image-area ">
                            <label class=""><?php echo Lang::get('messages.message'); ?></label>
                            <div class="">
                                <textarea name="message" rows="3" class="form-control" onkeyup="countChar(this)" required></textarea>
                            </div>
                             <div id="charNum"></div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <button type="submit" class="btn btn-success my-buttons"><?php echo Lang::get('messages.save'); ?></button>
                            </div>
                        </div>
                    </form>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
    function countChar(val) {
        var len = val.value.length;
        
        if (len > 1000) {
            val.value = val.value.substring(0, 1000);
       
        } else {
                        
			$('#charNum').text(1000 - len);
            
        }
    }
    ;
</script>	
</div>
@include('includes.footer')
@endsection


 
