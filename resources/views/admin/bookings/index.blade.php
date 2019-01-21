 @extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Booking Listing</h2>
        <p class="pull-right">
            <!-- <a href="coaches/create" class="btn btn-success">Add New</a> -->
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">
			
            <div class="searchh">
                <form class="form-inline " method="get" action="{{URL::to('admin/bookings')}}" style="padding-left:0px;">
                    <div class="form-group ">
                        <input type="text" name="q" class="form-control" placeholder="Transection Id , Booking Id" style="width:215px;" value="{{Request::input('q')}}">
                        <button type="submit" class="btn btn-success my-buttons">Search</button>
                    </div>

                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped product-create-table">
                    <thead class="heading">
                        <tr>
                            <th>ID</th>
                            <th>Transaction Id</th>
                            <th>Customer Name</th>
                            <th>Coach Name</th>
                                      
                            <th>Additional Players</th>                       
                            <th>Lessons</th>  
                                                 
                            <th>Rate</th>                       
                            <th>Total</th>                       
                            <th>Booking Date</th>
                           

                            
                        </tr>
                    </thead>
                    <tbody> 
                        @if(count($bookings) > 0)
                        <?php $i = 1; ?>


                        @foreach($bookings as $key => $value)

                        <tr>
                            <td><?php echo (($bookings->currentPage() - 1 ) * $bookings->perPage() ) + $i ?></td>
                           <td><?php
                                if (!empty($value->payment_info)) {

                                    $payment_info = unserialize($value->payment_info);
                                    $array = (array) $payment_info;


                                    //echo "<pre>";print_r($array); die;
                                    echo $data = ($array['balance_transaction']);
                                }
                                ?>
                            </td>	 
                            <td>{{ $value->constomer_first_name }}&nbsp;{{ $value->constomer_last_name }}</td>
                            <td>{{ $value->coach_first_name }}&nbsp;{{ $value->coach_last_name }}</td>
                           
                            <td>{{ $value->additional_players }}</td>
                            <td>{{ $value->lessons }}</td>
                            
                            <td>${{ $value->rate }}</td>
                            <td>${{ $value->total }}</td>

                            <td>  
                                @if(!empty($value->created_at))

                                {{date('M d, Y', strtotime($value->created_at))}}

                                @endif	 
                            </td>
                          <!--   <td>
                                @if($value->payment_status == 'Paid')
                                <a class="btn my-btn edit-btn btn-success" href="{{URL::to('admin/bookings/paymentstatus')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Paid</a>
                                @else
                                 <a class="btn my-btn edit-btn btn-warning" href="{{URL::to('admin/bookings/paymentstatus')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Awaiting Payment</a>

                                @endif

                            </td>
 -->                            
                        </tr>
                        <?php $i++; ?> 
                        @endforeach
                        @else 
                        <tr><td colspan="10">No Booking found.</td></tr>

                        @endif

                    </tbody>
                </table>
            </div>
            <?php echo $bookings->render(); ?>
        </div><!-- content section ends -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Booking</h4>
            </div>

            <div class="modal-body">
                Are you sure want to delete?
            </div>

        </div>
    </div>
</div>

@endsection
