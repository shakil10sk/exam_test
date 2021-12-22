@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="row mb-2">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4> বিল জেনারেট </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
            <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">

                <form action="{{route('holding.assessment.bill.generate.action')}}" method="post">
                
                @if(!empty($payer_info))
                    <div class="row mb-3" style="border-bottom: 1px dashed;">
                        <div class="col-6">
                            <input type="hidden" name="payer_id" id="payer_id" value="{{$payer_info->id}}" />

                            <p>নামঃ {{$payer_info->name}}</p>
                            <p>পিতাঃ {{$payer_info->father_name}}</p>
                            <p>মোবাইলঃ {{$payer_info->mobile_no}} &emsp;&emsp;&emsp; ওয়ার্ডঃ {{$payer_info->ward_name}}</p>
                        </div>

                        <div class="col-6">
                            <p>হোল্ডিং নংঃ {{$payer_info->holding_no}}</p>
                            <p>মাতাঃ {{$payer_info->mother_name}}</p>
                            <p>মহল্লাঃ {{$payer_info->moholla_name}}</p>
                        </div>
                    </div>
                @endif

                    <div class="row mb-3">
                @csrf    

                    @if(empty($payer_info))
                        <div class="col-2">
                            <label for="ward_no">ওয়ার্ড</label>

                            <select name="ward_no" id="ward_no" class="form-control" required>
                                <option value="">Select</option>

                            @foreach($ward_list as $item)
                                <option value="{{$item->id}}">{{$item->ward_no}} - {{$item->name}}</option>
                            @endforeach

                            </select>
                        </div>
                    @endif
                        
                        <div class="col-2">
                            <label for="fiscal_year_id">অর্থ বছর</label>
                            <select name="fiscal_year_id" id="fiscal_year_id" class="form-control" required>
                                <option value="">Select</option>

                                @foreach($fiscal_year_list as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-2">
                            <label>মাস নির্বাচন করুন</label><br/>

                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id7" value="7" /> July
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id8" value="8" /> August
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id9" value="9" /> September
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id10" value="10" /> October
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id11" value="11" /> November
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id12" value="12" /> December
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id1" value="1" /> January
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id2" value="2" /> February
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id3" value="3" /> March
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id4" value="4" /> April
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id5" value="5" /> May
                            </label><br/>
                            
                            <label>
                                <input type="checkbox" name="month_id[]" id="month_id6" value="6" /> June
                            </label><br/>

                        </div>

                        <div class="col-2">
                            <button class="btn btn-sm btn-primary" type="submit">Generate</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('script')
    <!-- add sweet alert js & css in footer -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweet-alert.init.min.js') }}"></script>

    <script src="{{ asset('js/holding_tax.js') }}"></script>

@endsection