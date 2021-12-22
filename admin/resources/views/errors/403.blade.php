<!DOCTYPE html>
<html>
<head>
	@include('layouts.include.head')
</head>
<body>
	<div class="error-page login-wrap bg-cover height-100-p customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
    <img src="{{ asset('vendors/images/error-bg.jpg') }}" alt="" class="bg_img">
		<div class="pd-10">
			<div class="error-page-wrap text-center color-white">
				<h1 class="color-white weight-500">Error: 403 Forbidden</h1>
            <img src="{{ asset('vendors/images/403.png') }}" alt="">
				<p>দুঃখিত, আপনি যে পৃষ্ঠায় সন্ধান করছেন সেটি অ্যাক্সেস করা যায় নি।<br>ফিরে যান..., <a href="{{ route('home') }}">go home</a>.</p>
			</div>
		</div>
	</div>
	@include('layouts.include.script')
</body>
</html>