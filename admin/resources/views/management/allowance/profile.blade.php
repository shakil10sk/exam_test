@extends('layouts.app')
@section('head')
<style>
.flip-card-3D-wrapper {
  width: 400px;
  height: 450px;
  position: relative;
  -o-perspective: 900px;
  -webkit-perspective: 900px;
  -ms-perspective: 900px;
  perspective: 900px;
  margin: 0 auto;
}
#flip-card {
  width: 100%;
  height: 100%;
  position: absolute;
  -o-transition: all 1s ease-in-out;
  -webkit-transition: all 1s ease-in-out;
  -ms-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
  -o-transform-style: preserve-3d;
  -webkit-transform-style: preserve-3d;
  -ms-transform-style: preserve-3d;
  transform-style: preserve-3d;
}

.do-flip {
  -o-transform: rotateY(-180deg);
  -webkit-transform: rotateY(-180deg);
  -ms-transform: rotateY(-180deg);
  transform: rotateY(-180deg);
}

#flip-card-btn-turn-to-back,
#flip-card-btn-turn-to-front {
  position: absolute;
  top: 8px;
  right: 8px;
  width: 40px;
  height: 40px;
  background: white;
  cursor: pointer;
  visibility: hidden;
  font-family: "Open Sans", sans-serif;
  font-weight: 600;
  font-size: 0.7em;
  padding: 0;
  color: grey;
  border: 1px solid grey;
}

#flip-card .flip-card-front,
#flip-card .flip-card-back {
  width: 100%;
  height: 100%;
  position: absolute;
  -o-backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  -ms-backface-visibility: hidden;
  backface-visibility: hidden;
  z-index: 2;
  -webkit-box-shadow: 5px 6px 32px 2px rgba(133, 133, 133, 0.71);
  -moz-box-shadow: 5px 6px 32px 2px rgba(133, 133, 133, 0.71);
  box-shadow: 5px 6px 32px 2px rgba(133, 133, 133, 0.71);
}

#flip-card .flip-card-front {
  background: #f3f8ff;
  border: 2px solid grey;
}
#flip-card .flip-card-back {
  background: #f3f8ff;
  border: 2px solid grey;
  -o-transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  transform: rotateY(180deg);
}

.left_logo{
    padding: 10px;
	text-align: left;
	width: 90px;
}
.right_logo{
    padding: 10px;
	text-align: left;
	width: 90px;
}

.middle_title{
	text-align: center;
	border: 1px solid;
	border-radius: 50px;
	width: 240px;
	margin: 0 auto;
}

.landscape{
	margin: 0 auto;
	overflow: hidden;
	width: 550px;
	height: 350px;
	background:#f3f8ff;
	border: 2px solid;
	padding: 2px;
}
</style>

