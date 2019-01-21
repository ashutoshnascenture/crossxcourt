@extends('app')
@section('title','Clients')
@section('content')

<div class="container-fluid">
    <div class="row">
	@include('includes.sidebar')
          <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">
          <h2 class="student-title"> <?php echo Lang::get('student.my_student'); ?> </h2>
          <hr/>
          	<div class="alert alert-success my-alert" role="alert">
  				<p><?php echo Lang::get('student.text'); ?><span class="label label-info"><?php echo Lang::get('student.text1'); ?></span><?php echo Lang::get('student.text2'); ?></p>
			</div>
			<form class="form-inline" method="get" action="{{URL::to('coaches/clients')}}">
			<div class="pull-left col-md-6 col-sm-6 col-xs-12 search-left">
		  
			  <div class="form-group">
			 
			 <input type="text" name="q" class="form-control" placeholder="<?php echo Lang::get('student.student_placeholder') ?>" value="{{Request::input('q')}}">
			   <button type="submit" class="btn btn-success my-buttons searching-btn"><?php echo Lang::get('student.search'); ?></button>
			  </div>
			
			</div>
			<div class="pull-right col-md-6 col-sm-6 col-xs-12 sort-search-right ">
			 	<div class="form-group">
				 <select class="form-control box-select" name="sort">
				 
				  <option value="recent-lessons" @if(Request::input('sort') == 'recent-lessons' || !Request::input('sort')) selected @endif>
				  <?php echo Lang::get('student.recent_lessons'); ?>
				  </option>
				  <option value="new-students" @if(Request::input('sort') == 'new-students') selected @endif>
				  <?php echo Lang::get('student.new_students'); ?>
				  </option>
				  <option value="credits-remaining" @if(Request::input('sort') == 'credits-remaining') selected @endif>
					<?php echo Lang::get('student.credit_remail'); ?>
				  </option>
				  
				 </select>
				  <button type="submit" class="btn btn-success my-buttons sorting-btn"><?php echo Lang::get('student.sort'); ?></button>
				  </div>
				 
		   </div>
		   </form>
			<div class="clearfix"></div>
            <!-- <div class="panel panel-default"> 
			<div class="panel-body"> -->
			<div class="table-responsive">
				<ul class="clint-list list-group">
 				 	@if(count($clients))
					@foreach($clients as $key => $value)
			
					<li class="client-list-item list-group-item clearfix">
    					<div class="col-md-4 col-sm-12 client-box">
    						
    						<strong>{{ucfirst($value->first_name)}} {{ucfirst($value->last_name)}}</strong>
    						
    						<p href="name" class="client-mail"> 
    							<i class="fa fa-envelope-o" aria-hidden="true"></i>
    							{{$value->email}}
    						</p>
							@if($value->mobile)	 
    						<p href="name" class="client-no"> 
    							<i class="fa fa-phone" aria-hidden="true"></i>
    							{{$value->mobile}}
    						</p>
							@endif
    					</div>
    					<div class="col-md-4 col-sm-12 text-center message-box">
    						
							@if($value->upcoming_lessons)
								<p class="alert-green"> {{$value->upcoming_lessons}} <?php echo Lang::get('student.upcoming_lesson'); ?> 
								</p>
							@else
								<p class="alert-black">  <?php echo Lang::get('student.No_upcoming_lesson'); ?>  </p>	
							@endif
							 
							@if($value->remaining_credits)
								<p class="alert-red">{{$value->remaining_credits}} <?php echo Lang::get('student.credit_hours_pending'); ?></p>
							@endif	
							 
    					</div>
    					<div class="col-md-4 pull-right col-sm-12 client-btn-box">
    						@if(isset($credits[$value->customer_id]) && !empty($value->remaining_credits))
								<a href="{{URL::to('coaches/create-lesson')}}/{{$credits[$value->customer_id]}}" class="btn btn-info create-lesson"> <?php echo Lang::get('student.create_lesson'); ?> </a>
							@endif			
							 
    						<a href="{{ url('add_message?c='.$value->customer_id) }}" class="btn btn-primary create-lesson"> <?php echo Lang::get('student.send_message'); ?> </a>
    					</div>
  					</li>
					@endforeach
				@else
					<li class="client-list-item list-group-item clearfix">
					<div class="alert alert-info">
					  <strong></strong> <?php echo Lang::get('student.no_record_found'); ?>
					</div>
					</li>
				@endif	
				</ul>

			 
			<?php echo $clients->appends(Input::except('page'))->render(); ?>
			</div>
			<!-- </div> 
			</div> -->
		</div>
		 
	<!-- </div> -->
	</div>
</div>
@include('includes.footer')
 @endsection
