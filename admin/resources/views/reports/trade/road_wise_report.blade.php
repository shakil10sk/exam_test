@extends('layouts.app')
@section('head')

@endsection

@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>ব্যবসায়ের ধরণ অনুযায়ী ট্রেড লাইসেন্সের তালিকা রিপোর্ট</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('certificate_report_print')}}" method="get" target="_blank">

                        @csrf

                        <div class="col-md-3 float-left">
                            <label for="market_id">অর্থবছর</label>
                            <select name="fiscal_year_id" id="fiscal_year_id" class="form-control" required>
                                <option value="">Select</option>

                                @foreach($fiscal_year_list as $item)
                                    <option value="{{$item->id}}" {{ ($item->is_current == 1) ? "selected" : "" }} >
                                    {{ $item->name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 float-left">
                            <label for="road_id">রাস্তার নাম</label>
                            <select name="road_id" id="road_id" class="form-control" >
                                <option value="">Select</option>

                                @foreach($data_list as $item)
                                    <option value="{{$item->id}}">
                                    {{ $item->name_bn }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2 float-left">
                            <input type="hidden" name="report_type" id="report_type" value="3" />

                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <button type="submit" class="btn btn-sm btn-primary">রির্পোট দেখুন</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
