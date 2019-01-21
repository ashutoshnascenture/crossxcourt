 @extends('app')
@section('title','Outbox')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title"><?php echo Lang::get('messages.outbox_messages'); ?>
                <a href="{{LaravelLocalization::localizeURL('add_message')}}" class="btn btn-success pull-right"><?php echo Lang::get('messages.add_new'); ?></a>
            </h2>
                 @if(session('message'))
                    <div class="alert alert-success">
                        {{session('message')}}
                    </div>
                    @endif

                    <div class="panel panel-default">

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><?php echo Lang::get('messages.id'); ?></th>
                                    <th><?php echo Lang::get('messages.from'); ?></th>
                                    <th width="60%"><?php echo Lang::get('messages.message'); ?></th>
                                    <th><?php echo Lang::get('messages.created'); ?></th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if(count($messages))
                                @foreach($messages as $key => $value)
                                    <?php //echo "<pre>"; print_r($value) ; die;?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$value->first_name}}</td>
                                    <td>
                                        <p> {{ substr($value->message,0,70) }}</p>
                                    </td>
                                    <td>
                                        {{ $value->created_at }}
                                    </td>

                                    <td>
                                    <form method="" action="{{LaravelLocalization::localizeURL('/delete')}}/{{$value->message_id}}" id="{{$value->message_id }}" accept-charset="UTF-8">
                                    
                                     <a class="btn my-btn edit-btn btn-success hours-btn btn-xs" href="{{LaravelLocalization::localizeURL('/show')}}/{{$value->message_id}}" role="button" style="margin-bottom:15px"><i class="fa fa-eye" aria-hidden="true">&nbsp;</i>View</a><br>

                                     <a class="btn my-btn btn-delete btn-danger btn-xs" data-href="{{$value->message_id}}" data-toggle="modal" data-target="#confirm-message" href="#" style="margin-bottom:15px"><i class="fa fa-trash-o" aria-hidden="true">&nbsp;</i>Delete</a>
                                     </form>    
                                    </td>
                                    <!--
                                    <td><a class="btn btn-primary" href="{{URL::to('edit_message')}}/{{$value->message_id}}" role="button"><i class="glyphicon glyphicon-edit"></i> Edit </a> </td> -->
                                </tr>
                                <?php $i++; ?> 
                                @endforeach
                                @else
                                <tr><td colspan="5"><?php echo Lang::get('messages.no_message_outbox'); ?></td></tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <?php echo $messages->render(); ?>
                <!-- </div> -->

        </div>
    </div>
</div>


<div class="modal fade" id="confirm-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Message</h4>
            </div>

            <div class="modal-body">
                Are you sure want to delete?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success cancel" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger delete" id="danger_message">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $('#confirm-message').on('show.bs.modal', function (e) {
        var form = $(e.relatedTarget).data('href');
        $('#danger_message').click(function () {
         
            $('#' + form).submit();
        });
    })
    });
</script>

@include('includes.footer')

@endsection
