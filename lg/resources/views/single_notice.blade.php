@extends('layouts.master')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                    <h4 style="color: white;"><i class="icon ion-document"></i> নোটিশ</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-offset-2">
                    <div class="content-area-boxes">
                        <div class="tottho">
                            <div class="about-content-full">
                                <div class="left-boxes-content">
                                    <div class="row">
                                        
                                        <ul>
                                            <li style="border-bottom: 1px dashed gray; margin-top: 20px; font-size: 14px;">
                                                <h4><strong>{{ $notice->title }}</strong> (<strong>প্রকাশকাল: </strong>{{ Converter::en2bn($notice->created_at->format('d-m-Y')) }}ইং)</h4><br/>
                                                @php
                                                    echo $notice->details;
                                                @endphp
                                                @if($notice->document)
                                                <br>
                                                    <a href="{{ env('ADMIN_ASSET_URL').'/files/notice/'.$notice->document }}" download="{{ $unionProfile->bn_name.'_notice_'.date('Y-m-d', time()).'_'.$notice->document }}" class="btn btn-info" style="margin-bottom: 10px;">ডাউনলোড নোটিশ</a>
                                                @endif
                                            </li>
                                        </ul>
                                        <div class="see-alls">
                                            <a href="{{ route('/') }}" class="btn btn-see btn-sm">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection