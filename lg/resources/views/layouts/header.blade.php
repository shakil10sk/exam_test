<style type="text/css">
	.main-menu-area{
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(238,246,227,1)), color-stop(100%,rgba(255,255,255,1)));
		background: -webkit-linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
		background: -o-linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
		background: -ms-linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
		background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
	}

	.head{
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(238,246,227,1)), color-stop(100%,rgba(255,255,255,1)));
		background: -webkit-linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
		background: -o-linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
		background: -ms-linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
		background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(238,246,227,1) 100%);
	}

	ul.special li a {
		width: 230px !important;
		float: left;
	}

	ul.mobsp li a {
		width: 171px !important;
		float: left;
		font-size: 12px;
	}

	ul.special {
		width: 480px !important;
		;
	}

	.seba {
		padding: 22px;
		text-align: left;
		padding-left: 25px;
	}

	.bgseba {
		padding: 15px 20px;
		margin-bottom: 25px;
		overflow: hidden;
		min-height: 280px !important;
		background: #0f0c29 !important;
		background: -webkit-linear-gradient(to right, #24243e, #302b63, #0f0c29) !important;
		background: linear-gradient(to right, #24243e, #302b63, #0f0c29) !important;
	}

	.seba ul li a {
		color: #fff;
		line-height: 1.9;
	}

	.seba ul li a:hover {
		color: rgb(106, 255, 0);

	}

	.ourteam {
		background: url({{ env('ASSET_URL').'/images/lily.jpg'}}) no-repeat;
		/* background: url("{{ asset('assets/img/lily.png') }}")no-repeat; */
		position: relative;
		background-size: cover;
		background-repeat: round;

	}

	.img-circle {
		margin-left: 20px;
	}

	.each-member {
		padding-top: 30px;
		color: #fff !important;
	}

	.name {
		color: #fff;
	}

	.icon-section {
		background: url({{ env('ASSET_URL').'/images/giphy.gif'}}) no-repeat;
		position: relative;
		background-size: cover;
		background-repeat: round;
		padding: 15px;
		opacity: 0.8px;
	}

	.inner-item-md3 {
		max-width: 265px;
		margin: 0 auto 30px auto;
		display: block;
	}

	.uplogo img {
		width: 100px;
	}

	.uk-form{
        background:#fff;
        padding:20px;
    }
    .text-warning{
        color:rgb(63 0 255);
    }
</style>
<!-- start header -->
<header class="head" style="">
	<div class="main-header wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="img-responsive" style="color:black; padding-bottom:20px;">
						<h2>নরসিংদী স্থানীয় সরকার ব্যবস্থাপনা </h2>
						<span style="font-size:20px; font-weight:bold;color:#888;">নরসিংদী</span>
					</div>
				</div>


			</div>

		</div>
	</div>

</header>




<div class="main-menu-area" data-spy="affix" data-offset-top="190" style="">
	<div class="container">
		<div class="main-header wow fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
			<nav id="lg-main-menu" role="navigation" class="lg-menu">
				<ul class="desktop-menu">
					<li class="active"><a href="{{ route('/')  }}">প্রথম পাতা </a></li>
					<li><a href="javascript:void(0)">স্থানীয় সরকারের তথ্য সমূহ</a>
						<ul class="sub-menus">
							<li> <a href="#employee">সরকারী কর্মকর্তাবৃন্দ</a> </li>
							<li> <a href="javascript:void(0)">মিশন, ভিশন ও অর্জন</a></li>

						</ul>
					</li>
					<li><a href="javascript:void(0)">ই-সেবা সমুহ </a>
						<ul class="sub-menus">

							<!-- <li> <a href="home/objection">অভিযোগ </a> </li> -->
							<li><a href="#services">যে কোন সনদের আবেদন</a></li>

						</ul>
					</li>
					<li><a href="{{ route('application_verify') }}">যাচাই করুন</a></li>
					{{-- <li><a href="javascript:void(0)">উপজেলা সমুহ </a>
						<ul class="sub-menus">
							<li><a href="javascript:void(0)">নরসিংদী সদর</a>
								<ul class="subs-menus special">
									<li> <a href="http://alokbaliup.narsingdilg.gov.bd" target='_new'>আলোকবালী
											ইউনিয়ন</a> </li>
									<li> <a href="http://chardighaldiup.narsingdilg.gov.bd" target='_new'>চরদিঘলদী
											ইউনিয়ন</a> </li>
									<li> <a href="http://chinishpurup.narsingdilg.gov.bd" target='_new'>চিনিশপুর
											ইউনিয়ন</a> </li>
									<li> <a href="http://hajipurup.narsingdilg.gov.bd" target='_new'>হাজীপুর ইউনিয়ন</a>
									</li>
									<li> <a href="http://karimpurup.narsingdilg.gov.bd" target='_new'>করিমপুর ইউনিয়ন</a>
									</li>
									<li> <a href="http://khathaliaup.narsingdilg.gov.bd" target='_new'>কাঠালিয়া
											ইউনিয়ন</a> </li>
									<li> <a href="http://nuralapurup.narsingdilg.gov.bd" target='_new'>নূরালাপুর
											ইউনিয়ন</a> </li>
									<li> <a href="http://mahishasuraup.narsingdilg.gov.bd" target='_new'>মহিষাশুড়া
											ইউনিয়ন</a> </li>
									<li> <a href="http://meherparaup.narsingdilg.gov.bd" target='_new'>মেহেড়পাড়া
											ইউনিয়ন</a> </li>
									<li> <a href="http://nazarpurup.narsingdilg.gov.bd" target='_new'>নজরপুর ইউনিয়ন</a>
									</li>
									<li> <a href="http://paikarcharup.narsingdilg.gov.bd" target='_new'>পাইকারচর
											ইউনিয়ন</a> </li>
									<li> <a href="http://panchdonaup.narsingdilg.gov.bd" target='_new'>পাঁচদোনা
											ইউনিয়ন</a> </li>
									<li> <a href="http://silmandiup.narsingdilg.gov.bd" target='_new'>শিলমান্দী
											ইউনিয়ন</a> </li>
									<li> <a href="http://amdiaup.narsingdilg.gov.bd" target='_new'>আমদিয়া ইউনিয়ন</a>
									</li>

								</ul>
							</li>
							<li><a href="javascript:void(0)">বেলাবো </a>
								<ul class="subs-menus special">
									<li> <a href="http://amlabaup.narsingdilg.gov.bd" target='_new'>আমলাব ইউনিয়ন</a>
									</li>
									<li> <a href="http://bajnabaup.narsingdilg.gov.bd" target='_new'> বাজনাব ইউনিয়ন </a>
									</li>
									<li> <a href="http://belaboup.narsingdilg.gov.bd" target='_new'>বেলাব ইউনিয়ন</a>
									</li>
									<li> <a href="http://binnabaydup.narsingdilg.gov.bd" target='_new'>বিন্নাবাইদ পশ্চিম
											ইউনিয়ন</a> </li>
									<li> <a href="http://charuzilabup.narsingdilg.gov.bd" target='_new'>চরউজিলাব
											ইউনিয়ন</a> </li>
									<li> <a href="http://naraynpurup.narsingdilg.gov.bd" target='_new'>নারায়নপুর
											ইউনিয়ন</a> </li>
									<li> <a href="http://sallabadup.narsingdilg.gov.bd" target='_new'>সল্লাবাদ
											ইউনিয়ন</a> </li>

									<li> <a href="http://patuliup.narsingdilg.gov.bd" target='_new'>পাটুলী ইউনিয়ন</a>
									</li>
								</ul>
							</li>
							<li><a href="javascript:void(0)">মনোহরদী </a>
								<ul class="subs-menus special">
									<li> <a href="http://barachapaup.narsingdilg.gov.bd" target="_blink">বড়চাপা
											ইউনিয়ন</a></li>
									<li> <a href="http://chalakcharup.narsingdilg.gov.bd" target='_new'> চালাকচর
											ইউনিয়ন</a></li>
									<li> <a href="http://charmandaliaup.narsingdilg.gov.bd" target='_new'>চরমান্দালিয়া
											ইউনিয়ন</a></li>
									<li> <a href="http://ekduariaup.narsingdilg.gov.bd" target='_new'>একদুয়ারিয়া
											ইউনিয়ন</a></li>
									<li> <a href="http://gotashiaup.narsingdilg.gov.bd" target='_new'>গোতাশিয়া
											ইউনিয়ন</a></li>
									<li> <a href="http://kanchikataup.narsingdilg.gov.bd" target='_new'>কাচিকাটা
											ইউনিয়ন</a></li>
									<li> <a href="http://khidirpurup.narsingdilg.gov.bd" target='_new'>খিদিরপুর
											ইউনিয়ন</a></li>
									<li> <a href="http://shukundiup.narsingdilg.gov.bd" target='_new'>শুকুন্দি ইউনিয়ন
										</a></li>
									<li> <a href="http://dawlatpurup.narsingdilg.gov.bd" target='_new'>দৌলতপুর
											ইউনিয়ন</a></li>
									<li> <a href="http://krisnopurup.narsingdilg.gov.bd" target='_new'>কৃষ্ণপুর
											ইউনিয়ন</a></li>
									<li> <a href="http://labutalaup.narsingdilg.gov.bd" target='_new'>লেবুতলা ইউনিয়ন
										</a></li>
									<li> <a href="http://chandanbariup.narsingdilg.gov.bd" target='_new'>চন্দনবাড়ী
											ইউনিয়ন</a></li>
								</ul>
							</li>
							<li><a href="javascript:void(0)">পলাশ </a>
								<ul class="subs-menus special">
									<li> <a href="http://dangaup.narsingdilg.gov.bd" target='_new'>ডাংঙ্গা ইউনিয়ন </a>
									</li>
									<li> <a href="http://charsindurup.narsingdilg.gov.bd" target='_new'>চরসিন্দুর
											ইউনিয়ন</a> </li>
									<li> <a href="http://jinardiup.narsingdilg.gov.bd" target='_new'>জিনারদী ইউনিয়ন</a>
									</li>
									<li> <a href="http://gazariaup.narsingdilg.gov.bd" target='_new'>গজারিয়া ইউনিয়ন</a>
									</li>
								</ul>
							</li>
							<li><a href="javascript:void(0)">রায়পুরা </a>
								<ul class="subs-menus special">
									<li> <a href="http://chanpurup.narsingdilg.gov.bd" target='_new'>চানপুর ইউনিয়ন </a>
									</li>
									<li> <a href="http://alipuraup.narsingdilg.gov.bd" target='_new'>অলিপুরা ইউনিয়ন </a>
									</li>
									<li> <a href="http://amirganjup.narsingdilg.gov.bd" target='_new'>আমিরগঞ্জ
											ইউনিয়ন</a> </li>
									<li> <a href="http://adiabadup.narsingdilg.gov.bd" target='_new'>আদিয়াবাদ ইউনিয়ন</a>
									</li>
									<li> <a href="http://banshgariup.narsingdilg.gov.bd" target='_new'>বাঁশগাড়ী
											ইউনিয়ন</a> </li>
									<li> <a href="http://chanderkandiup.narsingdilg.gov.bd" target='_new'>চান্দেরকান্দি
											ইউনিয়ন</a> </li>
									<li> <a href="http://chararaliaup.narsingdilg.gov.bd" target='_new'>চরআড়ালিয়া
											ইউনিয়ন</a> </li>
									<li> <a href="http://charmadhuaup.narsingdilg.gov.bd" target='_new'>চরমধুয়া
											ইউনিয়ন</a> </li>
									<li> <a href="http://charsubuddiup.narsingdilg.gov.bd" target='_new'>চরসুবুদ্দি
											ইউনিয়ন</a> </li>
									<li> <a href="http://daukarcharup.narsingdilg.gov.bd" target='_new'>ডৌকারচর
											ইউনিয়ন</a> </li>
									<li> <a href="http://hairmaraup.narsingdilg.gov.bd" target='_new'>হাইরমারা
											ইউনিয়ন</a> </li>
									<li> <a href="http://maheshpurup.narsingdilg.gov.bd" target='_new'>মহেষপুর
											ইউনিয়ন</a> </li>
									<li> <a href="http://mirzanagarup.narsingdilg.gov.bd" target='_new'>মির্জানগর
											ইউনিয়ন</a> </li>
									<li> <a href="http://mirzarcharup.narsingdilg.gov.bd" target='_new'> মির্জারচর
											ইউনিয়ন</a> </li>
									<li> <a href="http://nilakhyaup.narsingdilg.gov.bd" target='_new'>নিলক্ষ্যা
											ইউনিয়ন</a> </li>
									<li> <a href="http://palashtaliup.narsingdilg.gov.bd" target='_new'>পলাশতলী
											ইউনিয়ন</a> </li>
									<li> <a href="http://parataliup.narsingdilg.gov.bd" target='_new'>পাড়াতলী ইউনিয়ন</a>
									</li>
									<li> <a href="http://sreenagarup.narsingdilg.gov.bd" target='_new'>শ্রীনগর
											ইউনিয়ন</a> </li>
									<li> <a href="http://roypuraup.narsingdilg.gov.bd" target='_new'> রায়পুরা
											ইউনিয়ন</a> </li>
									<li> <a href="http://musapurup.narsingdilg.gov.bd" target='_new'>মুছাপুর ইউনিয়ন</a>
									</li>
									<li> <a href="http://uttarbakharnagarup.narsingdilg.gov.bd" target='_new'>উত্তর
											বাখরনগর ইউনিয়ন</a> </li>
									<li> <a href="http://marjal2up.narsingdilg.gov.bd" target='_new'>মরজাল ইউনিয়ন</a>
									</li>
									<li> <a href="http://radhanagarup.narsingdilg.gov.bd" target='_new'>রাধানগর
											ইউনিয়ন</a> </li>
									<li> <a href="http://mirzapurup.narsingdilg.gov.bd" target='_new'>মির্জাপুর
											ইউনিয়ন</a> </li>
								</ul>
							</li>
							<li><a href="javascript:void(0)">শিবপুর </a>
								<ul class="subs-menus special">

									<li> <a href="http://joynagarup.narsingdilg.gov.bd" target='_new'>জয়নগর ইউনিয়ন</a>
									</li>
									<li> <a href="http://sadharcharup.narsingdilg.gov.bd" target='_new'>সাধারচর
											ইউনিয়ন</a> </li>
									<li> <a href="http://masimpurup.narsingdilg.gov.bd" target='_new'>মাছিমপুর
											ইউনিয়ন</a> </li>
									<li> <a href="http://chakradhaup.narsingdilg.gov.bd" target='_new'>চক্রধা ইউনিয়ন</a>
									</li>
									<li> <a href="http://josharup.narsingdilg.gov.bd" target='_new'>যোশর ইউনিয়ন</a>
									</li>
									<li> <a href="http://baghaboup.narsingdilg.gov.bd" target='_new'>বাঘাব ইউনিয়ন</a>
									</li>
									<li> <a href="http://ayubpurup.narsingdilg.gov.bd" target='_new'>আয়ুবপুর ইউনিয়ন</a>
									</li>
									<li> <a href="http://putiaup.narsingdilg.gov.bd" target='_new'>পুটিয়া ইউনিয়ন</a>
									</li>
									<li> <a href="http://dulalpurup.narsingdilg.gov.bd" target='_new'>দুলালপুর
											ইউনিয়ন</a> </li>


								</ul>
							</li>


						</ul>
					</li> --}}
					{{-- <li><a href="javascript:void(0)">গ্যালারি</a></li> --}}
					<li><a href="#contact">যোগাযোগ</a></li>

				</ul>


			</nav>


		</div>
	</div>
</div>

<div class="mobile-menu">
	<div class="menu-button">Menu</div>
	<nav>
		<ul class="flexnav">
			<li class="active"><a href="{{ route('/') }}">প্রথম পাতা </a></li>
			<li><a href="javascript:void(0)">স্থানীয় সরকারের তথ্য সমূহ</a>
				<ul class="sub-menus">
					<li> <a href="#employee">সরকারী কর্মকর্তাবৃন্দ</a> </li>
					<li> <a href="javascript:void(0)">মিশন, ভিশন ও অর্জন</a></li>

				</ul>
			</li>
			<li><a href="javascript:void(0)">ই-সেবা সমুহ </a>
				<ul class="sub-menus">

					{{-- <li> <a href="home/objection">অভিযোগ </a> </li> --}}
					<li><a href="#services">যে কোন সনদের আবেদন</a></li>

				</ul>
			</li>
			<li><a href="{{ route('application_verify') }}">যাচাই করুন</a></li>
			 <li><a href="javascript:void(0)">উপজেলা সমুহ </a>
				<ul class="sub-menus">
                    <li><a href="javascript:void(0)">রাঙ্গুনিয়া</a>
                        <ul class="subs-menus special">
                            <li> <a href="javascript:void(0)" target='_new'>
                                    রাজানগর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>হোছনাবাদ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>স্বনির্ভর রাঙ্গুনিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মরিয়মনগর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পারুয়া ইউিনয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পোমরা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বেতাগী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সরফভাটা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শিলক ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চন্দ্রঘোনা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ইসলামপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>দক্ষিণ রাজানগর ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>লালানগর ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>১০নং পদুয়া </a> </li>

                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">সীতাকুন্ড </a>
                        <ul class="subs-menus special">
                            <li> <a href="javascript:void(0)" target='_new'>কুমিরা ইউনিয়ন</a>
                            </li>
                            <li> <a href="javascript:void(0)" target='_new'> বাঁশবাড়ীয়া ইউনিয়ন</a>
                            </li>
                            <li> <a href="javascript:void(0)" target='_new'>বারবকুন্ড ইউনিয়ন</a>
                            </li>
                            <li> <a href="javascript:void(0)" target='_new'>বারৈয়াঢালা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মুরাদপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সৈয়দপুর </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সালিমপুর ইউনিয়ন</a> </li>

                            <li> <a href="javascript:void(0)" target='_new'>সোনাইছড়ি ইউনিয়ন</a>
                            </li>
                            <li> <a href="javascript:void(0)" target='_new'>ভাটিয়ারী ইউনিয়ন</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">মীরসরাই </a>
                        <ul class="subs-menus special">
                            <li> <a href="javascript:void(0)" target="_blink">করেরহাট ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">হিংগুলি ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">জোরারগঞ্জ ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ধুম ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ওসমানপুর ইউনিযন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ইছাখালী ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কাটাছরা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">দূর্গাপুর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মীরসরাই ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মিঠানালা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মঘাদিয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">খৈয়াছরা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মায়ানী ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">হাইতকান্দি ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ওয়াহেদপুর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">করেরহাট ইউনিয়ন</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">পটিয়া </a>
                        <ul class="subs-menus special">
                            <li> <a href="javascript:void(0)" target="_blink">আশিয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কাচুয়াই ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কাশিয়াইশ ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কুসুমপুরা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কেলিশহর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কোলাগাঁও ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">খরনা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ছনহরা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">জঙ্গলখাইন ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">জিরি ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">দক্ষিণ ভূর্ষি ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ধলঘাট ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">বরলিয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">ভাটিখাইন ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">শোভনদন্ডী ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">হাবিলাসদ্বীপ ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">হাইদগাঁও ইউনিয়ন</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">সন্দ্বীপ </a>
                        <ul class="subs-menus special">
                            <li> <a href="javascript:void(0)" target="_blink">রহমতপুর ইউনিয়ন </a></li>
                            <li> <a href="javascript:void(0)" target="_blink">হরিশপুর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">কালাপানিয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">আমানউল্যা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">সন্তোষপুর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">গাছুয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">বাউরিয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">হারামিয়া ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মগধরা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মাইটভাঙ্গা ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">সারিকাইত ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">মুছাপুর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">আজিমপুর ইউনিয়ন</a></li>
                            <li> <a href="javascript:void(0)" target="_blink">উড়িরচর ইউনিয়ন</a></li>

                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">বাঁশখালী </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>পুকুরিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সাধনপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>খানখানাবাদ ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বাহারছড়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কালীপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বৈলছড়ি ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কাথরিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সরল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শীলকুপ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চাম্বল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>গন্ডামারা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শেখেরখীল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পুঁইছড়ি ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ছনুয়া ইউনিয়ন</a> </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">বোয়ালখালী </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>কধুরখীল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পশ্চিম গোমদন্ডী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শাকপুরা ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সারোয়াতলী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পোপাদিয়া ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চরনদ্বীপ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শ্রীপুর-খরণ্দ্বীপ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আমুচিয়া ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আহল্লা করলডেঙ্গা ইউনিয়ন</a> </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">আনোয়ারা </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>বৈরাগ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বারশত ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>রায়পুর</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বটতলী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বরুমচড়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বারখাইন ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আনোয়ারা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চাতরী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পরৈকোড়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>হাইলধর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>জুঁইদন্ডী ইউনিয়ন</a> </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">সাতকানিয়া </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>চরতী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>খাগরিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নলুয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কাঞ্চনা  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আমিলাইশ  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>এওচিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মাদার্শা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ঢেমশা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পশ্চিম ঢেমশা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কেঁওচিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কালিয়াইশ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বাজালিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পুরানগড় ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ছদাহা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সাতকানিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সোনাকানিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ধর্মপুর  ইউনিয়ন</a> </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">লোহাগাড়া</a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>পদুয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বড়হাতিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আমিরাবাদ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চরম্বা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কলাউজান ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>লোহাগাড়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পুটিবিলা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চুনতি ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আধুনগর ইউনিয়ন</a> </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">হাটহাজারী</a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>ফরহাদাবাদ  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ধলই ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মির্জাপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নাঙ্গলমোড়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>গুমান মর্দ্দন ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ছিপাতলী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মেখল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>গড়দুয়ারা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ফতেপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চিকনদন্ডী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>উত্তর মাদার্শা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>দক্ষিন মাদার্শা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শিকারপুর  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বুড়িশ্চর ইউনিয়ন</a> </li>

                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">হাটহাজারী</a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>ফরহাদাবাদ  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ধলই ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মির্জাপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নাঙ্গলমোড়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>গুমান মর্দ্দন ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ছিপাতলী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>মেখল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>গড়দুয়ারা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ফতেপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চিকনদন্ডী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>উত্তর মাদার্শা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>দক্ষিন মাদার্শা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>শিকারপুর  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বুড়িশ্চর ইউনিয়ন</a> </li>

                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">ফটিকছড়ি  </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>ধর্মপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বাগান বাজার ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>দাঁতমারা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নারায়নহাট ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ভূজপুর ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>হারুয়ালছড়ি ইউনিয়ন  </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পাইনদং ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কাঞ্চনগর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সুনদরপুর ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সুয়াবিল ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>আবদুল্লাপুর ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>সমিতির হাট ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>জাফতনগর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বক্তপুর ইউনিয়ন </a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>রোসাংগিরী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নানুপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>লেলাং ইউনিয়ন </a> </li>

                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">রাউজান   </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>রাউজান ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বাগোয়ান ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বিনাজুরী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>চিকদাইর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ডাবুয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পূর্ব গুজরা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পশ্চিম গুজরা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>গহিরা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>হলদিয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>কদলপূর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নোয়াপাড়া  ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>পাহাড়তলী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>উড়কিরচর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>নোয়াজিষপুর ইউনিয়ন</a> </li>

                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">চন্দনাইশ  </a>
                        <ul class="subs-menus special mobsp">
                            <li> <a href="javascript:void(0)" target='_new'>কাঞ্চনাবাদ ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>জোয়ারা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বরকল ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বরমা ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বৈলতলী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>বসাতবাড়িয়া ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>হাশিমপুর ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>দোহাজারী ইউনিয়ন</a> </li>
                            <li> <a href="javascript:void(0)" target='_new'>ধোপাছড়ী ইউনিয়ন</a> </li>

                        </ul>
                    </li>
					<li><a href="javascript:void(0)">কর্ণফুলী </a>
						<ul class="subs-menus special mobsp">
							<li> <a href="javascript:void(0)" target='_new'>চরপাথরঘাটা ইউনিয়ন</a> </li>
							<li> <a href="javascript:void(0)" target='_new'>চরলক্ষ্যা ইউনিয়ন</a> </li>
							<li> <a href="javascript:void(0)" target='_new'>জুলধা ইউনিয়ন</a> </li>
							<li> <a href="javascript:void(0)" target='_new'>বড় উঠান ইউনিয়ন</a> </li>
							<li> <a href="javascript:void(0)" target='_new'>শিকলবাহা ইউনিয়ন</a> </li>

						</ul>
					</li>


				</ul>
			</li>


			{{-- <li><a href="javascript:void(0)">গ্যালারি</a></li> --}}
			<li><a href="#contact">যোগাযোগ</a></li>
		</ul>
	</nav>
</div>

<!-- end header -->
