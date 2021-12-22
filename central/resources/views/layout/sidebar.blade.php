<div class="br-logo"><a href="{{ route('home') }}"><span>[</span>সেন্ট্রালি মনিটরিং<span>]</span></a>
</div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Manu</label>
    <div class="br-sideleft-menu">
        <a href="{{ route('dashboard') }}" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">ড্যাশবোর্ড</span>
            </div>
        </a>


        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                @if (auth()->user()->type == 1)
                    <span class="menu-item-label">জেলা সমূহ</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                @elseif (auth()->user()->type <= 3)
                    <span class="menu-item-label">উপজেলা সমূহ</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                @else
                    <span class="menu-item-label">{{ \App\Models\BdLocation::find(auth()->user()->upazila)->bn_name }}
                        উপজেলা</span>
                @endif
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">

            {{-- admin --}}
            @if (auth()->user()->type <= '1')
                @foreach (\App\Models\BdLocation::whereType(2)->get() as $item)
                    <li class="nav-item"><a href="{{ route('dashboard.district', $item->id) }}"
                            class="nav-link">{{ $item->bn_name }}</a></li>
                @endforeach
            @elseif (auth()->user()->type <= '3' ) @foreach (\App\Models\BdLocation::where('parent_id', auth()->user()->district)->get() as $item)
                    <li class="nav-item"><a href="{{ route('dashboard.upazila', $item->id) }}"
                            class="nav-link">{{ $item->bn_name }}</a></li>
            @endforeach
            @endif


        </ul>
        <a href="#" class="br-menu-link ">
            <div class="br-menu-item">
                <i class="menu-item-icon ion-ios-redo-outline tx-24"></i>
                <span class="menu-item-label">রিপোর্ট</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('report.daily') }}" class="nav-link"> দৈনিক রিপোর্ট</a></li>
            <li class="nav-item"><a href="{{ route('report.allowance') }}" class="nav-link"> ভাতার রিপোর্ট</a></li>
            {{-- <li class="nav-item"><a href="{{ route('report.attendance') }}"
                    class="nav-link"> দৈনিক হাজিরার রিপোর্ট </a></li> --}}
            {{-- <li class="nav-item"><a href="" class="nav-link"> জি আর উপকারভোগীদের<br>
                    তালিকা</a></li> --}}
        </ul>

        <a href="#" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">সকল রিপোর্ট ও রেজিষ্টার &nbsp; </span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('report-register.project') }}" class="nav-link">প্রকল্প সমূহ</a></li>
            <li class="nav-item"><a href="{{ route('report-register.reportResgister', 1) }}" class="nav-link">কর ও
                    রেট</a></li>
            <li class="nav-item"><a href="{{ route('report-register.reportResgister', 2) }}" class="nav-link">গ্রাম
                    আদালত (মাসিক)</a></li>
            <li class="nav-item"><a href="{{ route('report-register.reportResgister', 3) }}" class="nav-link">জন্ম
                    নিবন্ধন (মাসিক/ ত্রৈমাসিক)</a></li>
            <li class="nav-item"><a href="{{ route('report-register.reportResgister', 4) }}" class="nav-link">ষান্মাসিক
                    প্রতিবেদন</a></li>
            <li class="nav-item"><a href="{{ route('report-register.reportResgister', 5) }}" class="nav-link">এসওই
                    (ত্রৈমাসিক)</a></li>
            <li class="nav-item"><a href="{{ route('report-register.reportResgister', 6) }}" class="nav-link">বার্ষিক
                    আর্থিক বিবরণী</a></li>

            <li class="nav-item">
                <a href="#collapse1" class="nav-link" data-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="collapse1">
                    <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                    <span class="menu-item-label">বাজেট ও পরিকল্পনা </span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </a>
                <ul id="collapse1" class="collapse flex-column">
                    <li class="nav-item"><a href="{{ route('report-register.reportResgister', 7) }}"
                            class="nav-link">বার্ষিক বাজেট</a></li>
                    <li class="nav-item"><a href="{{ route('report-register.reportResgister', 8) }}" class="nav-link">
                            বার্ষিক পরিকল্পনা</a></li>
                    <li class="nav-item"><a href="{{ route('report-register.reportResgister', 9) }}"
                            class="nav-link">ত্রৈবার্ষিক পরিকল্পনা</a></li>
                    <li class="nav-item"><a href="{{ route('report-register.reportResgister', 10) }}"
                            class="nav-link">পঞ্চবার্ষিক পরিকল্পনা</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#collapse2" class="nav-link" data-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="collapse2">
                    <i class="menu-item-icon ion-ios-paper-outline tx-20"></i>
                    <span class="menu-item-label">রেজিষ্টারের বিবরণ</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </a>
                <ul id="collapse2" class="collapse flex-column">
                    <li class="nav-item"><a href="{{ route('letter.send') }}" class="nav-link">পত্র জারি রেজিষ্টার</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('letter.receive') }}" class="nav-link">পত্র প্রাপ্তি রেজিষ্টার</a></li>
                    <li class="nav-item"><a href="{{ route('asset.register') }}" class="nav-link">স্থায়ী সম্পত্তি রেজিষ্টার</a></li>
                </ul>
            </li>

        </ul>

        @if (auth()->user()->type <= 3)
            <a href="{{ route('admin.create') }}" class="br-menu-link">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-personadd-outline tx-22"></i>
                    <span class="menu-item-label">ইউজার অ্যাড</span>
                </div>
            </a>
        @endif

        <a href="{{ route('member_list') }}" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                <span class="menu-item-label">পরিষদের সদস্যদের তালিকা </span>
            </div>
        </a>
        {{-- <a href="layouts.html" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                <span class="menu-item-label">কমিটি</span>
            </div>
        </a> --}}
        
        @if (auth()->user()->type < 4)    
        <a href="{{ route('user.list') }}" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
                <span class="menu-item-label"> ইউজারের তালিকা
                </span>
            </div>
        </a>
        @endif

        <a href="javescript:void(0)" class="br-menu-link" data-toggle="modal" data-target="#password_change_modal">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
                <span class="menu-item-label"> পাসওয়ার্ড পরিবর্তন</span>
            </div>
        </a>
    </div>
</div>
