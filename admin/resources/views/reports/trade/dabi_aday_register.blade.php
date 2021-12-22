@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> ট্রেড দাবী আদায় রেজিষ্টার</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ট্রেড লাইসেন্স</li>
                        <li class="breadcrumb-item active" aria-current="page">দাবী আদায় রেজিষ্টার</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">
                <div class="col-md-12">
                    <form action="{{ url('trade/dabi_aday_print') }}" method="GET" target="_blank">

                        {{-- <div class="col-md-4 float-left"> --}}
                            <label for="from_date">অর্থবছরঃ</label>
                            <select id="fiscal_year" id="from_date" lass="form-control" name="fiscal_year_id">
                                <option value="">select Fiscal Year</option>

                                @foreach($fiscal_year_info as $item)
                                    <option value="{{$item->id}}" {{ ($item->is_current == 1) ? "selected" : "" }} >
                                    {{ $item->name }}
                                    </option>
                                @endforeach

                                {{-- @foreach ($fiscal_year_info as $values)
                                    <option value="{{ $values->id }}">{{ $values->name }}</option>
                                @endforeach --}}

                            </select>

                        {{-- </div> --}}


                        {{-- <div class="col-md-4 float-left">
                            <label for="from_date">হতেঃ</label>
                            <input type="text" name="from_date" id="from_date" value="{{ date('Y-m-d') }}" class="form-control" />

                            <span id="from_date_error" class="error"></span>
                        </div>

                        <div class="col-md-4 float-left">
                            <label for="to_date">পর্যন্তঃ</label>
                            <input type="text" name="to_date" id="to_date" value="{{ date('Y-m-d') }}" class="form-control"  />

                            <span id="to_date_error" class="error"></span>
                        </div> --}}

                        {{-- <div class="col-md-1 float-left"> --}}
                            <label>&emsp;&emsp;</label>

                            <button class="btn btn-primary" type="submit">দাবী আদায় বের করুন</button>
                        {{-- </div> --}}
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
	<script src="{{ asset('js/accounts.js') }}"></script>
@endsection
