 @extends('app')
@section('title','Inbox')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('messages.messages_listing'); ?></h2>
            <div class="">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="heading">
                        <tr>
                            <th><?php echo Lang::get('messages.id'); ?></th>
                            <th><?php echo Lang::get('messages.from'); ?></th>
                            <th><?php echo Lang::get('messages.message'); ?></th>
                            <th><?php echo Lang::get('messages.created'); ?></th>
                            <!-- <th>Action</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        @if(count($messages))
                        <?php $i = 1; ?>

                        @foreach($messages as $key => $value)
                        <?php
                        $color_val = '';
                        if (Auth::user()->role_id == '2' && $value->read_coach == '1')
                            $color_val = 'red';
                        else if (Auth::user()->role_id == '3' && $value->read_customer == '1')
                            $color_val = 'red';
                        if (Auth::user()->id == $value->to) {
                            ?>					
                            <tr>
                                <td><?php echo (($messages->currentPage() - 1 ) * $messages->perPage() ) + $i ?></td>
                                <td>{{$value->from_first_name}}</td>
                                <td>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a style="color:{{$color_val}};" href="{{LaravelLocalization::localizeURL('reply_message')}}/{{$value->message_id}}"> 
                                        {{substr($value->message,0,50)}}
                                    </a>
                                </td>
                                <td>{{ Helper::ago($value->created_at)}}</td> 
                            </tr>
                            <?php
                            $i++;
                        } elseif (Auth::user()->id == $value->from) {
                            ?>
                            <tr>
                                <td><?php echo (($messages->currentPage() - 1 ) * $messages->perPage() ) + $i ?></td>
                                <td>{{$value->to_first_name}}</td>
                                <td>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a style="color:{{$color_val}};" href="{{LaravelLocalization::localizeURL('reply_message')}}/{{$value->message_id}}"> 
                                        {{substr($value->message,0,50)}}
                                    </a> 
                                </td>
                                <?php
								date_default_timezone_set('UTC');
								$now = $value->created_at ;
								 //$created_at  = $now->format('Y-m-d H:i:s');
                                
                                
                                ?>
                                <td>{{ Helper::ago($value->created_at)}}</td>

                            </tr>
                            <?php
                            $i++;
                        }
                        ?> 
                        @endforeach
                        @else
                        <tr><td colspan="4"><?php echo Lang::get('messages.no_message_inbox'); ?></td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <?php echo $messages->appends(Input::except('page'))->render(); ?>
        </div>
        <!-- </div> -->
    </div>
</div>
@include('includes.footer')
@endsection
