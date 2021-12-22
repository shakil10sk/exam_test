@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> এসেসমেন্ট তালিকা</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্ট</li>
		                        <li class="breadcrumb-item active" aria-current="page"> এসেসমেন্ট তালিকা</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			@can('add-home')
		    <div class="row mb-3">
		    	<div class="col-sm-12">
		    		<a href="{{ route('assesment_application') }}" target="_blank" class="btn btn-info pull-right"><i class="fa fa-plus"> </i> বসতভিটা যোগ করুন</a>
		    	</div>
			</div>
			@endcan

			<!-- Export Datatable start -->

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						<div class="col-md-1"></div>

						<div class="col-md-1 text-right">অর্থ বছর:</div>
						
						<div class="col-md-2">
							<select class="form-control" name="fiscal_year_id" id="fiscal_year_id">
								
								@foreach ($fiscal_years as $item)
									
								<option value="{{ $item->id }}" {{ ($item->is_current == 1) ? 'selected' : '' }} >{{ $item->name }}</option>
								@endforeach
								
							</select> 
						</div>

						<div class="col-md-1 text-right">ওয়ার্ড নং</div>
						
						<div class="col-md-2"> 
							<input type="text" name="ward_no" id="ward_no"  class="form-control">
						</div>

						<div class="col-md-1 text-right">হোল্ডিং নং</div>
						
						<div class="col-md-2"> 
							<input type="text" name="holding_no" id="holding_no"  class="form-control">
						</div>

						<div class="col-md-1" style="margin-bottom: 20px">
							<button type="submit" class="btn btn-primary" onclick="assesment_list_search()">সার্চ করুন</button>
						</div>
					</div>

					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='assesment_list_table'>
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>মালিকের নাম</th>
									<th>পিন</th>
									<th>হোল্ডিং</th>
									<th>ওয়ার্ড</th>
									<th>হালসনের কর</th>
									{{-- <th>বকেয়া কর</th> --}}
									{{-- <th>মোট কর</th> --}}
									<th>স্ট্যাটাস</th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

		<!-- Export Datatable End -->

		@can('add-home-tax')
		<div class="modal fade" id="house_tax_collection_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title" id="myLargeModalLabel">বসতভিটার কর আদায়</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
                <form action="javascript:void(0)" method="post">
                    @csrf
					<div class="modal-body">

						<div class="row">
							<label  class="col-md-4 text-right">পিন</label>

							<input class="form-control col-md-6" type="text" name="pin" id="pin" readonly="readonly" />
						</div><br>

						<div class="row">
							<label  class="col-md-4 text-right">মালিকের নাম</label>

							<input class="form-control col-md-6" type="text" name="name" id="name" readonly="readonly" />
						</div><br>


						<div class="row">
							<label  class="col-md-4 text-right">হালসনের কর</label>

							<input class="form-control col-md-6" type="text" name="halson_tax" id="halson_tax" value="0.00" readonly="readonly" />

						</div><br>

						<div class="row">
							<label  class="col-md-4 text-right">বকেয়া কর</label>

							<input class="form-control col-md-6" type="text" name="due_tax" id="due_tax" onchange="discount_calculation()" />

						</div><br>

						<div class="row">
							<label  class="col-md-4 text-right">ছাড়</label>

							<input class="form-control col-md-6" type="text" name="discount" id="discount" value="0.00" onchange="discount_calculation()" />

						</div><br>

						<div class="row">
							<label  class="col-md-4 text-right">কর</label>

							<input class="form-control col-md-6" type="text" name="kor" id="kor" value="0.00" readonly="readonly" />

						</div><br>

						<div class="row">
							<label  class="col-md-4 text-right">তারিখ</label>

							<input class="form-control col-md-6" type="text" name="generate_date" id="generate_date" value="{{ date('Y-m-d') }}" />
						</div><br>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" onclick="house_tax_save()">সাবমিট</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
					</div>
				</form>
				</div>
			</div>
		</div>
		@endcan


		<div class="row">
			<div class="col-md-12">
				@can('add-home-tax')
					<input type="hidden" id="add-home-tax" value="add">
				@endcan

				@can('edit-home')
					<input type="hidden" id="edit-home" value="edit">
				@endcan
	
				@can('home-tax-invoice')
					<input type="hidden" id="home-tax-invoice" value="invoice">
				@endcan
				
				@can('delete-home')
					<input type="hidden" id="delete-home" value="delete">		
				@endcan
			</div>
		</div>



@endsection

@section('script')
	<script>
		$('document').ready(function(){
			assesment_list();
		});
	</script>

	<script src="{{ asset('js/assesment.min.js') }}"></script>
@endsection


