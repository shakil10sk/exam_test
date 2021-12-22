@extends('layouts.app')
@section('content')
    {{--Breadcrumb Section--}}
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-id-card-o" aria-hidden="true"></i>  @if($type == 1) মুক্তিযোদ্ধা ভাতা @elseif($type == 2) দুস্থ ও দরিদ্র ভাতা @elseif($type == 3) বয়স্ক ভাতা @elseif($type == 4) মাতৃত্যকালিন ভাতা @elseif($type == 5) বিধবা ভাতা @elseif($type == 6) প্রতিবন্ধী ভাতা @elseif($type == 7) ভি জি ডি ভাতা @endif তালিকা</h4>
                    @can('vata-card-print')
                    <a href="{{ route('all_vata_card', ['type' => $type]) }}" class="btn btn-info float-right mb-2"><i class="icon-copy fa fa-print" aria-hidden="true"></i> সকল আইডি কার্ড প্রিন্ট করুন</a>
                    @endcan

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pd-20 bg-white border-radius-4 box-shadow mb-30">
            <div class="clearfix mb-20">
                <div class="row">
                    <div class="col-md-1"></div>

                    <div class="col-md-1 text-right">হতে:</div>
                <div class="col-md-3"><input type="text" name="fromDate" id="fromDate" value="{{ date('Y-m-d') }}" class="form-control"> </div>

                    <div class="col-md-1 text-right">পর্যন্ত:</div>
                    <div class="col-md-3"> <input type="text" name="toDate" id="toDate" value="{{ date('Y-m-d') }}" class="form-control"></div>

                    <div class="col-md-1" style="margin-bottom: 20px">
                        <button type="submit" class="btn btn-primary" onclick="allowanceListSearch()">সার্চ করুন</button>
                    </div>
                </div>

                <div class="row">
                    <table class="stripe hover data-table-export nowrap" id='allowanceTable'>
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">নং</th>
                                <th class="">ছবি</th>
                                <th class="">নাম</th>
                                <th class="">এনআইডি</th>
                                <th class="">পিতার নাম</th>
                                <th class="">মোবাইল</th>
                                <th class="">ওয়ার্ড নং</th>
                                <th class="">ভাতার পরিমান</th>
                            <th class="">অ্যাকশন <input type="hidden" id="allowance" value="{{ $type }}"></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
		<div class="col-md-12">
			@can('edit-vata')
				<input type="hidden" id="edit-vata" value="edit">
            @endcan
            
			@can('vata-payment')
				<input type="hidden" id="vata-payment" value="payment">
            @endcan
            
			@can('vata-profile')
				<input type="hidden" id="vata-profile" value="profile">
			@endcan

			@can('delete-vata')
				<input type="hidden" id="delete-vata" value="delete">		
			@endcan
		</div>
    </div>
    
    @can('vata-payment')
		<div class="modal fade" id="vata-payment-form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title" id="heading"></h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
                <form action="{{ route('store_vata') }}" method="post">
                    @csrf
					<div class="modal-body">
                        <div class="form-group">
                            <label for="name">গ্রহীতার নাম:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="allowance_date">ভাতা প্রদানের তারিখ:</label>
                            <input type="text" class="form-control date" name="allowance_date" id="allowance_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">বিবরণ:</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
					</div>
					<div class="modal-footer">
                        <input type="hidden" name="allowance_id" id="allowance_id" value="">
                        <input type="hidden" name="type" id="type" value="">
						<button type="submit" class="btn btn-primary">প্রদান</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
					</div>
				</form>
				</div>
			</div>
		</div>
		@endcan

@endsection

@section('script')
<script src="{{ asset('js/allowance.min.js') }}"></script>
@endsection