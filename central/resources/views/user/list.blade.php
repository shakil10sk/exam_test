@extends('layout.main',['title'=> 'User List'])

@section('content')
    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Admin</a>
            <span class="breadcrumb-item active">----</span>
        </nav>
    </div> --}}


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h2 class="tx-gray-800 mg-b-5">ইউজার সমূহ</h2>
    </div>

    <div class="br-pagebody ">
        <div class="br-section-wrapper m-0 p-0">
            <div class="card ">
                
                <div class="card-body">
                    <table class="table datatable text-dark">
                        <thead>
                            <tr>
                                <th>নং</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>ইউজার নাম</th>
                                <th>পদ</th>
                                @if (auth()->user()->type == 1 )
                                <th>জেলা</th>
                                @endif
                                <th>উপজেলা</th>
                                <th>মোবাইল</th>
                                <th>অ্যাকশান</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ( $users ?? [] as $key => $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>
                                        @if (($item->profile->photo ?? '' ) == '')
                                        <img src="{{ asset('images/default_user.webp') }}" height="70" width="80" />
                                        @else
                                        <img src="{{ env('STORAGE_URL').'/images/profile/'.$item->profile->photo}}" height="70" width="80" />
                                        @endif
                                        
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->profile->bcs_batch}}</td>
                                    @if (auth()->user()->type == 1 )
                                    <td>{{$item->district_bn}}</td>
                                    @endif
                                    <td>{{$item->upazila_bn}}</td>
                                    <td>{{$item->profile->mobile}}</td>
                                    <td> 
                                        @if ( auth()->user()->type == 1 || ($item->type > 3))
                                        <a class="btn btn-sm btn-warning" href="{{route('get.profile.edit',$item->id)}}" >Edit</a> |
                                        @endif
                                        @if (!$item->is_active)
                                            <button onclick="$('#post_form').attr('action','{{route('user.chagneStatus',[$item->id,1])}}');$('#post_form').submit();" class="btn btn-sm btn-outline-success" >Active</button>
                                        @else
                                            <button onclick="$('#post_form').attr('action','{{route('user.chagneStatus',[$item->id,0])}}');$('#post_form').submit();" class="btn btn-sm btn-outline-danger" >Deactive</button>
                                        @endif 
                                        |
                                        <button onclick="$('#post_form').attr('action','{{route('user.delete',$item->id)}}');$('#post_form').submit()" class="btn btn-sm btn-danger">Delete</button>
                                     </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- used for submmiting post request --}}
    <form id="post_form" method="post" action=""> 
        @csrf
    </form>

@endsection

