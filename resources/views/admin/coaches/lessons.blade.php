 @extends('admin')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>Lessons listing</h2>
        <p class="pull-right">
            <!--<a href="coaches/create" class="btn btn-success">Add New</a>-->
        </p>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="inner-content">
            <div class="table-responsive">
                <table class="table table-bordered product-create-table table-striped table-hover">
                    <thead class="heading">
                        <tr>
                            <th>Id</th>
                            <th>Coach name</th>
                            <th>Customer name</th>
                            <th>Start time	</th>
                            <th>Lesson duration	</th>
                            <th>Number of students</th>
                            <th>Court name</th>
                            <th>Status</th>                      
                            <th>Date</th>                      
                            <th>Payment Status</th>                      

                        </tr>
                    </thead>
                    <tbody>
						 <?php $i = 1; ?>
                        @if(count($lessons) )
						<?php //echo "<pre>"; print_r($lessons); die; ?>
                        @foreach($lessons as $key =>  $value)

                        <tr> 
                            <td><?php echo (($lessons->currentPage() - 1 ) * $lessons->perPage() ) + $i ?></td>					 
                            <td>{{ $value->coach_first_name }} {{$value->coach_last_name}}</td>
                            <td>{{ $value->customer_first_name}} {{$value->customer_last_name}}</td>
                            <td>{{ $value->start_time }}</td>
                            <td>{{$value->lesson_duration }}</td>
                            <td>{{$value->number_of_students }}</td>
                            <td>{{$value->name }}</td>
                            <td>{{$value->status }}</td>                      
                            <td>@if(!empty($value->date))

                                {{date('M d, Y', strtotime($value->date))}}

                                @endif	 
                            </td>
                            <td>
                            @if(!empty($value->payment_status))
                            <a class="btn my-btn edit-btn btn-success" href="{{URL::to('admin/coaches/paymentstatus')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Paid</a>
                            @else
                             <a class="btn my-btn edit-btn btn-warning" href="{{URL::to('admin/coaches/paymentstatus')}}/{{$value->id}}" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp;</i>Awaiting Payment</a>
                            @endif
                            </td>

                        </tr>

						<?php $i++;  ?>
                        @endforeach
                        
                        @else
                        <tr><td colspan="9">No Lesson found.</td></tr>
                        @endif  

                    </tbody>
                </table>
            </div>

        </div><!-- content section ends -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->





@endsection
