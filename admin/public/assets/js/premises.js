//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

//fee calculation
function calculation() {

    $('#vat').val('');
    $('#total').val('');

    var fee = $("#fee").val();
    var due = $("#due").val();
    var discount = $("#discount").val();
    var signbord_vat = $("#signbord_vat").val();
    var source_vat = $("#source_tax").val();
    var sarcharge = $("#sarcharge").val();

    var total =0,vat = 0,amount = 0;


    //if due
    if (due > 0) {

        fee = parseInt(fee) + parseInt(due);

    }

    //if discaount
    if(discount > 0 ){

        fee = (parseInt(fee) - parseInt(discount));
    }

    vat = (fee * 15) / 100;

    //if signborad vat
    if (signbord_vat > 0) {

        fee = parseInt(fee) + parseInt(signbord_vat);
    }

    //if source vat
    if (source_vat > 0 ){
        fee = parseInt(fee) + parseInt(source_vat);
    }

    //if sarcharge
    if (sarcharge > 0) {

        fee = parseInt(fee) + parseInt(sarcharge);
    }


    total = (parseInt(fee) + parseInt(vat));

    $("#vat").val(vat);
    $("#total").val(total);
}


//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


//===datepicker===//
$('#issue_date, #payment_date, #trade_generate_date, #from_date, #to_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});


var premises_table, fiscal_year_id, from_date, to_date;
//===trade applicant list===//
function premises_applicant_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    premises_table = $('#premises_applicant_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url: premises_applicant_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: premises_applicant_csrf
            },
        },
        columns: [{
            data: null,
            render: function() {
                return premises_table.page.info().start + premises_table.column(0).nodes().length;
            }
        },{
            data: null,
            render:function(data, type, row) {
                return "<a class='link_color' href='edit/"+data.tracking+"'>"+data.organization_name_bn+"</a>";
            }
        },
        {
            data: "tracking"
        }, {
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
        }, {
            data: "business_type_bn"

        }, {
            data: "mobile"
        }, {
            data: "email"
        }, {
            data: "created_time"
        }, {
            data: null,
            render: function(data, type, row, meta) {
                var edit = '', del = '', generate = '';
                if($('#generate').val()){
                    generate = "<a  href='javascript:void(0)' onclick='premises_generate(" + meta.row + ")' ><p class='btn btn-sm btn-primary'>জেনারেট</p></a> ";
                }
                if($('#edit').val()){
                    edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                }
                if($('#delete').val()){
                    del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='premises_delete("+data.tracking+")' >ডিলিট</p></a> ";
                }
                return generate+edit+"<a  href='preview/" + data.tracking + "' target='_blank'><p class='btn btn-sm btn-success'>আবেদন প্র্রিন্ট</p></a> "+del;
            }
        }, ],
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
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
}


//====trade applicant search====//
function applicant_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#premises_applicant_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#premises_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#premises_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    premises_table.ajax.reload();
}

//get account list
    function account_list(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: url + "/global/account_list",
            type:"POST",
            dataType:"JSON",
            data:{},
            success:function(response){

                if(response['status'] == "success"){

                    var option;

                    response['data'].forEach(function(data) {

                        if (data.id == 28)
                            option += '<option value ="' + data.id + '"> ট্রেড লাইসেন্স</option>';

                        else
                            option += '<option value ="'+data.id+'">'+data.account_name+'</option>';

                    });

                    $("#account").html(option)

                }else{

                }
            }

        });
    }


//====trade generate====//
function premises_generate(row_index) {

    //bill genertate modal all fee reset
    $('#fee').val('');
    $('#due').val('');
    $('#due_fiscal_year').val('');
    $('#discount').val('');
    $('#vat').val('');
    $('#signbord_vat').val('');
    $('#pesha_vat').val('');
    $('#sarcharge').val('');
    $('#total').val('');


    var row_data = premises_table.row(row_index).data();


    //for account list show
    account_list();

    $("#tracking").val(row_data.tracking);
    $("#organization_name_bn").val(row_data.organization_name_bn);

    if (row_data.owner_type == 1) {

        $("#owner_type").val('ব্যক্তিগত');

    } else if (row_data.owner_type == 2) {

        $("#owner_type").val('যৌথ');

    } else {

        $("#owner_type").val('কোম্পানি');

    }

    $("#business_type").val(row_data.business_type_bn);
    $("#application_id").val(row_data.application_id);
    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.trade_upazila_id);
    $("#district_id").val(row_data.trade_district_id);

    $("#premises_generate_modal").modal('show');
}


