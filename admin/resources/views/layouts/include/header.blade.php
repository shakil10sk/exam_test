
<style>
	.header-right {

	background: #00b181;

	}

	.user-info-dropdown .dropdown-toggle .user-icon {
	border: 1px solid #fff;
	color: #fff;

}
.user-info-dropdown .dropdown-toggle .user-name {
	color: #fff;

}

.left-side-bar {
	background: #00b181;

}
.menu-icon {

	background: #14351159;

}
</style>
{{-- <div class="pre-loader"></div> --}}
<div class="header clearfix">

	<div class="header-right">

		<div class="brand-logo">
			<a href="{{ route('home') }}">
				<img src="{{ asset('images/logo.png') }}" alt="" class="mobile-logo">
			</a>
		</div>

		<div class="menu-icon">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>

		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon"><i class="fa fa-user-o"></i></span>
					<span class="user-name">{{ Auth::User()->name }}</span>
				</a>

				<div class="dropdown-menu dropdown-menu-right">

					@if(Auth::user()->type != 0)

					<a class="dropdown-item"
						href="@if(isset(Auth::User()->relationBetweenEmployee->employee_id)){{ route('view_profile', ['id' => Auth::User()->relationBetweenEmployee->employee_id]) }}@endif"><i
							class="fa fa-user-md" aria-hidden="true" style="color: white;"></i> প্রোফাইল</a>

					<a class="dropdown-item"
						href="@if(isset(Auth::User()->relationBetweenEmployee->employee_id)){{ route('view_profile', ['id' => Auth::User()->relationBetweenEmployee->employee_id]) }}@endif"><i
							class="fa fa-cog" aria-hidden="true"style="color: white;"></i> সেটিং</a>

					@endif

					<a class="dropdown-item" href="{{ route('support') }}"><i class="fa fa-question"
					aria-hidden="true"></i> হেল্পলাইন</a>


					@impersonate
					<a class="dropdown-item" href="{{route('impersonate.distroy')}}" ><i class="fa fa-sign-out" aria-hidden="true"></i> ইম্পারশোনেট আউট</a>
					@else
					<a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form-admin').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> লগ আউট</a>
					@endimpersonate
					<form id="logout-form-admin" action="{{ route('logout') }}" method="POST" style="display: none;">

						@csrf

					</form>
				</div>
			</div>
		</div>

		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle no-arrow" href="{{ route('support') }}">
					<span class="user-icon"><i class="icon-copy ti-headphone-alt"></i></span>
					<span class="user-name">01714-049013</span>
				</a>
			</div>
		</div>

		<div class="user-info-dropdown d-none d-sm-none d-md-none d-lg-block text-center"
			style="max-width: 92%; min-width: 61%;">

			@role('super-admin')
			<div class="" style="font-size: 24px;padding-top: 8px;color:white;font-weight: bold;">
				সুপার এডমিন
			</div>
			@else
			<div class="" style="font-size: 24px;padding-top: 8px;color:white;font-weight: bold;">
				@if (auth()->user()->union_id)
				<?php $union_info = App\Models\Global_model::union_profile(Auth::user()->union_id);?>

				{{ $union_info->bn_name.', '.$union_info->union_upazila_name_bn.', '.$union_info->union_district_name_bn }}
				@endif

			</div>
			@endrole

		</div>

		@if (auth()->user()->type == 0)
		<a href="{{ route('home') }}" >
			<img src="{{ asset('/images/globe2.gif') }}" style="width: 4%;margin-top: 10px; margin-left: 20px">
		</a>

		@else
    		{{-- @php

    		if (env("APP_TYPE") == 'single'){

                $url = env("WEB_URL");

            }else{

                $host= explode('.',request()->getHost());

				unset($host[0]);
				$url = $_SERVER['REQUEST_SCHEME'].'://'.$union_info->sub_domain.'.'.implode('.',$host);

            }

    		@endphp --}}
            @php

            @endphp

			<a href="{{ $url }}" target="_blank">
				<img src="{{ asset('/images/globe2.gif') }}" style="width: 4%;margin-top: 10px; margin-left: 20px">
			</a>
		@endif
	</div>
</div>
