@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> সনাতন ধর্ম রেজিষ্টার সমূহ</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">সনাতন ধর্ম</li>
		                        <li class="breadcrumb-item active" aria-current="page">রেজিষ্টার</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->


			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">

					<div class="row">

						{{-- <label class="col-md-2">রেজিষ্টার ধরনঃ</label> --}}
						{{-- <div class="col-md-2"> --}}
                            <input type="hidden" name="type" id="type" value="6">
							<!-- <span id="type_error" class="error"></span> -->
						{{-- </div> --}}

						<label class="col-md-1">হতেঃ</label>
						<div class="col-md-3">
						<input type="text" name="from_date" id="from_date" value="{{ date('Y-m-d') }}" class="form-control" />
						<span id="from_date_error" class="error"></span>
						</div>

						<label class="col-md-1">পর্যন্তঃ</label>
						<div class="col-md-3">
						<input type="text" name="to_date" id="to_date" value="{{ date('Y-m-d') }}" class="form-control"  />
						<span id="to_date_error" class="error"></span>
						</div>
						&nbsp;&nbsp;
						<input  type="button" name="" value="  সার্চ" class="btn btn-primary" onclick="register_show()">

					</div>

				</div>
			</div>



@endsection

@section('script')

	<script src="{{ asset('js/accounts.js') }}"></script>

@endsection


