@extends('layouts.master')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center bg-primary" style="margin-top: 20px; margin-bottom: 20px; border-radius: 4px;">
                <h3 style="color: white;"><i class="icon ion-document"></i> ইউপি ভোটারদের তালিকা</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>{{ $unionProfile->bn_name }} এ মোট {{ Converter::en2bn(count($data)) }} জন ভোটার এর তথ্য যোগ করা হয়েছে।</h4>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">  
                <div style="padding:4px;width:100%;">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="color: #000102;font-weight:bolder;" width="100%" cellspacing="0">
                    
                        <thead>
                            <tr>
                                <th>ক্রমিক নং</th>
                                <th>নাম</th>
                                <th>লিঙ্গ</th>
                                <th>পিতার নাম</th>
                                <th>ওয়ার্ড নং</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <td>{{ Converter::en2bn($key + 1) }}</td>
                                    <td>{{ $item->name_bn }}</td>
                                    <td>{{ ($item->gender == 1)? 'পুরুষ' : 'মহিলা' }}</td>
                                    <td>{{ $item->father_name_bn }}</td>
                                    <td>{{ Converter::en2bn($item->permanent_ward_no) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection