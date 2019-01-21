 @extends('admin')
@section('content')

<div class="content-wrapper">   
		
             <section class="content-header">
                <h2>Hours log</h2>
             </section>
	<section class="content">
        <div class="inner-content">
			<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
			<thead class="heading">
			<tr>
				<th>Month name</th>
				<th>Hours</th>
				<th>Total amount</th>
			</tr>
			</thead>
            @if(count($hours_log))
				@foreach($hours_log as $log)
				<tr>
					<td>{{ date('F, y' , strtotime($log->date))}}</td>
					<td>{{$log->hours}}</td>
					<td>${{$log->amount}}</td>
				</tr>	
				@endforeach
				 
			@else
				<tr>
					<td colspan="3"><div class="alert alert-info">
					  <strong>Info!</strong> Hours log not found.
						</div>
					</td>
				</tr>
				 
			@endif
			</table>
			</div>
		</div>	
    </section> 
</div><!-- content wrapper ends here -->
 
@endsection
