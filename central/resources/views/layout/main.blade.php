<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Site favicon -->
	<link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}">


    <title> {{ $title ?? 'Central' }} | Union App</title>

    <!-- vendor css -->
    <link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
    <link href={{ asset('css/ionicons.min.css') }} rel="stylesheet">
    <link href={{ asset('css/perfect-scrollbar.min.css') }} rel="stylesheet">
    <link href={{ asset('css/jquery.switchButton.min.css') }} rel="stylesheet">
    <link href="{{ asset('css/highlight.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chart.min.css') }}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('css/bracket.css') }}">

    @stack('style')

</head>

<body>

    {{-- sidebar --}}
    @include('layout.sidebar')


    {{-- header --}}
    @include('layout.header')



    {{-- right sidebar --}}
    {{-- @include('layout.right_sidebar') --}}

    <div class="br-mainpanel">

        @include('layout.alert')

        @yield('content')
    </div>

    @include('layout.password_change')

    

    @stack('modal')

    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('js/popper.min.js') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/perfect-scrollbar.jquery.min.js') }}></script>
    <script src={{ asset('js/moment.min.js') }}></script>
    <script src={{ asset('js/jquery-ui.min.js') }}></script>
    <script src="{{ asset('js/highlight.pack.js') }}"></script>
    <script src={{ asset('js/select2.min.js') }}></script>
    <script src={{ asset('js/jquery.dataTables.js') }}></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-labels.min.js') }}"></script>

    {{-- <script src="{{ asset('js/chart.bundle.min.js') }}"></script>
    --}}
    {{-- <script src={{ asset('js/jquery.switchButton.min.js') }}></script>
    --}}
    {{-- <script src={{ asset('js/jquery.peity.min.js') }}></script>
    --}}

    <script src={{ asset('js/bracket.js') }}></script>

    <script>
        $('.datatable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });

        $('.select2').select2();
        
        $('.br-sideleft a').each(function(i,el) {

            if($(el).attr('href') == window.location.href)
            {
                $(el).addClass('active');
                $(el).closest('.collapse').addClass('show').prev().addClass('active');
                $(el).closest('.br-menu-sub').prev().addClass('active show-sub');
            }
            else if(window.location.href == $(el).attr('href')+'/')
            {
                $(el).addClass('active');
            }

        });
    </script>

    @stack('script')

</body>

</html>
