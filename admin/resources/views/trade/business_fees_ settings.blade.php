@extends('layouts.app')
@section('head')
    <!-- cropzee.js -->
    <script src="{{ asset('js/cropzee.min.js') }}" defer></script>
    <!--  -->
    <link href="{{ asset('css/form_validate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')

    <section>
        <div class="page-header">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="title text-center">
                        <h4 class="text-center application_head">ট্রেড লাইসেন্স বিজনেস টাইপ ফি সেটিংস </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="height: 700px;">
        <div class="container">


            <div class="row">
               <div class="col-md-12">
                {{-- <a href="javascript:void(0)" class="btn btn-success float-right btn-group"
                onclick="add_category()"><i class="fas fa-plus"></i> যোগ করুন</a> --}}
               </div>

                <table class="stripe hover multiple-select-row data-table-export nowrap" id='trade_business_type_fee_table'>
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">নং</th>
                            <th>বাবসার ধরন বাংলা</th>
                            <th>বাবসার ধরন ইংরেজি</th>
                            <th>ফি</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div>
                <div class="modal fade" id="business_modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form name="business_form" id="business_form" class="form-horizontal form_middle"
                            {{-- method="post" --}}
                            >
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="Menu">বাবসার ফি
                                        </label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" id="fee" name="fee" class="form-control" required>
                                            <span style="color:red;" id="fee_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="business_id" id="business_id">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="update_business_type()">সাবমিট</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>











            {{-- <form id="form-data" action="{{ route('business.fee.settings.save') }}" method="post" enctype="multipart/form-data"
                  class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

                <div class="row mt-3">

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="max_source_tax" class="col-sm-4 control-label">অর্থ বছর</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <select class="form-control" id="fiscal_year_id" name="fiscal_year_id"
                                        onchange="getBusinessFees(this.value)">
                                    <option value="">Select</option>

                                    @foreach($fiscal_year_list as $item)
                                        <option value="{{$item->id}}"
                                                @if($item->is_current) selected @endif >{{$item->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    @foreach($business_fee_data as $key => $item )
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="max_source_tax"
                                       class="col-sm-4 control-label">{{ $item['name_bn']  }}</label>

                                <div class="col-sm-2 bt-flabels__wrapper">
                                    <input type="text" name="fees[{{$key}}]" id="fees_{{$key}}"
                                           value="{{  $item['fee'] }}"
                                           class="form-control fees_data"/>

                                    <input type="hidden" name="row_id[{{$key}}]" id="row_id_{{$key}}"
                                           value="{{ $item['business_id'] }}" />


                                </div>
                                <label for="general" class="col-sm-4 control-label text-green">টাকা</label>
                            </div>
                        </div>
                    @endforeach


                    <div class="col-sm-6">
                        <div class="form-group text-center">

                            <button type="submit" name="save" id="save" class="btn btn-sm btn-success">Save</button>

                            <a href="{{route('home')}}">
                                <button type="button" name="cancel" id="cancel" class="btn btn-sm btn-danger">Cancel
                                </button>
                            </a>
                        </div>
                    </div>

                </div>

            </form> --}}
        </div>

    </section>


@endsection

@section('script')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/trade.js') }}"></script>

    <script type="text/javascript">

    trade_business_type_fee_list();

        function getBusinessFees(fiscal_year_id) {

            // reset all data //
            $($(".fees_data")).each(function(){
                $(this).val("")
            });

            if (fiscal_year_id){
                $.ajax({
                    url: app_url + "/trade/settings/business/GetFees/" + fiscal_year_id,
                    type: "GET",
                    dataType: "JSON",
                    success: function (response) {

                        $.each(response.data, function( index, item ) {
                            if (item.fee == null){
                                $("#fees_"+index).val("");
                                $("#row_id_"+index).val("");
                            }else{
                                $("#fees_"+index).val(item.fee);
                                $("#row_id_"+index).val(item.business_id);
                            }

                        })
                    }
                });
            }


        }
        var trade_business_csrf = '@php echo csrf_token() @endphp';
    </script>

@endsection
