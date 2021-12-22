@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> সকল ক্যাশবুক সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
		                        <li class="breadcrumb-item active" aria-current="page">ক্যাশবুক</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">

					<div class="row">

						<label class="col-md-2">ক্যাশবুক ধরনঃ</label>
						<div class="col-md-2">
							<select class="form-control" name="type" id="type">
								<option value="">সিলেক্ট করুন</option>
								<option value="1">সাধারন ক্যাশবুক</option>
								<option value="2">স্থাবর সম্পত্তি ১%</option>
								<option value="3">এল, জি, এস, পি ১%</option>
								<option value="4">জন্ম, মৃত্যু নিবন্ধন</option>
							
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
						<input  type="button" name="" value="  সার্চ" class="btn btn-primary" onclick="cashbook_show()">

					</div>

				</div>
			</div>

			

@endsection

@section('script')

	<script src="{{ asset('js/accounts.min.js') }}"></script>

@endsection


