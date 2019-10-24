<!-- NOTE: Styles file must be loaded once, after page loads -->
<!DOCTYPE html>
<html>
	<head>
    	<title>Administrator</title>
    	<base href="{{ url('/') }}" />

    	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

			<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    	<!-- Bootstrap -->
    	<link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}" />

    	<!-- Font awesome -->
    	<link href="{{ asset('css/bootstrap/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" />

    	<!-- Bootstrap 3 Glyphicons -->
    	<link href="{{ asset('css/bootstrap/bootstrap-glyphicons.css') }}" type="text/css" rel="stylesheet" />

			<!-- Animate.CSS -->
			<link type="text/css" href="{{ asset('css/animate.css') }}" rel="stylesheet" media="screen" />

		<!-- UTop -->
			<link rel="stylesheet" media="screen,projection" href="{{ asset('js/utop/css/ui.totop.css') }}" />

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	    <![endif]-->

    	<!-- Custom styles for landing page-->
    	<link rel="stylesheet" type="text/css" href="{{ asset( 'css/app.css' ) }}" />

		<!-- Summernote -->
		<link href="{{ asset('js/summernote/summernote.css') }}" rel="stylesheet" />

		<!-- Include Date Range Picker -->
		<link href="{{ asset('css/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>

		<!-- SELECT2 CSS -->
		<link href="{{ asset('js/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet" />

    	<!-- Custom Styles -->
		@yield('styles')
  </head>
	<body>
