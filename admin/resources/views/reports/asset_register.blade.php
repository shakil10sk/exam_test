@extends('layouts.app')

@section('content')



			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-home" aria-hidden="true"></i> স্থায়ী সম্পত্তি রেজিষ্টার</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">সকল রিপোর্ট</li>
		                        <li class="breadcrumb-item active" aria-current="page">স্থায়ী সম্পত্তি রেজিষ্টার</li>
		                        {{-- <li class="breadcrumb-item active" aria-current="page">প্রকল্প সমূহ</li> --}}
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			@can('add-accounts')
			<div class="row text-right">
				<div class="col-md-12" style="margin-bottom: 10px">
					<button type="submit" class="btn btn-primary" onclick="add_asset()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
				</div>
			</div>
			@endcan	

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='asset_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>সম্পদের নাম ও অবস্থান</th>
									<th>নির্মাণ বা ক্রয়ের তারিখ</th>
									<th>মূল্য</th>
									<th>তহবিলের উৎস</th>
									<th>ব্যয়িত অর্থের পরিমাণ</th>
									<th>ফাইল</th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

			<!-- Export Datatable End -->

			<div class="modal fade bs-example-modal-lg" id="asset_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">স্থায়ী সম্পত্তি রেজিষ্টার</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<form action="javascript:void(0)" id="assetFormSubmit" method="post">
		                    @csrf
							<div class="modal-body">

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>সম্পদের নাম ও অবস্থান</label>
											<input type="text" class="form-control" name="asset_name_point" id="asset_name_point" required >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>নির্মাণ বা ক্রয়ের তারিখ</label>
											<input type="text" class="form-control" name="create_buy_date" id="create_buy_date" required >
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>মূল্য</label>
											<input type="text" class="form-control" name="rate" id="rate" required >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>তহবিলের উৎস</label>
											<input type="text" class="form-control" name="stock_source" id="stock_source" required >
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>সর্বশেষ রক্ষনাবেক্ষনের তারিখ </label>
											<input type="text" class="form-control" name="last_care_date" id="last_care_date" required >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>ব্যয়িত অর্থের পরিমাণ</label>
											<input type="text" class="form-control" name="expence_amount" id="expence_amount" required >
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>রক্ষনাবেক্ষনে ব্যয়িত অর্থের উৎস</label>
											<input type="text" class="form-control" name="care_expense_source" id="care_expense_source" >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>পরবর্তী রক্ষনাবেক্ষনের তারিখ</label>
											<input type="text" class="form-control" name="next_care_date" id="next_care_date" >
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>ফাইল</label>
											<input type="file" name="file" id="file" class="form-control">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>মন্তব্য</label>
											<input type="text" class="form-control" name="comment" id="comment" >
										</div>
									</div>
								</div>


								<input type="hidden" name="row_id" id="row_id" />


							</div>
						
							<div class="modal-footer">
								<button type="submit" id="save_button" class="btn btn-primary" >সাবমিট</button>
								<button type="submit" id="update_button" class="btn btn-warning" >আপডেট</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
							</div>
					</form>
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-md-12">
                    @can('edit-projcet')
                        <input type="hidden" id="edit-asset" value="edit">
                    @endcan

                    @can('delete-projcet')
                        <input type="hidden" id="delete-asset" value="delete">		
                    @endcan
                </div>
            </div>

@endsection

@section('script')

	<script>

    var url  = $('meta[name = path]').attr("content");

    $(function () {

        var asset_table = $('#asset_table').DataTable({

            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,

            ajax: {

            url: "{{ route('asset_register') }}",

            data: function (e) {}

            },

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'asset_name_point', name: 'asset_name_point'},
                {data: 'create_buy_date', name: 'create_buy_date'},
                {data: 'rate', name: 'rate'},
                {data: 'stock_source', name: 'stock_source'},
                {data: 'expence_amount', name: 'expence_amount'},


                { data: 'file', name: 'file', render:function(data, type, row){

						return "<a href='"+url+"/public/assets/reports/file/"+row.file+"' download ><button class='btn btn-sm btn-success'><i class='fa fa-download'></i> Download</button></a>"

					}
                },

                { data: 'id', name: 'id', render:function(data, type, row, meta){

                   	 	return "<a href='javascript:void(0)' class='edit btn btn-info btn-bordered-info btn-sm' onclick='asset_edit("+meta.row+")' >Edit</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='asset_delete("+meta.row+")' >Delete</a>"

					}
				},

            ]

        });

    });
	</script>

	<script src="{{ asset('js/reports.min.js') }}"></script>

@endsection


