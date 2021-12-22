@extends('layouts.master')
@section('content')



<section>
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-md-offset-3">
                <div class="panel panel-info" style="margin: 15px;">
                    <div class="panel-heading text-center">
                        <h3>ট্রেড লাইসেন্স নবায়ন আবেদন</h3>
                    </div>

                    <div class="panel-body">

                        <div class="row form-group">
                            <label class="col-md-4 form-control-label">ট্রেড লাইসেন্স নং</label>
                            <div class="col-md-8">
                                <input type="text" id="sonod_no" name="sonod_no" class="form-control" placeholder="১৭ সংখ্যার সনদ নাম্বার প্রদান করুন" required='required' >
                                <span id="sonod_error" class="text-danger"></span>
                            </div>
                        </div>

                      

                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" id="union_id" value="{{ $unionProfile->union_id }}">
                                <button class="btn btn-success btn-lg btn-block" type="button" id="tradeRenewApplication" >সাবমিট</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        //trade renew application
        $('#tradeRenewApplication').click(function(){

        let loc = $('meta[name=path]').attr("content");

        var sonod_no = $('#sonod_no').val();
        var union_id = $('#union_id').val();

        if(sonod_no == ''){

            $('#sonod_error').html('সনদ নাম্বার প্রদান করুন');
        
        }else{

            $('#sonod_error').html('');

            $.ajax({
                type:'POST',
                url:loc+'/api/trade_renew',
                data:{sonod_no : sonod_no, union_id : union_id},
                success: function (response) {
                    
                    Swal.fire({
                        icon    : response.status,
                        title   : response.status,
                        text    : response.message,
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        });
    </script>
    {{-- <script src="{{ asset('js/verify.min.js') }}"></script> --}}
@endsection