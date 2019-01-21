 @extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Play With Pro Listing</h2>
        <p class="pull-right">
            <a href="play-with-pro/create" class="btn btn-success">Add New</a>
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">

<!--
            <div class="searchh">
                <form class="form-inline " method="get" action="{{URL::to('admin/users')}}" style="padding-left:0px;">
                    <div class="form-group ">
                        <input type="text" name="q" class="form-control" placeholder="first name, last name or email" style="width:215px;">
                        <button type="submit" class="btn btn-success my-buttons">Search</button>
                    </div>

                </form>
            </div>
-->
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped product-create-table table-hover">
                    <thead class="heading">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>	
                            <th>Nationality</th>
                            <th>Age</th>
                            <th>Highest Career Ranking</th>
<!--
                            <th>Link</th>
-->
                            <th>Playing style</th>
                            <th>Turned Pro</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
						@if(count($play_with_pros))
							<?php $i = 1; ?>
                        
							@foreach($play_with_pros as $key => $value)

							<tr>
								<td><?php echo (($play_with_pros->currentPage() - 1 ) * $play_with_pros->perPage() ) + $i ?></td>
								<td>{{$value->name}}</td>
								<td>{{ $value->nationality }}</td>
								<td>{{ $value->age }}</td>
								<td>{{ $value->highest_career_ranking }}</td>
<!--
								<td>{{ $value->link }}</td>
-->
								<td>{{ $value->playing_style }}</td>
								<td>{{ $value->turned_pro }}</td>

								<td>
									<form method="POST" action="{{URL::to('admin/play-with-pro')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">

										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="_method" value="DELETE">

										<a class="btn my-btn view-btn btn-success" href="{{URL::to('admin/play-with-pro')}}/{{$value->id}}" role="button"><i class="fa fa-eye"></i> View </a>

										<a class="btn my-btn edit-btn btn-primary" href="{{URL::to('admin/play-with-pro')}}/{{$value->id}}/edit" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit </a> 

										<a class="btn my-btn btn-delete btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a> 

									</form>	
								</td>
							</tr>
							<?php $i++; ?> 
							@endforeach
						@else
						<tr><td colspan="9">No Record found.</td></tr>
						 	
						@endif
                    </tbody>
                </table>
            </div>
            <?php echo $play_with_pros->appends(Input::except('page'))->render(); ?>
        </div><!-- content section ends -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Pro User</h4>
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
