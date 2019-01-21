<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
		<title>@if(isset($meta['title']))
			{{$meta['title']}}
		@else 
			crossXcourt: Tennis Wherever you Travel
		@endif</title>
		<meta name="google-site-verification" content="OBr_miKakwqe7gGUslW9MyCdpTPDlqwMZFWPjOLjfE0" />
		<meta name="title" content="@yield('title') - Tennis Wherever you Travel">
		<meta name="description" content="@yield('description')">
		<meta name="keywords" content="@yield('keywords')">
		
        <link href="{{ asset('/css/bootstrap.min.css')}}" rel="stylesheet">
        
        
		<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,700italic,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{ asset('/font-awsome/css/font-awesome.css')}}">
        <link href="{{asset('/css/datepicker.min.css')}}" rel="stylesheet" type="text/css"> 
		<link href="{{asset('/css/raterater.css') }}" rel="stylesheet">
		
		<script src="{{asset('/js/2.1.3_jquery.min.js')}}" type="text/javascript"></script>
		<script> var siteUrl = '{{ LaravelLocalization::localizeURL("/") }}';
		 
		</script>
   
   <?php // LaravelLocalization::getCurrentLocale()  ?>
    <style>
        .icon { font-size:80px; }
        .dashboard-icon li { margin:50px }
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
            width:auto;
            padding:0 10px;
            border-bottom:none;
        }
        .required .control-label:after {
            content: "*";
            color: red;
            font-size: inherit;
            font-weight: 800;
        }
    </style>
</head>
<body>
	<div class="wrapper" id="main-container">
    @include('includes.header')

   
	<!-- sidebar -->
 
            @if ( Session::has('flash_message') )
			<div class="sidebar-wrapper">
			<div class="container">
            <div class="alert {{ Session::get('flash_type') }} margin-top-3">
                <div>{{ Session::get('flash_message') }}</div>
            </div>
    		
			</div>
			</div>
            @endif
    	
        @yield('content')
        
    
	</div> 
	 
	<script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('/js/custom.js')}}"></script>
	<script src="{{asset('/js/raterater.jquery.js') }}"></script>
	
    <script>
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var form = $(e.relatedTarget).data('href');
            $('#danger').click(function () {
                $('#' + form).submit();
            });
        })
    </script>
	
		<!--<script>
		jQuery(function ($) {
			var $active = $('#accordion .panel-collapse.in').prev().addClass('active');
			$active.find('a').prepend('<i class="glyphicon glyphicon-minus"></i>');
			$('#accordion .panel-heading').not($active).find('a').prepend('<i class="glyphicon glyphicon-plus"></i>');
			$('#accordion').on('show.bs.collapse', function (e) {
				$('#accordion .panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus ');
				$(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
			})
		});
	</script>-->
	<style>
	.panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content: "\e114";    /* adjust as needed, taken from bootstrap.css */
    float: right;        /* adjust as needed */
    color: grey;         /* adjust as needed */
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e080";    /* adjust as needed, taken from bootstrap.css */
}

	</style>
</body>
</html>
