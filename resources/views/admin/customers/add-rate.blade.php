@extends('admin')
@section('content')
<?php
 $value="";
 if(isset($getrate))
	$value=$getrate->rate;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Friend Rate</h2>
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

            <form class="form-horizontal padding-top-2" role="form" method="POST" action="{{URL::to('admin/customers/save-rate')}}">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 
				<div class="form-group">
                    <label class="col-md-3 control-label">Rate($)</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="rate" value="{{$value}}" required>
                    </div>
                </div>
				
				
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-3">
                        <button type="submit" class="btn btn-primary update">
                            Submit
                        </button>
                        
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
