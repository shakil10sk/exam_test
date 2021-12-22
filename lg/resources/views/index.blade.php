@extends('layouts.master')
@section('content')
<!-- Slider -->
<section id="featured">
    <!--start slider-->
    <!-- Slider -->
    <div class="container-fluid">
        <div class="col-md-8" style="padding:0px;">
            <div id="main-slider" class="flexslider">
                <ul class="slides wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                    @foreach($slider as $slide)
                    <li>
                        <a href="javascript:void(0)">
                            <div class="slide-overley"></div>
                            <img class="lazy fancybox"
                                data-original="{{ env('ASSET_URL').'/images/'.$slide->photo }}"
                                height="322" alt="slider.jpg" />
                            <p class="flex-caption">{{ $slide->caption }}</p>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>


        <div class="col-md-4" style="padding:0px;">
            <div class="key-specials-persons wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">

                <div class="ourteam" style='padding: 17px 20px;'>

                    @foreach ($employees as $employee)

                    <div class="row each-member" id="employee">
                        <div class="col-md-4">
                            <img src="{{ env('ASSET_URL').'/images/'.$employee->photo}}" class="img-circle" width='100px'
                                alt="...">
                        </div>
                        <div class="col-md-8">
                            <h4 class="name">{{ $employee->name }}</h4>
                            <h5 class="name">{{ ($employee->designation_id == 1) ? "জেলা প্রশাসক" : "উপ-পরিচালক(স্থানীয় সরকার)" }}</h5>
                            <a href="{{ route('employee', ['id' => encrypt($employee->id), 'unionId' => encrypt(0)]) }}" class="btn btn-sm btn-primary">বিস্তারিত</a>

                            {{-- <a href="{{ route('employee', ['id' => encrypt($employee['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}" class="btn btn-sm btn-mores">বিস্তারিত</a> --}}

                        </div>
                    </div>
                    @endforeach
                    

                </div>

            </div>
        </div>

    </div>
    <!-- end slider -->
</section>
<!-- end slider -->

<section id="product">
    <div class="features-section section-padding" id="services">
        <div class="container" style="width:1230px">

            <div class="row">
                <div class="col-md-12">
                    <div class="section-title wow slideInDown text-center" data-wow-duration="1s" data-wow-delay=".2s">
                        <h2>ই-সেবা সমূহ</h2>
                    </div>
                </div>
            </div>
            <div class="section-content text-center">

                <div class="row">

                    <div class="  wow fadeInLeft bgseba" data-wow-duration="2s" data-wow-delay=".5s">
                        <div class="col-md-4">
                            <div class="seba">
                                <ul class="latest-news link-list">
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(1)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> নাগরিক সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(18)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> পারিবারিক সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(9)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> চারিত্রিক সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(3)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> অবিবাহিত সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(20)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> বিবাহিত সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(12)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> প্রকৃত বাকঁ ও শ্রবন প্রতিবন্ধী
                                            আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(4)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> পুনঃ বিবাহ না হওয়া সনদের আবেদন</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="seba">
                                <ul class="latest-news link-list">
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(17)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> ওয়ারিশ সনদের আবেদন</a></li>

                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(14)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> ভোটার আইডি স্থানান্তর</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(8)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> নদী ভাঙনের সনদ</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(15)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> অনাপত্তি পত্র আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(5)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> একই নামের প্রত্যয়ন আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(13)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> অনুমতি পত্রের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(2)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> মৃত্যু সনদের আবেদন</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="seba">
                                <ul class="latest-news link-list">
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(19)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> ট্রেড লাইসেন্স সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(11)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> বার্ষিক আয়ের প্রত্যয়ন আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(10)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> ভূমিহীন সনদের আবেদন</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(6)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> সনাতন ধর্ম অবলম্বী</a></li>
                                    <li><a href="{{ route('showApplicationForm', ['id' => encrypt(7)]) }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> প্রত্যয়ন পত্র</a></li>
                                    <li><a href="{{ route('application_verify') }}" target="_blank" ><i
                                                class="ion-ios-redo"></i> আবেদন ও সনদ যাচাই</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- /.col-md-3 -->
            </div><!-- /.row -->
        </div><!-- /.section-content -->
    </div><!-- /.container -->
    </div><!-- /.features-section -->
</section>


