@extends('layouts.app')

@section('content')

    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4><i class="icon-copy fa fa-group" aria-hidden="true"></i> নাগরিক তালিকা</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                        <li class="breadcrumb-item active" aria-current="page">নাগরিক ব্যবস্থাপনা</li>
                        <li class="breadcrumb-item active" aria-current="page">নাগরিক তালিকা</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Export Datatable start -->

    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
        <div class="clearfix mb-20">
            <div class="row">
                <div class="col-md-1 text-right">&nbsp;</div>
            </div>

            <div class="row">
                <table class="stripe hover multiple-select-row data-table-export nowrap" id='nagorik_list_table'>
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">নং</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>পিতা</th>
                            <th>পিন</th>
                            <th>মোবাইল</th>
                            <th>গ্রাম</th>
                            <th>ওয়ার্ড</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

        nagorik_table = $('#nagorik_list_table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
                dataType: "JSON",
                type: "get",
                url: "{{ route('nagorik_list') }}",
                data: {

                },

            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'photo',
                    render: function(data) {

                        if (data != null) {
                            return "<img width='50' src='{{ asset('') }}/images/" + data +"' class='img-circle img-responsive' />";
                        } else
                        {
                            return "<img width='50' src='{{ asset('') }}/images/default_male.jpg' class='img-circle img-responsive' />";

                        }
                    }
                },
                {
                    data: 'name_bn',
                },
                {
                    data: 'father_name_bn',
                },
                {
                    data: 'pin',
                },
                {
                    data: 'mobile',
                },
                {
                    data: 'permanent_village_en',
                },
                {
                    data: 'permanent_ward_no',
                },

            ],
            columnDefs: [{
                targets: "datatable-nosort",
                orderable: false,
            }],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "language": {
                "info": "_START_-_END_ of _TOTAL_ entries",
                searchPlaceholder: "Search"
            }
        });

    </script>


@endsection
