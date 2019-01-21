 @extends('admin')
 @section('content')
 <style>

 </style>
 <div class="content-wrapper">

    <section class="content-header">
		   <h2>Coach Payment Information</h2>
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
            
            <form class="form-horizontal" role="form" method="" action="">

                <table class="table table-bordered product-create-table table-striped">
                @if(!empty($payment_information))
                    <thead>
                        <tr>
                            <th>Address</th>
                            <td>{{$payment_information->address}}</td>
                        </tr>
                    </thead>
					<tbody>
                        <tr>
                            <th>City</th>
                            <td>{{$payment_information->city}}</td>
                        </tr>
                 
                
                        <tr>
                            <th>State</th>
                            <td>{{$payment_information->state}}</td>
						</tr>
        


                
                        <tr>
                           <th>Postal code</th>
                            <td>{{$payment_information->postalcode}}</td>
                        </tr>
                  


                 
                        <tr>
                            <th>Social security number</th>
                            <td>{{$payment_information->ssn}}</td>
                        </tr>
                   

                   
                        <tr>
                            <th>Routing number</th>
                            <td>{{$payment_information->route_num}}</td>
                        </tr>
              


                    
                        <tr>
                            <th>Account number</th>
                            <td>{{$payment_information->account_num}}</td>
                        </tr>
                 



               
                        <tr>
                            <th>Email</th>
                            <td>{{$payment_information->email}}</td>
                        </tr>
                 </tbody>
                     

                    @else
                    No record found
                    @endif
                </table>
                <div class="form-group" style="margin-left: -5px;">
                    <div class="col-md-10">

                    <!-- <a href="{{URL::to('admin/coaches')}}" class="btn btn-primary">Cancel</a> -->

                    </div>
                </div>
            </form>
            
        </div>
    </section>
 </div>

 @endsection
