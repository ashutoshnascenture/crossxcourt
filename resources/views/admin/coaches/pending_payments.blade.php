 @extends('admin')
 @section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h2>Pending Payments</h2>
    <p class="pull-right">
      <!-- <a href="coaches/create" class="btn btn-success">Add New</a> -->
    </p>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="inner-content">
     <div class="table-responsive">
      <table class="table table-bordered table-striped product-create-table">
        <thead class="heading">
          <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Coach Name</th>
            <th>Date</th>
            <th>Lesson Duration</th>                       
<!--
            <th>Rate Per Hour</th>                       
-->
<!--
            <th>Total</th>                       
-->
            <th>Action</th>            
          </tr>
        </thead>
        <tbody>

          @if(count($credits) > 0)
          <?php $i = 1; ?>
          @foreach($credits as $key => $value)

          <tr>
            <td>{{ $i }}</td>  				 
            <td>{{ $value->cu_first_name }}&nbsp;{{ $value->cu_last_name }}</td>
            <td>{{ $value->co_first_name }}&nbsp;{{ $value->co_last_name }}</td>
            <td>{{ $value->date }} {{ $value->start_time }}</td>
            <td>{{ $value->lesson_duration }} hours</td>
<!--
            
-->
<!--
           
-->
            <td>
             <a class="btn my-btn edit-btn btn-success hours-btn" href="{{URL::to('admin/coaches/mark-paid/'.$value->lesson_id )}}">
               Mark Paid
             </a>
           </td>
         </tr>
         
         @endforeach
         
         @else
         <tr><td colspan="8">No pending payments found.</td></tr> 
         
         @endif

       </tbody>
     </table>
   </div>
   <?php echo $credits->render(); ?>
 </div><!-- content section ends -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->


@endsection
