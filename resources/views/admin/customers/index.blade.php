 @extends('admin')
@section('content')

<div class="row">
    <div class="col-md-10 col-md-offset-1">

        <p class="text-right">
            <!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
        </p>
        <div class="panel panel-default">




            <div class="panel-heading">
                <h4>Customers listing</h4>
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>

                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>                       
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    
                    @foreach($customers as $key => $value)

                    <tr>
                        <td>{{ $i }}</td>					 
                        <td>{{ $value->first_name }}</td>
                        <td>{{ $value->last_name }}</td>

                        <td>{{ $value->email }}</td>

                        <td>
                            <form method="POST" action="{{URL::to('admin/customers')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="hidden" name="_method" value="DELETE">
								
								<a class="btn btn-primary btn-xs" href="{{URL::to('admin/customers/view')}}/{{$value->id}}" role="button"><i class="glyphicon glyphicon-eye-open"></i> View </a>

                                
                                <a class="btn btn-primary btn-xs" href="{{URL::to('admin/customers/edit')}}/{{$value->id}}" role="button"><i class="glyphicon glyphicon-edit"></i> Edit </a> 


                                <a class="btn btn-danger btn-xs" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"> <i class="glyphicon glyphicon-trash"></i> Delete</a> 

                            </form>	
                        </td>
                    </tr>
                    <?php $i++; ?> 
                    @endforeach


                </tbody>
            </table>

        </div>
    </div>
</div>


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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="{{URL::to('admin/customers/destroy')}}/{{$value->id}}" class="btn btn-danger" id="danger">Delete</a>
            </div>
        </div>
    </div>
</div>

@endsection
