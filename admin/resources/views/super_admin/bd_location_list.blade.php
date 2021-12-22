@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-map" aria-hidden="true"></i> জেলা, উপজেলা, পোষ্ট অফিস সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">জেলা, উপজেলা, পোষ্ট অফিস সমূহের তালিকা</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

		    <div class="row">
		    	<div class="col-sm-12">
		    		 <button type="button" id="add_location" class="btn btn-info pull-right" onclick="add_bd_location()"><i class="fa fa-plus-circle"></i> যোগ করুন</button>
		    	</div>
		    </div><br>

			<!-- Export Datatable start -->

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						{{-- <div class="col-md-1"></div> --}}

						<div class="col-md-1 text-right">জেলাঃ</div>
						
						<div class="col-md-2">
							<select class="form-control custom-select2" name="district_id" id="district_id" onchange="get_location(this.value, 3, 'upazila_id')">

								<option value="">সিলেক্ট করুন</option>

								@foreach($data as $item)

								<option value="{{ $item->id }}">{{ $item->bn_name }}</option>

								@endforeach
								
							</select> 
						</div>

						<div class="col-md-1 text-right">উপজেলাঃ</div>
						
						<div class="col-md-2"> 
							<select class="form-control custom-select2" name="upazila_id" id="upazila_id" onchange="get_location(this.value, 6, 'postoffice_id')">
								<option>সিলেক্ট করুন</option>
							</select>
						</div>

						<div class="col-md-2 text-right">পোষ্ট অফিস</div>
						
						<div class="col-md-2"> 
							<select class="form-control custom-select2" name="postoffice_id" id="postoffice_id">
								<option>সিলেক্ট করুন</option>
							</select>
								
						</div>

						<div class="col-md-1" style="margin-bottom: 20px">
							<button type="submit" class="btn btn-primary" onclick="bd_locatin_search()">সার্চ করুন</button>
						</div>
					</div>

					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='bd_location_list_table'>
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>জেলা</th>
									<th>উপজেলা</th>
									<th>পোষ্ট অফিস</th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

		<!-- Export Datatable End -->

	<div class="modal fade" id="add_bdlocation_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title" id="myLargeModalLabel">নতুন লোকেশন যোগ করুন</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
                <form action="javascript:void(0)" method="post">
                    @csrf

					<div class="modal-body">

						<div class="row">
							<label  class="col-md-4 text-right">জেলা</label>

							<select name="district" id="district" class="form-control col-6" onchange="get_bd_upazila(this.value, 3)" >
								<option value="">সিলেক্ট করুন</option>
								
							</select>

						</div><br> 

						<div class="row" id="upazila_show" style="display: none;">
							
								<label  class="col-md-4 text-right">উপজেলা</label>

								<select name="upazila" id="upazila" class="form-control col-md-6" onclick="post_code_show(this.value);">
									<option value="">সিলেক্ট করুন</option>
									
								</select>
						</div><br> 

						<div class="row">
							<label  class="col-md-4 text-right">নাম(ইংরেজি)</label>

							<input name="en_name" id="en_name" class="form-control col-md-6"/>
							
							<span class="text-danger col-md-12" style="text-align: center;" id="en_name_error"></span>

						</div><br> 

						<div class="row">
							<label  class="col-md-4 text-right">নাম(বাংলা)</label>

							<input name="bn_name" id="bn_name" class="form-control col-md-6"/>
							
							<span class="text-danger col-md-12" style="text-align: center;" id="bn_name_error"></span>

						</div><br>

						<div class="row" id="show_post_code" style="display: none;">
							<label  class="col-md-4 text-right">পোষ্ট কোড</label>

							<input name="post_code" id="post_code" class="form-control col-md-6"/>
							
							<span class="text-danger col-md-12" style="text-align: center;" id="post_code_error"></span>

						</div><br> 

						<input type="hidden" name="row_id" id="row_id" />

					</div>

					<div class="modal-footer">
						

						<button type="submit" id="save_button" class="btn btn-primary" onclick="bd_location_save()">সাবমিট</button>

						<button type="submit" id="update_button" class="btn btn-warning" onclick="bd_location_update_save()">আপডেট</button>

						<button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>

					</div>

				</form>
			</div>
		</div>
	</div>



@endsection

@section('script')

	<script>

		$('document').ready(function(){

			bd_location_list();

		});


	</script>

	<script src="{{ asset('js/admin.min.js') }}"></script>

@endsection


