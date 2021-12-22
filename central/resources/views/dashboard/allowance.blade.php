@extends('layout.main',['title'=> 'Allowance Dashboard'])


@section('content')

    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Bracket</a>
            <span class="breadcrumb-item active">Blank Page</span>
        </nav>
    </div> --}}

    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Allowance Dashboard </h4>
    </div>

    <div class="br-pagebody">

        <div class="row">
            @foreach ((object) $union as $key => $item)
                <div class="col-6">
                    <div class="card">
                        <div class="card-header text-dark text-center">
                            <h5> {{ $item->bn_name }} ইউনিয়ন</h5>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row text-center">
                                <div class="col-6 pb-3">
                                    <div>মুক্তিযোদ্ধা</div>
                                    <span class="badge badge-pill badge-primary">{{$item->freedom->total}}</span> জন
                                </div>
                                <div class="col-6">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->freedom->amount??0}}</span> টাকা
                                </div>

                                <div class="col-6  pb-3">
                                    <div>গরিব</div>
                                    <span class="badge badge-pill badge-primary">{{$item->poor->total}}</span> জন
                                </div>
                                <div class="col-6 ">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->poor->amount??0}}</span> টাকা
                                </div>
                                <div class="col-6 pb-3">
                                    <div>বৃদ্ধ </div>
                                    <span class="badge badge-pill badge-primary">{{$item->old->total}}</span> জন
                                </div>
                                <div class="col-6">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->old->amount??0}}</span> টাকা
                                </div>
                                <div class="col-6  pb-3">
                                    <div>মাতৃত্যকালীন </div>
                                    <span class="badge badge-pill badge-primary">{{$item->motherhood->total}}</span> জন
                                </div>
                                <div class="col-6">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->motherhood->amount??0}}</span> টাকা
                                </div>
                                <div class="col-6  pb-3">
                                    <div>বিধবা</div>
                                    <span class="badge badge-pill badge-primary">{{$item->bidoba->total}}</span> জন
                                </div>
                                <div class="col-6">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->bidoba->amount??0}}</span> টাকা
                                </div>
                                <div class="col-6  pb-3">
                                    <div>প্রতিবন্ধী</div>
                                    <span class="badge badge-pill badge-primary">{{$item->protibondi->total}}</span> জন
                                </div>
                                <div class="col-6">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->protibondi->amount??0}}</span> টাকা
                                </div>
                                <div class="col-6  pb-3">
                                    <div>ভি জি ডি</div>
                                    <span class="badge badge-pill badge-primary">{{$item->vgd->total}}</span> জন
                                </div>
                                <div class="col-6">
                                    <div>ভাতার পরিমাণ</div>
                                    <span class="badge badge-pill badge-primary">{{$item->vgd->amount??0}}</span> টাকা
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


@endsection
