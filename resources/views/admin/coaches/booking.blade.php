 @extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Coach listing</h2>
        <p class="pull-right">
            <!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">
			<div class="table-responsive">
            <table class="table table-bordered product-create-table table-striped table-hover">
                <thead class="heading">
                    <tr>
                        <th>Id</th>

                        <th>Customer name</th>
                         <th>Lessons</th>
                        <th>Preferred day</th>
                        <th>Preferred time</th>
                        <!-- <th>Payment Status</th> -->
                        <th>Booking Time</th>                      
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @if(count($bookings) )
                    <?php $i = 1; ?>
                    @foreach($bookings as  $value)

                    <tr> 
                        <td>{{ $i }}</td>					 
                        <td>{{ $value->first_name }}{{$value->last_name}}</td>
                         <td>{{ $value->lessons }}</td>
                        <td>{{ $value->preferred_day }}</td>
                        <td>{{$value->preferred_time }}</td>
                        <!-- <td>{{$value->payment_status }}</td> -->
                        <td>{{$value->created_at }}</td>

                        <td>
                            <form method="POST" action="{{URL::to('admin/coaches')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="DELETE">
                               
                                @if($value->status != 'cancel')
                               
                                <a class="btn my-btn btn-delete btn-danger" data-href="{{$value->id}}" data-toggle="modal" name="" data-target="#confirm-booking" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>Cancel Booking</a> 

                                @else 
                                <!-- <a class="btn my-btn btn-delete btn-danger" data-href="" data-toggle="modal" name="" data-target="" href=""><i class="fa fa-trash-o" aria-hidden="true"></i>Cancel Booking</a> --> 

                                <span class="btn my-btn edit-btn btn-success" style="cursor:auto;">Booking canceled</span>

                                @endif


                                <?php $id = $value->id ; ?>
                            </form>	
                        </td>
                    </tr>


                    @endforeach
                    <?php $i++; ?> 
                    @else
                    <tr><td colspan="8">No booking found.</td></tr>
                    @endif  



                </tbody>
            </table>
			</div>

        </div><!-- content section ends -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade" id="confirm-booking" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Cancel booking</h4>
            </div>

            <div class="modal-body">
                Are you sure want to cancel booking?

                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" name="detail" id="detail"></textarea>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="status" value="cancel">
                    <input type="hidden" name="id" id="id"  value="@if(isset($id)){{$id}} @endif "> 
                </div>
                    
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                <a href="" class="btn btn-danger" id="submit">Cancel booking</a>
            </div>
        </div>
    </div>
</div>
    
 <script type="text/javascript">
      $(document).ready(function(){
    
        $("#submit").click(function(){
            var detail = $('#detail').val();
             var id = $('#id').val();
              
          $.ajax({
              
            type: "POST",
            async: false,//here you are synchrone
            data : {'detail': detail,'_token' : '{{ csrf_token() }}','status':'cancel', 'id' : id },
            url: "{{URL::to('admin/coaches/cancelbooking/')}}",
                      
            success: function(data) {
                //alert(data);
            //echo data from server side
            }
        });
         
      });
    });
</script>   

@endsection
