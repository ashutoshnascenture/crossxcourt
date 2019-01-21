@extends('app')
@section('title','Inbox')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('messages.messages_listing'); ?></h2>
			<div class="table-responsive">
			<form class="form-horizontal" role="form" method="" action="">
				<div class="table-responsive">
				<table class="table table-bordered product-create-table table-striped">
					<tbody>
						<!-- <tr>
							<td>From</td>
							<td>{{ucfirst($message->from)}}</th>
						</tr>
 -->					
				
						<tr>
							<td>Message</td>
							<td>{{ucfirst($message->message)}}</td>
						</tr>
				
					
						<tr>
							<td>created</td>
							<td>{{ ($message->created_at)}}</td>
						</tr>
					
 
					</tbody>
				</table>
				</div>
				
			</form>
			</div>
			  
		</div>
		
		
				
	<!-- </div> -->
	</div>
</div>
@include('includes.footer')
 @endsection
