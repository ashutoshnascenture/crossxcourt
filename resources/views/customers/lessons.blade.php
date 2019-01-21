 @extends('app')
@section('title','Lessons')
@section('content')
@include('includes.sidebar')
 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-xs-12 right-content-form-section pull-right profile-content">

            <div class="panel-heading">
                <a href="{{URL::to('/customer')}}"><?php echo Lang::get('lesson.all_lessons') ?></a>
                &nbsp; | &nbsp;  
                <a href="{{URL::to('customer?lesson=booked')}}"><?php echo Lang::get('lesson.booked_lesson') ?></a>
                &nbsp; | &nbsp;  
                <a href="{{URL::to('customer?lesson=completed')}}"><?php echo Lang::get('lesson.completed_lessons') ?></a>
                &nbsp; | &nbsp;  
                <a href="{{URL::to('customer?lesson=credits')}}"><?php echo Lang::get('lesson.lesson_credits') ?></a>

            </div>
            <div class="panel-body">

                <ul class="lessons list-group clint-list lesson-listing">
                 
                    @if(count($lessons))

                    @foreach($lessons as $lesson)

                    <li class="list-group-item client-list-item clearfix">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
									@if(!empty($lesson->profile_image))
                                    <img src="{{url('/coach-thumb/'.$lesson->profile_image)}}/265/264" class="client-img-2" style="max-width:100px;max-height:100px;"/>
                                    @else
                                    <img src="{{url('/coach-thumb/no-image.jpg')}}/265/264" class="client-img-2" style="max-width:100px;max-height:100px;"/>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <p> {{ucfirst($lesson->first_name)}} {{ucfirst($lesson->last_name)}} <br> <a href="mailto:{{ $lesson->email }}"> {{ $lesson->email }}</a> <br> <a href="tel:{{ $lesson->mobile }}"> {{ $lesson->mobile }}</a></p>

                                </div>
                                <div class="col-md-3 text-center">
                                    @if(!empty($lesson->date))
                                    <p class="date">{{date('D F d, Y', strtotime($lesson->date))}}</p>
                                    @endif
                                    @if(!$lesson->start_time)
                                    <p class="lesson-time">{{ $lesson->lessons }} Hour, </p>
                                    <p class="student">{{ $lesson->additional_players + 1 }} Player </p>

                                    @else
                                    <p class="">{{ $lesson->start_time }}, {{ $lesson->lesson_duration }} Hour,</p>
                                    <p class="">Max Students: {{ $lesson->number_of_students + 1 }}</p>
                                    @if(Request::input('lesson') == 'credits') 
                                    Credits Left: {{ $remaining_credits->remaining_credits  }} Hours
                                    
                                    @endif
                                        
                                    @endif



                                </div>
                             <!--  <div class="col-md-2 text-center">
 
                                </div>
 -->                                <div class="col-md-8">
                                   @if(Request::input('lesson') == 'booked')
                                    <a href="{{LaravelLocalization::localizeURL('coaches/profile')}}/{{$lesson->first_name}}-{{$lesson->last_name}}/{{$lesson->user_id}}" class="btn btn-success"><?php echo Lang::get('lesson.view_coach_Profile') ?></a>
                                    <a href="{{LaravelLocalization::localizeURL('add_message?c='.$lesson->user_id) }}" class="btn btn-primary create-lesson"><?php echo Lang::get('lesson.send_message'); ?></a>
                                 @endif
                                @if(Request::input('lesson') == 'completed')
                                   @if(!$lesson->review)
                                        <a href="{{LaravelLocalization::localizeURL('customer/add-review/'.$lesson->id)}}" class="btn btn-info create-lesson"><?php echo Lang::get('lesson.add_review'); ?></a>
                                    @endif      
                                 @endif


                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <a href="#" class="pull-left"> <strong> Lesson#:{{$lesson->id}}  </strong></a>
                                <a href="#" class="pull-right"> <strong> 
                                        <?php echo Lang::get('lesson.status'); ?>: 
                                        @if($lesson->status == null)
                                        <?php echo Lang::get('lesson.booked'); ?>
                                        @else
                                        {{$lesson->status}}
                                        @endif	 
                                    </strong></a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else

                    <p class="alert alert-info">
                        @if(Request::input('lesson') == 'credits') 

                         
                        @if(!empty($remaining_credits->remaining_credits))
                           
                            you have  {{$remaining_credits->remaining_credits}} Lessons credit.

                        @else  

                        <?php echo Lang::get('lesson.lesson_credits_mesg'); ?>    
                        @endif
                        @else

                        <?php echo Lang::get('lesson.current_lesson_status'); ?> {{Request::input('lesson') }} <?php echo Lang::get('lesson.lesson'); ?>.

                        @endif
                    </p>	
                    @endif
                </ul>  

                <?php echo $lessons->appends(Input::except('page'))->render(); ?>

            </div>


        </div>
    </div>
</div>
<style>

    .lessons{list-style-type:none; padding:0px;}
    .status {color: cadetblue;} 
    .lessons li:nth-child(odd) {
        background: #f5f5f5;
    }
    .lessons li:nth-child(even) {
        background: #f5f5f5;
    }
    .client-img-2{
        border: 1px solid #e4e4e4;
        border-radius: 2px;
        height: 254px;
        margin-bottom: 20px;
        margin-left: -15px;
        padding: 4px;
        width: 254px;
    }
    .pagination {
        float: right;
    }
</style>
</div>
@include('includes.footer')
@endsection
