@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> ফান্ড যোগ করুন</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
		                        <li class="breadcrumb-item active" aria-current="page">সেটিংস</li>
		                        <li class="breadcrumb-item active" aria-current="page">ফান্ড যোগ</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			@can('add-accounts')
			<div class="row text-right">
				<div class="col-md-12" style="margin-bottom: 10px">
					<button type="submit" class="btn btn-primary" onclick="add_fund()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
				</div>
			</div>
			@endcan	

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">

					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='fund_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>ফান্ডের নাম</th>
									<th>টাকার পরিমান</th>
									<th>মন্তব্য</th>
									<th>তারিখ</th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

			<!-- Export Datatable End -->

			@can('add-accounts')
			<div class="modal fade" id="fund_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header text-center">
							<h4 class="modal-title" id="myLargeModalLabel">ফান্ড যোগ</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
		                <form action="javascript:void(0)" method="post">
		                    @csrf
							<div class="modal-body">

								<div class="row">
									<label  class="col-md-4 text-right">প্রধান খাত</label>
									<div class="col-md-6">
										<select name="head" id="head" class="form-control" onchange="get_subcategoy(this.value,'sub_select', 'sub_label', 'sub_select')" >
											<option value="">সিলেক্ট করুন</option>

											@foreach ($data as $item)

											<option value="{{ $item->id}}">{{ $item->account_name }}</option>

											@endforeach
										
										</select>
										<span class="error" id="head_error"></span>
									</div>

								</div><br> 

								<div class="row" >
									<label  class="col-md-4 text-right" id="sub_label" style="display: none;">সাব-খাত</label>
									
										<select name="sub_head" id="sub_select" class="sub_head  form-control col-md-6" style="display: none;">
											<option value="">সিলেক্ট করুন</option>
										</select>

										<span class="error col-md-12 text-center" id="sub_head_error"></span>
									
								</div><br> 


								<div class="row">
									<label  class="col-md-4 text-right">টাকার পরিমান</label>

									<div class="col-md-6">
										<input class="form-control" type="text" name="amount" id="amount"/>
										<span class="error" id="amount_error"></span>
									</div>
									
								</div><br>

								<div class="row">
									<label  class="col-md-4 text-right">মন্তব্য</label>
									<div class="col-md-6">
										<input class="form-control" type="text" name="comment" id="comment"/>
										<span class="error" id="comment_error"></span>
									</div>
								</div><br>

								<input type="hidden" name="row_id" id="row_id" />
								<input type="hidden" name="transection_id" id="transection_id" />

							</div>
							<div class="modal-footer">
							

								<button type="submit" id="save_button" class="btn btn-primary" onclick="fund_store()">সাবমিট</button>

								<button type="submit" id="update_button" class="btn btn-warning" onclick="fund_update_save()">আপডেট</button>
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
				<input type="hidden" id="edit_fund" value="edit">
			@endcan

			@can('delete-accounts')
				<input type="hidden" id="delete_fund" value="delete">		
			@endcan
		</div>
	</div>

@endsection

@section('script')

	<script>



		$('document').ready(function(){

			fund_list();

		});

	</script>


	<script src="{{ asset('js/accounts_settings.min.js') }}"></script>

@endsection


