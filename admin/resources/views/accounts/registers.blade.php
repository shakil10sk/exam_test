@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> সকল রেজিষ্টার সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
		                        <li class="breadcrumb-item active" aria-current="page">রেজিষ্টার</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->


			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">

					<div class="row">

						<label class="col-md-2">রেজিষ্টার ধরনঃ</label>
						<div class="col-md-2">
							<select class="form-control" name="type" id="type">
								<option value="">সিলেক্ট করুন</option>
								<option value="1" {{($select==1)?'selected':''}} >নাগরিক সনদ</option>
								<option value="2" {{($select==2)?'selected':''}} >মৃত্যু সনদ</option>
								<option value="3" {{($select==3)?'selected':''}} >অবিবাহিত সনদ</option>
								<option value="4" {{($select==4)?'selected':''}} >পুনঃবিবাহ না হওয়া সনদ</option>
								<option value="5" {{($select==5)?'selected':''}} >একই নামের প্রত্যয়ন</option>
								<option value="6" {{($select==6)?'selected':''}} >সনাতন ধর্মাবলম্বী সনদ</option>
								<option value="7" {{($select==7)?'selected':''}} >প্রত্যয়ন</option>
								<option value="8" {{($select==8)?'selected':''}} >নদী ভাঙনের সনদ</option>
								<option value="9" {{($select==9)?'selected':''}} >চারিত্রিক সনদ</option>
								<option value="10" {{($select==10)?'selected':''}} >ভূমিহিন সনদ</option>
								<option value="11" {{($select==11)?'selected':''}} >বার্ষিক আয়ের সনদ</option>
								<option value="12" {{($select==12)?'selected':''}} >প্রতিবন্ধি সনদ</option>
								<option value="13" {{($select==13)?'selected':''}} >অনুমতি সনদ</option>
								<option value="14" {{($select==14)?'selected':''}} >ভোটার আইডি স্থানান্তর সনদ</option>
								<option value="15" {{($select==15)?'selected':''}} >অনাপত্তি</option>
								<option value="17" {{($select==17)?'selected':''}} >ওয়ারিশ সনদ</option>
								<option value="18" {{($select==18)?'selected':''}} >পারিবারিক সনদ</option>
								<option value="19" {{($select==19)?'selected':''}} >ট্রেড লাইসেন্স</option>
								<option value="90" {{($select==90)?'selected':''}} >প্রিমিসেস লাইসেন্স</option>
								<option value="20" {{($select==20)?'selected':''}} >বিবাহিত সনদ</option>
								<option value="21" {{($select==21)?'selected':''}}>পেশা কর</option>
								<option value="22" {{($select==22)?'selected':''}}>বসতভিটা কর</option>
								<option value="91" {{($select==91)?'selected':''}}>পোষা প্রাণীর সনদ</option>
								<option value="93" {{($select==93)?'selected':''}}>নতুন হোল্ডিং নামজারী সনদ</option>
								<option value="94" {{($select==94)?'selected':''}}>রাস্তা খননের অনুমতি সনদ</option>
								<option value="95" {{($select==95)?'selected':''}}>ইমারত নির্মাণ অনুমতি সনদ</option>
								<option value="96" {{($select==96)?'selected':''}}>ভূমি ব্যবহার ছাড়পত্রের সনদ</option>
								<option value="23">১৫% ভ্যাট রেজিষ্টার</option>

								<option value="100">পৌর মার্কেট হিসাব রেজিষ্টার</option>
							</select>
							<span id="type_error" class="error"></span>
						</div>

						<label class="col-md-1">হতেঃ</label>
						<div class="col-md-2">
						<input type="text" name="from_date" id="from_date" value="{{ date('Y-m-d') }}" class="form-control" />
						<span id="from_date_error" class="error"></span>
						</div>

						<label class="col-md-1">পর্যন্তঃ</label>
						<div class="col-md-2">
						<input type="text" name="to_date" id="to_date" value="{{ date('Y-m-d') }}" class="form-control"  />
						<span id="to_date_error" class="error"></span>
						</div>
						&nbsp;&nbsp;
						<input  type="button" name="" value="  সার্চ" class="btn btn-primary" onclick="register_show()">

					</div>

				</div>
			</div>



@endsection

@section('script')

	<script src="{{ asset('js/accounts.js') }}"></script>

@endsection


