@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> একাউন্ট সমূহের তালিকা</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
		                        <li class="breadcrumb-item active" aria-current="page">সেটিংস</li>
		                        <li class="breadcrumb-item active" aria-current="page">নতুন একাউন্ট</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			@can('add-accounts')
			<div class="row text-right">
				<div class="col-md-12" style="margin-bottom: 10px">
					<button type="submit" class="btn btn-primary" onclick="add_account()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
				</div>
			</div>
			@endcan	

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">

					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='account_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>একাউন্ট নাম</th>
									<th>নাম্বার</th>
									<th>ওপেনিং ব্যালেন্স</th>
									{{-- <th>মোট ব্যালেন্স</th> --}}
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

			<!-- Export Datatable End -->

			@can('add-accounts')
			<div class="modal fade" id="account_save_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header text-center">
							<h4 class="modal-title" id="myLargeModalLabel">নতুন একাউন্ট সংযোজন</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
		                <form action="javascript:void(0)" method="post">
		                    @csrf
							<div class="modal-body">

								<div class="row">
									<label  class="col-md-4 text-right">একাউন্ট হেড</label>

									<select name="head_type" id="head_type" class="form-control col-md-6">
										<option value="">সিলেক্ট করুন</option>

										@foreach ($data as $item)

										<option value="{{ $item->id}}">{{ $item->account_name }}</option>

										@endforeach
										
									</select>

								</div><br> 


								<div class="row">
									<label  class="col-md-4 text-right">একাউন্ট নাম</label>

									<input class="form-control col-md-6" type="text" name="account_name" id="account_name" />

									<span class="text-danger col-md-12" style="text-align: center;" id="account_name_error"></span>

								</div><br>

								<div class="row">
									<label  class="col-md-4 text-right">কোড</label>

									<input class="form-control col-md-6" type="text" name="account_code" id="account_code"/>

									<span class="text-danger col-md-12" style="text-align: center;" id="account_code_error"></span>

								</div><br>

								<div class="row">
									<label  class="col-md-4 text-right">ওপেনিং ব্যালেন্স</label>

									<input class="form-control col-md-6" type="text" name="opening_balance" id="opening_balance"/>

								</div><br>


							

								<input type="hidden" name="row_id" id="row_id" />
								<input type="hidden" name="transection_id" id="transection_id" />

							</div>
							<div class="modal-footer">
							

								<button type="submit" id="save_button" class="btn btn-primary" onclick="account_save()">সাবমিট</button>

								<button type="submit" id="update_button" class="btn btn-warning" onclick="account_update()">আপডেট</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			@endcan

	<div class="row">
		<div class="col-md-12">
			@can('edit-accounts')
				<input type="hidden" id="edit-accounts" value="edit">
			@endcan

			@can('delete-accounts')
				<input type="hidden" id="delete-accounts" value="delete">		
			@endcan
		</div>
	</div>

@endsection

@section('script')

	<script>

		$('document').ready(function(){

			account_list();

		});

	</script>

	<script src="{{ asset('js/accounts_settings.min.js') }}"></script>

@endsection


