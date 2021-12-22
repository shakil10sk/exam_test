
@extends('layouts.app') @section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active" aria-current="page">প্রিমিসেস লাইসেন্স ব্যবস্থাপনা</li>
                    <li class="breadcrumb-item active" aria-current="page">মেয়াদ উত্তীর্ন প্রিমিসেস লাইসেন্স সমূহ</li>

                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- Export Datatable start -->
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

    <div class="row text-center">
        @if(Session::has('message'))
        <p style="margin:0 auto;" class="alert alert-success ">{{ Session::get('message') }}</p>
        @endif
    </div>

    <div class="clearfix mb-20">

        <div class="row">
            <table class="stripe hover multiple-select-row data-table-export nowrap" id='premises_certificate_table'>
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">নং</th>
                        <th>প্রতিষ্ঠানের নাম</th>
                        <th>ট্রাকিং</th>
                        <th>সনদ নং</th>
                        <th>মালিকানার ধরন</th>
                        <th>ব্যবসার ধরন</th>
                        <th>মোবাইল</th>
                        <th>ই-মেইল</th>
                        <th>মেয়াদ উত্তীর্ণের তারিখ</th>
                        <th>জেনারেট তারিখ</th>
                        <th>Action</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>
    <!-- Export Datatable End -->
    {{-- @can('generate') --}}
    <div class="modal fade bs-example-modal-lg" id="premise_regenerate_modal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 840px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">প্রিমিসেস লাইসেন্স রি-জেনারেট</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form action="javascript:void(0)" method="post">

                        @csrf

                        <div class="row">

                            {{-- start modal left section --}}
                            <div class="col-md-6">

                                <div class="row">
                                    <label class="col-md-4 text-right">ট্র্যাকিং</label>

                                    <input class="form-control col-md-8" type="text" name="tracking" id="tracking" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">প্রতিষ্ঠানের নাম</label>

                                    <input class="form-control col-md-8" type="text" name="organization_name_bn" id="organization_name_bn" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ব্যবসার ধরণ</label>

                                    <input class="form-control col-md-8" type="text" name="business_type" id="business_type" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মালিকানার ধরণ</label>

                                    <input class="form-control col-md-8" type="text" name="owner_type" id="owner_type" readonly="readonly" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মেয়াদকাল</label>

                                    <input class="form-control col-md-8" type="text" name="expire_date" id="expire_date" readonly="readonly" value="<?php  $year = date('Y')+1; echo $year."-06-30"; ?>" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ইস্যু তারিখ</label>

                                    <input class="form-control col-md-8" type="text" name="issue_date" id="issue_date" value="{{ date('Y-m-d') }}" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">Payment Type</label>

                                    <select name="account" id="account" class="form-control col-md-8">
                                        <option value="">Select</option>

                                    </select>
                                </div></br>

                                 <div class="row">
                                    <label class="col-md-4 text-right">Payment Date</label>

                                    <input class="form-control col-md-8" type="text" name="payment_date" id="payment_date" value="{{ date('Y-m-d') }}" />
                                </div>

                            </div>

                            {{-- end modal left section --}} {{--start modal right section --}}
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4 text-right">লাইসেন্স ফি</label>

                                    <input class="form-control col-md-7" type="text" name="fee" id="fee" onchange="calculation()" />

                                    <span class="error col-md-12 text-center" id="fee_error"></span>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">বকেয়া</label>

                                    <input class="form-control col-md-7" type="text" name="due" id="due" onchange="calculation()" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">বকেয় অর্থ বছর</label>

                                    <input class="form-control col-md-7" type="text" name="due_fiscal_year" id="due_fiscal_year" placeholder="2018-2019" />

                                    <span class="error col-md-12 text-center" id="due_fiscal_year_error"></span>
                                </div>
                                </br>

                                 <div class="row">
                                    <label class="col-md-4 text-right">ছাড়</label>

                                    <input class="form-control col-md-7" type="text" name="discount" id="discount" onchange="calculation()" placeholder="কোন ছাড় দিতে চাইলে" />
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">ভ্যাট(১৫%)</label>

                                    <input class="form-control col-md-7" type="text" name="vat" id="vat" readonly="readonly" />

                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">সাইনবোর্ড কর</label>

                                    <input class="form-control col-md-7" type="text" name="signbord_vat" id="signbord_vat" onchange="calculation()"/>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">সাব চার্জ</label>

                                    <input class="form-control col-md-7" type="text" name="sarcharge" id="sarcharge" onchange="calculation()"/>
                                </div>
                                </br>

                                <div class="row">
                                    <label class="col-md-4 text-right">মোট</label>

                                    <input class="form-control col-md-7" type="text" name="total" id="total" readonly="readonly" />
                                </div>
                                </br>

                            </div>
                            {{-- end modal right section --}}
                        </div>

                        <input type="hidden" name="sonod_no" id="sonod_no" />

                        <input type="hidden" name="certificate_id" id="certificate_id" />

                        <input type="hidden" name="union_id" id="union_id" />

                        <input type="hidden" name="upazila_id" id="upazila_id" />

                        <input type="hidden" name="district_id" id="district_id" />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="re_generate_save()">রি-জেনারেট</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">বাতিল</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- @endcan --}}

@endsection

@section('script')

<script type="text/javascript">

    //url for print trade sonod
    var premises_bangla_sonod_url = '@php echo  url("premises/print_bn") @endphp';

    $(function () {

      var table = $('#premises_certificate_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
          ajax: "{{ route('premises_expire_certificate_list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'organization_name_bn', name: 'organization_name_bn'},
              {data: 'tracking', name: 'tracking'},
              {data: 'sonod_no', name: 'sonod_no'},
              {
                data: null,
                render: function(data, type, row) {
                    if (data.owner_type == 1) {
                        return "ব্যক্তিগত";
                    } else if (data.owner_type == 2) {
                        return "যৌথ";
                    } else {
                        return "কোম্পানি";
                    }
                }
              },
              {data: 'business_type', name: 'business_type'},
              {data: 'mobile', name: 'mobile'},
              {data: 'email', name: 'email'},
              {
                  data: null,
                  render: function(data, type, row){
                        return "<span class='text-danger font-weight-bold'>" + data.expire_date + "</span>";
                  }
              },
              {data: 'generate_date', name: 'generate_date'},

              {
                data: 'certificate_id', name: 'certificate_id',
                    render: function(data, type, row, meta) {

                        return "<a  href='javascript:void(0)' onclick='premises_regenerate("+meta.row+")' ><p " +
                            "class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a>"
                    }
              },
          ]
      });

    });




</script>

<script src="{{ asset('js/premises.js') }}"></script>

@endsection
