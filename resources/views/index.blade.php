@extends('layouts.master')
@section('content')
    <main>
        <div class="container">

            <div class="DScroll">
                <div class="row DMargin0">
                    <div class="col-sm-1" style="font-family: 'Kalpurush', sans-serif; font-size: 20px;">স্বাগতম</div>
                    <div class="col-sm-11">
                        <marquee scrollamount="4" style="font-family: 'Kalpurush', sans-serif; font-size: 16px;">
                            @foreach($latest_notices as $item)
                                <i class="fas fa-play"></i> &nbsp; {{ strip_tags($item->details) }}
                             @endforeach
                        </marquee>
                    </div>
                </div>
            </div>

            <div class="row DMainContain">
                <div class="col-sm-6 col-lg-push-3">
                    <div id="main-slider" class="flexslider">
                        <ul class="slides wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                            @foreach($slider as $slide)
                                <li>
                                    <a href="javascript:void(0)">
                                        <div class="slide-overley"></div>
                                        <img class="lazy fancybox"
                                             data-original="{{ env('ADMIN_ASSET_URL').'/images/slider/'.$slide->photo }}"
                                             height="322" alt="slider.jpg"/>
                                        <p class="flex-caption">{{ $slide->caption }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="border_bottom">
                                <span class="DTitle" style="font-family: 'Kalpurush', sans-serif;"><a
                                        href="#">স্বাগতম</a></span>
                            </div>
                            <h4 style="color:ffffff font-family: 'Kalpurush', sans-serif;">{{ $unionProfile->bn_name }}</h4>
                            <div class="col-12" style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                @php
                                    echo substr("$unionProfile->about",0,1500);
                                @endphp
                                <a href="{{ route('unionInfo') }}" class="btn btn-success btn-sm"
                                   style="background:#00B181">আরো
                                    পড়ুন....</a>

                            </div>
                        </div>
                    </div>

                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="border_bottom">
                                <span class="DTitle" style="font-family: 'Kalpurush', sans-serif;"><a
                                        href="#">সেবাসমূহ</a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(19)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/Trade License.png')}}" alt="tika" title="tika"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">ট্রেড
                                                লাইসেন্স ব্যবস্থাপনা </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="holding_tex.php">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{ asset('icon/holding1.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">হোল্ডিং
                                                ট্যাক্স ব্যবস্থাপনা</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="#">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{ asset('icon/market.png')}}" alt="market" title="market"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">বাজার
                                                ব্যবস্থাপনা </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="#">
                                            <img style="width: 60px;margin-left: 23px;"
                                                 src="{{ asset('icon/water.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">পানি
                                                ব্যবস্থাপনা </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="border_bottom">
                                <h4 class="DTitle2" style="text-align: center; background: #00B181">নাগরিক সেবাসমূহ</h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(1)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('/icon/nagorik.png')}}" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">নাগরিক
                                                আবেদন </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(7)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/pottoyon.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">প্রত্যয়ন
                                                পত্র আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(17)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/owaris.png')}}" alt="market" title="market"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">ওয়ারিশ
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(18)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/family.png')}}" alt="tika" title="tika"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">পারিবারিক
                                                আবেদন </h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="">
                                <span class="" style="font-family: 'Kalpurush', sans-serif;"><a href="#"></a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(90)])}}">
                                            <img style="width: 60px;margin-left: 14px;"
                                                 src="{{asset('icon/premises.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">প্রিমিসেস
                                                লাইসেন্স </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(94)])}}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/roadexcavation.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">রাস্তা খননের
                                                অনুমতির আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(5)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/akenamercertificate.png')}}" alt="tika" title="tika"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">একই নামের
                                                প্রত্যয়ন আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(96)])
                                                    }}">
                                            <img style="width: 60px;margin-left: 15px;"
                                                 src="{{asset('icon/landuse.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">ভূমি
                                                ব্যবহারের আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="">
                                <span class="" style="font-family: 'Kalpurush', sans-serif;"><a href="#"></a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(4)])}}">
                                            <img style="width: 60px;margin-left: 15px;"
                                                 src="{{asset('icon/punno_bibaho.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">পুনঃবিবাহ না
                                                হওয়া আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(93)])}}">
                                            <img style="width: 45px;margin-left: 14px;"
                                                 src="{{asset('icon/holdingnamzari.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">হোল্ডিং
                                                নামজারির আবেদন </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(91)]) }}">
                                            <img style="width: 45px;margin-left: 23px;" src="{{asset('icon/pets.png')}}"
                                                 alt="market" title="market" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">পোষা প্রাণীর
                                                লাইসেন্সের আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(9)])}}">
                                            <img style="width: 60px;margin-left: 15px;"
                                                 src="{{asset('icon/character certificate.png')}}" alt="water"
                                                 title="water" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">চারিত্রিক
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="">
                                <span class="" style="font-family: 'Kalpurush', sans-serif;"><a href="#"></a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(2)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/death.png')}}" alt="tika" title="tika"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">মৃত্যু সনদের
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(3)])}}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/unmarrage.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">অবিবাহিত
                                                আবেদন </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(20)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/bibahito.png')}}" alt="market" title="market"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">বিবাহিত
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(92)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/holdingnew.png')}}" alt="tika" title="tika"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">নতুন হোল্ডিং
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="">
                                <span class="" style="font-family: 'Kalpurush', sans-serif;"><a href="#"></a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(11)])}}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/yearly income.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">বার্ষিক
                                                আয়ের প্রত্যয়ন আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(14)])}}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/votar id.png')}}" alt="holding tax"
                                                 title="holding tax" class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">ভোটার আইডি
                                                স্থানান্তর আবেদন </h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(15)])}}">
                                            <img style="width: 60px;margin-left: 15px;"
                                                 src="{{asset('icon/onapotti.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">অনাপত্তি
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(12)])}}">
                                            <img style="width: 60px;margin-left: 23px;"
                                                 src="{{asset('icon/potibondi.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">প্রকৃত বাকঁ
                                                ও শ্রবন প্রতিবন্ধী
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="">
                                <span class="" style="font-family: 'Kalpurush', sans-serif;"><a href="#"></a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(95)]) }}">
                                            <img style="width: 60px;margin-left: 15px;"
                                                 src="{{asset('icon/bulding.png')}}" alt="market" title="market"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">ইমারত
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(6)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/swastika.png')}}" alt="tika" title="tika"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">সনাতন ধর্ম
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(10)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/landscape.png')}}" alt="market" title="market"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">ভূমিহীন
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(13)]) }}">
                                            <img style="width: 45px;margin-left: 23px;"
                                                 src="{{asset('icon/permission.png')}}" alt="market" title="market"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">অনুমতি
                                                পত্রের আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row DService DMarginTop20">
                        <div class="col-sm-12">
                            <div class="">
                                <span class="" style="font-family: 'Kalpurush', sans-serif;"><a href="#"></a></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="DServiceList">
                                        <a href="{{ route('showApplicationForm', ['id' => encrypt(8)])}}">
                                            <img style="width: 60px;margin-left: 15px;"
                                                 src="{{asset('icon/river.png')}}" alt="water" title="water"
                                                 class="imagesA">
                                            <h5 style="margin-top: 8px;text-align: center;font-size: 16px;">নদী ভাঙন
                                                আবেদন</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div id="medium" class="col-sm-3 col-lg-pull-6 DLeftContain">
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="DTitle2" style="background: #00B181;">আপডেট নোটিশ</h4>
                                <div class="DCategoryList">
                                    <marquee direction="down" height="250" scrollamount="4" onMouseOver="this.stop()"
                                             onMouseOut="this.start()">
                                        @foreach($notices as $notice)
                                            <div class="news-item" style="font-family: 'Kalpurush', sans-serif;">
                                                <a href="{{ route('notice', [ 'id' => encrypt($notice->id)]) }}"
                                                   target="_blank">
                                                    <p>{{ $notice->title }}</p>
                                                    <strong
                                                        style="font-size : 16px">প্রকাশকাল: </strong>{{ Converter::en2bn($notice->created_at->format('d-m-Y')) }}
                                                    ইং
                                                </a>
                                            </div>
                                        @endforeach
                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="counselor.php">
                    </a>
                    <div class="row DMarginTop15">
                        <div class="col-sm-12">
                            <h4 class="DTitle2" style="background: #00B181;">গুরুত্বপূর্ণ লিঙ্ক</h4>
                            <div class="DCategoryList">
                                <div class="list-group" style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                    <a href="http://www.pmo.gov.bd/" target="_blank" class="list-group-item">প্রধানমন্ত্রীর
                                        কার্যালয়</a>
                                    <a href="http://www.bangabhaban.gov.bd/" target="_blank" class="list-group-item">রাষ্ট্রপতির
                                        কার্যালয়</a>
                                    <a href="http://bris.lgd.gov.bd/pub/?pg=verify_br" target="_blank"
                                       class="list-group-item">জন্ম নিবন্ধন যাচাই</a>
                                    <a class="list-group-item" href="http://www.mopa.gov.bd/" target="_blank">জনপ্রশাসন
                                        মন্ত্রণালয়</a>
                                    <a class="list-group-item" href="http://www.bangladesh.gov.bd" target="_blank">বাংলাদেশ
                                        জাতীয় তথ্য বাতায়ন</a>
                                    <a class="list-group-item" href="https://cabinet.gov.bd/" target="_blank">মন্ত্রীপরিষদ
                                        বিভাগ</a>
                                    <a class="list-group-item" href="https://apams.cabinet.gov.bd/" target="_blank">বার্ষিক
                                        কর্মসম্পাদন চুক্তি (এপিএ) - মন্ত্রিপরিষদ বিভাগ</a>
                                    <a class="list-group-item" href="http://pmis.mopa.gov.bd/" target="_blank">কর্মী
                                        পরিচলন তথ্য সিস্টেম</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row DMarginTop15">
                        <div class="col-sm-12">
                            <h4 class="DTitle2" style="background: #00B181;">কেন্দ্রীয় ই-সেবা</h4>
                            <div class="DCategoryList">
                                <div class="list-group">
                                    <a href="http://www.bmet.gov.bd/BMET/onlinaVisaCheckAction" title="Verify Visa"
                                       target="_blank" class="list-group-item">Verify Visa</a>
                                    <a href="http://www.nbrepayment.gov.bd/" title="e-Tax Payment" target="_blank"
                                       class="list-group-item">e-Tax Payment</a>
                                    <a href="https://services.nidw.gov.bd/"
                                       title="Updating national identity card information" target="_blank"
                                       class="list-group-item">National identity card information</a>
                                    <a href="http://bris.lgd.gov.bd/pub/?pg=application_form"
                                       title="Birth and Death Registration" target="_blank" class="list-group-item">Birth
                                        and Death Registration</a>
                                    <a href="http://www.cga.gov.bd/index.php?option=com_wrapper"
                                       title="Online Invoice Verification" target="_blank" class="list-group-item">
                                        Invoice Verification Online</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4 class="DTitle2" style="background: #00B181;">জরুরি হটলাইন<h4>
                                <img alt="জরুরি হটলাইন" src="{{asset('images/Hotline.jpg')}}" style="width:100%;">
                    </div>

                    <div class="row DMarginTop15">
                        <div class="col-sm-12">
                            <h5 class="DTitle2" style="background: #00B181;"> {{ $unionProfile->bn_name }} মোবাইল
                                অ্যাপ</h5>
{{--                            <img alt="ফেনীর মেয়র" src="{{asset('images/fenir_meyor.png')}}"--}}
{{--                                 style="width:100%; margin-top: -15px;">--}}
{{--                            <img src="{{asset('images/fenir mayor.jpg')}}" style="width:100%"></a>--}}
                        </div>
                    </div>


                </div>
                <div id="DRightContain" class="col-sm-3 DRightContain">
                    <div class="row DMarginTop15">
                        <div class="col-sm-12" style="margin-top: -15px;">
                            <img src="{{asset('images/Mujib_sotoborso.jpg')}}" alt="Awareness" title="Awareness"
                                 class="img-responsive">
                        </div>
                    </div>

                    <div class="row DMarginTop15">
                        <div class="col-sm-12">
                            <!-- <a href="Mayor_speech.php"> -->
                            <h4 class="DTitle2" style="background: #00B181;">সম্মানিত মেয়র</h4>
                            @foreach($chairman as $item)
                                <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}">
                                    <div class="DImageList">
                                        <img src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$item['photo'] }}"
                                             class="img-responsive img100"/>

                                        <center
                                            style="font-weight: bold; font-size: 18px;font-family: 'Kalpurush', sans-serif;font-size: 16px;">{{ $item['name'] }}</center>
                                        <center
                                            style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">@if($item['designation_id'] == 1)
                                                মেয়র @elseif($item['designation_id'] == 2) সচিব @endif</center>
                                        <center
                                            style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">{{ $unionProfile->bn_name }}</center>

                                        {{-- <center>--}}
                                        {{-- <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}" class="btn btn-sm btn-mores">বিস্তারিত
                                </a>--}}
                                        {{-- </center>--}}
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="row DMarginTop15">
                        <div class="col-sm-12">

                            <h4 class="DTitle2" style="background: #00B181;">প্যানেল মেয়রবৃন্দ </h4>
                            <div class="DImageList">
                                <div class="row DCounselor">
                                    @foreach($panelmayor as $item)
                                        <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}">
                                            <div class="col-xs-6"
                                                 style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                                @if($item['photo'])
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$item['photo'] }}"
                                                        class="img-responsive img100"/>
                                                @else
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/default/default_male.jpg' }}"
                                                        class="img-responsive img100"/>
                                                @endif
                                                <p style="color:#121212;">{{ $item['name'] }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row DMarginTop15">
                        <div class="col-sm-12">

                            <h4 class="DTitle2" style="background: #00B181;">কাউন্সিলরবৃন্দ</h4>
                            <div class="DImageList">

                                <div class="row DCounselor">
                                    @php $htmlRender = "" @endphp
                                    @foreach($councilors as $key => $item)

                                       @if($key < 4)
                                        <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}">
                                            <div class="col-xs-6"
                                                 style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                                @if($item['photo'])
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$item['photo'] }}"
                                                        class="img-responsive img100"/>
                                                @else
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/default/default_male.jpg' }}"
                                                        class="img-responsive img100"/>
                                                @endif
                                                <p style="color:#121212;">{{ $item['name'] }}</p>
                                            </div>
                                        </a>
                                        @endif
                                    @endforeach
                                    <div class="collapse" id="collapseExample">
                                        <div class="row">
                                        @foreach($councilors as $key => $item)

                                            @if($key >= 4)
                                            <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}">
                                                <div class="col-xs-6"
                                                    style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                                    @if($item['photo'])
                                                        <img
                                                            src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$item['photo'] }}"
                                                            class="img-responsive img100"/>
                                                    @else
                                                        <img
                                                            src="{{ env('ADMIN_ASSET_URL').'/images/default/default_male.jpg' }}"
                                                            class="img-responsive img100"/>
                                                    @endif
                                                    <p style="color:#121212;">{{ $item['name'] }}</p>
                                                </div>
                                            </a>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        @if(count($councilors) > 4 )
                                        <button style="float: right;" class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                        আরো দেখুন..
                                        </button>
                                        @endif
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row DMarginTop15">
                        <div class="col-sm-12">
                            <h4 class="DTitle2" style="background: #00B181;">বিভাগীয় প্রধানগণ</h4>
                            <div class="DImageList">
                                <div class="row DReserveCounselor">
                                    @foreach($headOfDepartment as $item)
                                        <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}">
                                            <div class="col-xs-6"
                                                 style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                                @if($item['photo'])
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$item['photo'] }}"
                                                        class="img-responsive img100"/>
                                                @else
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/default/default_male.jpg' }}"
                                                        class="img-responsive img100"/>
                                                @endif

                                                <p style="color:#121212;">{{ $item['name'] }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row DMarginTop15">
                        <div class="col-sm-12">

                            <h4 class="DTitle2" style="background: #00B181;">অন্যান্য কর্মকর্তাগণ</h4>
                            <div class="DImageList">
                                <div class="row DCounselor">
                                    @foreach($othersEmployee as $item)
                                        <a href="{{ route('employee', ['id' => encrypt($item['id']), 'unionId' => encrypt($unionProfile->union_id)]) }}">
                                            <div class="col-xs-6"
                                                 style="font-family: 'Kalpurush', sans-serif;font-size: 16px;">
                                                @if($item['photo'])
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/employee/'.$item['photo'] }}"
                                                        class="img-responsive img100"/>
                                                @else
                                                    <img
                                                        src="{{ env('ADMIN_ASSET_URL').'/images/default/default_male.jpg' }}"
                                                        class="img-responsive img100"/>
                                                @endif
                                                <p style="color:#121212;">{{ $item['name'] }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row DMarginTop15">
                        <div class="col-sm-12">
                            <h4 class="DTitle2" style="background: #00B181;">করোনা ভাইরাস প্রতিরোধে যোগাযোগ </h4>
                            <a href="https://bangladesh.gov.bd/site/page/91530698-c795-4542-88f2-5da1870bd50c"
                               target="_blank" title=""><img alt="
  করোনা আপডেট  " src="{{asset('images/corona_new.jpg')}}" style="width:100%"></a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        </div>
    </main>
@endsection
@section('script')
    <script>

        var app = @json($councilors);

        console.log(app);

        /*Boxer---------------------------------------------------*/
        $(document).ready(function () {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: true,
                live: true,
                callback: function (box) {
                },
                scrollContainer: null
            });
            wow.init();

            $(function () {
                $("img.lazy").lazyload({
                    threshold: 200,
                    effect: "fadeIn"
                });
            });

            $('.flexslider').flexslider({
                animation: "slide"
            });

            $(".flexnav").flexNav();
        });
    </script>
@endsection
