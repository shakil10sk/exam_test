<!-- start header -->

<div class="container">
    <div class="DHeaderBanner"
         style="background-image:url({{asset('images/bennar.png')}});background-repeat:no-repeat;height:170px; width:100%; padding:10px 10px 10px 60px;margin-left:0px;background-size: 100% 100%;">
        <div class="row">
            <div class="col-sm-12">
                <div class="logo col-sm-6">
                    <a href="{{ route('/') }}">
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/union_profile/'.$unionProfile->main_logo }} "
                             style="position: absolute; max-width:25%;margin-top: 15px;">
                    </a>
                </div>
                <div class="pname col-sm-6">

                    <a href="{{ route('/') }}">

                        <p style="font-weight: bold; color: white;font-family: 'Kalpurush', sans-serif;">

                            {{ $unionProfile->bn_name }}

                        </p>

                    </a>

                </div>
            </div>
        </div>
    </div>

    <div class="DHeaderNav">
        <div class="row">
            <div class="col-sm-12">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li><a href="{{url('/')}}"><i class="fas fa-home"> </i>
                                    </a></li>
                                <li class="dropdown" style="font-family: 'Kalpurush', sans-serif;">
                                    <a href="javascript:void(0)" class="dropdown-toggle"
                                       data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false" style=" font-size:18px;">পৌরসভা
                                        তথ্য<span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('unionInfo') }}" style=" font-size:16px;">পৌরসভার সংক্ষিপ্ত
                                                বিবরন</a></li>
                                        <!-- <li><a href="javascript:void(0)" style=" font-size:16px;">পৌরসভার সাংগঠনিক
                                                কাঠামো</a></li>
                                        <li><a href="javascript:void(0)" style=" font-size:16px;">পৌরসভার মানচিত্র</a>
                                        </li>
                                        <li><a href="javascript:void(0)" style=" font-size:16px;">সম্মানিত মেয়রদের
                                                তালিকা</a></li>
                                        <li><a href="javascript:void(0)" style=" font-size:16px;">পৌরসভার কর্মকর্তা ও
                                                কর্মচারী</a></li> -->
                                        <li><a href="https://comillaboard.portal.gov.bd/" style=" font-size:16px;">শিক্ষা বিষয়ক তথ্য</a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- <li class="dropdown" style="font-family: 'Kalpurush', sans-serif;">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false" style=" font-size:18px;">জরুরী যোগাযোগ<span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu" style="font-family: 'Kalpurush', sans-serif;">
                                        <li><a href="javascript:void(0)" style=" font-size:16px;">মেয়রের প্রোফাইল এবং
                                                সংযোগ</a></li>
                                        <li><a href="javascript:void(0)" style=" font-size:16px;">কাউন্সিলরদের প্রোফাইল
                                                এবং সংযোগ</a></li> -->
                                <!-- <li><a href="javascript:void(0)">প্রধান নির্বাহী কর্মকর্তার প্রোফাইল এবং
                                        সংযোগ</a></li> -->
                                <!-- <li><a href="javascript:void(0)" style=" font-size:16px;">তথ্য পরিষেবা
                                        কেন্দ্র</a></li>
                                <li><a href="javascript:void(0)" style=" font-size:16px;">প্রশাসন বিভাগ</a></li>
                                <li><a href="javascript:void(0)" style=" font-size:16px;">প্রকৌশল বিভাগ</a></li>
                                <li><a href="javascript:void(0)" style=" font-size:16px;">স্বাস্থ্য বিভাগ</a>
                                </li>
                            </ul>
                        </li> -->

                                <li class="dropdown" style="font-family: 'Kalpurush', sans-serif;">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false" style=" font-size:18px;">আবেদন
                                        করুন<span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu" style="font-family: 'Kalpurush', sans-serif;">
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(1)]) }}"
                                               style=" font-size:16px;">নাগরিক
                                                আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(19)]) }}"
                                               style=" font-size:16px;">ট্রেড
                                                লাইসেন্স আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(17)]) }}"
                                               style=" font-size:16px;">ওয়ারিশ
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(90)])
                                                }}" style=" font-size:16px;">প্রিমিসেস লাইসেন্স আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(18)]) }}"
                                               style=" font-size:16px;">পারিবারিক
                                                সনদের আবেদন</a></li>

                                        <!-- <li><a href="#">অন্যান্য</a></li> -->

                                    </ul>
                                </li>

                                <li class="dropdown" style="font-family: 'Kalpurush', sans-serif;">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-haspopup="true" aria-expanded="false" style=" font-size:18px;">অন্যান্য
                                        আবেদন<span
                                            class="caret"></span></a>
                                    <ul style="font-family: 'Kalpurush', sans-serif;"
                                        class="dropdown-menu scrollable-menu" role="menu">
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(9)]) }}"
                                               style=" font-size:16px;">চারিত্রিক
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(3)]) }}"
                                               style=" font-size:16px;">অবিবাহিত
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(20)]) }}"
                                               style=" font-size:16px;">বিবাহিত
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(2)]) }}"
                                               style=" font-size:16px;">মৃত্যু
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(10)]) }}"
                                               style=" font-size:16px;">ভূমিহিন
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(4)]) }}"
                                               style=" font-size:16px;">পুনঃ
                                                বিবাহ না হওয়া সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(14)]) }}"
                                               style=" font-size:16px;">ভোটার
                                                আইডি স্থানান্তর সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(8)]) }}"
                                               style=" font-size:16px;">নদী ভাঙন
                                                সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(15)]) }}"
                                               style=" font-size:16px;">অনাপত্তি
                                                পত্র আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(5)]) }}"
                                               style=" font-size:16px;">একই নামের
                                                প্রত্যয়ন আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(13)]) }}"
                                               style=" font-size:16px;">অনুমতি
                                                পত্রের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(11)]) }}"
                                               style=" font-size:16px;">বার্ষিক
                                                আয়ের প্রত্যয়ন আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(12)]) }}"
                                               style=" font-size:16px;">প্রকৃত
                                                বাকঁ ও শ্রবন প্রতিবন্ধী
                                                আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(6)]) }}"
                                               style=" font-size:16px;">সনাতন
                                                ধর্ম অবলম্বী সনদের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(7)]) }}"
                                               style=" font-size:16px;">প্রত্যয়ন
                                                পত্র আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(94)])
                                                }}" style=" font-size:16px;">রাস্তা খননের অনুমতির আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(91)])
                                                    }}" style=" font-size:16px;">পোষা প্রাণীর লাইসেন্সের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(92)])
                                                    }}" style=" font-size:16px;">নতুন হোল্ডিং আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(93)])
                                                    }}" style=" font-size:16px;">হোল্ডিং নামজারির আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(95)])
                                                }}" style=" font-size:16px;">ইমারত নির্মাণ আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(96)])
                                                    }}" style=" font-size:16px;">ভূমি ব্যবহার ছাড়পত্রের আবেদন</a></li>
                                        <li><a href="{{ route('showApplicationForm', ['id' => encrypt(108)])
                                                    }}" style=" font-size:16px;">আর্থিক অসচ্ছলতার সনদ আবেদন</a></li>
                                    </ul>


                                <li style="font-family: 'Kalpurush', sans-serif;"><a
                                        href="{{ route('application_verify') }}" style="font-size:18px;">যাচাই করুন</a>
                                </li>

                                <!-- <li style="font-family: 'Kalpurush', sans-serif;"><a href="javascript:void(0)"
                                                                                     style="font-size:18px;">সিটিজেন
                                        চার্টার</a></li> -->

                            <!-- <li><a href="javascript:void(0)">এক নজরে</a></li>

                                <li><a href="{{url('/admin/login')}}">লগইন</a></li> -->

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</div>
<!-- end header -->

