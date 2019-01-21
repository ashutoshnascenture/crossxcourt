@extends('admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Page List</h2>
      <p class="pull-right">
			<a href="pages/create" class="btn btn-success">Add New</a>
		</p>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="inner-content">
			<div class="table-responsive">
			 <table class="table table-striped table-bordered table-hover product-create-table">
				<thead class="heading">
					<tr>
						<th>ID</th>					 
						<th>Title</th>
						<th>Slug</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
				@foreach($pages as $key => $value)
					
					<tr>
						<td><?php echo (($pages->currentPage() - 1 ) * $pages->perPage() ) + $i ?></td>						 						 
						<td>{{ $value->title }}</td>
						<td>{{ $value->slug }}</td>
						  
						<td>
							<form method="POST" action="{{URL::to('admin/pages')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
									
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">
								 <a class="btn my-btn view-btn btn-success" href="{{URL::to('admin/pages')}}/{{$value->id}}/view" role="button"> <i class="fa fa-eye" aria-hidden="true"></i> View</a>
								<a class="btn my-btn edit-btn btn-primary" href="{{URL::to('admin/pages')}}/{{$value->id}}/edit" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a> 
								
								<a class="btn my-btn btn-delete btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> 
								 
							</form>	
						</td>
					</tr>
					<?php $i++; ?> 
				@endforeach
				</tbody>
			</table>
			</div>
			<?php echo $pages->render(); ?>
		</div>
	</section>
</div>
 
 
 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                </div>
            
                  <div class="modal-body">
					Are you sure want to delete?
				  </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-success data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger delete" id="danger">Delete</a>
                </div>
            </div>
        </div>
</div>
    
@endsection
