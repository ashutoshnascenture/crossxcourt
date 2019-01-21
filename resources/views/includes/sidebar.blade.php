 <div class="sidebar-wrapper">
	
    <div class="container padding-top-bottom-5">

        @if (Auth::check() && Auth::user()->role_id == 2)

        <?php
        $coach = Helper::profile_image();
        $text = '';
        $class_name = '';
        ?>
                             
		  
		 
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar-section pull-left">

            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                
                <?php
                
                if ($coach) :
                    ?>
                    @if(!empty($coach->user_id))    
                    <div class="profile-userpic">


                        <form role="form" method="POST" enctype="multipart/form-data" action="{{ LaravelLocalization::localizeURL('/users/update-profile-image')}}" name = "form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group label-text-area image-area">

                                @if(!empty($coach->profile_image))
                                <?php
                                $text = Lang::get('sidebar.change_image');
                                $class_name = '';
                                ?>
                            </div>
                            <div id="loading" style="display: none; margin-left: 30%;"><img src="{{asset('images/loader.gif')}}" ></div>
                            <div class="profile-userpic" id="noimage" style="display: block;">
                                <img src=" {{url('/coach-thumb/'.$coach->profile_image)}}/150/150" height="150px" width="150px" alt="No Image" class="img-responsive">
                                <p class="img-text"><?php echo Lang::get('coachProfile.profile_image'); ?></p>  
                            </div>
                            <div class="profile-userbuttons"> 
                                <a href="" role="button" class="btn btn-danger delete_profile_image_btn" data-href="" data-toggle="modal" data-target="#confirm-delete"  href="#"><?php echo Lang::get('sidebar.delete_image'); ?></a>


                                <!-- <a class="btn my-btn btn-delete btn-danger" data-href="" data-toggle="modal" data-target="#confirm-delete" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>  Delete</a>  -->


                                @else
                                <?php
                                $text = Lang::get('sidebar.upload_image');
                                $class_name = 'browse-center';
                                ?>
                                

                                <div id="loading" style="display: none; margin-left: 30%;"><img src="{{asset('images/loader.gif')}}" ></div>

                                <div id="noimage" style="display: block;"><img src="{{url('/coach-thumb/no-image.jpg')}}/200/200" class="img-responsive"></div>
                                <p class="img-text" ><?php echo Lang::get('coachProfile.profile_image'); ?>
                                </p>  
                                @endif
								
                                <div class="browse <?php echo $class_name; ?>">
                                    <div class="upload-btn"> <?php echo $text; ?> </div>
                                    <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
                                </div> 

                            </div>

                        </form>
                    </div>
                <?php endif; ?>
                <div class="profile-usermenu">
                    <ul class="nav">
						
						<li>
							@if(!empty($coach->is_active))
                            <a href="{{ url('/coaches/lessons')}}" id="setting">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.add_lessons'); ?></a>
                            @else 
                             <a href="{{ url('/coaches/pending-review')}}" id="setting">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.add_lessons'); ?></a>  
                            @endif     
                        </li>
<!--
                        <li>
                            <a href="{{ url('coaches/create-lesson')}}" id="setting">
                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                <?php //echo Lang::get('sidebar.create_lesson'); ?></a>
                        </li>
-->
						
                        <li>
                            <a href="{{ url('/coaches/clients')}}" id="setting">
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.students'); ?></a>
                        </li>
                        
                        <li>
                            <a href="{{ url('/coaches/courts')}}" id="setting">
                                <i class="fa fa-object-group" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.courts'); ?></a>
                        </li>
                        
                        <li>
                            <a href="{{ url('/users/account-information/')}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.account_information'); ?></a>
                        </li>
                        <li>
                            <a href="{{ url('/coaches/service-area')}}" id="setting">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.area_served'); ?></a>
                        </li>
                        <li>
                            <a href="{{ url('/coaches/schedule')}}" id="setting">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.availability'); ?></a>
                        </li>
                        <li>
                            <a href="{{ url('/users/profile')}}" id="setting">
                                <i class="glyphicon glyphicon-user"></i>
                                <?php echo Lang::get('sidebar.profile'); ?></a>
                        </li>
                        <li>
                            <a href="{{ url('/coaches/price')}}" id="setting">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.rate'); ?></a>
                        </li>
                        
                        <li>
                            <a href="{{ url('/users/password')}}" id="setting">
                                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.change_password'); ?></a>
                        </li>
                        <li>
                            <a href="{{ url('/coaches/payment-information')}}" id="setting">
                                <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.payment'); ?></a>
                        </li>
                        
                      
                        
                        <li>
                            <a href="{{URL('/faqs')}}" id="setting">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.Faqs'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @else

        @endif

        @elseif (Auth::check() && Auth::user()->role_id == 3)


        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar-section pull-left">
            <div class="profile-sidebar">
                <div class="profile-usermenu">
                    <ul class="nav">

                        <li><a href="{{ url('/customer')}}" id="setting"><i class="fa fa-tachometer" aria-hidden="true"></i><?php echo Lang::get('sidebar.lesson'); ?></a></li>
                        <li><a href="{{ url('/customer/edit')}}" id="setting"> <i class="glyphicon glyphicon-user"></i><?php echo Lang::get('sidebar.profile'); ?></a></li>
                        <li>
                            <a href="{{ url('/customer/password')}}" id="setting">
                                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                <?php echo Lang::get('sidebar.change_password'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>  
        </div>

        @endif
        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"> <?php echo Lang::get('usersMessage.Delete_profile_image') ?></h4>
                    </div>

                    <div class="modal-body">
                        <?php echo Lang::get('usersMessage.delete') ?>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success cancel" data-dismiss="modal"><?php echo Lang::get('usersMessage.cancel_button') ?></button>
                        <a href="{{ LaravelLocalization::localizeURL('/users/deletephoto')}}" class="btn btn-danger delete" id="danger"><?php echo Lang::get('usersMessage.delete_button') ?></a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                
                var CurrentUrl = window.location.origin + window.location.pathname;
                
                $('.nav a').each(function (Key, Value)
                {
                    
                    if (Value['href'] === CurrentUrl)
                    {
						
                        $(Value).parent().addClass('active');
                        
                    }
                });
            });

            $("#profile_image").change(function () {

                var val = $(this).val();

                switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
                    case 'gif':
                    case 'jpeg':
                    case 'jpg':
                    case 'png':

                        $("#loading").css("display", "block");
                        $("#noimage").css("display", "none");
                        $(this).parents('form').submit();


                        break;
                    default:
								
						$('.img-text').after('<div id="fname_msg" style="color:red; margin-left: 20px;">Accepted types are PNG, GIF, JPEG</div>')	
						 	 
								
                        $(this).val('');
                        
                        break;
                }
            });

        </script>
