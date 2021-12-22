@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-file-text" aria-hidden="true"></i> সকল রশিদ সমূহ</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">একাউন্টস</li>
                        <li class="breadcrumb-item active" aria-current="page">রশিদ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->


    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">

                <label class="col-md-2">রশিদ ধরনঃ</label>
                <div class="col-md-2">
                    <select class="form-control" name="type" id="type">
                        <option value="">সিলেক্ট করুন</option>
                        <option value="1">নাগরিক সনদ</option>
                        <option value="2">মৃত্যু সনদ</option>
                        <option value="3">অবিবাহিত সনদ</option>
                        <option value="4">পুনঃবিবাহ না হওয়া সনদ</option>
                        <option value="5">একই নামের প্রত্যয়ন</option>
                        <option value="6">সনাতন ধর্মাবলম্বী সনদ</option>
                        <option value="7">প্রত্যয়ন</option>
                        <option value="8">নদী ভাঙনের সনদ</option>
                        <option value="9">চারিত্রিক সনদ</option>
                        <option value="10">ভূমিহিন সনদ</option>
                        <option value="11">বার্ষিক আয়ের সনদ</option>
                        <option value="12">প্রতিবন্ধি সনদ</option>
                        <option value="13">অনুমতি সনদ</option>
                        <option value="14">ভোটার আইডি স্থানান্তর সনদ</option>
                        <option value="15">অনাপত্তি</option>
                        <option value="17">ওয়ারিশ সনদ</option>
                        <option value="18">পারিবারিক সনদ</option>
                        <option value="19">ট্রেড লাইসেন্স</option>
                        <option value="20">বিবাহিত সনদ</option>
                        <option value="28">পেশা কর</option>
                        <option value="29">বসতভিটা কর</option>
                    </select>
                    <span id="type_error" class="error"></span>
                </div>

                <label class="col-md-1">হতেঃ</label>
                <div class="col-md-2">
                    <input type="text" name="from_date" id="from_date" value="{{ date('Y-m-d') }}"
                        class="form-control date"/>
                    <span id="from_date_error" class="error"></span>
                </div>

                <label class="col-md-1">পর্যন্তঃ</label>
                <div class="col-md-2">
                    <input type="text" name="to_date" id="to_date" value="{{ date('Y-m-d') }}" class="form-control date"/>
                    <span id="to_date_error" class="error"></span>
                </div>
                &nbsp;&nbsp;
                <input type="button" name="" value="  সার্চ" class="btn btn-primary" onclick="search()">

            </div>

        </div>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">

            <div class="row">

                <table class="table data-table">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Sonod No</th>
                            <th>Voucher</th>
                            <th>Amount</th>
                            <th>Acc Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>

        </div>
    </div>



@endsection

@section('script')

    <script>
        let types = [];

        types[1] = {url:"nagorik", text:"নাগরিক সনদ"};
        types[2] = {url:"death", text:"মৃত্যু সনদ"};
        types[3] = {url:"obibahito", text:"অবিবাহিত সনদ"};
        types[4] = {url:"punobibaho", text:"পুনঃবিবাহ না হওয়া সনদ"};
        types[5] = {url:"ekoinam", text:"একই নামের প্রত্যয়ন"};
        types[6] = {url:"sonaton", text:"সনাতন ধর্ম অবলম্বি সনদ"};
        types[7] = {url:"prottyon", text:"প্রত্যয়ন"};
        types[8] = {url:"nodibanga", text:"নদী ভাঙনের সনদ"};
        types[9] = {url:"character", text:"চারিত্রিক সনদ"};
        types[10] = {url:"vumihin", text:"ভূমিহীন সনদ"};
        types[11] = {url:"yearlyincome", text:"বার্ষিক আয়ের সনদ"};
        types[12] = {url:"protibondi", text:"প্রকৃত বাক ও শ্রবণ প্রতিবন্ধি সনদ"};
        types[13] = {url:"onumoti", text:"অনুমতি সনদ"};
        types[14] = {url:"voter", text:"ভোটার আইডি স্থানান্তর সনদ"};
        types[15] = {url:"onapotti", text:"অনাপত্তি প্ত্র"};
        types[16] = {url:"16", text:"রাস্তা খনন"};
        types[17] = {url:"warish", text:"ওয়ারিশ সনদ"};
        types[18] = {url:"family", text:"পারিবারিক সনদ"};
        types[19] = {url:"trade", text:"ট্রেড লাইসেন্স"};
        types[20] = {url:"bibahito", text:"বিবাহিত সনদ"};
        types[28] = {url:"trade/peshakor_money_receipt", text:"পেশা কর"};
        types[29] = {url:"accounts/home_tax_money_receipt", text:"বসতভিটা কর"};

        function search() {
            
            $('.data-table').DataTable().ajax.reload();
        }


        $('.data-table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {

                type: "get",
                url: "{{ route('rosid_list') }}",
                data: {
                    type : function () {
                        return $('#type :selected').val() || null;   
                    },
                    from_date: function(){
                        return $('#from_date').val() || null;
                    },
                    to_date: function(){
                        return $('#to_date').val() || null;
                    }
                },

            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'sonod_no',
                },
                {
                    data: 'voucher',
                },
                {
                    data: 'amount',
                },
                {
                    data: 'type',
                    render: function(data) {

                        if(types[data])
                        {
                            return types[data].text;
                        }
                        else
                        {
                            return data;
                        }
                    }
                },
                {
                    data: 'type',
                    orderable: false,
                    searchable: false,
                    render: function(data,type,row) {
                        
                        if(types[data])
                        {
                            if(data == 28)
                            {
                                return "<a  href='"+types[data].url+"/"+row.sonod_no+"' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";    
                            }
                            return "<a  href='"+types[data].url+"/money_receipt/"+row.sonod_no+"' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                        }
                        else
                        {
                            return data;
                        }
                    }
                },

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [
                [10, 15, -1],
                [10, 15, "All"]
            ],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            },
        });

    </script>

@endsection
