 @extends('admin')
@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">

        <p class="text-right">
            <!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
        </p>
        <div class="panel panel-default">


            <div class="panel-heading">
                <h4>Customer detail</h4>
            </div>
             
            <form class="form-horizontal" role="form" method="" action="">
			 
					<table class="table">
						<thead>
						  <tr>
							<th>First name</th>
							<th>{{ucfirst($customer->first_name)}}</th>
						  </tr>
						</thead>
						<thead>
						  <tr>
							<th>Last name</th>
							<th>{{ucfirst($customer->last_name)}}</th>
						  </tr>
						</thead>
						<thead>
						  <tr>
							<th>Email</th>
							<th>{{ ($customer->email)}}</th>
						  </tr>
						</thead>
						<!--<thead>
						  <tr>
							<th>Mobile</th>
							<th>{{ ($customer->mobile)}}</th>
						  </tr>
						</thead>
                        <thead>
						  <tr>
							<th>Postal code</th>
							<th>{{ ($customer->post_code)}}</th>
						  </tr>
						</thead>
                        <thead>
						  <tr>
							<th>Country</th>
							<th>{{ ($customer->country)}}</th>
						  </tr>
						</thead>
                        <thead>
						  <tr>
							<th>State</th>
							<th>{{ ($customer->state)}}</th>
						  </tr>
						</thead>
                        <thead>
						  <tr>
							<th>City</th>
							<th>{{ ($customer->city)}}</th>
						  </tr>
						</thead>-->
                            
                         
						 
						 
						
						 
					  </table>
					  <div class="form-group" style="margin-left: -5px;">
						<div class="col-md-10">
 
							<a href="{{URL::to('admin/customers')}}" class="btn btn-primary">Cancel</a>
							 
						</div>
					</div>
				</form>

        </div>
    </div>
</div>


 

@endsection
