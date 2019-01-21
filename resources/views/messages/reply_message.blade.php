 @extends('app')
@section('title','Inbox')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('includes.sidebar')
        <div class="col-md-9 right-content-form-section pull-right profile-content">
            <h2 class="student-title">Send Message</h2>
            <div class="">
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

                <form class="form-horizontal" role="form" method="POST" action="{{ LaravelLocalization::localizeURL('/postReply_message/') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!--    hidden fields         -->
                    <input type="hidden" name="message_id" value="<?php echo $data['messages']->id; ?>">
                    <!--    hidden fields         -->
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModalLabel" ></h4>
                    </div>

                    <div class="modal-body">
                        <textarea name="message_reply" rows="3"  class="form-control" onkeyup="countChar(this)"></textarea>
                        <div id="charNum"></div>
                    </div>

                    <div class="modal-footer">
                        <input class="btn btn-success" type='submit' name='send' value="Send">
                    </div>

                </form>
                <!-- <div class="form-group">
                  @if ($data['messages']->from == Auth::user()->id)
                         <label class="col-md-4 control-label"> </label>
                         <div class="col-md-12">
                         
                              <p class="admin-chat"><?php //echo $data['messages']->message; ?></p><span style="float:right;">{{ ($data['messages']->created_at)}}</span>
                         </div>
                      @else
                         <label class="col-md-4 control-label"> </label>
                         <div class="col-md-12"> 
                       
                              <p class="client-chat"><?php //echo $data['messages']->message; ?></p><span style="float:right;"> {{ ($data['messages']->created_at)}}</span>
                         </div>	
                      @endif
               </div> -->
                @foreach($data['messages_detail'] as $key => $value)
				
                <div class="form-group">
                    @if ($value->user_id == Auth::user()->id)
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-12">
                        <br>
                        <?php
                        
								//date_default_timezone_set('UTC');
								//$now = $value->created_at ;
								 //$created_at  = $now->format('Y-m-d H:i:s');
                                
                                
                                ?>
                        {{ucfirst($value->first_name)}}
                        <p class="admin-chat"><?php echo $value->message_reply; ?></p><span style="float:right;">{{ Helper::ago($value->created_at)}}</span>
                        <br>
                    </div>
                    @else
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-12">
                        <br>
                        {{ucfirst($value->first_name)}}
                        <p class="client-chat"><?php echo $value->message_reply; ?></p><span style="float:right;">{{ Helper::ago($value->created_at)}}</span>
                        <br>
                    </div> 


                    @endif


                </div>

                @endforeach
            </div>

        </div>



        <!-- </div> -->
    </div>
</div>

<style>
    .admin-chat,.client-chat{padding:5px;margin-bottom:0px; border-radius:4px;}
    .col-md-6 span{color: #CCC!important;} 

</style>
<script>
    function countChar(val) {
        var len = val.value.length;

        if (len > 2000) {
            val.value = val.value.substring(0, 2000);

        } else {

            $('#charNum').text(2000 - len);

        }
    }
    ;
</script>
@include('includes.footer')
@endsection
