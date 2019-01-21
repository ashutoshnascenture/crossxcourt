@extends('app')
@section('title','Edit')
@section('content')

<div class="container-fluid">
 <div class="row">
   @include('includes.sidebar')
   <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right">
   <div class="panel panel-default clearfix">
    <div class="panel-heading"><h4>Messages</h4></div>
	<div class="col-md-9 form-container">
    <div class="panel-body">
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

     <form class="" role="form" method="POST" action="{{ url('/edit_post/') }}">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	  <!--hidden fields------>
	  
	    <input type ="hidden" name="id" value="<?php echo $message->id;?>"
	  
	  <!--hidden fields------>
	
	  
       <div class="form-group label-text-area image-area ">
		   <label class="">Edit</label>
		   <div class="">
			<textarea name="message" rows="5" class="form-control" required><?php echo $message->message;?></textarea>
		   </div>
      </div>


      <div class="form-group">
       <div class="">
        <button type="submit" class="btn btn-success my-buttons">Update</button>

      
       </div>
      </div>
     </form>
    </div>
	</div>
   </div>
  </div>
 </div>
</div>
@endsection
