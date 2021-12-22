<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a>
        </div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#">
                <i class="icon ion-navicon-round"></i></a>
        </div>
        {{-- <div class="input-group hidden-xs-down wd-170 transition">
            <input id="searchbox" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
            </span>
        </div> --}}
    </div>
    <div class="br-header-right">
        <nav class="nav">

            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down pr-2"> {{ auth()->user()->name }} </span>
                    @if (auth()->user()->profile && auth()->user()->profile->photo)
                        <img src="{{ env('STORAGE_URL') . '/images/profile/' . auth()->user()->profile->photo }}"
                            class="wd-45 rounded-circle" alt="">
                    @else
                        <img src="{{ asset('images/default_user.webp') }}" class="wd-45 rounded-circle" alt="">
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-300">
                    <div class="row text-center bd bd-b-1">
                        <div class="col-12">
                            @if (auth()->user()->profile && auth()->user()->profile->photo)
                                <img src="{{ env('STORAGE_URL') . '/images/profile/' . auth()->user()->profile->photo }}"
                                    class="wd-100 ht-100 rounded-circle mb-2" alt="">
                            @else
                                <img src="{{ asset('images/default_user.webp') }}" class="wd-100 ht-100 rounded-circle mb-2" alt="">
                            @endif
                            <h5>{{ auth()->user()->name }}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center pt-2">

                        <a class="btn btn-sm btn-info text-white" href="{{ route('profile') }}"><i
                                class="icon ion-ios-person"></i> Profile</a>
                        
                        <a class="btn btn-sm btn-info text-white" href="javascript:void(0)"
                            onclick="$('#logout_form').submit()"><i class="icon ion-power"></i> Sign Out</a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

{{-- logout form --}}
<form id="logout_form" action="{{ route('logout') }}" method="post">
    @csrf
</form>
