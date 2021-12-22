@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> কমিটি</h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">সকল রিপোর্ট</li>
		                        <li class="breadcrumb-item active" aria-current="page">কমিটি</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
		    </div>

			<!-- Export Datatable start -->
			

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif


                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>	
                            <strong>{{ $message }}</strong>
                    </div>
                @endif


                <form action="{{ route('committee_save') }}" method="POST">
                    @csrf
                    <div class="clearfix mb-20">

                        <div class="row">
                            <label class="col-md-2">কমিটির নাম</label>
                            <div class="col-md-4">
                                <select class="form-control" name="committee_name" id="committee_name" required >
                                    <option value="">সিলেক্ট করুন</option>
                                    @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                   
                                </select>
                                <span id="committee_name_error" class="error"></span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="clearfix mb-20">
                        <div class="row">
                            <label class="col-md-2">কমিটির পর্যায়</label>
                            <div class="col-md-4">
                                <select class="form-control" name="committee_step" id="committee_step" required >
                                    <option value="">সিলেক্ট করুন</option>
                                    <option value="1">ওয়ার্ড</option>
                                    <option value="2">পৌরসভা</option>
                                    
                                </select>
                                <span id="committee_step_error" class="error"></span>
                            </div>
                            
                            <label class="col-md-1" >ওয়ার্ড</label>
                            <div class="col-md-4">
                                <select class="form-control" name="ward_no" id="ward_no">
                                    <option value="">সিলেক্ট করুন</option>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                    <option value="9" >9</option>
                                </select>
                                <span id="ward_no_error" class="error"></span>
                            </div>
                        
                        </div>
                    </div>

                    <div class="clearfix mb-20">
                        <div class="row">
                            <table class="table table-bordered table-hover" id="table_append">
                                <thead>
                                    <tr>
                                        <th>সদস্যের নাম</th>
                                        <th>পদবী</th>
                                        <th>ঠিকানা</th>
                                        <th>মোবাইল</th>
                                        <th>ইমেইল</th>
                                        <th>ন্যাশনাল আইডি</th>
                                        <th>সামাজিক অবস্থান</th>	
                                    </tr>	
                                </thead>
                                <tbody>
                                    <tr id='info0'>						
                                    
                                        <td><input type="text" name='member_name[]' class="form-control" required/></td>
                                        <td><input type="text" name='designation[]' class="form-control" required/></td>
                                        <td><input type="text" name='address[]' class="form-control"/></td>
                                        <td><input type="text" name='mobile[]' class="form-control" required/></td>
                                        <td><input type="text" name='email[]' class="form-control"/></td>
                                        <td><input type="text" name='national_id[]' class="form-control"/></td>
                                        <td><input type="text" name='social_status' class="form-control"/></td>	
                                    </tr>
                                    <tr id='info1'></tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                 <button id="add_row" class="btn btn-sm btn-info pull-right">নতুন যোগ করুন</button>&nbsp;&nbsp;&nbsp;<button id='delete_row' class="pull-right btn btn-sm btn-danger"> ডিলিট করুন</button>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix mb-20">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="type" id="type" value="1" />
                                <button type="submit" class="btn btn-sm btn-success pull-right" id="submit" onclick="daily_deposit_store()">সাবমিট</button>
                            </div>
                        </div>
                    </div>

                </form>   
			</div>

			

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            var i=1;

            $("#add_row").click(function(){

                $('#info'+i).html("<td><input name='member_name[] "+i+"' type='text' class='form-control input-md' required /> </td><td><input name='designation[] "+i+"' type='text' class='form-control input-md' required/> </td><td><input name='address[] "+i+"' type='text' class='form-control input-md' required /> </td><td><input name='mobile[] "+i+"' type='text' class='form-control input-md'  /> </td><td><input name='email[] "+i+"' type='email' class='form-control input-md'  /> </td><td><input name='national_id[] "+i+"' type='text' class='form-control input-md'  /> </td><td><input name='social_status[] "+i+"' type='text' class='form-control input-md'  /> </td>");

                $('#table_append').append('<tr id="info'+(i+1)+'"></tr>');
                i++; 
            });

            $("#delete_row").click(function(){
                if(i>1){
                    $("#info"+(i-1)).html('');
                    i--;
                }
            });
        });
    </script>	

	<script src="{{ asset('js/committee.min.js') }}"></script>

@endsection


