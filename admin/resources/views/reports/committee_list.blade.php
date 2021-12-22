@extends('layouts.app')

@section('content')



			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-home" aria-hidden="true"></i> কমিটি সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">সকল রিপোর্ট</li>
		                        <li class="breadcrumb-item active" aria-current="page">কমিটি</li>
		                        <li class="breadcrumb-item active" aria-current="page">কমিটি সমূহ</li>
		                        {{-- <li class="breadcrumb-item active" aria-current="page">প্রকল্প সমূহ</li> --}}
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			{{-- @can('add-accounts') --}}
			<div class="row text-right">
				<div class="col-md-12" style="margin-bottom: 10px">
					<a href="{{ route('committee') }}"> <button type="button	" class="btn btn-primary" ><i class="fa fa-plus"></i> নতুন যোগ করুন</button><a/>
				</div>
			</div>
			{{-- @endcan	 --}}

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='committee_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>কমিটির নাম</th>
									<th>পর্যায়</th>
									<th>ওয়ার্ড</th>
									<th>তারিখ </th>
									<th>Action</th>
								</tr>
							</thead>

						</table>
					</div>
				</div>
			</div>

			<!-- Export Datatable End -->

			

            <div class="row">
                <div class="col-md-12">
                    {{-- @can('edit-projcet') --}}
                        <input type="hidden" id="edit-committee" value="edit">
                    {{-- @endcan --}}

                    {{-- @can('delete-projcet') --}}
                        <input type="hidden" id="delete-report" value="delete">		
                    {{-- @endcan --}}
                </div>
            </div>

@endsection

@section('script')

	<script>

    var url  = $('meta[name = path]').attr("content");

    $(function () {

        var committee_table = $('#committee_table').DataTable({

            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,

            ajax: {

            url: "{{ route('committee_list') }}",

            data: function (e) {}

            },

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name	'},
                {data: 'committee_step', name: 'committee_step', render:function(data, type, row){

					if(row.committee_step == 1){
						return 'ওয়ার্ড';
					}else{
						return 'পৌরসভা';
					}
				}},
                {data: 'ward_no', name: 'ward_no'},
                {data: 'created_time', name: 'created_time'},
               
                { data: 'id', name: 'id', render:function(data, type, row, meta){

                   	 	return "<a href='{{ url("reports/committee_edit/") }}/"+row.comm_id+"' class='edit btn btn-info btn-bordered-info btn-sm' >Edit</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='committee_delete("+meta.row+")' >Delete</a>"

					}
				},

            ]

        });

    });
	</script>

	<script src="{{ asset('js/committee.min.js') }}"></script>

@endsection