<section class="notice-board-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
    <div class="container extrawidth">
        <div class="row">
            <div class="col-md-7">
                <div class="content-area-boxes">
                    <div class="tottho">
                        <div class="section-title text-left">
                            <h2 class="br2">{{ $unionProfile->bn_name }} তথ্য</h2>
                        </div>
                        <div class="about-content-full">
                            <div class="left-boxes-content">
                                <div class="row">
                                    <div class="col-12">
                                        @php
                                        echo $unionProfile->about;
                                        @endphp
                                        <div class="see-alls">
                                            <a href="{{ route('unionInfo') }}" class="btn btn-see btn-sm">আরো
                                                পড়ুন....</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="content-area-boxes">
                    <div class="tottho">
                        <div class="section-title text-left">
                            <h2 class="br2"><i class="icon ion-document"></i> নোটিশ</h2>
                        </div>
                        <div class="about-content-full">
                            <div class="left-boxes-content">
                                <div class="row">
                                    <ul>
                                        @foreach($notices as $key => $notice)
                                        <a href="{{ route('notice', [ 'id' => encrypt($notice->id)]) }}"
                                            style="color: #0B5661;" onMouseOver="this.style.color='#00F'"
                                            onMouseOut="this.style.color='#0B5661'">
                                            <li style="border-bottom: 1px dashed gray;">
                                                <strong>{{ $notice->title }}</strong><br />
                                                <strong>প্রকাশকাল:
                                                </strong>{{ Converter::en2bn($notice->created_at->format('d-m-Y')) }}ইং
                                            </li>
                                        </a>
                                        @if($key == 4)
                                        @break
                                        @endif
                                        @endforeach
                                    </ul>
                                    <div class="see-alls">
                                        <a href="{{ route('all_notice') }}" class="btn btn-see btn-sm">সকল নোটিশ....</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>


    <div class="section-title wow slideInDown text-center" style="margin-left: 100px;" data-wow-duration="1s"
        data-wow-delay=".2s">
        <h2>উপজেলা সমূহ</h2>
    </div>

    <div class="icon-section section-padding">
        <div class="overlay"></div>
        <div class="container" style="width:110%;">

            <div class="section-content text-center">
                <div class="row" style="margin-left:0px;margin-right:0px;width:120%">

                    <div class="col-md-1 ">
                        <div class="inner-item-md3">

                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-1">
                        <div class="inner-item-md3">
                            <div class="uplogo">
                                <img src="{{ env('ADMIN_ASSET_URL').'/images/logo/union_logo.png'}}" alt="pic" />
                            </div><!-- /.icon -->
                            <h3>নরসিংদী সদর</h3>
                        </div><!-- /.inner-item-md3 -->

                    </div><!-- /.col-md-3 -->

                    <div class="col-md-1">
                        <div class="inner-item-md3">
                            <div class="uplogo">
                                <img src="{{ env('ADMIN_ASSET_URL').'/images/logo/union_logo.png'}}" alt="pic" />
                            </div><!-- /.icon -->
                            <h3>মনোহরদী</h3>
                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-1">
                        <div class="inner-item-md3">
                            <div class="uplogo">
                                <img src="{{ env('ADMIN_ASSET_URL').'/images/logo/union_logo.png'}}" alt="pic" />
                            </div><!-- /.icon -->
                            <h3>বেলাবো </h3>
                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-1">
                        <div class="inner-item-md3">
                            <div class="uplogo">
                                <img src="{{ env('ADMIN_ASSET_URL').'/images/logo/union_logo.png'}}" alt="pic" />
                            </div><!-- /.icon -->
                            <h3>পলাশ </h3>
                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-1 ">
                        <div class="inner-item-md3">
                            <div class="uplogo">
                                <img src="{{ env('ADMIN_ASSET_URL').'/images/logo/union_logo.png'}}" alt="pic" />
                            </div><!-- /.icon -->
                            <h3>রায়পুরা </h3>
                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-1">
                        <div class="inner-item-md3">
                            <div class="uplogo">
                                <img src="{{ env('ADMIN_ASSET_URL').'/images/logo/union_logo.png'}}" alt="pic" />
                            </div><!-- /.icon -->
                            <h3>শিবপুর </h3>
                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->



                    <div class="col-md-1">
                        <div class="inner-item-md3">

                        </div><!-- /.inner-item-md3 -->
                    </div><!-- /.col-md-3 -->

                </div><!-- /.row -->

                <style>
                    .inner-item-md3 h3 {
                        color: #fff;
                        font-size: 19px;
                    }
                </style>

            </div><!-- /.section-content -->
        </div><!-- /.container -->
        <!-- </div> -->
        <!-- /.overlay -->
    </div><!-- /.icon-section -->
</section><!-- /#icon -->
<!-- Icon Section End -->
</section>

@endsection

@section('script')
<script>
    /*Boxer---------------------------------------------------*/
        $(document).ready(function(){
            var wow = new WOW(
                {
                    boxClass:     'wow',
                    animateClass: 'animated',
                    offset:       0,
                    mobile:       true,
                    live:         true,
                    callback:     function(box) {},
                    scrollContainer: null
                }
            );
            wow.init();

            $(function() {
                $("img.lazy").lazyload({
                    threshold : 200,
                    effect : "fadeIn"
                });
            });

            $('.flexslider').flexslider({
                animation: "slide"
            });

            $(".flexnav").flexNav();
        });
</script>
@endsection