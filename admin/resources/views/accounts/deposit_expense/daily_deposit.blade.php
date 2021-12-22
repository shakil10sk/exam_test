@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> দৈনিক জমা ও ব্যাংক এর টাকা বিনিময়</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
		                        <li class="breadcrumb-item active" aria-current="page">দৈনিক জমা</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <form action="javascript:void(0)" method="POST">
                    <div class="clearfix mb-20">

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span class="text-danger" id="category_error"></span><br/>
                                <span class="text-danger" id="subcategory_error"></span><br/>
                                <span class="text-danger" id="fund_error"></span>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-md-2">প্রধান খাত</label>
                            <div class="col-md-4">
                                <span class="badge badge-light  btn-block" id="main_balance"></span>
                                <select class="form-control" name="from_category" id="from_category" onchange="get_subcategoy(this.value,'from_subcategory', 'sub_label', 'sub_select')">
                                    <option value="">সিলেক্ট করুন</option>

                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->account_name }}</option>
                                    @endforeach

                                </select>
                                <input type="hidden" name="main_amount" id="main_amount">
                                <span id="from_category_error" class="error"></span>
                            </div>
                            
                            <label class="col-md-2" id="sub_label" style="display: none;">সাব-খাত</label>
                            <div class="col-md-4" id="sub_select" style="display: none;">
                                <span class="badge badge-light  btn-block" id="sub_balance"></span>
                                <select class="form-control" name="from_subcategory" id="from_subcategory" onchange="account_balance(this.value, 'sub_balance', 'sub_amount')">
                                    <option value="">সিলেক্ট করুন</option>

                                </select>
                                <input type="hidden" name="sub_amount" id="sub_amount">
                                <span id="from_subcategory_error" class="error"></span>
                            </div>
                        
                        </div>
                    </div>

                    <div class="clearfix mb-20">
                        <div class="row">
                            <label class="col-md-2">জমার বিস্তারিত</label>
                            <div class="col-md-4">
                                <textarea class="form-control" cols="4" name="comment" id="comment"></textarea>
                                <span id="comment_error" class="error"></span>
                            </div>	
                            <div class="col-md-4" style="color: green;">
                                হতে<br/>
                                ||<br/>||<br/>||<br/>||<br/>||<br/>||</span><br/>
                                জমা
                            </div>
                        </div>
                    </div>
                    
                    <div class="clearfix mb-20">
                        <div class="row">
                            <label class="col-md-2">জমা প্রধান খাত</label>
                            <div class="col-md-4">
                                <select class="form-control" name="to_category" id="to_category" onchange="get_subcategoy(this.value,'to_subcategory', 'tsub_label', 'tsub_select')">
                                    <option value="">সিলেক্ট করুন</option>

                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->account_name }}</option>
                                    @endforeach

                                </select>
                                <span id="to_category_error" class="error"></span>
                            </div>
                            
                            <label class="col-md-2" id="tsub_label" style="display: none;">জমা সাব-খাত</label>
                            <div class="col-md-4" id="tsub_select" style="display: none;">
                                <select class="form-control" name="to_subcategory" id="to_subcategory">
                                    <option value="">সিলেক্ট করুন</option>

                                </select>
                                <span id="to_subcategory_error" class="error"></span>
                            </div>
                        
                        </div>
                    </div>

                    <div class="clearfix mb-20">
                        <div class="row">
                            <label class="col-md-2">টাকার পরিমান</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" name="amount" id="amount" />
                                <span id="amount_error" class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix mb-20">
                        <div class="row">
                            <label class="col-md-2">তারিখ</label>
                            <div class="col-md-4">
                                <input class="form-control"  type="text" name="transfer_date" id="transfer_date"/>
                                <span id="transfer_date_error" class="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix mb-20">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="type" id="type" value="1" />
                                <button type="submit" class="btn btn-sm btn-success pull-right" id="submit" onclick="daily_deposit_store()">সাবমিট</button>
                            </div>
                        </div>
                    </div>

                </form>   
			</div>

			

@endsection

@section('script')

	<script src="{{ asset('js/deposit_expense.min.js') }}"></script>

@endsection