@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4><i class="icon-copy fa fa-id-card-o" aria-hidden="true"></i>  @if($type == 1) মুক্তিযোদ্ধা ভাতা @elseif($type == 2) দুস্থ ও দরিদ্র ভাতা @elseif($type == 3) বয়স্ক ভাতা @elseif($type == 4) মাতৃত্যকালিন ভাতা @elseif($type == 5) বিধবা ভাতা @elseif($type == 6) প্রতিবন্ধী ভাতা @elseif($type == 7) ভি জি ডি ভাতা @endif প্রদান</h4><hr/>
            </div>

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ভাতার তালিকা</li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('show-allowance', ['type' => $type]) }}"> @if($type == 1) মুক্তিযোদ্ধাদের @elseif($type == 2) দুস্থ ও হত দরিদ্রদের @elseif($type == 3) বয়স্ক ভাতা প্রাপ্তদের @elseif($type == 4) মাতৃত্যকালিন ভাতার @elseif($type == 5) বিধবা ভাতার @elseif($type == 6) পপ্রতিবন্ধী ভাতার @elseif($type == 7) ভি জি ডি ভাতার @endif তালিকা</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $profile[0]->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 border">
                    <table>
                        <tr>
                            <td width="100" height="100">
                            <img src="{{ asset('images/allowance/'.$profile[0]->photo) }}" class="image-resposive pt-2" alt="vata.jpg">
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td><h5 class="pl-3">ভাতা গ্রহীতার নাম</h5></td>
                                        <td width="10"><h5> : </h5></td>
                                        <td><h5>{{ $profile[0]->name }}</h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5 class="pl-3">পিতার নাম</h5></td>
                                        <td width="10"><h5> : </h5></td>
                                        <td><h5>{{ $profile[0]->father_name }}</h5></td>
                                    </tr>
                                    <tr>
                                        <td><h5 class="pl-3">এনআইডি নং</h5></td>
                                        <td width="10"><h5> : </h5></td>
                                        <td><h5>{{ BanglaConverter::bn_number($profile[0]->nid) }}</h5></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2" class="p-2">
                                <table>
                                    <tr>
                                        <td width="50%">
                                            <table>
                                                <tr>
                                                    <td>শিক্ষাগত যোগ্যতা</td>
                                                    <td width="10">:</td>
                                                    <td>{{ $profile[0]->educational_qualification }}</td>
                                                </tr>
                                                <tr>
                                                    <td>গ্রাম/মহল্লা</td>
                                                    <td width="10">:</td>
                                                    <td>{{ $profile[0]->village }}</td>
                                                </tr>
                                                <tr>
                                                    <td>মোবাইল</td>
                                                    <td width="10">:</td>
                                                    <td>{{ BanglaConverter::bn_number($profile[0]->mobile) }}</td>
                                                </tr>
                                                @if($type == 1)
                                                <tr>
                                                    <td>সেক্টর নং</td>
                                                    <td width="10">:</td>
                                                    <td>{{ BanglaConverter::bn_number($profile[0]->sector_no) }}</td>
                                                </tr>
                                                @endif
                                                @if($type == 4)
                                                <tr>
                                                    <td>স্বাস্থ্যগত অবস্থা</td>
                                                    <td width="10">:</td>
                                                    <td>{{ $profile[0]->health_condition }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </td>
                                        <td width="50%" class="pl-2">
                                            <table>
                                                <tr>
                                                    <td>জম্ম তারিখ</td>
                                                    <td width="10">:</td>
                                                    <td>{{ BanglaConverter::bn_number($profile[0]->date_of_birth) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>ওয়ার্ড নং</td>
                                                    <td width="10">:</td>
                                                    <td>{{ BanglaConverter::bn_number($profile[0]->ward_no) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>ভাতার পরিমান</td>
                                                    <td width="10">:</td>
                                                    <td>{{ BanglaConverter::bn_number($profile[0]->amount_of_allowance) }}</td>
                                                </tr>
                                                @if($type == 4)
                                                <tr>
                                                    <td>আর্থ সামাজিক অবস্থা</td>
                                                    <td width="10">:</td>
                                                    <td>{{ $profile[0]->economical_condition }}</td>
                                                </tr>
                                                @endif
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><h4 class="text-center pt-2 text-blue">--:জীবনবৃত্তান্ত:--</h4></td>
                        </tr>
                        <tr>
                            <td colspan="2"><p class="text-justify">{{ $profile[0]->bio }}</p></td>
                        </tr>
                    </table>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                    <div class="landscape p-2">

                        <table style="margin:0 auto;">

                            <tr>
                                <td>
                                <img class="left_logo" src="{{ asset('images/union_profile/'.$profile[0]->union_logo) }}">
                                </td>
                                <td class="text-center">
                                    <p style="font-weight: bold;line-height: 3px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
                                    <p style="text-align: center;line-height: 3px;padding-top: 2px;">{{ $profile[0]->union_name_bn }}</p>
                                    <p style="text-align: center;line-height: 3px;">{{ $profile[0]->union_upazila }} , {{ $profile[0]->union_district }}</p>
                                </td>
                                <td>
                                    <img class="right_logo" src="{{ asset('images/allowance/'.$profile[0]->photo) }}" >
                                </td>
                            </tr>

                        </table><br>

                        <h4 class="middle_title">@if($type == 1) মুক্তিযোদ্ধা @elseif($type == 2) দুস্থ ও হত দরিদ্রদ @elseif($type == 3) বয়স্ক ও প্রাপ্তবয়স্ক @elseif($type == 4) মাতৃত্যকালিন @elseif($type == 5) বিধবা @elseif($type == 6) পপ্রতিবন্ধী @elseif($type == 7) ভি জি ডি @endif ভাতা কার্ড</h4><br>

                        <table style="width: 100%;">

                            <tr>
                                <td class="pl-2">নাম</td>
                                <td>:</td>
                                <td style="border-right: 1px dotted;">{{ $profile[0]->name }}</td>
                                <td class="pl-2">ওয়ার্ড নং</td>
                                <td>:</td>
                                <td>{{ BanglaConverter::bn_number($profile[0]->ward_no) }}</td>
                            </tr>

                            <tr>
                                <td class="pl-2">আইডি নং</td>
                                <td>:</td>
                                <td style="border-right: 1px dotted;">{{ BanglaConverter::bn_number($profile[0]->allowance_id) }}</td>
                                <td class="pl-2">গ্রাম</td>
                                <td>:</td>
                                <td>{{ $profile[0]->village }}</td>
                            </tr>

                            <tr>
                                <td class="pl-2">এন আই ডি নং</td>
                                <td>:</td>
                                <td style="border-right: 1px dotted;">{{ BanglaConverter::bn_number($profile[0]->nid) }}</td>
                                <td class="pl-2">মোবাইল</td>
                                <td>:</td>
                                <td>{{ BanglaConverter::bn_number($profile[0]->mobile) }}</td>
                            </tr>


                        </table>

                        <table style="width: 100%;border-top: 1px dotted;">
                            <tr>
                                <td class="" style="font-size: 12px;">

                                        <p>১.ভাতার বিস্তারিত জানতে QR কোডটি স্ক্যান করুন।</br>
                                        ২.কার্ডটি হস্তান্তরযোগ্য নয়।</br>
                                        ৩।কর্তৃপক্ষ কার্ডটি বাতিলের সিদ্বান্ত গ্রহণ করতে পারে।</p>

                                </td>
                                <td class="">
                                    <p style="text-align: center;font-size: 12px;padding-top: 40px;">
                                        চেয়ারম্যান <br>
                                        {{ $profile[0]->union_name_bn }}
                                    </p>
                                </td>
                                <td class="pl-1">
                                    @php $url = route('vata_card', ['type' => $type, 'id' => $profile[0]->id]); @endphp
                                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate($url)) !!} " style="width: 120px;height: 90px;padding-right: 14px;">
                                </td>
                            </tr>
                        </table>

                    </div>

                    @can('vata-card-print')
                    <div class="mt-2">
                    <a href="{{ route('vata_card', ['type' => $type, 'id' => $profile[0]->id]) }}" class="btn btn-info"><i class="icon-copy fa fa-print" aria-hidden="true"></i> Print ID Card</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-30">
        <div class="pd-20 bg-white border-radius-4 box-shadow height-100-p">
            <h4 class="text-center text-blue">প্রদেয় ভাতা</h4>
            <table class="data-table stripe hover nowrap">
                <thead>
                <tr>
                    <th class="table-plus datatable-nosort">নং</th>
                    <th class="">ভাতা প্রদানের তারিখ</th>
                    <th class="">বিবরণ</th>
                </tr>
                </thead>
                <tbody>

                @foreach($allowance as $key => $item)
                <tr>
                    <td class="table-plus">{{ $key + 1 }}</td>

                    <td class="">{{ $item->allowance_date }}</td>
                    <td class="">{{ $item->description }}</td>
                    <td></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>

        document.addEventListener("DOMContentLoaded", function (event) {
  document.getElementById("flip-card-btn-turn-to-back").style.visibility =
    "visible";
  document.getElementById("flip-card-btn-turn-to-front").style.visibility =
    "visible";

  document.getElementById("flip-card-btn-turn-to-back").onclick = function () {
    document.getElementById("flip-card").classList.toggle("do-flip");
  };

  document.getElementById("flip-card-btn-turn-to-front").onclick = function () {
    document.getElementById("flip-card").classList.toggle("do-flip");
  };
});

//This is for datatable
$('.data-table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        },
    });
    </script>
@endsection
