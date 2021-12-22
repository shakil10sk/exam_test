@extends('layout.main',['title'=> 'attendance'])

@section('content')
    {{-- <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="index-2.html">Admin</a>
            <span class="breadcrumb-item active">----</span>
        </nav>
    </div> --}}


    <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h2 class="tx-gray-800 mg-b-5">দৈনিক হাজিরার রিপোর্ট</h2>
    </div>

    <div class="br-pagebody ">
        <div class="br-section-wrapper m-0 p-0">
            <div class="card ">
                <div class="card-header">
                    <form action="{{ route('report.attendance') }}" method="get">
                        <div class="row text-dark">
                            <div class="form-group col-3">
                                <label for="">উপজেলা</label>
                                <select id="upazila_id" class="form-control select2" name="upazila">
                                    @if (auth()->user()->type <=3)
                                    <option value="">সকল উপজেলা</option>
                                    @endif
                                    @foreach ((object) json_decode($upazila) as $item)
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
                                <label for="">পদবী</label>
                                <select id="designation_select" class="form-control select2" name="designation_id">
                                    <option value="" >পদবী সিলেক্ট করুন</option>
                                    <option value="2" {{( isset($_GET['designation_id']) && $_GET['designation_id'] == 2)? 'selected':'' }}>সচিব</option>
                                    <option value="4" {{( isset($_GET['designation_id']) && $_GET['designation_id'] == 4)? 'selected':'' }}>উদ্যোক্তা </option>
                                    <option value="5" {{( isset($_GET['designation_id']) && $_GET['designation_id'] == 5)? 'selected':'' }}>গ্রামপুলিশ </option>
                                    <option value="6" {{( isset($_GET['designation_id']) && $_GET['designation_id'] == 6)? 'selected':'' }}>হিসাব সহকারী </option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">কর্মকর্তা/কর্মচারীর নাম</label>
                                <select id="employee_id" class="form-control select2" name="employee_id">
                                    <option value="">কর্মকর্তা সিলেক্ট করুন</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">হতে</label>
                                <input type="date" class="form-control" name="from" placeholder="" value="{{$_GET['from'] ?? date('Y-m-d')}}" data-format="yyyy-mm-dd">
                            </div>
                            <div class="form-group col-3">
                                <label for="">পর্যন্ত</label>
                                <input type="date" class="form-control" name="to" placeholder="" value="{{$_GET['to'] ?? date('Y-m-d')}}" data-format="yyyy-mm-dd">
                            </div>

                            <div class="form-group col-3">
                                <button type="submit" class="btn btn-info mg-t-25">submit</button>
                                {{-- <button class="btn btn-info ml-2 mg-t-25">submit</button>
                                --}}
                            </div>


                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table datatable text-dark">
                        <thead>
                            <tr>
                                <th>নং</th>
                                <th>আইডি</th>
                                <th>ইউনিয়ন</th>
                                <th>নাম</th>
                                <th>পদবী</th>
                                <th>মোবাইল নং</th>
                                <th>তারিখ</th>
                                <th>লগইন</th>
                                <th>লগআউট</th>
                                <th>স্ট্যাটাস</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendance ?? [] as $key => $item)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$item->record_id}}</td>
                                    <td>{{$item->employee->union->bn_name}}</td>
                                    <td>{{$item->employee->name}}</td>
                                    <td>
                                        @if ($item->employee->designation_id == 2)
                                            সচিব
                                        @elseif ($item->employee->designation_id == 4)
                                            উদ্যোক্তা
                                        @elseif ($item->employee->designation_id == 5)
                                            গ্রামপুলিশ
                                        @elseif ($item->employee->designation_id == 6)
                                            হিসাব সহকারী
                                        @endif
                                    </td>
                                    <td>{{$item->employee->mobile}}</td>
                                    <td>{{$item->attendance_date}}</td>
                                    <td>{{$item->login_time}}</td>
                                    <td>{{$item->logout_time}}</td>
                                    <td>{{ $item->status ?'উপস্থিত': 'অনুপুস্থিত'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id='upazila' value="{{ $upazila }}">

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

        $('#designation_select').change(() => {
            $.ajax({
                method: "get",
                url: "{{ route('report.employee-list') }}",
                data: {
                    union_id: $('#union_id').val(),
                    designation_id: $('#designation_select').val()
                },
                success: (data) => {

                    let employee = `<option value="">কর্মকর্তা সিলেক্ট করুন</option>`;
                    if(data.employee)
                    data.employee.forEach(item => {

                        employee += `<option value="` + item.employee_id + `">` + item.name + `</option>`;
                    });

                    $('#employee_id').html(employee);
                },
                error: () => {
                    alert('Error Occur');
                },
            });
        });

    </script>
@endpush
