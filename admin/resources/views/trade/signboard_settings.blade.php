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
                        <h4 class="text-center application_head">ট্রেড লাইসেন্স সাইনবোর্ড সেটিংস</h4>
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
                                <select class="form-control" id="fiscal_year_id" name="fiscal_year_id" onchange="getSignboardConfig(this.value)">
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
                            <label for="max_source_tax" class="col-sm-4 control-label">নিয়ন</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="nion" id="nion" value="{{ isset($data['nion']) ? $data['nion']['value'] : '' }}" class="form-control @error('nion') is-invalid @enderror" />

                                <input type="hidden" name="nion_id" id="nion_id" value="{{ isset($data['nion']) ? $data['nion']['id'] : '' }}" />

                                @error('nion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="nion" class="col-sm-4 control-label text-green">প্রতি র্বগ ফুট</label>
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="lighting" class="col-sm-4 control-label">আলোকসজ্জা</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="lighting" id="lighting" value="{{ isset($data['lighting']) ? $data['lighting']['value'] : '' }}" class="form-control @error('lighting') is-invalid @enderror" />

                                <input type="hidden" name="lighting_id" id="lighting_id" value="{{ isset($data['lighting']) ? $data['lighting']['id'] : '' }}" />

                                @error('lighting')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="lighting" class="col-sm-4 control-label text-green">প্রতি র্বগ ফুট</label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row form-group">
                            <label for="general" class="col-sm-4 control-label">সাধারণ</label>

                            <div class="col-sm-2 bt-flabels__wrapper">
                                <input type="text" name="general" id="general" value="{{ isset($data['general']) ? $data['general']['value'] : '' }}" class="form-control @error('general') is-invalid @enderror" autocomplete="general" />

                                <input type="hidden" name="general_id" id="general_id" value="{{ isset($data['general']) ? $data['general']['id'] : '' }}" />

                                @error('general')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="general" class="col-sm-4 control-label text-green">প্রতি র্বগ ফুট</label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group text-center">
                            <input type="hidden" name="type" value="signboard" >
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
        function getSignboardConfig(fiscal_year_id){

            // reset all input
            $("#nion").val('');
            $("#nion_id").val('');

            $("#lighting").val('');
            $("#lighting_id").val('');

            $("#general").val('');
            $("#general_id").val('');


            $.ajax({
                url: app_url + "/trade/settings/getConfig/"+fiscal_year_id,
                type: "GET",
                dataType: "JSON",
                success: function(response){
                    if (typeof response.data.nion != "undefined" && response.data.nion != null){
                        $("#nion").val(response.data.nion.value);
                        $("#nion_id").val(response.data.nion.id);
                    }

                    if (typeof response.data.lighting != "undefined" && response.data.lighting != null){
                        $("#lighting").val(response.data.lighting.value);
                        $("#lighting_id").val(response.data.lighting.id);
                    }

                    if (typeof response.data.general != "undefined" && response.data.general != null){
                        $("#general").val(response.data.general.value);
                        $("#general_id").val(response.data.general.id);
                    }
                }
            });
        }
    </script>

@endsection
