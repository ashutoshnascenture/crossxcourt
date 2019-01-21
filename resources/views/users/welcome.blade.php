@extends('app')
@section('content')
<div class="container">
  <h2>Upcoming Events</h2>
  <p></p>
   
	  <table class="table table-bordered">
		<thead>
		  <tr>
			<th>Event Name</th>
			<th>Organiser Name</th>
			<th>Location</th>
			<th>Event Date</th>
		  </tr>
		</thead>
		 
		<tbody>
			
			@if(count($event))
			<?php 
			  
				foreach ($event as $events) : 
			
			?> 
			<tr>
				<td>
					 
					<a href ="{{URL::to('affiliate') }}/{{$events->id}}"><?php echo  ucfirst($events->event_name) ; ?> </a> 
				
				
				</td>
				<td>
					<?php echo  ucfirst($events->organiser_name) ; ?> 
				
				</td>
				<td>
					<?php echo  ucfirst($events->location) ; ?> 
				
				</td>
				<td>
					<?php echo  ucfirst($events->event_date) ; ?> 
				
				</td>
			
			 
			</tr> 
			 <?php	
                endforeach;
			  ?>
			@else
				<tr><td colspan="4">No event found.</td></tr>
		    @endif
		</tbody>
	  </table>
	 
</div>
 
@endsection
