	<!-- Basic Page Info -->
	<meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="path" content="{{ url('/') }}">
    <style type="text/css">.error{color: red;}</style>

	<title>@if(isset(Auth::User()->relationBetweenUnion->bn_name)) {{ Auth::User()->relationBetweenUnion->bn_name }} @else ডিজিটাল পৌরসভা অ্যাডমিন @endif</title>

	<script>
		var app_url = '{{url('/')}}';
		var csrf_token = '{{csrf_token()}}';
	</script>

	<!-- Site favicon -->
	<link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/app-style.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">


	{{-- this is for serverside data table --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.dataTables.min.css') }}">

    <!-- bangla font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/kalpurush-font.css') }}">


