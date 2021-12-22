@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-home" aria-hidden="true"></i> ট্রেড লাইসেন্স ফি সংশোধন </h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স ফি সংশোধন</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>



			<!-- Export Datatable start -->

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif


                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <form action="{{ route('get_trade_fee_info') }}" method="POST" >
                        @csrf

                        <div class="row">
                            {{-- <div class="col-md-1"></div> --}}
                            <div class="col-md-2">
                                <label>জেলা</label>
                                <select class="form-control" name="district_id" id="district_id" onchange="get_location(this.value, 3, 'upazila_id')">

                                    <option value="">সিলেক্ট করুন</option>

                                    @foreach($data as $item)

                                    <option value="{{ $item->id }}">{{ $item->bn_name }}</option>

                                    @endforeach

                                </select>
                            </div>


                            <div class="col-md-2">
                                <label>উপজেলা</label>
                                <select class="form-control" name="upazila_id" id="upazila_id" onchange="get_all_union(this.value, 'union_id')"  >
                                    <option>সিলেক্ট করুন</option>
                                </select>
                            </div>


                            <div class="col-md-2">
                                <label>পৌরসভা</label>
                                <select class="form-control" name="union_id" id="union_id" required>
                                    <option value="">সিলেক্ট করুন</option>
                                </select>

                            </div>


                            <div class="col-md-2">
                                <label>ভাউচার</label>
                                <input type="text" class="form-control"  name="voucher" id="voucher" required />
                            </div>

                            <div class="col-md-1" >
                            <br/>
                                <button type="submit" class="btn btn-primary" >সার্চ করুন</button>
                            </div>
                        </div>
                    </form>

                    <div class="row" style="margin-top:50px;" >
						<table class="table stripe hover multiple-select-row data-table-export nowrap fee_table" style="display: none;" >
							<thead>
								<tr>
									<th>সনদ</th>
                                    <th>ভাউচার</th>
                                    <th>ফি</th>
                                    <th>বকেয়া</th>
                                    <th>ভ্যাট</th>
                                    <th>ছাড়</th>
                                    <th>সাব চার্জ</th>
                                    <th>তারিখ</th>
									<th>Action</th>
								</tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id='credit_account'></td>
                                    <td id='debit_account'></td>
                                    <td id='voucher_no'></td>
                                    <td id='created_time'></td>
                                    <td>
                                        <input type="hidden" name="id" id="row_id" />
                                        <input type="hidden" name="unionid" id="unionid" />
                                        <input class="form-control" type="text" id='amount' />
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="update_fee()"> <i class="fa fa-pencil"></i> Update</a><button class="btn btn-danger btn-sm" onclick="delete_fee('')"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                        <span id="data_message" class="text-danger text-center" style="display: none; text-align:center;"> দুঃখিত ! কোন তথ্য খূজেঁ পাওয়া যায়নি।</span>
					</div>

				</div>
			</div>

		<!-- Export Datatable End -->




@endsection

@section('script')


	<script src="{{ asset('js/admin.min.js') }}"></script>

@endsection