//====trade generate save===//
function generate_save() {

    var tracking = $("#tracking").val();
    var expire_date = $("#expire_date").val();
    var issue_date = $("#issue_date").val();
    var payment_date = $("#payment_date").val();
    var due_fiscal_year = $("#due_fiscal_year").val();
    var application_id = $("#application_id").val();
    var union_id = $("#union_id").val();
    var upazila_id = $("#upazila_id").val();
    var district_id = $("#district_id").val();


    var credit_id = $("#account").val();
    var fee = $("#fee").val();
    var due = $("#due").val();
    var discount = $("#discount").val();
    var vat = $("#vat").val();
    var signbord_vat = $("#signbord_vat").val();
    var pesha_vat = $("#pesha_vat").val();
    var source_vat = $("#source_tax").val();
    var sarcharge = $("#sarcharge").val();
    var total = $("#total").val();
    var memo_no = $("#memo_no").val();



    var error_status = false;

    if (fee == null || fee < 1) {

        $('#fee_error').html('লাইসেন্স ফি দিতে হবে');

        error_status = true;

    }else{

        $('#fee_error').html('');

    }

    if(due > 0 && due_fiscal_year == ''){

        $('#due_fiscal_year_error').html('বকেয়া অর্থ বছর দিতে হবে');

        error_status = true;

    }else{

        $('#due_fiscal_year_error').html('');
    }

    if (error_status == false) {

        swal({
            title: "মোট "+total+" টাকা",
            text: "আপনি কি সনদটি জেনারেট করতে চান ?",
            type: "warning",
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "হ্যাঁ",
            showCancelButton: true,
            cancelButtonText: "না",
            showLoaderOnConfirm: true,
            preConfirm: function() {
                $.ajax({
                    url: url+"/premises/generate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        tracking: tracking,
                        due_fiscal_year: due_fiscal_year,
                        expire_date: expire_date,
                        issue_date: issue_date,
                        payment_date: payment_date,
                        union_id: union_id,
                        upazila_id: upazila_id,
                        district_id: district_id,
                        application_id: application_id,

                        credit_id: credit_id,
                        fee: fee,
                        due: due,
                        discount: discount,
                        vat: vat,
                        signbord_vat: signbord_vat,
                        pesha_vat: pesha_vat,
                        source_vat:source_vat,
                        sarcharge: sarcharge,
                        total: total,
                        memo:memo_no,

                        _token: premises_generate_csrf
                    },
                    success: function(response) {
                        $("#premises_generate_modal").modal('hide');
                        console.log(response);
                        swal({
                            title: "ধন্যবাদ",
                            text: response.message,
                            type: response.status,
                            showCancelButton: true,
                            cancelButtonText: "বাতিল",
                            showConfirmButton: true,
                            confirmButtonText: '<a href="' + premises_bangla_sonod_url + '/' + response.sonod_no + '" target="_blank">প্রিন্ট</a>',
                            closeOnConfirm: true,
                            allowEscapeKey: false
                        })
                        premises_table.ajax.reload();
                    }
                });
            }
        }).then(function() {});

    }else{
        return false;
    }
}


//===premises delete===//
function premises_delete(tracking) {

    swal({
        title: "অনুমোদন",
        text: "আপনি কি আবেদনটি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: premises_delete_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    tracking: tracking,
                    _token: premises_delete_csrf
                },
                success: function(response) {
                    swal({
                        title: "মোছা হয়েছে!",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                    trade_table.ajax.reload();
                }
            });
        }
    }).then(function() {});
}


// this is for trade certificate list
var premises_certificate_table;

