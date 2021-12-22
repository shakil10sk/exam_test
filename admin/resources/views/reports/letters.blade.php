@extends('layouts.app')

@section('content')

@php
	
	if ($type ==1) {
		$title = 'পত্র জারি রেজিষ্টার';
	}elseif ($type == 2) {
		$title = 'পত্র প্রাপ্তি রেজিষ্টার';
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
					<button type="submit" class="btn btn-primary" onclick="add_letter()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
				</div>
			</div>
			@endcan	

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='letter_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th><?php echo ($type == 1)? 'বিলির' : 'প্রাপ্তি' ?> তারিখ</th>
									<th><?php echo ($type == 1)? 'বিলিকৃত' : 'প্রাপ্ত' ?> চিঠির নং ও তারিখ</th>
									<th>কোন  <?php echo ($type == 1)? 'অফিসে প্রেরিত' : 'অফিস হতে প্রাপ্ত' ?> </th>
									<th>জবাব নং ও তারিখ </th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

			<!-- Export Datatable End -->

			<div class="modal fade bs-example-modal-lg" id="letter_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="myLargeModalLabel">{{ $title }}</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<form action="javascript:void(0)" id="letterFormSubmit" method="post">
		                    @csrf
							<div class="modal-body">

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label><?php echo ($type == 1)? 'বিলির' : 'প্রাপ্তি' ?>  তারিখ</label>
											<input type="text" class="form-control date" name="accept_send_date" id="accept_send_date" required>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label><?php echo ($type == 1)? 'বিলিকৃত' : 'প্রাপ্ত' ?>  চিঠির নং ও তারিখ</label>
											<input type="text" class="form-control date" name="acc_send_no_date" id="acc_send_no_date" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>কোন <?php echo ($type == 1)? 'অফিসে প্রেরিত' : 'অফিস হতে প্রাপ্ত' ?> </label>
											<input type="text" class="form-control" name="office" id="office" required >
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>জবাব নং ও তারিখ</label>
											<input type="text" class="form-control" name="repley_no_date" id="repley_no_date" >
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label><?php echo ($type == 1) ? 'বিলিকৃত' : 'প্রাপ্ত' ?>  চিঠির সংক্ষিপ্ত বিবরণ</label>
											<textarea type="text" name="description" id="description" class="form-control"></textarea>
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

        var letter_table = $('#letter_table').DataTable({

            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,

            ajax: {

            url: "{{ route('letters', $type) }}",

            data: function (e) {}

            },

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'accept_send_date', name: 'accept_send_date'},
                {data: 'acc_send_no_date', name: 'acc_send_no_date'},
                {data: 'office', name: 'office'},
                {data: 'repley_no_date', name: 'repley_no_date'},


                { data: 'file', name: 'file', render:function(data, type, row){

						return "<a href='"+url+"/public/assets/reports/file/"+row.file+"' download ><button class='btn btn-sm btn-success'><i class='fa fa-download'></i> Download</button></a>"

					}
                },

                { data: 'id', name: 'id', render:function(data, type, row, meta){

                   	 	return "<a href='javascript:void(0)' class='edit btn btn-info btn-bordered-info btn-sm' onclick='letter_edit("+meta.row+")' >Edit</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='letter_delete("+meta.row+")' >Delete</a>"

					}
				},

            ]

        });

    });
	</script>

	<script src="{{ asset('js/reports.min.js') }}"></script>

@endsection


