@extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Messages Listing</h2>
      <p class="pull-right">
			<a href="{{URL::to('admin/add_message/'.$role)}}" class="btn btn-success pull-right" style="margin-top:-7px;">Add New</a></h4>
		</p>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="inner-content">
		 
			 <table class="table table-bordered table-responsive product-create-table table-hover">
				<thead class="heading">
					<tr>
						<th>ID</th>
						<th>To</th>
						<th width="60%">Messages</th>
						<th>Created</th>
						 
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
				@foreach($messages as $key => $value)
				
					<tr>
						<td>{{ $i }}</td>
						<td>{{$value->first_name}}</td>
						<td>
						   <p> {{ $value->message }}</p>
					    </td>
						<td>
						    {{ $value->created_at }}
					    </td>
						
					</tr>
					<?php $i++; ?> 
				@endforeach
				</tbody>
			</table>
		
      </div><!-- content section ends -->
	  <?php echo $messages->render(); ?>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection