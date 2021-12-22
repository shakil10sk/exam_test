@extends('layouts.app')

@section('content')
	<div class="page-header">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="title">
					<h4><i class="icon-copy fa fa-home" aria-hidden="true"></i> অর্থবছর</h4>
				</div>
				<nav aria-label="breadcrumb" role="navigation">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
						<li class="breadcrumb-item active" aria-current="page">অর্থবছর</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>

	<!-- Export Datatable start -->

	<div class="row text-right">
		<div class="col-md-12" style="margin-bottom: 10px">
			<button type="submit" class="btn btn-primary" onclick="add_fiscal_year()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
		</div>
	</div>
		

	<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
		<div class="clearfix mb-20">
			<div class="row">
				<table class="stripe hover multiple-select-row data-table-export nowrap" id='fiscal_year_table'>

					<thead>
						<tr>
							<th class="table-plus datatable-nosort">নং</th>
							<th>আইডি</th>
							<th>অর্থবছর</th>
							<th>মেয়াদ উত্তীর্নের তারিখ</th>
							<th>কারেন্ট অর্থবছর</th>
							<th>Action</th>
						</tr>
					</thead>

				</table>
			</div>
		</div>
	</div>

	<!-- Export Datatable End -->


	<div class="modal fade" id="fiscal_year_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title" id="myLargeModalLabel">নতুন যোগ করুন</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="javascript:void(0)" id="fiscalYearFormSubmit" method="POST" >
					@csrf
					<div class="modal-body">

						<div class="row">
							<label  class="col-md-4 text-right">অর্থবছর</label>

							<input class="form-control col-md-6" type="text" name="name" id="name" required />

							<span class="text-danger col-md-12" style="text-align: center;" id="name_error"></span>

						</div><br>

						
						<div class="row">
							<label  class="col-md-4 text-right">মেয়াদ উত্তীর্নের তারিখ</label>

							<input class="form-control col-md-6" autocomplete="off" type="text" name="expire_date" id="expire_date" required/>
							
							<span class="text-danger col-md-12" style="text-align: center;" id="expire_date_error"></span>

						</div><br>


						<div class="row">
							<label  class="col-md-4 text-right">ইজ কারেন্ট ?</label>

							<input type="checkbox" name="is_current" id="is_current" />

						</div><br>

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
			
			<input type="hidden" id="edit-fiscal" value="edit">

			<input type="hidden" id="delete-fiscal" value="delete">		
			
		</div>
	</div>

@endsection

@section('script')

	<script>

    var url  = $('meta[name = path]').attr("content");

    $(function () {

        var fiscal_year_table = $('#fiscal_year_table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
            	url: "{{ route('fiscal_year_list') }}",
            	data: function (e) {}
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'expire_date', name: 'expire_date'},
                {data: 'name', name: 'name', render:function(data, type, row){

                    if(row.is_current == 1){
                        return "<span class='badge badge-success'>বর্তমান অর্থবছর</span>";
                    }else{
                        return " ";
                    }
                }},

                {
					data: 'id',
					name: 'id',
					render: function(data, type, row, meta){
						return "<a href='javascript:void(0)' class='edit btn btn-info btn-bordered-info btn-sm' onclick='fiscal_year_edit("+meta.row+")' >Edit</a>";
					}
				},
            ]
        });
	});
	
	$('#expire_date').datepicker({
		autoClose: true,
		dateFormat: 'yy-06-30',
	});
	</script>

	<script src="{{ asset('js/fiscal_year.min.js') }}"></script>

@endsection


