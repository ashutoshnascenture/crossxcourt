 @extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Coach Listing</h2>
        <p class="pull-right">
            <a href="coaches/create" class="btn btn-success">Add New</a>
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">
            <div class="searchh">
                <form class="form-inline" method="get" action="{{URL::to('admin/coaches')}}" style="padding-left:0px;">

                    <div class="form-group">
                        <input type="text" name="q" class="form-control" placeholder="first name, last name or email" style="width:215px;" value="{{Request::input('q')}}">
                    </div>
                    <button type="submit" class="btn btn-success my-buttons" >Search</button>
					
                </form>
            </div>   

            <div class="table-responsive ">

                <table class="table table-bordered product-create-table table-striped">
                    <thead class="heading">
                        <tr>
                            <th>ID</th>

                            <th>Name</th>
                            <th>Email</th>     
                            <th>City / Country</th>     
                            <th>Featured</th>     
                            <th>Status</th>                      
                            <th>Date</th>                      
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					@if(count($coaches))
                        <?php $i = 1; ?>
					
                        @foreach($coaches as $key => $value)
                        <?php // echo"<pre>"; print_r($coaches); die;?>
                        <tr>
                            <td><?php echo (($coaches->currentPage() - 1 ) * $coaches->perPage() ) + $i ?></td>					 
                            <td>{{ $value->first_name }}&nbsp;{{ $value->last_name }}</td>

                            <td>{{ $value->email }}</td>
                            <td>{{ $value->city}}
   								@if(!empty($value->country))
									@foreach($countries as $country)
										@if($country->sortname == $value->country)
										/ {{$country->name}}
										@endif
									@endforeach
								@endif 
                            </td>

                            <td>
                                @if($value->Info['is_featured'])
                                <a class="btn my-btn edit-btn btn-success" href="{{URL::to('admin/coaches/featured')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Yes</a>
                                @else
                                <a class="btn my-btn edit-btn btn-warning" href="{{URL::to('admin/coaches/featured')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>No</a>
                                @endif
                            </td>

                            <td> 
								@if(!$value->Info['is_active'])

                                <a class="btn my-btn edit-btn btn-warning" href="{{URL::to('admin/coaches/approve')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Inactive</a> 


                                @else

                                <a class="btn my-btn edit-btn btn-success" href="{{URL::to('admin/coaches/approve')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Active</a>

                                @endif 
							</td>
                            <td>
								@if(!empty($value->created_at))
								  									 
									{{date('M d, Y', strtotime($value->created_at))}}
									
								@endif	 
								 
                            </td>
                            <td>
                                <form method="" action="{{URL::to('admin/coaches/destroy')}}/{{$value->id}}" id="{{$value->id }}" accept-charset="UTF-8">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <input type="hidden" name="_method" value="DELETE">

                                  
                                    <a class="btn my-btn edit-btn btn-success hours-btn" href="{{URL::to('admin/coaches/show')}}/{{$value->id}}" role="button"><i class="fa fa-eye" aria-hidden="true">&nbsp;</i>View</a>

                                  
                                    <a class="btn my-btn edit-btn btn-primary" href="{{URL::to('admin/coaches/editprofile')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Edit</a> 


                                    <a class="btn my-btn btn-delete btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash-o" aria-hidden="true">&nbsp;</i>Delete</a> 

                                </form>	
                            </td>
                        </tr>
                        <?php $i++; ?> 
                        @endforeach
					@else
					<tr><td colspan="8">No Record Found.</td></tr>
					No Record Found
					@endif

                    </tbody>
                </table>
            </div>

            <?php echo $coaches->appends(Input::except('page'))->render(); ?>
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
