@extends('layout.main',['title'=> 'Report Register'])

@section('content')
    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Admin</a>
            <span class="breadcrumb-item active">----</span>
        </nav>
    </div> --}}


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h2 class="tx-gray-800 mg-b-5">{{$hearder}}</h2>
    </div>

    <div class="br-pagebody ">
        <div class="br-section-wrapper m-0 p-0">
            <div class="card ">
                <div class="card-header">
                    <form action="{{ route('report-register.reportResgister',$type) }}" method="get">
                        <div class="row text-dark">
                            <div class="form-group col-3">
                                <label for="">উপজেলা</label>
                                <select id="upazila_id" class="form-control select2" name="upazila">
                                    <option value="">উপজেলা সিলেক্ট করুন</option>
                                    @foreach ((object) json_decode($upazila ?? '') as $item)
                                        <option value="{{ $item->id }}" {{($item->id == ($_GET['upazila'] ?? '') )? "selected" : ""}}>{{ $item->bn_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">ইউনিয়ন</label>
                                <select id="union_id" class="form-control select2" name="union">
                                    <option value="">ইউনিয়ন নাম</option>
                                </select>
                            </div>
                           
                            <div class="form-group col-3">
                                <button type="submit" class="btn btn-info mg-t-25">submit</button>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table datatable text-dark">
                        <thead>
                            <tr>
                                <th>নং</th>
                                <th>টাইটেল</th>
                                <th>ফাইল</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report_resgister ?? [] as $key => $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->title}}</td>
                                    <td> <a href="{{env('ADMIN_URL').'\public\assets\reports\\'.$item->file}}" download="{{$item->file}}">Download</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id='upazila' value="{{ $upazila ?? '' }}">

@endsection

@push('script')
    <script>
        select_update_upzila();
        $('#upazila_id').change(() => {
            // console.log($('#upazila_id').val());
            select_update_upzila();
        });

        function select_update_upzila() {
            let loop = false;
            let union = null;
            JSON.parse($('#upazila').val()).forEach(el => {
                if (loop) {
                    return;
                }

                union = `<option value="">ইউনিয়ন নাম</option>`;

                if (el.union)
                    el.union.forEach(item => {
                        if('{{$_GET["union"]??null}}' == item.union_code)
                        {
                            union += `<option value="` + item.union_code + `" selected="selected" >` + item.bn_name + `</option>`;
                        }
                        else
                        {
                            union += `<option value="` + item.union_code + `">` + item.bn_name + `</option>`;
                        }
                    });

                if ($('#upazila_id').val() == el.id) {
                    loop = true;
                }
            });

            $('#union_id').html(union);
        }

    </script>
@endpush
