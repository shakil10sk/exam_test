@extends('layout.main',['title'=> 'Dashboard'])


@section('content')

    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Bracket</a>
            <span class="breadcrumb-item active">Blank Page</span>
        </nav>
    </div> --}}


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Dashboard DDLG</h4>
    </div>

    <div class="br-pagebody">
        <div class="row pb-5">
            <div class="col-4 pl-0 pr-0">
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
            <div class="col-4 pr-0">
                <div class="card">
                    <div class="card-header text-dark">
                        <h5  class="text-center">পলাশ উপজেলা  </h5>
                        <span>মোট ইউনিয়ন পরিষদ : <a href="" class="list-group-item-info"> 0</a> </span>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="section2-1"></canvas>
                    </div>
                    <div class="card-footer text-center">
                        <a href="" class="btn btn-sm btn-info mx-2 px-4">সেবা</a>
                        <a href="" class="btn btn-sm btn-warning mx-2 px-4">ভাতা</a>
                        <a href="" class="btn btn-sm btn-success mx-2 px-4">হাজিরার</a>
                    </div>
                </div>
            </div>
            <div class="col-4 pr-0">
                <div class="card">
                    <div class="card-header text-dark">
                        <h5  class="text-center">রায়পুরা উপজেলা </h5>
                        <span>মোট ইউনিয়ন পরিষদ : <a href="" class="list-group-item-info"> 0</a> </span>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="section2-2"></canvas>
                    </div>
                    <div class="card-footer text-center">
                        <a href="" class="btn btn-sm btn-info mx-2 px-4">সেবা</a>
                        <a href="" class="btn btn-sm btn-warning mx-2 px-4">ভাতা</a>
                        <a href="" class="btn btn-sm btn-success mx-2 px-4">হাজিরার</a>
                    </div>
                </div>
            </div>
            <div class="col-4 pr-0">
                <div class="card">
                    <div class="card-header text-dark">
                        <h5  class="text-center">শিবপুর উপজেলা </h5>
                        <span>মোট ইউনিয়ন পরিষদ : <a href="" class="list-group-item-info"> 0</a> </span>
                    </div>
                    <div class="card-body p-0">
                        <canvas id="section2-3"></canvas>
                    </div>
                    <div class="card-footer text-center">
                        <a href="" class="btn btn-sm btn-info mx-2 px-4">সেবা</a>
                        <a href="" class="btn btn-sm btn-warning mx-2 px-4">ভাতা</a>
                        <a href="" class="btn btn-sm btn-success mx-2 px-4">হাজিরার</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('script')


    <script>
        let colors = [
            '#29B0D0',
            '#2A516E',
            '#F07124',
            '#CBE0E3',
            '#979193'
        ];

        let labels = [
            "ইউনিয়ন পরিষদের \n তথ্য সমুহ ",
            "ইউনিয়ন পরিষদের \n তথ্য সমুহ ",
            "ইউনিয়ন পরিষদের \n তথ্য সমুহ ",
            "ইউনিয়ন পরিষদের \n তথ্য সমুহ ",
            "ইউনিয়ন পরিষদের \n তথ্য সমুহ ",
            "ইউনিয়ন পরিষদের \n তথ্য সমুহ ",
        ];

        let options = {
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

        let data = [10, 44, 50];
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


        data = [10, 44, 10, 44, 144, 50];
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

        data = [10, 44, 10, 10, 44, 50];
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

        data = [10, 44, 4, 10, 49, 50];
        new Chart(document.getElementById('section2-1').getContext('2d'), {
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
        data = [10, 44, 4, 10, 49, 50];
        new Chart(document.getElementById('section2-2').getContext('2d'), {
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
        data = [10, 44, 4, 10, 49, 50];
        new Chart(document.getElementById('section2-3').getContext('2d'), {
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

    </script>
@endpush
