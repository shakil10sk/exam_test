@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> পৌরসভা সমূহের তালিকা</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">পৌরসভা তালিকা</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

		    <div class="row">
		    	<div class="col-sm-12">
		    		<a href="{{ route('union_add') }}" target="_blank" class="btn btn-info pull-right"><i class="fa fa-plus"> </i> পৌরসভা যোগ করুন</a>
		    	</div>
		    </div><br>

			<!-- Export Datatable start -->

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						{{-- <div class="col-md-1"></div> --}}

						<div class="col-md-1 text-right">জেলাঃ</div>

						<div class="col-md-2">
							<select class="form-control" name="district_id" id="district_id" onchange="get_location(this.value, 3, 'upazila_id')">

								<option value="">সিলেক্ট করুন</option>

								@foreach($data as $item)

								<option value="{{ $item->id }}">{{ $item->bn_name }}</option>

								@endforeach

							</select>
						</div>

						<div class="col-md-1 text-right">উপজেলাঃ</div>

						<div class="col-md-2">
							<select class="form-control" name="upazila_id" id="upazila_id">
								<option>সিলেক্ট করুন</option>
							</select>
						</div>

						<div class="col-md-2 text-right">পৌরসভা কোডঃ</div>

						<div class="col-md-2">
							<input class="form-control" type="text" name="union_code" id="union_code"/>

						</div>

						<div class="col-md-1" style="margin-bottom: 20px">
							<button type="submit" class="btn btn-primary" onclick="union_list_search()">সার্চ করুন</button>
						</div>
					</div>

					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='union_list_table'>
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>পৌরসভা কোড</th>
									<th>পৌরসভা নাম</th>
									<th>ইউজারনেম</th>
									<th>সাব-ডোমেইন</th>
									<th>মোবাইল</th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

		<!-- Export Datatable End -->




@endsection

@section('script')

	<script src="{{ asset('js/admin.min.js') }}"></script>

	<script>

		$('document').ready(function(){

			union_list();

		});

		$('body').on('click', '.delete_union_btn', function(){

			let id = $(this).data('id');
			swal({
				title: "অনুমোদন",
				text: "আপনি কি ডিলিট করতে চান?",
				type: "warning",
				showConfirmButton: true,
				confirmButtonText: "হ্যাঁ",
				showCancelButton: true,
				cancelButtonText: "না",
				showLoaderOnConfirm: true,
				preConfirm: function() {
					window.location.href= url+"/super_admin/union-delete/"+id;
				}
			});
		});

	</script>


@endsection


