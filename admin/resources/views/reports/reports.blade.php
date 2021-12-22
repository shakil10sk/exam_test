@extends('layouts.app')

@section('content')

@php
	
	if ($type ==1) {
		$title = 'কর ও রেট';
	}elseif ($type == 2) {
		$title = 'গ্রাম আদালত (মাসিক)';
	}elseif ($type == 3) {
		$title = 'জন্ম নিবধ্বন (মাসিক/ ত্রৈমাসিক)';
	}elseif ($type == 4) {
		$title = 'ষান্মাসিক প্রতিবেদন';
	}elseif ($type == 5) {
		$title = 'এসওই (ত্রৈমাসিক)';
	}elseif ($type == 6) {
		$title = 'বার্ষিক আর্থিক বিবরণী';
	}elseif ($type == 7) {
		$title = 'বার্ষিক বাজেট';
	}elseif ($type == 8) {
		$title = 'বার্ষিক পরিকল্পনা';
	}elseif ($type == 9) {
		$title = 'ত্রৈবার্ষিক পরিকল্পনা';
	}elseif ($type == 10) {
		$title = 'পঞ্চবার্ষিক পরিকল্পনা';
	}else{
		$title = '';
	}

@endphp

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-home" aria-hidden="true"></i> {{ $title }}</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">সকল রিপোর্ট</li>
		                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
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
					<button type="submit" class="btn btn-primary" onclick="add_report()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
				</div>
			</div>
			@endcan	

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='report_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>টাইটেল</th>
									<th>ফাইল</th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

			<!-- Export Datatable End -->

			{{-- @can('add-project') --}}
			<div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header text-center">
							<h4 class="modal-title" id="myLargeModalLabel">নতুন যোগ করুন</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
		                <form action="javascript:void(0)" id="reportFormSubmit" method="post">
		                    @csrf
							<div class="modal-body">

								<div class="row">
									<label  class="col-md-4 text-right">টাইটেল</label>

									<input class="form-control col-md-6" type="text" name="title" id="title" required />

									<span class="text-danger col-md-12" style="text-align: center;" id="title_error"></span>

								</div><br>

								
                                <div class="row">
									<label  class="col-md-4 text-right">ফাইল</label>

									<input class="form-control col-md-6" type="file" name="file" id="file"/>

                                </div><br>
                                
                               

								<input type="hidden" name="row_id" id="row_id" />
								<input type="hidden" name="type" id="type" value="{{ $type }}" />

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
			{{-- @endcan --}}

            <div class="row">
                <div class="col-md-12">
                    @can('edit-projcet')
                        <input type="hidden" id="edit-report" value="edit">
                    @endcan

                    @can('delete-projcet')
                        <input type="hidden" id="delete-report" value="delete">		
                    @endcan
                </div>
            </div>

@endsection

@section('script')

	<script>

    var url  = $('meta[name = path]').attr("content");

    $(function () {

        var report_table = $('#report_table').DataTable({

            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,

            ajax: {

            url: "{{ route('reports', $type) }}",

            data: function (e) {}

            },

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'title', name: 'title'},

                { data: 'file', name: 'file', render:function(data, type, row){

						return "<a href='"+url+"/public/assets/reports/file/"+row.file+"' download ><button class='btn btn-sm btn-success'><i class='fa fa-download'></i> Download</button></a>"

					}
				},

                { data: 'id', name: 'id', render:function(data, type, row, meta){

                   	 	return "<a href='javascript:void(0)' class='edit btn btn-info btn-bordered-info btn-sm' onclick='report_edit("+meta.row+")' >Edit</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='report_delete("+meta.row+")' >Delete</a>"

					}
				},

            ]

        });

    });
	</script>

	<script src="{{ asset('js/reports.min.js') }}"></script>

@endsection


