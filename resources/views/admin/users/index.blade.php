@extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Customer Listing</h2>
      <p class="pull-right">
			<a href="users/create" class="btn btn-success">Add New</a>
		</p>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="inner-content">
			
			<div class="searchh">
			<form class="form-inline " method="get" action="{{URL::to('admin/users')}}" style="padding-left:0px;">
			 
			 <div class="form-group ">
			 <input type="text" name="q" class="form-control" placeholder="first name, last name or email" style="width:215px;" value="{{Request::input('q')}}">
			 <button type="submit" class="btn btn-success my-buttons">Search</button>
			  </div>
			  
			 
			</form>
			</div>
			<div class="table-responsive">
			<table class="table table-bordered table-striped product-create-table table-hover">
				<thead class="heading">
					<tr>
						<th>ID</th>
						<th>Name</th>	
						<th>Email</th>
						 
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				@if(count($users))	
				<?php $i = 1 ; ?>
				@foreach($users as $key => $value)
					
					<tr>
						<td><?php echo  (($users->currentPage() - 1 ) * $users->perPage() ) + $i ?></td>
						<td>{{$value->first_name}}&nbsp;{{$value->last_name}}</td>
						<td>{{ $value->email }}</td>
						 
						 
						 
						  
						<td>
							<form method="POST" action="{{URL::to('admin/users')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
									
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">

								<a class="btn my-btn view-btn btn-success" href="{{URL::to('admin/users')}}/{{$value->id}}" role="button"><i class="fa fa-eye"></i> View </a>

								 
								<a class="btn my-btn edit-btn btn-primary" href="{{URL::to('admin/users')}}/{{$value->id}}/edit" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a> 
								
								<a class="btn my-btn btn-delete btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> 
								 
							</form>	
						</td>
					</tr>
					<?php $i++; ?> 
				@endforeach
				@else
			<tr><td colspan="4">No Record Found.</td></tr>
			 
			@endif
				</tbody>
				</table>
			</div>
		<?php echo $users->appends(Input::except('page'))->render(); ?>
      </div><!-- content section ends -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
  
 
 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
                </div>
            
                  <div class="modal-body">
					Are you sure want to delete?
				  </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="danger">Delete</a>
                </div>
            </div>
        </div>
</div>
    
@endsection
