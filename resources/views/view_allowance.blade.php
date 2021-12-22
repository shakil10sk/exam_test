@extends('layouts.master')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                <h3 style="color: white;"><i class="icon ion-document"></i> পৌরসভা @if($type == 1) মুক্তিযোদ্ধাদের @elseif($type == 2) দুস্থ ও দরিদ্র ভাতা গ্রহণকারীদের @elseif($type == 3) বয়স্ক ভাতা গ্রহণকারীদের @elseif($type == 4) মাতৃত্যকালিন ভাতা গ্রহণকারীদের @elseif($type == 5) বিধবা ভাতা গ্রহণকারীদের @elseif($type == 6) প্রতিবন্ধী ভাতা গ্রহণকারীদের @elseif($type == 7) ভি জি ডি ভাতা গ্রহণকারীদের @endif তালিকা</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>{{ $unionProfile->bn_name }} এ মোট {{ Converter::en2bn(count($data)) }} জন @if($type == 1) মুক্তিযোদ্ধা @elseif($type == 2) দুস্থ ও দরিদ্র ভাতা গ্রহণকারী @elseif($type == 3) বয়স্ক ভাতা গ্রহণকারী @elseif($type == 4) মাতৃত্যকালিন ভাতা গ্রহণকারী @elseif($type == 5) বিধবা ভাতা গ্রহণকারী @elseif($type == 6) প্রতিবন্ধী ভাতা গ্রহণকারী @elseif($type == 7) ভি জি ডি ভাতা গ্রহণকারী @endif রয়েছে।</h4>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
        @foreach ($data as $item)
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class = "panel panel-default">
                <div class = "panel-body" style="width: 100%;">
                    <div class="row">
                      <div class="col-md-5">
                        <img src="{{ env('ADMIN_ASSET_URL').'/images/allowance/'.$item->photo }}" alt="default.jpg" width="100%" height="180" />
                      </div>
                      <div class="col-md-7">
                      <p><strong>নাম: </strong>{{ $item->name }}</p>
                      <p><strong>পিতার নাম: </strong>{{ $item->father_name }}</p>
                      <p><strong>গ্রাম: </strong>{{ $item->village }}</p>
                      <p><strong>ওয়ার্ড নং: </strong>{{ $item->ward_no }}</p>
                      <p><strong>মোবাইল নং: </strong>{{ $item->mobile }}</p>
                      <p><strong>ভাতার পরিমাণ: </strong>{{ $item->amount_of_allowance }}</p>
                      <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseBio" aria-expanded="false" aria-controls="collapseBio">
                        জীবনবৃত্তান্ত
                      </button>
                      </div>
                      <div class="col-md-12" style="margin-top: 10px;">
                          <div class="collapse" id="collapseBio">
                            <div class="well">
                              @php
                                 echo $item->bio;
                              @endphp
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
             </div>
        </div>
        @endforeach
        </div>
    </div>
</section>

@endsection