//==for trade certificate list===//
function premises_certificate_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    premises_certificate_table = $('#premises_certificate_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url: premises_certificate_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: premises_certificate_csrf
            },
        },
        columns: [{
            data: null,
            render: function() {
                return premises_certificate_table.page.info().start + premises_certificate_table.column(0).nodes().length;
            }
        }, {
            data: null,
            render:function(data, type, row) {
                return "<a class='link_color' href='edit/"+data.tracking+"'>"+data.organization_name_bn+"</a>";
            }
        },{
            data: "tracking"
        },
        {
            data: "sonod_no"
        },
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
        }, {
            data: null,
            render: function(data, type, row) {
                return "পাইকারি";
            }
        }, {
            data: "mobile"
        }, {
            data: "email"
        }, {
            data: "generate_date"
        }, {
            data: null,
            render: function(data, type, row, meta) {
                var edit = '', regenerate = '', invoice = '';
                    if($('#regenerate').val()){
                        regenerate = "<a  href='javascript:void(0)' onclick='premises_regenerate("+meta.row+")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }
                    if($('#edit').val()){
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                    }
                    if($('#invoice').val()){
                        invoice = "<a  href='money_receipt/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                    }
                return "<a  href='print_bn/" + data.sonod_no + "' target='_blank' ><p class='btn btn-sm btn-primary '>বাংলা</p></a>  <a  href='print_en/" + data.sonod_no + "' target='_blank' ><p class='btn btn-sm btn-success'>ইংরেজি</p></a> "+edit+invoice;
            }
        }, ],
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
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
}



//this is for trade certificate list search
function certificate_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#premises_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#premises_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#premises_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    premises_certificate_table.ajax.reload();
}

