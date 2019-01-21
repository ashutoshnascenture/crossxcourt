 @extends('admin')
@section('content')
<style>

</style>
<div class="content-wrapper">
   
            <section class="content-header">
                <h2>Messages</h2>
            </section>
		<section class="content">     
        <div class="inner-content">
           

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

                <form class="form-horizontal padding-top-2" role="form" method="POST" action="{{ url('admin/send_message/') }}">
					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <input type="hidden" name="role" value="{{$role}}">
					 
					   <div class="form-group">
						   <label class="col-md-3 control-label">To</label>
						   <div class="col-md-8">
							
							 <select class="form-control" id="country_list" name="to">
									<option value="">-- select value --</option>
									@foreach($customers as $customers)
										<option value="{{$customers->id}}">
											{{$customers->first_name}}
										</option>
									@endforeach
								  
								</select>

						   </div>
					  </div>
					  
					    <div class="form-group">
						    <label class="col-md-3 control-label">Message</label>
						    <div class="col-md-8">
							  <textarea name="message" rows="3" class="form-control"></textarea>
						    </div>
					    </div>
					     <div class="form-group">
					       <div class="col-md-8 col-md-offset-3">
							<button type="submit" class="btn btn-primary">Submit</button>
                           </div>
					     </div>
              </form>
      </div>
    </section>
</div>

@endsection