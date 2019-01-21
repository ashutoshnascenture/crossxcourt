 @extends('admin')
@section('content')

<div class="content-wrapper">   
 
           <section class="content-header">
                <h2>Rate Listing</h2>
            </section>
		<section class="content">
        <div class="inner-content">
            <form method="post" action="{{URL::to('admin/coaches/save')}}" accept-charset="UTF-8">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" class="form-control">
				<input type="hidden" name="coach_id" value="{{ $coach_id }}" class="form-control">
				@if($coachpackages)
					<input type="hidden" name="action" value="update" class="form-control">
				@endif
				<div class="table-responsive">
                <table class="table table-striped table-bordered table-hover price-table">
                    <thead class="heading">
                        <tr>
                            <th>ID</th>			 
                            <th>Lessons</th>
                            <th style="width:60%">Rate ($)</th>
						</tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>

                        @foreach($packages as $value)
                        <tr>
							<td>{{ $i }}</td>					 
                            <td>{{ $value->lessons }}&nbsp;Lessons</td>
                            <td>
							<input type='text' name="price[{{ $value->id}}]" value="@if(isset($coachpackages[$value->id])){{$coachpackages[$value->id]}} @endif" class="form-control"> 
                            </td>
						</tr>

                        <?php $i++; ?> 

                       
                         @endforeach
                         

                    </tbody>
                </table>
				</div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 btns-section">
                        <button type="submit" class="btn btn-primary save">Save
                        </button>
                         <a href="{{URL::to('admin/coaches')}}" class="btn btn-success">Cancel</a>
                    </div>
                </div>
            </form>	 

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
                <button type="button" class="btn btn-succes cancel" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger delete" id="danger">Delete</a>
                
            </div>
        </div>
    </div>
	</div>
	</div>
</div>

@endsection
