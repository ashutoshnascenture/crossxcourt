 @extends('admin')
@section('content')
<style>

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Create Pro</h2>
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

            <form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/play-with-pro')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

				
				
				<div class="form-group">
					<label class="col-md-3 control-label">Profile Image</label>
					<div class="col-md-8 browse">
						<input type="file" class="form-control" name="profile_image" value="">
					</div>
				</div>


                <div class="form-group required">
                    <label class="col-md-3 control-label">Name </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" >
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Nationality </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nationality" value="{{ old('nationality') }}">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Age </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="age" value="{{ old('age') }}">
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-md-3 control-label">Highest Career Ranking </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="highest_career_ranking" value="{{ old('highest_career_ranking') }}">
                    </div>
                </div>

                <div class="form-group ">
                    <label class="col-md-3 control-label">Link </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                    </div>
                </div>
                
                <div class="form-group required">
                    <label class="col-md-3 control-label">Playing Style </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="playing_style" value="{{ old('playing_style') }}">
                    </div>
                </div>
                
                <div class="form-group required">
                    <label class="col-md-3 control-label">Turned Pro </label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="turned_pro" value="{{ old('turned_pro') }}">
                    </div>
                </div>

           
                <div class="form-group required">
                    <div class="col-md-6 col-md-offset-3">
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
