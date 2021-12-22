@extends('layouts.app')
@section('head')

@endsection

@section('content')
<div class="page-header">
    <div class="row mb-2">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>মাসিক বিল কালেকশন রিপোর্ট</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

            <div class="row">
                <div class="col-md-4">
                    <form action="{{route('monthly.bill.collection.report.action')}}" method="get">
                    @csrf
                        <div class="col-md-12">
                            <label for="year_id">বছর</label>

                            <select class="form-control" name="year_id" id="year_id" required>
                                <option value="">সিলেক্ট করুন</option>
                                @for($year = 2019; $year <= date('Y')+1; $year++ )
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="month_id">মাস</label>

                            <select class="form-control" name="month_id" id="month_id" required>
                                <option value="">সিলেক্ট করুন</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="market_id">মার্কেটের নাম</label>

                            <select class="form-control" name="market_id" id="market_id" >
                                <option value="">সিলেক্ট করুন</option>
                                @foreach($market_list as $item)
                                    <option value="{{ $item->id  }}">{{ $item->name  }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12" style="margin-top: 10px">
                            <button class="btn btn-sm btn-primary" type="submit">রিপোর্ট</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
