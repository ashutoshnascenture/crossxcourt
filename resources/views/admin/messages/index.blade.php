@extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Messages Listing</h2>
   </section>
    <!-- Main content -->
    <section class="content">
      <div class="inner-content">
		 
			 <table class="table table-bordered table-responsive product-create-table table-hover">
				<thead class="heading">
					<tr>
						<th>ID</th>
						<th>From</th>
						<th>Message</th>
						<th>Created</th>
						 
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
				@foreach($messages as $key => $value)
					<?php
					  $color_val='';
                       if($value->read_admin=='1')
						   $color_val='red';
					  
                       if(Auth::user()->id==$value->to)
					   {
                     ?>					
					<tr>
						<td>{{ $i }} </td>
						<td>{{$value->from_first_name}}</td>
						<td>
						     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							 <a style="color:{{$color_val}};" href="{{URL::to('admin/reply_message')}}/{{$value->message_id}}/{{$role}}"> 
                                {{substr($value->message,0,50)}}
							 </a>
                         </td>
						<td>{{$value->created_at}}</td>
					</tr>
					  <?php 
					     $i++;
					   }
					   elseif(Auth::user()->id==$value->from && $value->reply=='1')
					   {
						  
						   ?>
						<tr>
						<td>{{ $i }} </td>
						<td>{{$value->to_first_name}}</td>
						<td>
						     <input type="hidden" name="_token" value="{{ csrf_token() }}">
							 <a style="color:{{$color_val}};" href="{{URL::to('admin/reply_message')}}/{{$value->message_id}}/{{$role}}"> 
                                {{substr($value->message,0,50)}}
							 </a> 
                         </td>
						<td>{{$value->created_at}}</td>
					</tr>
                      <?php	
                         $i++;					  
					   }
      					 ?> 
				@endforeach
				</tbody>
			</table>
		
      </div><!-- content section ends -->
	    <?php echo $messages->render(); ?>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection