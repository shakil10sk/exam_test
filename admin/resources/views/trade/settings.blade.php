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
                        <h4 class="text-center application_head">ট্রেড লাইসেন্স সেটিংস</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('trade.settings.save') }}" method="post" enctype="multipart/form-data" class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                @csrf

                <div class="row mt-3">

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="max_source_tax" class="col-sm-4 control-label">অর্থ বছর</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <select class="form-control" id="fiscal_year_id" name="fiscal_year_id" onchange="getTradeConfig(this.value)">
                                    <option value="">Select</option>

                                    @foreach($fiscal_year_list as $item)
                                        <option value="{{$item->id}}" @if($item->is_current) selected @endif >{{$item->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="max_source_tax" class="col-sm-4 control-label">সর্বোচ্চ উৎসে কর (টাকা)</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="max_source_tax" id="max_source_tax" value="{{ isset($data['max_source_tax']) ? $data['max_source_tax']['value'] : '' }}" class="form-control @error('max_source_tax') is-invalid @enderror" />

                                <input type="hidden" name="max_source_tax_id" id="max_source_tax_id" value="{{ isset($data['max_source_tax']) ? $data['max_source_tax']['id'] : '' }}" />

                                @error('max_source_tax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="vat" class="col-sm-4 control-label">ভ্যাট (%)</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="vat" id="vat" value="{{ isset($data['vat']) ? $data['vat']['value'] : '' }}" class="form-control @error('vat') is-invalid @enderror" />

                                <input type="hidden" name="vat_id" id="vat_id" value="{{ isset($data['vat']) ? $data['vat']['id'] : '' }}" />

                                @error('vat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="running_sarcharge" class="col-sm-4 control-label">চলতি বছর ১ অক্টোবর থেকে ৩০ জুন সারচার্জ (%)</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="running_sarcharge" id="running_sarcharge" value="{{ isset($data['running_sarcharge']) ? $data['running_sarcharge']['value'] : '' }}" class="form-control @error('running_sarcharge') is-invalid @enderror" autocomplete="running_sarcharge" />

                                <input type="hidden" name="running_sarcharge_id" id="running_sarcharge_id" value="{{ isset($data['running_sarcharge']) ? $data['running_sarcharge']['id'] : '' }}" />

                                @error('running_sarcharge')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="sarcharge_on_due" class="col-sm-4 control-label">বকেয়ার উপর সারচার্জ (%)</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="sarcharge_on_due" id="sarcharge_on_due" value="{{ isset($data['sarcharge_on_due']) ? $data['sarcharge_on_due']['value'] : '' }}" class="form-control @error('sarcharge_on_due') is-invalid @enderror" autocomplete="sarcharge_on_due" />

                                <input type="hidden" name="sarcharge_on_due_id" id="sarcharge_on_due_id" value="{{ isset($data['sarcharge_on_due']) ? $data['sarcharge_on_due']['id'] : '' }}" />

                                @error('sarcharge_on_due')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group text-center">

                            <button type="submit" name="save" id="save" class="btn btn-sm btn-success">Save</button>

                            <a href="{{route('home')}}">
                                <button type="button" name="cancel" id="cancel" class="btn btn-sm btn-danger">Cancel</button>
                            </a>
                        </div>
                    </div>

                </div>

            </form>
        </div>

    </section>


@endsection

@section('script')
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <script type="text/javascript">
        function getTradeConfig(fiscal_year_id){

            // reset all input
            $("#max_source_tax").val('');
            $("#max_source_tax_id").val('');

            $("#vat").val('');
            $("#vat_id").val('');

            $("#running_sarcharge").val('');
            $("#running_sarcharge_id").val('');

            $("#sarcharge_on_due").val('');
            $("#sarcharge_on_due_id").val('');

            $.ajax({
                url: app_url + "/trade/settings/getConfig/"+fiscal_year_id,
                type: "GET",
                dataType: "JSON",
                success: function(response){
                    if (typeof response.data.max_source_tax != "undefined" && response.data.max_source_tax != null){
                        $("#max_source_tax").val(response.data.max_source_tax.value);
                        $("#max_source_tax_id").val(response.data.max_source_tax.id);
                    }

                    if (typeof response.data.vat != "undefined" && response.data.vat != null){
                        $("#vat").val(response.data.vat.value);
                        $("#vat_id").val(response.data.vat.id);
                    }

                    if (typeof response.data.running_sarcharge != "undefined" && response.data.running_sarcharge != null){
                        $("#running_sarcharge").val(response.data.running_sarcharge.value);
                        $("#running_sarcharge_id").val(response.data.running_sarcharge.id);
                    }

                    if (typeof response.data.sarcharge_on_due != "undefined" && response.data.sarcharge_on_due != null){
                        $("#sarcharge_on_due").val(response.data.sarcharge_on_due.value);
                        $("#sarcharge_on_due_id").val(response.data.sarcharge_on_due.id);
                    }
                }
            });
        }
    </script>

@endsection
