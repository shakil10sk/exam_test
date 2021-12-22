@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> সকল প্রকল্প সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
		                        <li class="breadcrumb-item active" aria-current="page">সেটিংস</li>
		                        <li class="breadcrumb-item active" aria-current="page">প্রকল্প সমূহ</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			@can('add-accounts')
			<div class="row text-right">
				<div class="col-md-12" style="margin-bottom: 10px">
					<button type="submit" class="btn btn-primary" onclick="add_project()"><i class="fa fa-plus"></i> নতুন যোগ করুন</button>
				</div>
			</div>
			@endcan	

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id='project_table'>

							<thead>
								<tr>
									<th class="table-plus datatable-nosort">নং</th>
									<th>টাইটেল</th>
									<th>পূর্বের ছবি</th>
									<th>পরের ছবি</th>
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
			<div class="modal fade" id="project_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header text-center">
							<h4 class="modal-title" id="myLargeModalLabel">প্রকল্প যোগ করুন</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
		                <form action="javascript:void(0)" id="formsubmit" method="post">
		                    @csrf
							<div class="modal-body">

								<div class="row">
									<label  class="col-md-4 text-right">প্রকল্পের টাইটেল</label>

									<input class="form-control col-md-6" type="text" name="title" id="title" required />

									<span class="text-danger col-md-12" style="text-align: center;" id="title_error"></span>

								</div><br>

								<div class="row">
									<label  class="col-md-4 text-right">পূর্বের ছবি</label>

									<input class="form-control col-md-6" type="file" name="pre_photo" id="pre_photo"/>

									<span class="text-danger col-md-12" style="text-align: center;" id="pre_photo_error"></span>

								</div><br>

								<div class="row">
									<label  class="col-md-4 text-right">পরের ছবি</label>

									<input class="form-control col-md-6" type="file" name="final_photo" id="final_photo"/>
                                    <span class="text-danger col-md-12" style="text-align: center" id="final_photo_error"></span>
                                </div><br>

                                <div class="row">
									<label  class="col-md-4 text-right">ফাইল</label>

									<input class="form-control col-md-6" type="file" name="file" id="file"/>

                                </div><br>
                                
                                <div class="row">
									<label  class="col-md-4 text-right">বিস্তারিত</label>

									<input class="form-control col-md-6" type="text" name="description" id="description"/>

								</div><br>

								<input type="hidden" name="row_id" id="row_id" />

							</div>
							<div class="modal-footer">
							
								<button type="submit" id="save_button" class="btn btn-primary" >সাবমিট</button>

								<button type="submit" id="update_button" class="btn btn-warning" onclick="project_update()">আপডেট</button>
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
                        <input type="hidden" id="edit-project" value="edit">
                    @endcan

                    @can('delete-projcet')
                        <input type="hidden" id="delete-project" value="delete">		
                    @endcan
                </div>
            </div>

@endsection

@section('script')

	<script>

	var url  = $('meta[name = path]').attr("content");

    $(function () {

        var project_table = $('#project_table').DataTable({

            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,

            ajax: {

            url: "{{ route('projects') }}",

            data: function (e) {}

            },

            columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},

                {data: 'title', name: 'title'},

                { data: 'pre_photo', name: 'pre_photo', render:function(data, type, row){

						return "<img width='50px' height='50px' src='"+url+"/public/assets/reports/photo/"+row.pre_photo+"' />"

					}
				},

                { data: 'final_photo', name: 'final_photo', render:function(data, type, row){

						return "<img width='50px' height='50px' src='"+url+"/public/assets/reports/photo/"+row.final_photo+"' />"

					}
				},

                { data: 'file', name: 'file', render:function(data, type, row){
						return "<a href='"+url+"/public/assets/reports/file/"+row.file+"' download='"+row.file+"' ><button class='btn btn-sm btn-success'><i class='fa fa-download'></i> Download</button></a>"

					}
				},

                { data: 'id', name: 'id', render:function(data, type, row, meta){

                   	 	return "<a href='javascript:void(0)' class='edit btn btn-info btn-bordered-info btn-sm' onclick='project_edit("+meta.row+")' >Edit</a> <a href='javascript:void(0)' class='edit btn btn-danger btn-sm' onclick='project_delete("+meta.row+")' >Delete</a>"

					}
				},

            ]

        });

    });
	</script>

	<script src="{{ asset('js/reports.min.js') }}"></script>

@endsection


