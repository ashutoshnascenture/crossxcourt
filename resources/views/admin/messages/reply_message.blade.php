@extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2>Messages</h2>
    
    </section>
    <!-- Main content -->
    <section class="content">
      <div style="padding: 15px;">
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
	   <div class="form-group">
	    @if ($data['messages']->from == Auth::user()->id)
		   <label class="col-md-4 control-label"> </label>
		   <div class="col-md-6">
			<p class="admin-chat"><?php echo $data['messages']->message;?></p><span style="float:right;">{{ Helper::ago($data['messages']->created_at)}}</span>
		   </div>
		@else
		   <label class="col-md-4 control-label"> </label>
		   <div class="col-md-6">
			<p class="client-chat"><?php echo $data['messages']->message;?></p><span style="float:right;"> {{ Helper::ago($data['messages']->created_at)}}</span>
		   </div>	
		@endif
	 </div>
	 	 @foreach($data['messages_detail'] as $key => $value)
	   
		<div class="form-group">
		  @if ($value->user_id == Auth::user()->id)
		   <label class="col-md-4 control-label"></label>
		   <div class="col-md-6">
             <br>
			<p class="admin-chat"><?php echo $value->message_reply;?></p><span style="float:right;">{{Helper::ago($value->created_at)}}</span>
			<br>
		   </div>
		 @else
		     <label class="col-md-4 control-label"></label>
		   <div class="col-md-6">
		   <br>
			<p class="client-chat"><?php echo $value->message_reply;?></p><span style="float:right;">{{Helper::ago($value->created_at)}}</span>
			<br>
		   </div> 
		   
		   
		  @endif
		  
		  
	   </div>
	   
	 @endforeach
	 <div class="form-group">
       <div class="col-md-6 col-md-offset-4">
       
		<br>
		 <a class="btn btn-success" data-toggle="modal" data-target="#confirm-message" href="#"> <i class="glyphicon glyphicon-edit"></i> Reply</a> 

      
       </div>
		  <div class="modal fade" id="confirm-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	     <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/postReply_message/'.$data['role']) }}">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-dialog">
				<div class="modal-content">
				<!--    hidden fields         -->
				      <input type="hidden" name="message_id" value="<?php echo $data['messages']->id;?>">
				<!--    hidden fields         -->
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Send Message</h4>
					</div>
				
					  <div class="modal-body">
						  <textarea name="message_reply" rows="3"  class="form-control"></textarea>
					  </div>
					 
					<div class="modal-footer">
					   <input class="btn btn-success" type='submit' name='send' value="Send">
					</div>
				</div>
			</div>
		 </form>
	 </div>
 		
		
      </div><!-- content section ends -->
	   <style>
	.admin-chat,.client-chat{padding:5px;margin-bottom:0px; border-radius:4px;}
	.col-md-6 span{color: #CCC;!important;} 
	 
      </style>
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection


