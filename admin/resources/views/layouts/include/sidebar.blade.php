<style>
    .dropdown-toggle::after {
        content: "\f13a";
        border: 0;
        font-family: "FontAwesome";
        vertical-align: unset;
        width: auto;
        height: auto;
        border: 0 !important;
        color: #fff;
    }

    .dropdown.show > .dropdown-toggle::after {
        content: "\f139";
        color: white;
    }

    .mtext {
        color: black;
    }

    .wtext {
        color: white;
    }

    .sidebar-menu .dropdown-toggle .fa {
        position: absolute;
        left: 20px;
        font-size: 18px;
        color: #fff;
        width: 26px;
        top: 13px;
        text-align: center;
    }

    .sidebar-menu .dropdown-toggle.active, .sidebar-menu .dropdown-toggle.active .fa {
        color: #0099ff;
        background: #7bddb8;
    }

    .sidebar-menu .dropdown-toggle:hover, .sidebar-menu .show > .dropdown-toggle {
        background: #7bddb8;
        color: #0099ff;
    }

    .sidebar-menu .submenu {
        position: relative;
        width: 100%;
        display: none;
        background: #7bddb8;
    }

    .left-side-bar .menu-block {
        height: calc(100vh - 70px);
        /* background: #ffffff; */
        overflow-y: auto;
    }
</style>

<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </a>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ route('home') }}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-home"></span><span class="wtext">ড্যাশবোর্ড</span>
                    </a>
                </li>

                @role('super-admin')
                <li>
                    <a href="{{ route('union_list') }}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-list"></span><span class="wtext">পৌরসভা সমূহের তালিকা</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('bd_location_list') }}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-map"></span><span class="wtext">লোকেশন যুক্ত করুন</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('fiscal_year_list') }}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-dollar"></span><span class="wtext">অর্থবছর</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('designation') }}" class="dropdown-toggle no-arrow">
                        <span class="fa fa-dollar"></span><span class="wtext">পদবী</span>
                    </a>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="fa fa-support"></span><span class="wtext">সাপোর্ট</span>
                    </a>
                    <ul class="submenu">

                        <li class="dropdown">
                            <a href="{{ route('trade_support') }}" class="dropdown-toggle no-arrow">
                                <i class="fa fa-certificate" aria-hidden="true"></i><span
                                    class="mtext">ট্রেড লাইসেন্স</span>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a href="{{ route('other_support') }}" class="dropdown-toggle no-arrow">
                                <i class="fa fa-list" aria-hidden="true"></i><span class="wtext">অন্যান্য</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="icon-copy fa fa-list" aria-hidden="true"></i><span class="wtext">রোল সেটআপ</span>
                    </a>
                    <ul class="submenu child">
                        <li><a href="{{ route('role.list') }}">রোল লিস্ট</a></li>
                        <li><a href="{{ route('role.assigned_role') }}">এসাইন রোল</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle">
                        <i class="icon-copy fa fa-list" aria-hidden="true"></i><span class="wtext">সমন্বয়</span>
                    </a>
                    <ul class="submenu child">
                        <li><a href="{{ route('sync.table_structure') }}">সমন্বয় টেবিল গঠন</a></li>
                        <li><a href="{{ route('sync.web_data') }}">সমন্বয় ওয়েব তথ্য</a></li>
                        <li><a href="{{ route('sync.central') }}">সমন্বয় কেন্দ্রীয় তথ্য</a></li>
                        <li><a href="{{ route('sync.central_regular') }}">সমন্বয় কেন্দ্রীয় সেবা</a></li>
                    </ul>
                </li>

                @endrole

                @can('nagorik')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-user"></span><span class="wtext">নাগরিক ব্যবস্থাপনা</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('nagorik_application') }}">আবেদন করুন</a></li>
                            @can('application')
                                <li><a href="{{ route('nagorik_applicant_list') }}"> আবেদনকারিগন</a></li>
                            @endcan
                            @can('certificate')
                                <li><a href="{{ route('certificate_list') }}">সনদ গ্রহন কারিগণ</a></li>
                            @endcan
                            @can('registers')
                                <li><a href="{{ route('nagorik_register_show') }}">রেজিস্টার সমূহ</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('others-application')
                    <li>
                        <a href="{{ route('nagorik_list') }}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-line-chart"></span>
                            <span class="wtext">সকল নাগরিক তালিকা</span>
                        </a>
                    </li>
                @endcan

                @can('trade-license')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-certificate"></span><span class="wtext">ট্রেড লাইসেন্স ব্যবস্থাপনা</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('trade_application') }}">আবেদন করুন</a></li>
                            @can('application')
                                <li><a href="{{ route('trade_applicant_list') }}"> আবেদনকারিগন</a></li>
                            @endcan

                            <li>
                                <a href="{{ route('trade_bill_collection') }}">বিল কালেকশন</a>
                            </li>

                            <li>
                                <a href="{{ route('trade_due_bill') }}">বকেয়া বিল এন্ট্রি</a>
                            </li>

                            @can('certificate')
                                <li><a href="{{ route('trade_certificate_list') }}">সনদ গ্রহন কারিগণ</a></li>
                            @endcan

                            <li>
                                <a href="{{ route('trade_bill_list') }}">বিলের তালিকা</a>
                            </li>

                            {{-- @can('previous_fiscal_year_certificate') --}}
                            {{-- <li><a href="{{ route('previous_certificate_list') }}">অর্থবছর অনুযায়ী সনদ সমূহ</a></li> --}}
                            {{-- @endcan --}}

                            {{-- @can('previous_fiscal_year_certificate') --}}
                            <li><a href="{{ route('expire_certificate_list') }}">মেয়াদ উত্তীর্ন ট্রেড লাইসেন্স</a></li>
                            {{-- @endcan --}}

                           <li class="dropdown">
                               <a href="javascript:void(0);" class="dropdown-toggle">
                                   <i class="icon-copy fa fa-sticky-note" aria-hidden="true"></i>
                                   <span class="wtext">রির্পোট</span>
                               </a>

                               <ul class="submenu child">
                                   <li>
                                       <a href="{{ route('trade_register') }}">
                                           <span class="mtext">রেজিষ্টার</span>
                                       </a>
                                   </li>
                                   <li>
                                        <a href="{{ route('trade_dabi_aday_register') }}">
                                            <span class="mtext">দাবী আদায় রিপোর্ট</span>
                                        </a>
                                    </li>

                                   <li>
                                       <a href="{{ route('fiscal_year_wise_report') }}">
                                           <span class="mtext">অর্থ বছর অনুযায়ী</span>
                                       </a>
                                   </li>

                                   <li>
                                       <a href="{{ route('business_type_wise_report') }}">
                                           <span class="mtext">ব্যবসায়ের ধরণ অনুযায়ী</span>
                                       </a>
                                   </li>

                                   <li>
                                       <a href="{{ route('road_wise_report') }}">
                                           <span class="mtext">রাস্তা অনুযায়ী</span>
                                       </a>
                                   </li>

                                   <li>
                                       <a href="{{ route('fee_wise_report')  }}">
                                           <span class="mtext">ফি অনুযায়ী</span>
                                       </a>
                                   </li>

                                   <li>
                                       <a href="{{ route('new_license_report')  }}">
                                           <span class="mtext">নতুন ট্রেড লাইসেন্স</span>
                                       </a>
                                   </li>

                                   <li>
                                       <a href="{{ route('renew_license_report')  }}">
                                           <span class="mtext">নবায়ন ট্রেড লাইসেন্স</span>
                                       </a>
                                   </li>

                                   <li>
                                       <a href="{{ route('due_license_report')  }}">
                                           <span class="mtext">বকেয়া ট্রেড লাইসেন্স</span>
                                       </a>
                                   </li>

                               </ul>
                           </li>

                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle">
                                    <i class="icon-copy fa fa-cogs" aria-hidden="true"></i>
                                    <span class="wtext">সেটিংস</span>
                                </a>

                                <ul class="submenu child">
                                    <li>
                                        <a href="{{ route('trade.settings') }}">
                                            <span class="mtext">সাধারণ সেটিংস</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('trade.settings','signboard') }}">
                                            <span class="mtext">সাইনবোর্ড সেটিংস</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('business_type.list') }}">
                                            <span class="mtext">বিজনেস টাইপ</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('business.fee.settings')  }}">
                                            <span class="mtext">বিজনেস টাইপ ফি সেটিংস</span>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            {{-- @endcan --}}

                        </ul>
                    </li>
                @endcan



                @can('warish')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-users"></span><span class="wtext">ওয়ারিশ ব্যবস্থাপনা</span>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="{{ route('warish_application') }}">আবেদন করুন</a>
                            </li>

                            @can('application')
                                <li>
                                    <a href="{{ route('warish_applicant_list') }}"> আবেদনকারিগন</a>
                                </li>
                            @endcan

                            @can('certificate')
                                <li>
                                    <a href="{{ route('warish_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                </li>
                            @endcan

                            @can('registers')
                                <li>
                                    <a href="{{ route('warish_register_show') }}">রেজিস্টার সমূহ</a>
                                </li>
                            @endcan

                            {{-- @can('expire_warish') --}}
                                <li>
                                    <a href="{{ route('warish_expire_certificate_list') }}">মেয়াদ উত্তীর্ন সনদ</a>
                                </li>
                            {{-- @endcan --}}


                        </ul>
                    </li>
                @endcan

                @can('paribarik')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-male"></span><span class="wtext">পারিবারিক ব্যবস্থাপনা</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('family_application') }}">আবেদন করুন</a></li>
                            @can('application')
                                <li><a href="{{ route('family_applicant_list') }}"> আবেদনকারিগন</a></li>
                            @endcan
                            @can('certificate')
                                <li><a href="{{ route('family_certificate_list') }}">সনদ গ্রহন কারিগণ</a></li>
                            @endcan
                            @can('registers')
                                <li><a href="{{ route('family_register_show') }}">রেজিস্টার সমূহ</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

            <!-- =========================  পৌরসভা ===============   !-->
                @can('premises')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-certificate"></span><span class="wtext">প্রিমিসেস ব্যবস্থাপনা</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('premises_application') }}">আবেদন করুন</a></li>
                            @can('application')
                                <li><a href="{{ route('premises_applicant_list') }}"> আবেদনকারিগন</a></li>
                            @endcan
                            @can('certificate')
                                <li><a href="{{ route('premises_certificate_list')  }}">সনদ গ্রহন কারিগণ</a></li>
                            @endcan

                            {{-- @can('previous_fiscal_year_certificate') --}}
                            <li><a href="{{ route('premises_previous_certificate_list')  }}">অর্থবছর অনুযায়ী সনদ
                                    সমূহ</a></li>
                            {{-- @endcan --}}

                            {{-- @can('previous_fiscal_year_certificate') --}}
                            <li><a href="{{ route('premises_expire_certificate_list') }}">মেয়াদ উত্তীর্ন প্রিমিসেস
                                    লাইসেন্স</a></li>
                            {{-- @endcan --}}
                            @can('registers')
                                <li><a href="{{ route('premises_register_show') }}">রেজিস্টার সমূহ</a></li>
                            @endcan
                        </ul>
                    </li>

                @endcan
            <!-- =========================  পৌরসভা ===============   !-->


                @can('others-application')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-list"></span><span class="wtext">অন্যান্য সনদ</span>
                        </a>
                        <ul class="submenu">

                            @can('charittik')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">চারিত্রিক সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('character_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('character_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('character_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('character_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('mirttu')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">মৃত্যু সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('death_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('death_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('death_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan

                                        @can('registers')
                                            <li><a href="{{ route('death_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('obibahito')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">অবিবাহিত সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('obibahito_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('obibahito_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('obibahito_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('obibahito_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('bibahito')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">বিবাহিত সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('bibahito_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('bibahito_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('bibahito_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('bibahito_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('punobibaho')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span
                                            class="mtext" style="color: black;">পুনঃ বিবাহ না হওয়া</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('punobibaho_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('punobibaho_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('punobibaho_certificate_list') }}">সনদ গ্রহন
                                                    কারিগণ</a></li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('punobibaho_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('sonaton')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span
                                            class="mtext" style="color: black;">সনাতন ধর্ম অবলম্বি</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('sonaton_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('sonaton_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('sonaton_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('sonaton_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('prottan')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">প্রত্যয়ন</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('prottyon_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('prottyon_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('prottyon_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('prottyon_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('vumihin')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">ভূমিহীন সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('vumihin_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('vumihin_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('vumihin_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('vumihin_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('protibondi')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">প্রকৃত বাকঁ ও শ্রবন
                                    প্রতিবন্ধী</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('protibondi_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('protibondi_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('protibondi_certificate_list') }}">সনদ গ্রহন
                                                    কারিগণ</a></li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('protibondi_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('ekoinam')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span
                                            class="mtext" style="color: black;">একই নামের প্রত্যয়ন</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('ekoinam_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('ekoinam_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('ekoinam_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('ekoinam_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                            @can('barshikay')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span
                                            class="mtext" style="color: black;">বার্ষিক আয়ের সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('yearlyincome_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('yearlyincome_applicant_list') }}">আবেদনকারীগন</a>
                                            </li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('yearlyincome_certificate_list') }}">সনদ গ্রহন
                                                    কারিগণ</a></li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('yearlyincome_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('onumoti')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">অনুমতি পত্র</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('onumoti_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('onumoti_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('onumoti_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('onumoti_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>

                                </li>
                            @endcan

                            @can('onapotti')
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle">
                                    <span class="fa fa-file-text-o"></span><span class="mtext" style="color: black;">অনাপত্তি পত্র</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="{{ route('onapotti.application') }}">আবেদন করুন</a></li>
                                    {{-- @can('application') --}}
                                    <li><a href="{{ route('onapotti_applicant_list') }}">আবেদনকারীগন</a></li>
                                    {{-- @endcan --}}
                                    {{-- @can('certificate') --}}
                                    <li><a href="{{ route('onapotti_certificate_list') }}">সনদ গ্রহন কারিগণ</a></li>
                                    {{-- @endcan --}}
                                    @can('registers')
                                            <li><a href="{{ route('onapotti_register_show') }}">রেজিস্টার সমূহ</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan

                            @can('nodibanga')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span class="mtext"
                                                                                     style="color: black;">নদী ভাঙনের সনদ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('nodibanga_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('nodibanga_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('nodibanga_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('nodivanga_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan

                                    </ul>
                                </li>
                            @endcan

                            @can('voterid')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <span class="fa fa-file-text-o"></span><span
                                            class="mtext" style="color: black;">ভোটার আইডি স্থানান্তর</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('voter_application') }}">আবেদন করুন</a></li>
                                        @can('application')
                                            <li><a href="{{ route('voter_applicant_list') }}">আবেদনকারীগন</a></li>
                                        @endcan
                                        @can('certificate')
                                            <li><a href="{{ route('voter_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                                            </li>
                                        @endcan
                                        @can('registers')
                                            <li><a href="{{ route('voter_register_show') }}">রেজিস্টার সমূহ</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan

            <!-- =========================  পৌরসভা ===============   !-->
                {{-- @can('website-management') --}}


                   <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-street-view"></span><span class="wtext">রাস্তা খনন ব্যবস্থাপনা </span>
                        </a>

                        <ul class="submenu child">
                            <li>
                                <a href="{{ route('road_application') }}">আবেদন করুন</a>
                            </li>

                            @can('application')
                            <li><a href="{{ route('road_applicant_list') }}">আবেদনকারীগন</a></li>
                            @endcan

                            @can('certificate')
                            <li><a href="{{ route('road_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                            </li>
                            @endcan
                            @can('registers')
                                <li><a href="{{ route('road_register_show') }}">রেজিস্টার সমূহ</a></li>
                            @endcan

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-street-view"></span><span
                                class="wtext">ইমারত নির্মাণ ব্যবস্থাপনা  </span>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('emarot_application')  }}">আবেদন করুন</a></li>
                            @can('application')
                                <li><a href="{{ route('emarat_applicant_list') }}"> আবেদনকারিগন</a></li>
                            @endcan
                            @can('certificate')
                                <li><a href="{{ route('emarot_certificate_list') }}">সনদ গ্রহন কারিগণ</a></li>
                            @endcan
                            @can('registers')
                                <li><a href="{{ route('emarot_register_show') }}">রেজিস্টার সমূহ</a></li>
                            @endcan

                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-archive"></span><span class="wtext">ভূমি ব্যবহার ব্যবস্থাপনা </span>
                        </a>

                        <ul class="submenu">
                            <li>
                                <a href="{{ route('land_use_application') }}">আবেদন করুন</a>
                            </li>

                            <li>
                                <a href="{{ route('land_use_application_list') }}">আবেদনকারিগন</a>
                            </li>

                            <li>
                                <a href="{{ route('land_use_certificate_list') }}">সনদ গ্রহন কারিগণ</a>
                            </li>
                            @can('registers')
                                <li><a href="{{ route('vumihin_register_show') }}">রেজিস্টার সমূহ</a></li>
                            @endcan
                        </ul>
                    </li>

                   <li class="dropdown">
                       <a href="javascript:void(0);" class="dropdown-toggle">
                           <span class="fa fa-home"></span><span class="wtext">  নতুন হোল্ডিং ব্যবস্থাপনা </span>
                       </a>
                       <ul class="submenu">
                           <li><a href="{{ route('newholding_application')  }}">আবেদন করুন</a></li>
                           @can('application')
                               <li><a href="{{ route('newholding_applicant_list')  }}"> আবেদনকারিগন</a></li>
                           @endcan
                           @can('certificate')
                               <li><a href="{{ route('holdingnamjari_certificate_list')  }}">সনদ গ্রহন কারিগণ</a></li>
                           @endcan

                       </ul>
                   </li>

{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-home"></span><span class="wtext">নামজারী হোল্ডিং ব্যবস্থাপনা</span>--}}
{{--                        </a>--}}
{{--                        <ul class="submenu">--}}
{{--                            <li><a href="{{ route('holdingnamjari')  }}">আবেদন করুন</a></li>--}}
{{--                            @can('application')--}}
{{--                                <li><a href="{{ route('holdingnamjari_applicant_list')  }}"> আবেদনকারিগন</a></li>--}}
{{--                            @endcan--}}
{{--                            @can('certificate')--}}
{{--                                <li><a href="{{ route('holdingnamjari_certificate_list')  }}">সনদ গ্রহন কারিগণ</a></li>--}}
{{--                            @endcan--}}

{{--                        </ul>--}}
{{--                    </li>--}}

                    {{-- @can('animalid') --}}
{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-file-text-o"></span>--}}
{{--                            <span class="wtext">পোষা প্রাণী</span>--}}
{{--                        </a>--}}

{{--                        <ul class="submenu child">--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('animal_application') }}">আবেদন করুন</a>--}}
{{--                            </li>--}}

{{--                            --}}{{-- @can('application') --}}
{{--                            <li><a href="{{ route('animal_applicant_list') }}">আবেদনকারীগন</a></li>--}}
{{--                            --}}{{-- @endcan --}}

{{--                            --}}{{-- @can('certificate') --}}
{{--                            <li><a href="{{ route('animal_certificate_list') }}">সনদ গ্রহন কারিগণ</a>--}}
{{--                            </li>--}}
{{--                            --}}{{-- @endcan --}}

{{--                        </ul>--}}
{{--                    </li>--}}
                {{-- @endcan --}}
            <!-- =========================  পৌরসভা ===============   !-->
                {{-- @endcan --}}



                @can('website-management')
{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-sticky-note"></span><span class="wtext">টিকা ব্যবস্থাপনা</span>--}}
{{--                        </a>--}}
{{--                        <ul class="submenu">--}}
{{--                            <li><a href="javascript:void(0)">টিকার তথ্য</a></li>--}}
{{--                            <li><a href="javascript:void(0)"> শিশুর তথ্য</a></li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}

{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-car"></span><span class="wtext">গাড়ীর ব্যবস্থাপনা</span>--}}
{{--                        </a>--}}
{{--                        <ul class="submenu">--}}
{{--                            <li><a href="javascript:void(0)">গাড়ীর তথ্য</a></li>--}}
{{--                            @can('application')--}}
{{--                                <li><a href="javascript:void(0)"> যন্ত্রপাতির তথ্য</a></li>--}}
{{--                            @endcan--}}
{{--                            @can('certificate')--}}
{{--                                <li><a href="javascript:void(0)">ব্যয় ভাউচার</a></li>--}}
{{--                            @endcan--}}

{{--                        </ul>--}}
{{--                    </li>--}}

                    {{-- @can('animalid') --}}
                    {{-- @endcan --}}

                    {{-- @can('animalid') --}}

                @endcan

{{--                <li class="dropdown">--}}
{{--                    <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                        <span class="fa fa-calculator"></span><span class="wtext">হোল্ডিং ট্যাক্স ব্যবস্থাপনা</span>--}}
{{--                    </a>--}}
{{--                    <ul class="submenu">--}}
{{--                        <li>--}}
{{--                            <a href="{{route('holding.tax.assessment.create')}}">এসেসমেন্ট</a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="{{route('holding.tax.assessment')}}">তালিকা</a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="{{route('holding.assessment.bill.generate')}}">বিল জেনারেট</a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="{{route('holding.tax.bill.list')}}">বিলের তালিকা</a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a href="{{route('holding.tax.bill.collection')}}">ট্যাক্স কালেকশন</a>--}}
{{--                        </li>--}}

{{--                        <li class="dropdown">--}}
{{--                            <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                <span class="fa fa-file-text"></span><span class="wtext">রিপোর্ট</span>--}}
{{--                            </a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="{{route('holding.tax.report.cash')}}">ক্যাশ রিপোর্ট</a></li>--}}

{{--                                <li><a href="{{route('holding.tax.report.bank')}}">ব্যাংক রিপোর্ট</a></li>--}}

{{--                                <li><a href="{{route('holding.tax.report.others')}}">অন্যান্য রিপোর্ট</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                        <li class="dropdown">--}}
{{--                            <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                <span class="fa fa-gear"></span><span class="wtext">সেটিংস</span>--}}
{{--                            </a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="{{route('holding.settings.ward')}}">ওয়ার্ড</a></li>--}}

{{--                                <li><a href="{{route('holding.settings.moholla')}}">মহল্লা</a></li>--}}

{{--                                <li><a href="{{route('holding.settings.block')}}">ব্লক</a></li>--}}

{{--                                <li><a href="{{route('holding.settings.property_type')}}">ভবনের ধরন</a></li>--}}

{{--                                <li><a href="{{route('holding.tax.area.rate')}}">ট্যাক্স রেট</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </li>--}}

                @can('bazar')
{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-building-o"></span>--}}
{{--                            <span class="wtext">বাজার ব্যবস্থাপনা</span>--}}
{{--                        </a>--}}

{{--                        <ul class="submenu child">--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('shop_bill_generate') }}">--}}
{{--                                    বিল জেনারেট--}}
{{--                                </a>--}}
{{--                            </li>--}}

{{--                            <li>--}}
{{--                                <a href="{{ route('shop_bill_collection') }}">বিল কালেকশন</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('invoice_list') }}">ইনভয়েস লিস্ট</a>--}}
{{--                            </li>--}}

{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                    <span class="fa fa-window-restore"></span>--}}
{{--                                    <span class="mtext">রিপোর্ট</span>--}}
{{--                                </a>--}}

{{--                                <ul class="submenu child">--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ route('monthly.bill.collection.report') }}">মাসিক বিল--}}
{{--                                            কালেকশন</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('shop.list.report') }}">দোকানের তালিকা</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('shop.owner.list.report') }}">দোকান মালিকদের তালিকা</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}


{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                    <span class="fa fa-cogs"></span>--}}
{{--                                    <span class="mtext">সেটিংস</span>--}}
{{--                                </a>--}}

{{--                                <ul class="submenu child">--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ route('market.list') }}">মার্কেট তালিকা</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('shop.list') }}">দোকানের তালিকা</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('shop.owner.list') }}">দোকান ভাড়া</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('shop.owner.change') }}">মালিকানা পরিবর্তন</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('shop.owner.expirelist') }}">মেয়াদ উত্তীর্ন মালিকানা</a>--}}
{{--                                    </li>--}}

{{--                                    <li class="dropdown">--}}
{{--                                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                            <span class="fa fa-commenting-o"></span>--}}
{{--                                            <span class="mtext">এসএমএস</span>--}}
{{--                                        </a>--}}

{{--                                        <ul class="submenu child">--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('shop_bill_generate_sms') }}">বিল জেনারেট</a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('shop_due_rent_sms') }}">৩ মাস বকেয়া</a>--}}
{{--                                            </li>--}}

{{--                                        </ul>--}}
{{--                                    </li>--}}

{{--                                </ul>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
                @endcan

                @can('association')
{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-home"></span>--}}
{{--                            <span class="wtext">সমিতি ব্যবস্থাপনা</span>--}}
{{--                        </a>--}}

{{--                        <ul class="submenu child">--}}

{{--                            <li>--}}
{{--                                <a href="{{ route('association_member_bill_collection') }}">বিল কালেকশন</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="{{ route('association_invoice_list') }}">ইনভয়েস লিস্ট</a>--}}
{{--                            </li>--}}
{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                    <span class="fa fa-window-restore"></span>--}}
{{--                                    <span class="mtext">আয় ও ব্যয়</span>--}}
{{--                                </a>--}}

{{--                                <ul class="submenu child">--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ route('all_member_collection_report') }}" target="_blank" >যোগ--}}
{{--                                            করুন</a>--}}
{{--                                    </li>--}}

{{--                                    <li>--}}
{{--                                        <a href="{{ route('association.income-expense.khat') }}">খাত</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                    <span class="fa fa-window-restore"></span>--}}
{{--                                    <span class="mtext">রিপোর্ট</span>--}}
{{--                                </a>--}}

{{--                                <ul class="submenu child">--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ route('all_member_collection_report') }}" target="_blank" >সকল সদস্যর--}}
{{--                                            হিসাব</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}


{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                    <span class="fa fa-cogs"></span>--}}
{{--                                    <span class="mtext">সেটিংস</span>--}}
{{--                                </a>--}}

{{--                                <ul class="submenu child">--}}
{{--                                    <li class="dropdown">--}}
{{--                                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                                            <span class="fa fa-users"></span>--}}
{{--                                            <span class="mtext">সদস্য</span>--}}
{{--                                        </a>--}}

{{--                                        <ul class="submenu child">--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('association_member_add') }}">সদস্য যোগ করুন</a>--}}
{{--                                            </li>--}}
{{--                                            <li>--}}
{{--                                                <a href="{{ route('association_member_list') }}">সদস্য তালিকা</a>--}}
{{--                                            </li>--}}

{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
                    {{-- @endcan --}}
                @endcan

            <!-- =========================  পৌরসভা ===============   !-->


                @can('website-management')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="fa fa-desktop"></span><span class="wtext">ওয়েবসাইট ম্যানেজমেন্ট</span>
                        </a>
                        <ul class="submenu">
                            @can('employee-list')
                                <li class="dropdown">
                                    <a href="{{ route('all_members') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-user-circle-o" aria-hidden="true"></i><span
                                            class="mtext" style="color: black;">কর্মকর্তা-কর্মচারী</span>
                                    </a>
                                </li>
                            @endcan

                            @can('notice-list')
                                <li class="dropdown">
                                    <a href="{{ route('all_up_notice') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-file" aria-hidden="true"></i><span class="mtext"
                                                                                                     style="color: black;">
                                    নোটিশ</span>
                                    </a>
                                </li>
                            @endcan

                            @can('slider-list')
                                <li class="dropdown">
                                    <a href="{{ route('slider') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-image" aria-hidden="true"></i><span class="mtext"
                                                                                                      style="color: black;">
                                    স্লাইডার</span>
                                    </a>
                                </li>
                            @endcan

                            @can('vata-list')
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle">
                                        <i class="icon-copy fa fa-id-card-o" aria-hidden="true"></i><span class="mtext"
                                                                                                          style="color: black;">
                                    ভাতার তালিকা</span>
                                    </a>
                                    <ul class="submenu">
                                        @can('add-vata')
                                            <li class="dropdown">
                                                <a href="{{ route('add-allowance') }}" class="dropdown-toggle no-arrow">
                                                    <i class="icon-copy fa fa-plus" aria-hidden="true"></i><span
                                                        class="mtext">অ্যাড ভাতার তালিকা</span>
                                                </a>
                                            </li>
                                        @endcan

                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 1]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-hand-rock-o" aria-hidden="true"></i><span
                                                    class="mtext">মুক্তিযোদ্ধাদের তালিকা</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 2]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-wheelchair" aria-hidden="true"></i><span
                                                    class="mtext">দুস্থ ও হত দরিদ্রদের তালিকা</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 3]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-blind" aria-hidden="true"></i><span
                                                    class="mtext">বয়স্ক ভাতা প্রাপ্তদের তালিকা</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 4]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-user-md" aria-hidden="true"></i><span
                                                    class="mtext">মাতৃত্যকালিন ভাতার তালিকা</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 5]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-signing" aria-hidden="true"></i><span
                                                    class="mtext">বিধবা ভাতার তালিকা</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 6]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-wheelchair-alt" aria-hidden="true"></i><span
                                                    class="mtext">প্রতিবন্ধী ভাতার তালিকা</span>
                                            </a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="{{ route('show-allowance', ['type' => 7]) }}"
                                               class="dropdown-toggle no-arrow">
                                                <i class="icon-copy fa fa-users" aria-hidden="true"></i><span
                                                    class="mtext">ভি
                                            জি ডি ভাতার তালিকা</span>
                                            </a>
                                        </li>


                                    </ul>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan

                @can('accounts')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <i class="icon-copy fa fa-dollar" aria-hidden="true"></i><span class="wtext">একাউন্টস</span>
                        </a>
                        <ul class="submenu">
                            @can('registers')
                                <li class="dropdown">
                                    <a href="{{ route('registers') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-file-text" aria-hidden="true"></i><span
                                            class="mtext">রেজিস্টার সমূহ</span>
                                    </a>
                                </li>
                            @endcan

                            @can('tax')
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle">
                                        <i class="icon-copy fa fa-money" aria-hidden="true"></i><span class="mtext">কর
                                    আদায়</span>
                                    </a>
                                    <ul class="submenu child">
                                        @can('income-tax')
                                            <li><a href="{{ route('collect_pesha_kor') }}">পেশা কর</a></li>
                                        @endcan
                                        @can('home-tax')
                                            <li><a href="{{ route('assesment_list') }}">বসত ভিটা</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan


                            @can('everyday-reports')
                                <li class="dropdown">
                                    <a href="{{ route('daily_reports') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-file-excel-o" aria-hidden="true"></i><span
                                            class="mtext">দৈনিক
                                    রিপোর্ট
                                    সমূহ</span>
                                    </a>
                                </li>
                            @endcan

                            <li class="dropdown">
                                <a href="{{ route('daily_deposit') }}" class="dropdown-toggle no-arrow">
                                    <i class="icon-copy fa fa-file-text" aria-hidden="true"></i><span
                                        class="mtext">দৈনিক জমা</span>
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="{{ route('daily_expense') }}" class="dropdown-toggle no-arrow">
                                    <i class="icon-copy fa fa-file-text" aria-hidden="true"></i><span
                                        class="mtext">দৈনিক খরচ</span>
                                </a>
                            </li>


                            {{-- @can('registers') --}}
                            <li class="dropdown">
                                <a href="{{ route('cashbooks') }}" class="dropdown-toggle no-arrow">
                                    <i class="icon-copy fa fa-file-text" aria-hidden="true"></i><span
                                        class="mtext">ক্যাশবুক</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="{{ route('rosid_list') }}" class="dropdown-toggle no-arrow">
                                    <i class="icon-copy fa fa-file-text" aria-hidden="true"></i><span
                                        class="mtext">রশিদ সমূহ</span>
                                </a>
                            </li>
                            {{-- @endcan --}}

                            @can('accounts-setting')
                                <li class="dropdown">
                                    <a href="{{ route('fund') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-file-text" aria-hidden="true"></i><span
                                            class="mtext">ফান্ড যোগ করুন</span>
                                    </a>
                                </li>

                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle">
                                        <i class="icon-copy fa fa-gear" aria-hidden="true"></i><span class="mtext">সেটিংস</span>
                                    </a>
                                    <ul class="submenu child">
                                        @can('add-accounts')
                                            <li><a href="{{ route('account_list') }}">একাউন্ট যোগ করুন</a></li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan

                @can('all-reports')
{{--                    <li class="dropdown">--}}
{{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
{{--                            <span class="fa fa-file-text-o"></span><span class="wtext">ডিসি অফিস রিপোর্ট</span>--}}
{{--                        </a>--}}
{{--                        <ul class="submenu">--}}

{{--                            <li class="dropdown">--}}
{{--                                <a href="{{ route('projects') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span--}}
{{--                                        class="mtext">প্রকল্প সমূহ</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="dropdown">--}}
{{--                                <a href="{{ route('reports', '1') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span--}}
{{--                                        class="mtext">কর ও রেট</span>--}}
{{--                                </a>--}}
{{--                                <a href="{{ route('reports', '2') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">গ্রাম আদালত (মাসিক)</span>--}}
{{--                                </a>--}}
{{--                                <a href="{{ route('reports', '3') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">জন্ম নিবন্ধন (মাসিক/ ত্রৈমাসিক)</span>--}}
{{--                                </a>--}}
{{--                                <a href="{{ route('reports', '4') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">ষান্মাসিক প্রতিবেদন</span>--}}
{{--                                </a>--}}
{{--                                <a href="{{ route('reports', '5') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">এসওই (ত্রৈমাসিক)</span>--}}
{{--                                </a>--}}
{{--                                <a href="{{ route('reports', '6') }}" class="dropdown-toggle no-arrow">--}}
{{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">বার্ষিক আর্থিক বিবরণী</span>--}}
{{--                                </a>--}}

{{--                            </li>--}}
{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0)" class="dropdown-toggle">--}}
{{--                                    <i class="icon-copy fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">বাজেট ও পরিকল্পনা</span>--}}
{{--                                </a>--}}
{{--                                <ul class="submenu child">--}}
{{--                                    <li><a href="{{ route('reports', '7') }}">বার্ষিক বাজেট</a></li>--}}
{{--                                    <li><a href="{{ route('reports', '8') }}">বার্ষিক পরিকল্পনা</a></li>--}}
{{--                                    <li><a href="{{ route('reports', '9') }}">ত্রৈবার্ষিক পরিকল্পনা</a></li>--}}
{{--                                    <li><a href="{{ route('reports', '10') }}">পঞ্চবার্ষিক পরিকল্পনা</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0)" class="dropdown-toggle">--}}
{{--                                    <i class="icon-copy fa fa-list" aria-hidden="true"></i><span class="mtext">রেজিষ্টারের বিবরণ</span>--}}
{{--                                </a>--}}
{{--                                <ul class="submenu child">--}}
{{--                                    <li><a href="{{ route('letters', '1') }}">পত্র জারি রেজিষ্টার</a></li>--}}
{{--                                    <li><a href="{{ route('letters', '2') }}">পত্র প্রাপ্তি রেজিষ্টার</a></li>--}}
{{--                                    <li><a href="{{ route('asset_register') }}">স্থায়ী সম্পত্তি রেজিষ্টার</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                            <li class="dropdown">--}}
{{--                                <a href="javascript:void(0)" class="dropdown-toggle">--}}
{{--                                    <i class="icon-copy fa fa-list" aria-hidden="true"></i><span--}}
{{--                                        class="mtext">কমিটি</span>--}}
{{--                                </a>--}}
{{--                                <ul class="submenu child">--}}
{{--                                    <li><a href="{{ route('committee') }}">কমিটি</a></li>--}}
{{--                                    <li><a href="{{ route('committee_list') }}">কমিটি দেখুন</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}

{{--                        </ul>--}}
{{--                    </li>--}}
                    {{--                    <li class="dropdown">--}}
                    {{--                        <a href="javascript:void(0);" class="dropdown-toggle">--}}
                    {{--                            <span class="fa fa-file-text-o"></span><span class="mtext">ডিসি অফিস রিপোর্ট</span>--}}
                    {{--                        </a>--}}
                    {{--                        <ul class="submenu">--}}

                    {{--                            <li class="dropdown">--}}
                    {{--                                <a href="{{ route('projects') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span--}}
                    {{--                                        class="mtext">প্রকল্প সমূহ</span>--}}
                    {{--                                </a>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="dropdown">--}}
                    {{--                                <a href="{{ route('reports', '1') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span--}}
                    {{--                                        class="mtext">কর ও রেট</span>--}}
                    {{--                                </a>--}}
                    {{--                                <a href="{{ route('reports', '2') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">গ্রাম আদালত (মাসিক)</span>--}}
                    {{--                                </a>--}}
                    {{--                                <a href="{{ route('reports', '3') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">জন্ম নিবন্ধন (মাসিক/ ত্রৈমাসিক)</span>--}}
                    {{--                                </a>--}}
                    {{--                                <a href="{{ route('reports', '4') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">ষান্মাসিক প্রতিবেদন</span>--}}
                    {{--                                </a>--}}
                    {{--                                <a href="{{ route('reports', '5') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">এসওই (ত্রৈমাসিক)</span>--}}
                    {{--                                </a>--}}
                    {{--                                <a href="{{ route('reports', '6') }}" class="dropdown-toggle no-arrow">--}}
                    {{--                                    <i class="fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">বার্ষিক আর্থিক বিবরণী</span>--}}
                    {{--                                </a>--}}

                    {{--                            </li>--}}
                    {{--                            <li class="dropdown">--}}
                    {{--                                <a href="javascript:void(0)" class="dropdown-toggle">--}}
                    {{--                                    <i class="icon-copy fa fa-sticky-note" aria-hidden="true"></i><span class="mtext">বাজেট ও পরিকল্পনা</span>--}}
                    {{--                                </a>--}}
                    {{--                                <ul class="submenu child">--}}
                    {{--                                    <li><a href="{{ route('reports', '7') }}">বার্ষিক বাজেট</a></li>--}}
                    {{--                                    <li><a href="{{ route('reports', '8') }}">বার্ষিক পরিকল্পনা</a></li>--}}
                    {{--                                    <li><a href="{{ route('reports', '9') }}">ত্রৈবার্ষিক পরিকল্পনা</a></li>--}}
                    {{--                                    <li><a href="{{ route('reports', '10') }}">পঞ্চবার্ষিক পরিকল্পনা</a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </li>--}}

                    {{--                            <li class="dropdown">--}}
                    {{--                                <a href="javascript:void(0)" class="dropdown-toggle">--}}
                    {{--                                    <i class="icon-copy fa fa-list" aria-hidden="true"></i><span class="mtext">রেজিষ্টারের বিবরণ</span>--}}
                    {{--                                </a>--}}
                    {{--                                <ul class="submenu child">--}}
                    {{--                                    <li><a href="{{ route('letters', '1') }}">পত্র জারি রেজিষ্টার</a></li>--}}
                    {{--                                    <li><a href="{{ route('letters', '2') }}">পত্র প্রাপ্তি রেজিষ্টার</a></li>--}}
                    {{--                                    <li><a href="{{ route('asset_register') }}">স্থায়ী সম্পত্তি রেজিষ্টার</a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </li>--}}

                    {{--                            <li class="dropdown">--}}
                    {{--                                <a href="javascript:void(0)" class="dropdown-toggle">--}}
                    {{--                                    <i class="icon-copy fa fa-list" aria-hidden="true"></i><span--}}
                    {{--                                        class="mtext">কমিটি</span>--}}
                    {{--                                </a>--}}
                    {{--                                <ul class="submenu child">--}}
                    {{--                                    <li><a href="{{ route('committee') }}">কমিটি</a></li>--}}
                    {{--                                    <li><a href="{{ route('committee_list') }}">কমিটি দেখুন</a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </li>--}}

                    {{--                        </ul>--}}
                    {{--                    </li>--}}
                @endcan

                @can('everyday-attendance-report')
                    <li>
                        <a href="{{ route('attendance_data') }}" class="dropdown-toggle no-arrow">
                            <span class="fa fa-calendar-check-o"></span><span class="wtext">দৈনিক হাজিরা রিপোর্ট</span>
                        </a>
                    </li>
                @endcan

                @can('setting')
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <i class="icon-copy fa fa-gear" aria-hidden="true"></i><span class="wtext">সেটিং</span>
                        </a>
                        <ul class="submenu">
                            @can('union-setup')
                                <li class="dropdown">
                                    <a href="{{ route('union_setup') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-cogs" aria-hidden="true"></i><span class="mtext">পৌরসভা
                                    সেটআপ</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('pdf_setup') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-cogs" aria-hidden="true"></i><span class="mtext">প্রিন্ট সেটিং</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('bank_view') }}"class="dropdown-toggle no-arrow">
                                        <i class="fa fa-university" aria-hidden="true"></i><span class="wtext">ব্যাংক একাউন্ট</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="{{ route('designation') }}" class="dropdown-toggle no-arrow">
                                        <span class="fa fa-dollar"></span><span class="wtext">পদবী</span>
                                    </a>
                                </li>

                            @endcan
                                @can('street-setup')
                                    <li>
                                        <a href="{{ route('bd_location_list') }}" class="dropdown-toggle no-arrow">
                                            <span class="fa fa-map"></span><span class="wtext">লোকেশন যুক্ত করুন</span>
                                        </a>
                                    </li>
                                <li class="dropdown">
                                    <a href="{{ route('street.list') }}" class="dropdown-toggle no-arrow">
                                        <i class="icon-copy fa fa-cogs" aria-hidden="true"></i><span
                                            class="mtext">রাস্তা সেটআপ</span>
                                    </a>
                                </li>
                                @endcan

                            @can('role-setup')
                                <li class="dropdown">
                                    <a href="javascript:void(0)" class="dropdown-toggle">
                                        <i class="icon-copy fa fa-list" aria-hidden="true"></i><span class="mtext">রোল সেটআপ</span>
                                    </a>
                                    <ul class="submenu child">
                                        <li><a href="{{ route('role.list') }}">রোল লিস্ট</a></li>
                                        <li><a href="{{ route('role.assigned_role') }}">এসাইন রোল</a></li>
                                    </ul>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan


            </ul>
        </div>
    </div>
</div>
