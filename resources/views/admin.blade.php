 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>crossXcourt</title>

        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{asset('/css/datepicker.min.css')}}" rel="stylesheet" type="text/css"></script>
    <link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/font-awsome/css/font-awesome.css') }}">

    <script src="{{asset('/js/2.1.3_jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/custom.js')}}"></script>
    <script src="{{asset('/js/app.js')}}"></script>

    <script> var siteUrl = '{{ url("/") }}';</script>
	<script>
		$(document).ready(function(){
			    var role_id=$("#role_id").val();
				if(role_id==2)
				{
				  $(".messages").css({ 'display': "block" });
				  $(".message_coach").css({ 'display': "block" });
				  $(".message_customer").css({ 'display': "none" });
				}
				else if(role_id==3)
				{
				  $(".messages").css({ 'display': "block" });
				  $(".message_coach").css({ 'display': "none" });
				  $(".message_customer").css({ 'display': "block" });
				}
				
		});
</script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

             <!-- Logo -->
    <a href="{{ url('/admin/home/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('images/small-logo.png') }}" alt="logo"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('images/nav-logo.png') }}" alt="logo"></span>
    </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			
			
			<li class="dropdown admin-dropdown">
				
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome &nbsp;{{ucfirst(Auth::user()->first_name) }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <!--<li><a href="{{ url('/users/changepassword/')}}"> Change Password</a></li>-->
                             <!--<li><a href="{{ url('/users/editprofile/')}}"> Edit Profile</a></li>-->
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
            </li>
			
        </ul>
      </div>
    </nav>

        </header>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active treeview">
                        <a href="{{ url('/admin/home/') }}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard </span> <!--<i class="fa fa-angle-left pull-right"></i>-->
                        </a>

                    </li>
                    <li class="treeview">
                        <a href="{{ url('/admin/') }}/users">
                            <i class="fa fa-files-o"></i>
                            <span>Customers</span>

                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/admin/') }}/coaches">
                            <i class="fa fa-th"></i> <span>Coaches</span>

                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{{ url('/admin/') }}/pages">
                           <i class="fa fa-paper-plane" aria-hidden="true"></i>

                            <span>Pages</span>
                            <!--<i class="fa fa-angle-left pull-right"></i>-->
                        </a>
                    </li>
                    
                    <li class="treeview">
                        <a href="{{ url('/admin/') }}/bookings">
                            <i class="fa fa-calendar" aria-hidden="true"></i>

                            <span>Bookings</span>
                             
                        </a>
                    </li>
                    
                    <li class="treeview">
                        <a href="{{ url('/admin/coaches/lessons') }}">
                            <i class="fa fa-file-text" aria-hidden="true"></i>

                            <span>Lessons</span>
                             
                        </a>
                    </li>
                    
                    <li class="treeview">
                        <a href="{{url('/admin/customers/mass-email')}}">
                            <i class="fa fa-envelope" aria-hidden="true"></i>

                            <span>Mass Email</span>
                            
                        </a> 
                    </li>
<!--
					<li class="treeview">
                        <a href="{{url('/admin/coaches/pending-payments')}}">
                          <i class="fa fa-credit-card" aria-hidden="true"></i>

                            <span>Pending Payments</span>
                            
                        </a> 
                    </li>
-->
                   <li class="treeview">
                        <a href="{{url('/admin/customers/add-rate')}}">
                           <i class="fa fa-star-o" aria-hidden="true"></i>

                            <span>Friend Rate</span>
                            
                        </a> 
                    </li>
                    
                    <li class="treeview">
                        <a href="{{ url('/admin/') }}/play-with-pro">
                            <i class="fa fa-files-o"></i>
                            <span>Play With a Pro</span>

                        </a>
                    </li>
			   <!----------------Messages------------------------------>
			    <?php
			         $role_val='';
                     if(isset($role))
					   $role_val=$role
                 ?>			   
			    <input type='hidden' name='role_id' id='role_id' value="{{$role_val}}">
			
			<?php
			  
			  $messages_count = Helper::notification('read_admin');
			
			?>
			<li class="active treeview">
				  <a href="#">
					<i class="fa fa-comments-o" aria-hidden="true"></i>
<span>Messages</span> <i class="fa fa-angle-left pull-right"></i>
					@if($messages_count)
							<span class="badge">{{$messages_count}}</span>
					@endif
					
				  </a>
			 <!----------------Messages------------------------------>
			 
				<?php 
			  
			
				$notifications = Helper::adminNotification();
				$coach_unread = null;
				$customer_unread = null;
				if($notifications){
					foreach($notifications as $val){
						if($val->role_id == 2){
							$coach_unread = $val->unread;
						}
						if($val->role_id == 3){
							$customer_unread = $val->unread;
						}
					}
				}
				 
				?>	
				<ul style="display:none;" class="treeview-menu messages">
				       <li class="active treeview">
					        <a href="#">
								<i class="fa fa-pie-chart"></i> <span>Coaches </span> <i class="fa fa-angle-left pull-right"></i>
									<span class="badge"> {{$coach_unread}}</span>
							  </a>
							   <ul  class="treeview-menu message_coach"> 
							       	<li class="active"><a href="{{url('admin/add_message/2') }}"><i class="fa fa-circle-o"></i>Compose</a></li>
									<li><a href="{{ url('admin/messages/2') }}"><i class="fa fa-circle-o"></i>Inbox</a></li>
									<li><a href="{{ url('admin/outbox/2') }}"><i class="fa fa-circle-o"></i>Outbox</a></li>
							     </ul>
					   </li>
					   <li class="active treeview">
					        <a href="#">
								<i class="fa fa-pie-chart"></i> <span>Customers</span> <i class="fa fa-angle-left pull-right"></i>
								<span class="badge">{{$customer_unread}}</span>
							  </a>
							      <ul  class="treeview-menu message_customer"> 
							       	<li class="active"><a href="{{url('admin/add_message/3') }}"><i class="fa fa-circle-o"></i>Compose</a></li>
									<li><a href="{{ url('admin/messages/3') }}"><i class="fa fa-circle-o"></i>Inbox</a></li>
									<li><a href="{{ url('admin/outbox/3') }}"><i class="fa fa-circle-o"></i>Outbox</a></li>
							     </ul>
					   </li>
					
				  </ul>
            </li>
			
		  <!----------------Messages------------------------------>			

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


        @if ( Session::has('flash_message') )
        <div class="alert {{ Session::get('flash_type') }}" style="float: right;
    margin-right: 15px; margin-top: 20px;width: 80%;">
            <div>{{ Session::get('flash_message') }}</div>
        </div>
        @endif
        @yield('content')
    </div>
    <script>
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var form = $(e.relatedTarget).data('href');
            $('#danger').click(function () {
                $('#' + form).submit();
            });
        })
    </script>

</body>
</html>
