<!DOCTYPE html>
<html>

<head>
    @include('layouts.include.head')
    @yield('head')
</head>

<body>
    @include('layouts.include.header')
    @include('layouts.include.sidebar')
    <div class="main-container">
        <div class="pd-ltr-20 customscroll customscroll-10-p height-100-p xs-pd-20-10">
            <div class="footer-position">

                @yield('content')

            </div>
            @include('layouts.include.footer')
        </div>
    </div>
    @include('layouts.include.script')
    @yield('script')
    @include('sweetalert::alert')
</body>

</html>