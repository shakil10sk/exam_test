@extends('layouts.app')

@section('content')

	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> দৈনিক কালেকশন রিপোর্ট</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
						<li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
						<li class="breadcrumb-item active" aria-current="page">রিপোর্ট</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
		<div class="clearfix mb-20">

			<div class="row">

				<label class="col-md-2">রিপোর্টের ধরনঃ</label>
				<select class="form-control col-md-2" name="type" id="type">
					<option>সিলেক্ট করুন</option>
					<option value="1">দৈনিক ট্রেড ও পেশা কর</option>
					<option value="2" {{($select==2)?"selected":""}}>দৈনিক ভ্যাট কালেকশন </option>
					<option value="3">দৈনিক সকল কালেকশন </option>
					<option value="4">দৈনিক বসতভিটার কর কালেকশন </option>
					<option value="5">দৈনিক জমা/খরচ রিপোর্ট </option>
				</select>

				<label class="col-md-1">হতেঃ</label>
				<input type="text" name="from_date" id="from_date" value="{{ date('Y-m-d') }}" class="form-control col-md-2" />

				<label class="col-md-1">পর্যন্তঃ</label>
				<input type="text" name="to_date" id="to_date" value="{{ date('Y-m-d') }}" class="form-control col-md-2"  />
				&nbsp;&nbsp;
				<input  type="button" name="" value="  সার্চ" class="btn btn-primary" onclick="daily_report_show()">

			</div>

		</div>
	</div>

			

@endsection

@section('script')

	<script src="{{ asset('js/accounts.min.js') }}"></script>

@endsection


