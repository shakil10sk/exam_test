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
                        <h4 class="text-center application_head">এরিয়া ট্যাক্স রেট সেটিংস </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form id="form-data" action="{{ route('holding.tax.area.rate.action') }}" method="post" enctype="multipart/form-data"
                  class="uk-form bt-flabels js-flabels" data-parsley-validate data-parsley-errors-messages-disabled>
                
                @csrf

                <div class="row mt-3">

                    @foreach($data as $key => $item )
                        <div class="col-sm-12">
                            <div class="row form-group">
                                <label for="fee_{{$key}}" class="col-sm-4 control-label">{{ $item->name }}</label>

                                <div class="col-sm-2 bt-flabels__wrapper">
                                    <input type="text" name="fee[{{$key}}]" id="fee_{{$key}}"
                                           value="{{  $item->fee }}"
                                           class="form-control fees_data"/>

                                    <input type="hidden" name="id[{{$key}}]" id="id_{{$key}}" value="{{ $item->id }}" />
                                    
                                    <input type="hidden" name="property_id[{{$key}}]" id="property_id{{$key}}" value="{{ $item->property_id }}" />


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

            </form>
        </div>

    </section>

@endsection
