@extends('layouts.master')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                    <h4 style="color: white;">{{ $unionProfile->bn_name }} তথ্য</h4>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-offset-1">
                    <div class="content-area-boxes">
                        <div class="tottho">
                            <div class="about-content-full">
                                <div class="left-boxes-content">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                                echo $unionProfile->about;
                                            @endphp
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
        </div>
    </section>

@endsection
