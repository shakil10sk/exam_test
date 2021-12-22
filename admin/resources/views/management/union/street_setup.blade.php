@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-map" aria-hidden="true"></i> পৌরসভার রাস্তা সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">রাস্তা সমূহের তালিকা</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

		    <div class="row">
		    	<div class="col-sm-12">
		    		 <button type="button" id="add_location" class="btn btn-info pull-right" onclick="add_street()"><i
                             class="fa fa-plus-circle"></i> যোগ করুন</button>
		    	</div>

                <table id="street_list" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>বাংলা নাম</th>
                        <th>ইংরেজি নাম</th>
                        <th>অ্যাকশান</th>
                    </tr>
                    </thead>

                    <tbody>
                    </tbody>

                </table>
		    </div><br>

			<!-- Export Datatable start -->



		<!-- Export Datatable End -->

	<div class="modal fade" id="street_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" >
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title" id="myLargeModalLabel">যোগ করুন</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
                <form action="javascript:void(0)" method="post">
                    @csrf

					<div class="modal-body">


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

						<input type="hidden" name="row_id" id="row_id" />

					</div>

					<div class="modal-footer">


						<button type="submit" id="save_button" class="btn btn-primary" onclick="streetStore()">সাবমিট</button>

						<button type="submit" id="update_button" class="btn btn-warning" onclick="streetUpdate()">আপডেট</button>

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

            streetList();

		});


	</script>

	<script src="{{ asset('js/admin.js') }}"></script>

@endsection


