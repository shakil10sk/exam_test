@extends('layouts.app')
@section('head')

@endsection

@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>পৌরসভা মার্কেটের দোকানের তালিকার রিপোর্ট</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('shop.list.report.action')}}" method="get">

                        @csrf

                        <div class="col-md-3 float-left">
                            <label for="market_id">মার্কেট</label>
                            <select name="market_id" id="market_id" class="form-control">
                                <option value="">Select</option>

                                @foreach($market_data as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2 float-left">
                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <button type="submit" class="btn btn-sm btn-primary">Get Report</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
