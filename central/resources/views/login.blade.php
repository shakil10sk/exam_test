<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Union Central</title>

    <link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
    <link href={{ asset('css/ionicons.min.css') }} rel="stylesheet">
    <link href={{ asset('css/perfect-scrollbar.min.css') }} rel="stylesheet">
    <link href={{ asset('css/jquery.switchButton.min.css') }} rel="stylesheet">
    <link href="{{ asset('css/highlight.css') }}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('css/bracket.css') }}">
</head>

<body>
    <div class="br-mainpanel">
        
        @include('layout.alert')

        <div class="br-pagebody">
            <div class="br-section-wrapper">


                <form action="{{ route('login.post') }}" method="post">
                    @csrf
                    <div class="row no-gutters">
                        
                        <div class="col-xl-6 bg-primary">
                            <div class="pd-40">
                                <img class="wd-100p" src="{{asset('images/login.png')}}" alt="login">
                            </div>
                        </div>
                        
                        <div class="col-xl-6">
                            <div class="pd-30">
                                <div class="pd-xs-x-30 pd-y-10">
                                    <h5 class="tx-xs-28 tx-inverse mg-b-5">সেন্ট্রাল মনিটরিং প্যানেল</h5>
                                    <p> আপনার ইউজার নাম আর পাসওয়ার্ড দিন </p>
                                    <br>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control pd-y-12"
                                            placeholder="User name">
                                    </div>
                                    <div class="form-group mg-b-20">
                                        <input type="password" name="password" class="form-control pd-y-12"
                                            placeholder="Enter your password">
                                    </div>

                                    <button type="submit" class="btn btn-primary pd-y-12 btn-block">লগইন</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('js/popper.min.js') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/perfect-scrollbar.jquery.min.js') }}></script>
    <script src={{ asset('js/moment.min.js') }}></script>
    <script src={{ asset('js/jquery-ui.min.js') }}></script>
    <script src="{{ asset('js/highlight.pack.js') }}"></script>
    <script src={{ asset('js/bracket.js') }}></script>
</body>

</html>
