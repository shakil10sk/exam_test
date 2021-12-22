@extends('layouts.app')

@section('content')

			<div class="page-header">
		        <div class="row">
		            <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4><i class="icon-copy fa fa-home" aria-hidden="true"></i> ট্রেড লাইসেন্স ফি সংশোধন </h4>
                        </div>
		                <nav aria-label="breadcrumb" role="navigation">
		                    <ol class="breadcrumb">
		                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
		                        <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স ফি সংশোধন</li>
		                    </ol>
		                </nav>
		            </div>
		        </div>
            </div>
            

			<!-- Export Datatable start -->

			<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
				<div class="clearfix mb-20">
					<div class="row">

                        @if(!empty($data))
                        <div class="modal-body">
                            <form action="{{ route('trade_fee_update_save') }}" method="post">
                                @csrf
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-4 text-right">লাইসেন্স ফি</label>
        
                                            <input class="form-control col-md-7" type="text" name="fee" value="<?php echo  (isset($data[19])) ? $data[19]['amount'] : null; ?>"  id="fee" onchange="calculation()" />

                                            <input type="hidden" name="fee_id" id="fee_id" value="<?php echo  (isset($data[19])) ? $data[19]['transection_id'] : 0; ?>"/>
        
                                            <span class="error" id="fee_error"></span>
                                        </div>
                                        </br>
        
                                        <div class="row">
                                            <label class="col-md-4 text-right">বকেয়া</label>
        
                                            <input class="form-control col-md-7" type="text" name="due" id="due" value="<?php echo  (isset($data[23])) ? $data[23]['amount'] : null; ?>" onchange="calculation()" />

                                            <input type="hidden" name="due_id" id="due_id" value="<?php echo  (isset($data[23])) ? $data[23]['transection_id'] : 0; ?>"/>
                                        </div>
                                        </br>
        
                                        <div class="row">
                                            <label class="col-md-4 text-right">বকেয় অর্থ বছর</label>
        
                                            <input class="form-control col-md-7" type="text" name="due_fiscal_year" id="due_fiscal_year"  placeholder="2018-2019" value="{{ $other_data['due_fiscal_year'] }}" />
        
                                            <span class="error" id="due_fiscal_year_error"></span>
                                        </div>
                                        </br>
        
                                            <div class="row">
                                            <label class="col-md-4 text-right">ছাড়</label>
        
                                            <input class="form-control col-md-7" type="text" name="discount" id="discount" value="<?php echo  (isset($data[24])) ? $data[24]['amount'] : null; ?>" onchange="calculation()" placeholder="কোন ছাড় দিতে চাইলে" />

                                            <input type="hidden" name="discount_id" id="discount_id" value="<?php echo  (isset($data[24])) ? $data[24]['transection_id'] : 0; ?>"/>
                                            
                                        </div>
                                        </br>
        
                                        <div class="row">
                                            <label class="col-md-4 text-right">ভ্যাট(১৫%)</label>
        
                                            <input class="form-control col-md-7" type="text" name="vat" id="vat" value="<?php echo  (isset($data[25])) ? $data[25]['amount'] : null; ?>" readonly="readonly" />
                                            
                                            <input type="hidden" name="vat_id" id="vat_id" value="<?php echo  (isset($data[25])) ? $data[25]['transection_id'] : 0; ?>"/>
                                        </div>
                                        </br>
        
                                    </div>

                                    <div class="col-md-6">

                                        <div class="row">
                                            <label class="col-md-4 text-right">সাইনবোর্ড কর</label>
        
                                            <input class="form-control col-md-7" type="text" name="signbord_vat" id="signbord_vat" value="<?php echo  (isset($data[21])) ? $data[21]['amount'] : null; ?>" onchange="calculation()"/>

                                            <input type="hidden" name="signbord_id" id="signbord_id" value="<?php echo  (isset($data[21])) ? $data[21]['transection_id'] : 0; ?>"/>
                                        </div>
                                        </br>
        
                                        <div class="row">
                                            <label class="col-md-4 text-right">পেশা কর</label>
        
                                            <input class="form-control col-md-7" type="text" name="pesha_vat" id="pesha_vat" value="<?php echo  (isset($data[28])) ? $data[28]['amount'] : null; ?>" onchange="calculation()" />

                                            <input type="hidden" name="pesha_vat_id" id="pesha_vat_id" value="<?php echo  (isset($data[28])) ? $data[28]['transection_id'] : 0; ?>" />
                                        </div>
                                        </br>
        
                                        <div class="row">
                                            <label class="col-md-4 text-right">সাব চার্জ</label>
        
                                            <input class="form-control col-md-7" type="text" name="sarcharge" id="sarcharge" value="<?php echo  (isset($data[22])) ? $data[22]['amount'] : null; ?>" onchange="calculation()"/>

                                            <input type="hidden" name="sarcharge_id" id="sarcharge_id" value="<?php echo  (isset($data[22])) ? $data[22]['transection_id'] : 0; ?>" />

                                        </div>
                                        </br>
        
                                        <div class="row">
                                            <label class="col-md-4 text-right">মোট</label>
        
                                            <input class="form-control col-md-7" type="text" name="total" id="total" readonly="readonly" value="<?php echo $other_data['total'];?>" />
                                        </div>
                                        </br>

                                        <div class="row">
                                            <label class="col-md-4 text-right">তারিখ</label>
        
                                            <input class="form-control col-md-7" type="text" name="created_time" id="created_time" value="<?php echo date('Y-m-d' ,strtotime($other_data['created_time'])) ?>" readonly="readonly" />
                                        </div>
                                        </br>

                                    </div>
                                  
                                </div>
        
                              
                                <div class="modal-footer">

                                    <input type="hidden" name="union_id"  id="union_id" value="<?php echo $other_data['union_id']?>" />
                                    <input type="hidden" name="sonod_no"  id="sonod_no" value="<?php echo $other_data['sonod_no']?>" />
                                    <input type="hidden" name="voucher"  id="voucher" value="<?php echo $other_data['voucher']?>" />
                                    
                                    <button type="submit" class="btn btn-primary" >আপডেট</button>
                                    <button type="button" class="btn btn-danger" onclick="trade_fee_delete()">ডিলিট</button>
                                </div>
                            </form>
                        </div>
                    @else

                    <h5 class="text-danger text-center">দুঃখিত ! কোন তথ্য খুঁজে পাওয়া যায়নি।</h5>

                    @endif
                         
					</div>
				</div>
			</div>

		<!-- Export Datatable End -->




@endsection

@section('script')

    <script>
        function trade_fee_delete(){

        var voucher = $('#voucher').val();
        var sonod_no = $('#sonod_no').val();
        var union_id = $('#union_id').val();
 
        swal({
            title: "অনুমোদন",
            text: "আপনি কি ডিলিট করতে চান?",
            type: "warning",
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "হ্যাঁ",
            showCancelButton: true,
            cancelButtonText: "না",
            showLoaderOnConfirm: true,
            preConfirm: function() {

                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url + '/super_admin/trade_fee_delete',
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        voucher : voucher,
                        sonod_no : sonod_no,
                        union_id : union_id,
                    
                    },
                    success: function(response) {
                        
                        swal({
                            title: (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত",
                            text: response.message,
                            type: response.status,
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: 'ঠিক আছে',
                            closeOnConfirm: true,
                            allowEscapeKey: false
                        })

                        if(response.status == 'success'){
                            window.location.replace( url + '/super_admin/trade_support');
                        }
                    }
                });
            }
        }).then(function(){
            location.reload();
        });

        }
    </script>


	<script src="{{ asset('js/trade.min.js') }}"></script>

@endsection