var fiscal_year; var prev_certi_table;
//==for previous trade certificate list===//
function previous_trade_certificate_list() {

    from_date = $("#from_date").val();
    to_date = $("#to_date").val();
    fiscal_year = $("#fiscal_year_id").val();

    // alert(from_date);
    prev_certi_table = $('#trade_certificate_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url: trade_certificate_data_url,
            data: {
                from_date: from_date,
                to_date: to_date,
                fiscal_year: fiscal_year,
                _token: trade_certificate_csrf
            },
        },
        columns: [{
            data: null,
            render: function() {
                return prev_certi_table.page.info().start + prev_certi_table.column(0).nodes().length;
            }
        }, {
            data: null,
            render:function(data, type, row) {
                return "<a class='link_color' href='edit/"+data.tracking+"'>"+data.organization_name_bn+"</a>";
            }
        },{
            data: "tracking"
        },
        {
            data: "sonod_no"
        },
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
        }, {
            data: null,
            render: function(data, type, row) {
                return "পাইকারি";
            }
        }, {
            data: "mobile"
        }, {
            data: "email"
        }, {
            data: "generate_date"
        }, {
            data: null,
            render: function(data, type, row, meta) {
                var edit = '', regenerate = '', invoice = '';
                    if($('#regenerate').val()){
                        regenerate = "<a  href='javascript:void(0)' onclick='trade_regenerate("+meta.row+")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }
                    if($('#edit').val()){
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                    }
                    if($('#invoice').val()){
                        invoice = "<a  href='money_receipt/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                    }
                return "<a  href='previous_print_bn/" + data.sonod_no + "/2' target='_blank' ><p class='btn btn-sm btn-primary '>বাংলা</p></a>  <a  href='previous_print_en/" + data.sonod_no + "/2' target='_blank' ><p class='btn btn-sm btn-success'>ইংরেজি</p></a> "+edit+invoice;
            }
        }, ],
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
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
}



//this is for previous trade certificate list search
function previous_certificate_list_search() {

    from_date = $("#from_date").val();
    to_date = $("#to_date").val();
    fiscal_year = $("#fiscal_year_id").val();

    $("#premises_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#premises_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;
    $("#premises_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year = fiscal_year;

    prev_certi_table.ajax.reload();
}


//====trade re-generate====//
function premises_regenerate(row_index) {

    var row_data = $('#premises_certificate_table').DataTable().row(row_index).data();

     //trade re-genertate modal all fee reset
     $('#fee').val('');
     $('#due').val('');
     $('#due_fiscal_year').val('');
     $('#discount').val('');
     $('#vat').val('');
     $('#signbord_vat').val('');
     $('#pesha_vat').val('');
     $('#sarcharge').val('');
     $('#total').val('');
     $('#fee_error').html('');
     $('#due_fiscal_year_error').html('');

     //for account list show
     account_list();

     $("#tracking").val(row_data.tracking);
     $("#organization_name_bn").val(row_data.organization_name_bn);

     if (row_data.owner_type == 1) {

         $("#owner_type").val('ব্যক্তিগত');

     } else if (row_data.owner_type == 2) {

         $("#owner_type").val('যৌথ');

     } else {

         $("#owner_type").val('কোম্পানি');

     }

     $("#business_type").val(row_data.business_type);
     $("#certificate_id").val(row_data.certificate_id);
     $("#sonod_no").val(row_data.sonod_no);
     $("#union_id").val(row_data.union_id);
     $("#upazila_id").val(row_data.trade_upazila_id);
     $("#district_id").val(row_data.trade_district_id);
     $("#premise_regenerate_modal").modal('show');

}


var table
//====premises re-generate save===//
function re_generate_save() {

    var tracking = $("#tracking").val();
    var sonod_no = $("#sonod_no").val();
    var expire_date = $("#expire_date").val();
    var issue_date = $("#issue_date").val();
    var payment_date = $("#payment_date").val();
    var due_fiscal_year = $("#due_fiscal_year").val();
    var certificate_id = $("#certificate_id").val();
    var union_id = $("#union_id").val();
    var upazila_id = $("#upazila_id").val();
    var district_id = $("#district_id").val();


    var credit_id = $("#account").val();
    var fee = $("#fee").val();
    var due = $("#due").val();
    var discount = $("#discount").val();
    var vat = $("#vat").val();
    var signbord_vat = $("#signbord_vat").val();
    var sarcharge = $("#sarcharge").val();
    var total = $("#total").val();

    var error_status = false;

    if (fee == '') {

        $('#fee_error').html('লাইসেন্স ফি দিতে হবে');

        error_status = true;

    }else{

        $('#fee_error').html('');

    }

    if(due != '' && due_fiscal_year == ''){

        $('#due_fiscal_year_error').html('বকেয়া অর্থ বছর দিতে হবে');

        error_status = true;

    }else{

        $('#due_fiscal_year_error').html('');
    }

    if (error_status == false) {

        swal({
            title: "মোট "+total+" টাকা",
            text: "আপনি কি সনদটি রি-জেনারেট করতে চান ?",
            type: "warning",
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "হ্যাঁ",
            showCancelButton: true,
            cancelButtonText: "না",
            showLoaderOnConfirm: true,
            preConfirm: function() {
                $.ajax({
                    url: url+"/premises/regenerate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        sonod_no: sonod_no,
                        tracking: tracking,
                        due_fiscal_year: due_fiscal_year,
                        expire_date: expire_date,
                        issue_date: issue_date,
                        payment_date: payment_date,
                        union_id: union_id,
                        upazila_id: upazila_id,
                        district_id: district_id,
                        certificate_id: certificate_id,

                        credit_id: credit_id,
                        fee: fee,
                        due: due,
                        discount: discount,
                        vat: vat,
                        signbord_vat: signbord_vat,
                        sarcharge: sarcharge,
                        total: total,

                        _token: csrf
                    },
                    success: function(response) {
                        $("#premise_regenerate_modal").modal('hide');
                        swal({
                            title: "ধন্যবাদ",
                            text: response.message,
                            type: response.status,
                            showCancelButton: true,
                            cancelButtonText: "বাতিল",
                            showConfirmButton: true,
                            confirmButtonText: '<a href="' + premises_bangla_sonod_url + '/' + response.sonod_no + '" target="_blank">প্রিন্ট</a>',
                            closeOnConfirm: true,
                            allowEscapeKey: false
                        })
                        table.ajax.reload();
                    }
                });
            }
        }).then(function() {});

    }else{
        return false;
    }
}


// this is for pesha kor list
var pesha_kors;

//==for trade certificate list===//
function pesha_kor_list() {

    from_date = $("#from_date").val();
    to_date = $("#to_date").val();

    pesha_kors = $('#pesha_kor_list_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,

        ajax: {
            dataType: "JSON",
            type: "post",
            url: url + '/trade/pesha_kor_list',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            data: {
                from_date: from_date,
                to_date: to_date,
                // _token: pesha_csrf
            },
        },
        columns: [{
            data: null,
            render: function() {
                return pesha_kors.page.info().start + pesha_kors.column(0).nodes().length;
            }
        },

        {
            data: "organization_name_bn"
        },{
            data: "tracking"
        },
        {
            data: "voucher"
        },
        {
            data: "sonod_no"
        },
        {
            data: "amount"
        },
        {
            data: "payment_date"
        },
        {
            data: null,
            render: function(data, type, row, meta) {
                if($('#income-tax-invoice').val()){
                    return "<a  href='peshakor_money_receipt/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                }else{
                    return '';
                }
            }
        },],
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
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
}



//this is for pesha kor list search
function pesha_kor_list_search() {

    from_date = $("#from_date").val();
    to_date = $("#to_date").val();

    // alert(from_date);
    $("#pesha_kor_list_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#pesha_kor_list_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    pesha_kors.ajax.reload();
}

//collect pesha kor

function collect_pesha_kor(){

    //value reset
    $('#sonod_no').val('');
    $('#tracking').val('');
    $('#organization_name').val('');
    $('#voucher').val('');
    $('#pesha_kor').val('0.00');

    //empty existing error
    $('#error_show').html('');

    $("#pesha_kor_modal").modal('show');
}

//get pesha kor data
function peshakor_data_search(){

    var sonod_no = $('#sonod_no').val();

    $.ajax({
        url:url + '/trade/get_pesha_kor_data',
        type:'POST',
        dataType:"JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{sonod_no:sonod_no},
        success:function(response){

            if (response.status == 'error') {

                //show existing error message
                $('#error_show').html(response.message);

                //reset value reset
                $('#tracking').val('');
                $('#organization_name').val('');
                $('#voucher').val('');
                $('#pesha_kor').val('0.00');

            }else{

                $('#error_show').html('');

                $('#tracking').val(response.data.tracking);
                $('#organization_name').val(response.data.organization_name_bn);
                $('#voucher').val(response.data.voucher);
            }
        }

    });
}

//pesha kor save
function pesha_kor_save(){

    var sonod_no = $('#sonod_no').val();
    var tracking = $('#tracking').val();
    var voucher = $('#voucher').val();
    var pesha_kor = $('#pesha_kor').val();
    var payment_date = $('#payment_date').val();

    var error_status = false;

    if (sonod_no == '') {

        $('#sonod_no_error').html('সনদ নাম্বার প্রদান করুন');
        error_status = true;

    }else{

        $('#sonod_no_error').html('');
    }

    if (pesha_kor == 0.00 ) {

        $('#pesha_kor_error').html('কর প্রদান করুন');
        error_status = true;


    }else{

        $('#pesha_kor_error').html('');


    }

    if (error_status == false) {

        $.ajax({
            url:url+ '/trade/pesha_kor_save',
            type:'POST',
            dataType:'JSON',
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            data:{
                sonod_no:sonod_no,
                tracking:tracking,
                voucher:voucher,
                pesha_kor:pesha_kor,
                payment_date:payment_date,
            },
            success:function(response){

                $('#pesha_kor_modal').modal('hide');

                if (response.status == 'success') {
                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText: "বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: "<a  href='peshakor_money_receipt/" + response.sonod_no + "' target='_blank'>প্রিন্ট</a>",
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                    pesha_kors.ajax.reload();

                }else{

                     swal({
                        title: "দুঃখিত",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText: "বাতিল",
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                     pesha_kors.ajax.reload();
                }


            }

        });

    }else{

        return false;
    }


}
