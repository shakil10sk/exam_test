<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Innovation IT">
    <meta name="path" content="{{ $path }}">
    <meta name="district_id" content="{{ $unionProfile->district_id}}">
    <meta name="url" content="{{ route('/') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
    <title>{{ $unionProfile->bn_name }}</title>


    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" type="image/x-icon"/>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}" />

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="{{ asset('css/flexslider.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick-theme.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mobilenav.min.css') }}">


    <!-- Theme skin -->
    <link href="{{ asset('css/default.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet"/>

    <!-- Owl Carousel Assets -->
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.theme.min.css') }}" rel="stylesheet">

    {{-- this is for menu --}}
    <link href="{{ asset('css/menu/mobilenav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu/style.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.js') }}"></script>

    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    --}}
  
   

    @yield('head')

    <style>
        body{font-family:solaimanlipi, "Times New Roman", Times, serif !important;
            color:black !important;}
        .shadow{
            border-radius: 4px;
            padding: 10px;
            margin-left: 10px;
            text-align: center;
            box-shadow: 0px 0px 3px gray;
        }
    </style>

</head>
<body>
    {{-- <div id="overlay"> --}}
        {{-- <div class="preload-zone">
          <span class="loadtext">অনুগ্রহ করে অপেক্ষা করুন...</span>
          <div class="spinner"></div>
        </div> --}}
      {{-- </div> --}}
<div id="wrapper">

@include('layouts.header')

@yield('content')

@include('layouts.footer')
</div>
<a href="#" class="scrollup"><i class="ion-ios-arrow-up active"></i></a>
<!-- javascript ================================================== -->


<!-- Placed at the end of the document so the pages load faster -->

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" ></script>
<script src="{{ asset('js/jquery.lazyload.min.js') }}"></script>
<script src="{{ asset('js/jquery.easing.1.3.min.js') }}"></script>
<script src="{{ asset('js/animate.min.js') }}"></script>
<script src="{{ asset('js/jquery.fitvids.min.js') }}"></script>
<script src="{{ asset('js/jquery.flexnav.min.js') }}"></script>

<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/jquery.flexslider.min.js') }}"></script>
<script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('js/jquery.okayNav.min.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}
<script src="{{ asset('js/sweetalert2@9.min.js') }}"></script>
@include('sweetalert::alert')
@yield('script')

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose : true
        });
    });
</script>
</body>
</html>
