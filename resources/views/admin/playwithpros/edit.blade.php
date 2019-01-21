 @extends('admin')
@section('content')
<style>

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Update Pro User</h2>
        <p class="pull-right">
            <!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
 
            <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/play-with-pro')}}/{{$pro->id}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">



 
				
				 <div class="form-group">
                    <label class="col-md-2 control-label">Profile Image </label>
                     
					<div class="col-md-10 browse">
                        <input type="file" class="form-control " name="profile_image" value="">
                    </div>  
					
                     @if(!empty($pro->profile_image))
                    <div class="col-md-10 col-md-offset-2 ">                         
						<img src="{{url('/coach-thumb/'.$pro->profile_image)}}/200/200" alt="" />
                    </div>				                      
                    @endif
                </div>
                
				
		
                <div class="form-group required">
                    <label class="col-md-2 control-label">Name </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ $pro->name }}" >
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-2 control-label">Nationality </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="nationality" value="{{ $pro->nationality }}">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-2 control-label">Age </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="age" value="{{ $pro->age }}">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-2 control-label">Highest Career Ranking </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="highest_career_ranking" value="{{ $pro->highest_career_ranking }}">
                    </div>
                </div>

                <div class="form-group ">
                    <label class="col-md-2 control-label">Link </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="link" value="{{ $pro->link }}">
                    </div>
                </div>
                
                <div class="form-group required">
                    <label class="col-md-2 control-label">Playing Style </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="playing_style" value="{{ $pro->playing_style }}">
                    </div>
                </div>
                
                <div class="form-group required">
                    <label class="col-md-2 control-label">Turned Pro </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="turned_pro" value="{{ $pro->turned_pro }}">
                    </div>
                </div>

           
                <div class="form-group required">
                    <div class="col-md-6 col-md-offset-2">
                        <button type="submit" class="btn btn-primary add">
                            Add
                        </button>
                        <a href="{{URL::to('admin/play-with-pro')}}" class="btn btn-edit btn-success cancel">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


@endsection
