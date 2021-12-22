@extends('layout.main',['title'=> 'District Dashboard'])


@section('content')

    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Bracket</a>
            <span class="breadcrumb-item active">Blank Page</span>
        </nav>
    </div> --}}


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">ড্যাশবোর্ড
            @if (auth()->user()->type==1)
            এডমিন
            @elseif (auth()->user()->type==2)
            ডিসি
            @elseif (auth()->user()->type==3)
            ডিডিএলজি
            @elseif (auth()->user()->type==4)
            ইউএনও
            @endif
        </h4>
        {{-- <p class="mg-b-0">ইউজার যোগঃ &nbsp;&nbsp;

            <select name="district">
                <option value=""></option>
            </select>
        </p> --}}
    </div>

    <div class="br-pagebody">
        <div class="row pb-5 text-dark">
            <div class="col-4 pl-0 pr-0 ">
                <h5 class="text-center">জেলা সর্বমোট নাগরিক সেবা</h5>
                <div class="bd">
                    <canvas id="section1-1"></canvas>
                </div>
            </div>
            <div class="col-4 pl-0 pr-0">
                <h5 class="text-center">জেলা সর্বমোট ভাতা প্রাপ্তগণ</h5>
                <div class="bd">
                    <canvas id="section1-2"></canvas>
                </div>
            </div>
            <div class="col-4 pl-0 pr-0">
                <h5 class="text-center">জেলা সর্বমোট কর্মকতা /কর্মচারী</h5>
                <div class="bd">
                    <canvas id="section1-3"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach (json_decode($upazila) ?? [] as $key => $item)
                <div class="col-4 pr-0 pl-1 mb-1">
                <div class="card">
                    <div class="card-header text-dark">
                        <h5 class="text-center"> {{$item->bn_name}} উপজেলা</h5>
                        <span>মোট ইউনিয়ন পরিষদ : <a href="{{ route('dashboard.upazila',$item->id) }}" class="list-group-item-info"> {{ count($item->union?? []) }}</a> </span>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="section2-{{++$key}}"></canvas>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('dashboard.upazila',$item->id) }}" class="btn btn-sm btn-info mx-2 px-4">সেবা</a>
                        <a href="{{route('dashboard.allowance',$item->id)}}" class="btn btn-sm btn-warning mx-2 px-4">ভাতা</a>
                        <a href="{{route('report.attendance')}}" class="btn btn-sm btn-success mx-2 px-4">হাজিরার</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>


<input type="hidden" id="upazila" value="{{$upazila}}">
@endsection

@push('script')

    <script>

        let colors = [
            '#29B0D0',
            '#2A516E',
            '#F07124',
            '#CBE0E3',
            '#979193',
            '#23BF08',
            '#d2a70d',
            '#bf3b08'
        ];

        let options = {
            tooltips: {
                mode: 'dataset'
            },
            plugins: {
                labels: [{
                        render: 'label',
                        position: 'outside',
                        fontSize: 12,
                        textMargin: 5
                    },
                    {
                        render: 'percentage',
                        fontColor: '#000',
                    },

                ]
            },
            legend: {
                display: false,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        // ================ section 1 ================= //

        // section 1-1
        let labels = [
            "নাগরিক সনদ",
            "নাগরিক আবেদন",
            "ট্রেড সনদ",
            "ট্রেড আবেদন",
            "ওয়ারিশ সনদ",
            "ওয়ারিশ আবেদন",
        ];

        let data = [
            {{ $nagoric->app }},
            {{ $nagoric->certificate }},
            {{ $trade->app }},
            {{ $trade->certificate }},
            {{ $warish->app }},
            {{ $warish->certificate }},
        ];

        new Chart(document.getElementById('section1-1').getContext('2d'), {
            type: 'pie',
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: colors
                }],

                labels: labels
            },
            options: options
        });

        // ------------------ section 1-2
        labels = [
            "মুক্তি যোদ্ধা ভাতা",
            "দরিদ্র ভাতা",
            "বিদ্ধ ভাতা",
            "মাত্রিত্ত ভাতা",
            "বিধবা ভাতা",
            "প্রতিবন্ধী ভাতা",
            "ভিজিডি ভাতা",
        ];

        data = [
            {{ $freedom_fighter }},
            {{ $poor }},
            {{ $old }},
            {{ $motherhood }},
            {{ $bidoba }},
            {{ $protibondi }},
            {{ $vgd }},
        ];

        new Chart(document.getElementById('section1-2').getContext('2d'), {
            type: 'pie',
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: colors
                }],
                labels: labels
            },
            options: options
        });

        // section 1-3
        labels = [
            "মেয়র",
            "সচিব",
            "নির্বাহী কর্মকর্তা",
            "নির্বাহী প্রকৌশলী",
            "কাউন্সিলর",
            "মেডিকেল অফিসার",
        ];

        data = [
            {{ $chairman }},
            {{ $sochib }},
            {{ $udc }},
            {{ $computer_operator }},
            {{ $member }},
            {{ $gram_police }},
        ];

        new Chart(document.getElementById('section1-3').getContext('2d'), {
            type: 'pie',
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: colors
                }],
                labels: labels
            },
            options: options
        });


        // ==================== section 2 ==================== //


        JSON.parse($('#upazila').val()).forEach((item,i) => {

            labels = [];
            data = [];

            if(item.union)
            item.union.forEach(el => {
                labels.push(el.bn_name);
                data.push(el.total);
                // console.log(el);
            });


            new Chart(document.getElementById('section2-' + (i+1)).getContext('2d'), {
                type: 'pie',
                data: {
                    datasets: [{
                        data: data,
                        backgroundColor: colors
                    }],
                    labels: labels
                },
                options: options
            });
        });

    </script>
@endpush
