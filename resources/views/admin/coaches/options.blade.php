 @extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Coach Listing</h2>
        <p class="pull-right">
           
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">
<!--
            <div class="searchh">
                <form class="form-inline" method="get" action="{{URL::to('admin/coaches')}}" style="padding-left:0px;">

                    <div class="form-group">
                        <input type="text" name="q" class="form-control" placeholder="first name, last name or email" style="width:215px;">
                    </div>
                    <button type="submit" class="btn btn-success my-buttons">Search</button>

                </form>
            </div>   
-->

            <div class="table-responsive ">

                <table class="table table-bordered product-create-table table-striped">
                    <thead class="heading">
                        <tr>
<!--
                            <th>ID</th>

                            <th>Name</th>
                            <th>Email</th>     
                            <th>City/State/Country</th>     
                            <th>Featured</th>     
                            <th>Staus</th>                      
                            <th>Date</th>                      
-->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

 

                        
                        <?php // echo"<pre>"; print_r($coaches); die;?>
						<tr>
							<td>	
                                <form method="" action="" accept-charset="UTF-8">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <input type="hidden" name="_method" value="DELETE">

<!--
Account info, profile, availability, payment information, price, bookings, hours logged.                                   
-->								
									<a class="btn my-btn edit-btn btn-danger hours-btn" href="{{URL::to('admin/coaches/show')}}/{{$id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Account info</a> 
									
									<a class="btn my-btn edit-btn btn-success hours-btn" href="{{URL::to('admin/coaches/viewcoachdetail')}}/{{$id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Profile</a> 
                                   
									 <a class="btn my-btn edit-btn btn-warning booking" href="{{URL::to('admin/coaches/paymentinfo')}}/{{$id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Payment information</a>
                                    
                                    <a class="btn my-btn edit-btn btn-info price" href="{{URL::to('admin/coaches/price')}}/{{$id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Price</a> 
                                    
                                    <a class="btn my-btn edit-btn btn-primary booking" href="{{URL::to('admin/coaches/booking')}}/{{$id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Bookings</a>
                                                                        
                                    <a class="btn my-btn edit-btn btn-warning hours-btn" href="{{URL::to('admin/coaches/hours-log')}}/{{$id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Hours loggged</a
                                                                                                         
									
                                    
                                </form>	
                            </td>
                        </tr>
                        


                    </tbody>
                </table>
            </div>

            <?php //echo $coaches->appends(Input::except('page'))->render(); ?>
        </div><!-- content section ends -->
    </section><!-- /.content -->
    
</div><!-- /.content-wrapper -->


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete coach</h4>
            </div>

            <div class="modal-body">
                Are you sure want to delete?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success cancel" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger delete" id="danger">Delete</a>
            </div>
        </div>
    </div>
</div>

@endsection
