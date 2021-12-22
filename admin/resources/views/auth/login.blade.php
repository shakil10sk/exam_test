<!DOCTYPE html>
<html>
<head>
    	<!-- Basic Page Info -->
	<meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="path" content="{{ url('/') }}">
    <style type="text/css">.error{color: red;}</style>

	<title>@if(isset(Auth::User()->relationBetweenUnion->bn_name)) {{ Auth::User()->relationBetweenUnion->bn_name }} @else ডিজিটাল পৌরসভা পরিষদ অ্যাডমিন @endif</title>

	<!-- Site favicon -->
	<link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet"> --}}
	{{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"> --}}
	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('css/app-style.min.css') }}">


	{{-- this is for serverside data table --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.dataTables.css') }}"> --}}


    <style type="text/css">
        .login-wrap{
            background-image:url('public/assets/images/lg-bg.jpg');
            background-repeat: no-repeat;
            /*background-origin: content-box;*/
            background-position: center;
            background-size: cover;
        }

        .input-group.custom > .custom-select:not(:last-child), .input-group.custom > .form-control:not(:last-child) {
            border-radius:.25rem;
            padding-right: 50px;
            /* border: 1px solid; */
            background: white;
            color: black;
            /*border: 1px solid #17A2B8;*/
            width: 250px;
            /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
            height: 40px;
        }
        .form-control-lg, .input-group-lg > .form-control, .input-group-lg > .input-group-prepend > .input-group-text, .input-group-lg > .input-group-append > .input-group-text, .input-group-lg > .input-group-prepend > .btn, .input-group-lg > .input-group-append > .btn {
            height: 40px;
            font-size: 16px;
        }

        .btn-lg, .btn-group-lg>.btn {
            font-size: 22px !important;
        }
        .input-group-append.custom {
            position: absolute;
            right: 0;
            top: 0;
            z-index: 12;
            height: 100%;
            /*background: #17A2B8;*/
            border-radius: .25rem;
        }
        .login-box .login-img {
            display: block;
            margin: 0 auto 20px;
            height: 80px;
        }


    </style>
</head>
<body>

{{--<div class="over-bg"></div>--}}
<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
    <div class="login-box box-shadow">
         <img src="{{ asset('images/logo.png') }}" alt="login" class="login-img">
{{--         <h2 class="text-center mb-20" style="color: white">ডিজিটাল পৌরসভা</h2>--}}
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Username</h6>
            </label>
            <div class="input-group custom input-group-lg">
                <input placeholder="Enter Username" id="username" type="text" class="form-control @error('username')
                    is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                <div class="input-group-append custom">
                    <span class="input-group-text" style="color: #37474F"><i class="fa fa-user"
                                                                             aria-hidden="true"></i></span>
                </div>

                @error('username')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <label class="mb-1">
                <h6 class="mb-0 text-sm">Password</h6>
            </label>
            <div class="input-group custom input-group-lg">
                <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password')
                    is-invalid @enderror" name="password" required autocomplete="current-password" size="4">
                <div class="input-group-append custom">
                    <span class="input-group-text" style="color: #37474F"><i class="fa fa-lock" aria-hidden="true"></i></span>
                </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-info btn-block" type="submit" value="লগইন">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
    @if (env('APP_ENV') == 'production')
    <script src="{{ asset('js/script.min.js') }}"></script>
    @else
    <script src="{{ asset('js/script.js') }}"></script>
    @endif

    <script>
        x = $('.footer-position').height(); // +20 gives space between div and footer
        y = $(window).height();
        if (x < 200){ // 100 is the height of your footer
            $('.footer-position').css('height', y+'px'); // again 100 is the height of your footer
            $('#footer').css('position', 'relative'); // again 100 is the height of your footer
            $('#footer').css('left', '0px'); // again 100 is the height of your footer
            $('#footer').css('bottom', '0px'); // again 100 is the height of your footer
        }else{
            $('#footer').removeAttr('style');
            $('.footer-position').removeAttr('style');
        }


    </script>
</body>
</html>
