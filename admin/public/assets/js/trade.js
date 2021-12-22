//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

//fee calculation
function calculation() {

    var fee = parseInt($("#fee").val()) || 0;
    var discount = parseInt($("#discount").val()) || 0;
    var vat = parseInt($("#vat").val()) || 0;
    var bibidh = parseInt($("#bibidh").val()) || 0;
    var signboard_vat = parseInt($("#signbord_vat").val()) || 0;
    var source_vat = parseInt($("#source_tax").val()) || 0;
    var sarcharge = parseInt($("#sarcharge").val()) || 0;
    var due = parseInt($("#due").val()) || 0;

    var total = 0;
    // due tax //
    // var dueTax = (parseInt(due) * 15) / 100;

    // vat +=  dueTax; // add dueTax into main Tax //

    // console.log(source_vat);
    // console.log(general_settings['max_source_tax']);

    // console.log(typeof source_vat);
    // console.log(typeof general_settings['max_source_tax']);

    // if source tax cross the max_source_tax
    if(general_settings['max_source_tax'] > 0 && source_vat > general_settings['max_source_tax']){
        source_vat = 0;
        $("#source_tax").val(source_vat);
        $("#source_tax_error").html('সর্বোচ্চ উৎসে কর ' + general_settings['max_source_tax'] + ' টাকা');
    }


    total = parseInt(fee) - parseInt(discount) + Math.round(vat) + parseInt(signboard_vat) + parseInt(source_vat) + parseInt(sarcharge) + parseInt(due) + parseInt(bibidh);

    $("#vat").val(Math.round(vat).toString());
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


var trade_table, fiscal_year_id, from_date, to_date;

//===trade applicant list===//
function trade_applicant_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    trade_table = $('#trade_applicant_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url: trade_applicant_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: trade_applicant_csrf
            },
        },
        columns: [{
            data: null,
            render: function() {
                return trade_table.page.info().start + trade_table.column(0).nodes().length;
            }
        },{
            data: null,
            render:function(data, type, row) {
                return "<a class='link_color' href='edit/" + data.fiscal_year_id + "/" + data.tracking + "'>"+data.organization_name_bn+"</a>";
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
                }else if (data.owner_type == 3) {
                    return "কোম্পানি";
                }
                else {
                    return "ব্যাংক অথবা আর্থিক প্রতিষ্ঠান";
                }
            }
        }, {
            data: "business_type_bn",

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
                    generate = "<a  href='javascript:void(0)' onclick='trade_generate(" + meta.row + ")' ><p class='btn btn-sm btn-primary'>জেনারেট</p></a> ";
                }
                if($('#edit').val()){
                    edit = "<a  href='edit/" + data.fiscal_year_id + "/" + data.tracking + "'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                }
                if($('#delete').val()){
                    del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='trade_delete("+data.tracking+")' >ডিলিট</p></a> ";
                }

                return generate+edit+"<a  href='preview/" + data.fiscal_year_id + '/' + data.tracking + "' target='_blank'><p class='btn btn-sm btn-success'>আবেদন প্র্রিন্ট</p></a> "+del;
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

    // alert(from_date);
    $("#trade_applicant_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#trade_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#trade_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    trade_table.ajax.reload();
}

// get account list
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
function trade_generate(row_index) {
    // bill genertate modal all fee reset
    $('#fee').val('');
    $('#discount').val('');
    $('#vat').val('');
    $('#bibidh').val('');
    $('#source_tax').val('');
    $('#signbord_vat').val('');
    $('#sarcharge').val('');
    $('#due').val('');
    $('#total').val('');

    $("#license_fee_error").html('');
    $("#signboard_fee_error").html('');
    $("#source_tax_error").html('');

    var row_data = trade_table.row(row_index).data();

    // set default value
    if(typeof general_settings['vat'] == 'undefined'){
        general_settings['vat'] = 15;
    }

    if(typeof general_settings['max_source_tax'] == 'undefined'){
        general_settings['max_source_tax'] = 0;
    }

    if(typeof general_settings[row_data.signboard_type] == 'undefined'){
        $("#signboard_fee_error").html('Signboard fee system settings not found');
        general_settings[row_data.signboard_type] = 0;
    }

    if(row_data.signboard_type == null){
        $("#signboard_fee_error").html('');
    }

    var total = 0;

    // console.log(row_data);

    // console.log(typeof business_fee[row_data.business_type] == 'undefined');
    // console.log(business_fee[row_data.business_type]);

    // assign fees
    if(typeof business_fee[row_data.business_type] == 'undefined'){
        $("#license_fee_error").html('Business type fee system settings not found');
        business_fee[row_data.business_type] = 0;
    }

    var signboard_fee = 0;
    var signboard_tax = 0;

    if(row_data.signboard_type && row_data.signboard_length && row_data.signboard_width){
        var signboard_fee = general_settings[row_data.signboard_type];
        var signboard_tax = signboard_fee * parseInt(((parseInt(row_data.signboard_length) || 0) * (parseInt(row_data.signboard_width) || 0))  );
    }

    // console.log(signboard_fee);
    // console.log(signboard_tax);

    // vat on TL fee and signboard fee
    var vat = (+business_fee[row_data.business_type] + +signboard_tax) * (general_settings['vat'] / 100);

    total = parseInt(business_fee[row_data.business_type]) + parseInt(vat) + parseInt(signboard_tax);

    $("#fee").val(business_fee[row_data.business_type]);
    $("#vat").val(Math.round(vat));
    $("#signbord_vat").val(signboard_tax);
    $("#total").val(total);
    $("#source_tax").val(general_settings['max_source_tax']);

    // console.log(general_settings);


    // for account list show
    // account_list();

    $("#tracking").val(row_data.tracking);
    $("#organization_name_bn").val(row_data.organization_name_bn);

    if (row_data.owner_type == 1) {
        $("#owner_type").val('ব্যক্তিগত');
    } else if (row_data.owner_type == 2) {
        $("#owner_type").val('যৌথ');
    }else if (row_data.owner_type == 3) {
        $("#owner_type").val('কোম্পানি');
    } else {
        $("#owner_type").val('ব্যাংক অথবা আর্থিক প্রতিষ্ঠান');
    }

    var sgn_type = (row_data.signboard_type == 'lighting') ? "আলোকসজ্জা" : (row_data.signboard_type == 'nion' ? "নিয়ন" : (row_data.signboard_type == 'general' ? "সাধারন" : ''));

    $("#signboard_type").val(sgn_type);
    $("#signboard_length").val(row_data.signboard_length);
    $("#signboard_width").val(row_data.signboard_width);

    $("#business_type").val(row_data.business_type_bn);
    $("#application_id").val(row_data.application_id);
    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.trade_upazila_id);
    $("#district_id").val(row_data.trade_district_id);

    $("#trade_generate_modal").modal('show');
}


//====trade generate save===//
function generate_save() {
    var tracking = $("#tracking").val();
    var expire_date = $("#expire_date").val();
    var issue_date = $("#issue_date").val();
    // var payment_date = $("#payment_date").val();
    // var due_fiscal_year = $("#due_fiscal_year").val();
    var application_id = $("#application_id").val();
    var union_id = $("#union_id").val();
    var upazila_id = $("#upazila_id").val();
    var district_id = $("#district_id").val();

    // var credit_id = $("#account").val();
    var fee = $("#fee").val();
    var due = $("#due").val();
    var discount = $("#discount").val();
    var vat = $("#vat").val();
    var bibidh = $("#bibidh").val();

    var signbord_vat = parseInt($("#signbord_vat").val()) || 0;
    var signboard_length = parseInt($("#signboard_length").val()) || 0;
    var signboard_width = parseInt($("#signboard_width").val()) || 0;

    var source_vat = $("#source_tax").val();
    var sarcharge = $("#sarcharge").val();
    var total = $("#total").val();

    var error_status = false;

    if (fee == null || fee < 1) {
        $('#license_fee_error').html('লাইসেন্স ফি দিতে হবে');

        error_status = true;

    } else {
        $('#license_fee_error').html('');
    }

    // console.log(signboard_length, signboard_width, signbord_vat);

    if((signboard_length > 0 && signboard_width > 0) && signbord_vat <= 0){
        $("#signboard_fee_error").html('সাইনবোর্ড ফি দিতে হবে');

        error_status = true;
    }

    if (error_status == false) {
// console.log(trade_bangla_sonod_url);
// return;
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
                    url: url+"/trade/generate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        tracking: tracking,
                        // due_fiscal_year: due_fiscal_year,
                        expire_date: expire_date,
                        issue_date: issue_date,
                        // payment_date: payment_date,
                        union_id: union_id,
                        upazila_id: upazila_id,
                        district_id: district_id,
                        application_id: application_id,

                        // credit_id: credit_id,
                        fee: fee,
                        due: due,
                        discount: discount,
                        vat: vat,
                        bibidh: bibidh,
                        signbord_vat: signbord_vat,
                        source_vat:source_vat,
                        sarcharge: sarcharge,
                        total: total,

                        _token: trade_generate_csrf
                    },
                    success: function(response) {

                        $("#trade_generate_modal").modal('hide');

                        if(response.status == 'error'){
                            swal({
                                title: "Response",
                                text: response.message,
                                type: response.status,
                                showCancelButton: true,
                                cancelButtonText: "বাতিল",
                                showConfirmButton: true,
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                                allowEscapeKey: false
                            });

                            return;
                        }

                        swal({
                            title: "ধন্যবাদ",
                            text: response.message,
                            type: response.status,
                            showCancelButton: true,
                            cancelButtonText:'<a href="' + url +'/trade/due/bill?sno='+response.sonod_no+'">বকেয়া' +
                                ' এন্ট্রি</a>',
                            showConfirmButton: true,
                            confirmButtonText: '<a href="'+trade_bangla_sonod_url+'/'+response.sonod_no+'" target="_blank">প্রিন্ট করুন</a>',
                            closeOnConfirm: true,
                            allowEscapeKey: false
                        });

                        trade_table.ajax.reload();
                    }
                });
            }
        }).then(function() {});

    }else{
        return false;
    }
}

//===trade delete===//
function trade_delete(tracking) {

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
                url: trade_delete_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    tracking: tracking,
                    _token: trade_delete_csrf
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
var trade_certi_table;

//==for trade certificate list===//
function trade_certificate_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    // alert(from_date);
    trade_certi_table = $('#trade_certificate_table').DataTable({
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
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: trade_certificate_csrf
            },
        },
        columns: [{
            data: null,
            render: function() {
                return trade_certi_table.page.info().start + trade_certi_table.column(0).nodes().length;
            }
        }, {
            data: null,
            render:function(data, type, row) {
                return "<a class='link_color' href='edit/"+ data.fiscal_year_id + "/" + data.tracking + "'>"+data.organization_name_bn+"</a>";
            }
        },

        { data: "tracking" },

        { data: "sonod_no" },

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
            data: "business_type_bn"

        }, {
            data: "mobile"
        }, {
            data: "email"
        }, {
            data: "generate_date"
        }, {
            data: null,
            render: function(data, type, row, meta) {
                // console.log(meta.settings.json.policy.value);

                var regenerate = '', bn_en_sonod = '', edit = '', invoice = '';

                if(data.is_paid == null || data.is_paid == 1){
                    if($('#regenerate').val()){
                        regenerate = "<a  href='javascript:void(0)' onclick='trade_regenerate("+meta.row+")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }
                }

                // if(data.is_paid == null || data.is_paid == 1){
                    bn_en_sonod = "<a href='print_bn/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm btn-primary'>বাংলা</p></a>&nbsp;<a href='print_en/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm btn-success'>ইংরেজি</p></a>";
                // }

                if($('#edit').val()){
                    edit = "&nbsp;<a href='edit/" + data.fiscal_year_id + "/" + data.tracking + "'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                }

                // invoice button
                invoice = "<a href='money_receipt/" + data.voucher_no + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";

                // due entry button
                var due_btn = "&nbsp;<a  href='due/bill?sno=" + data.sonod_no + "' target='_blank'><p class='btn btn-sm btn-secondary'>বকেয়া এন্ট্রি</p></a>";

                // if(data.is_paid == 0){
                //     collection = '<button class="btn btn-sm btn-primary" type="button" onclick="collectTradeInvoiceMoney('+data.invoice_id+','+data.amount+')">Collect</button>';
                // }

                return regenerate + bn_en_sonod + edit + invoice + due_btn;
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

function certificate_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#trade_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#trade_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#trade_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    trade_certi_table.ajax.reload();
}

// trade bill list
var trade_bill_tbl;

function trade_bill_list() {
    trade_bill_tbl = $('#trade_bill_list_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: url + '/trade/bill/list',
        columns: [
            {
                data: null,
                render: function() {
                    return trade_bill_tbl.page.info().start + trade_bill_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "invoice_id" },
            { data: "voucher_no" },
            { data: "txn_no" },
            { data: "sonod_no" },
            { data: "fiscal_year" },
            { data: "amount" },
            { data: "created_at", orderable: false, searchable: false},
            { data: "action", orderable: false, searchable: false},
            { data: "print_btn", orderable: false, searchable: false},
            // {
            //     data: null,
            //     render: function(data, type, row, meta) {
            //         return data.is_paid == 0 ? '<span class="btn btn-sm btn-primary">Unpaid</span>' : '<span class="btn btn-sm btn-success">Paid</span>';
            //     },
            //     orderable: false,
            //     searchable: false
            // }
        ]
    });
}

// ==== Bill Collection Module ==== //
function trade_bill_search(){
    var search_id = $("#search_id").val() || 0;

    // reset
    $("#error_msg").html('');
    $("#bill_list").html('');
    $("#intotal").val(0);
    $("#payment_date").datepicker("setDate", new Date());

    var output = '';
    var intotal = 0;
    var sub_total = 0;

    if(search_id <= 0){
        $("#error_msg").html('Invalid! Please search with Invoice No or Tracking no or Sonod No');
        return;
    }

    $("#sonod_"+search_id).css('background-color','#72b972');

    $(".sonod_nos").each(function (){
        if ( $(this).val() != search_id ){
            $("#sonod_"+$(this).val()).css('background-color','white');
        }
    })


    // get invoice data
    $.ajax({
        url: url + "/trade/bill/invoice_data",
        type: "GET",
        data: {search_id: search_id},
        dataType: "JSON",
        success: function(response){
            if(response.status == 'error'){
                $("#error_msg").html(response.message);

                return;
            }

            console.log(response.data);
            // return;

            // var invoice_info = response.data.invoice_info;
            // var voucher_info = response.data.voucher_info;

            $("#sonod_no").val(response.data[0].sonod_no);

            response.data.forEach(function(pitem){
                output += '<h4 class="fiscal-year">অর্থ বছরঃ '+ pitem.fiscal_year +' <span class="inv">INV No: '+ pitem.invoice_id +'</span></h4>';

                output += '<table class="inv-tbl">';

                sub_total = 0;

                pitem.voucher_info.forEach(function(item, key){
                    output += '<tr>';
                    output += '<td>'+(key+1)+'. </td>';
                    output += '<td>'+item.account_name+'</td>';
                    output += '<td>'+ (item.acc_type == 24 ? '(-) ' : '') + item.amount+'</td>';
                    output += '</tr>';

                    if(item.acc_type == 24){    // add without discount
                        sub_total -= +item.amount;
                        intotal -= +item.amount;
                    } else {
                        sub_total += +item.amount;
                        intotal += +item.amount;
                    }
                });

                output += '<tr style="border-top: 1px solid black;"><td>&nbsp;</td><td>মোট</td><td>'+sub_total+'</td></tr></table><br/>';

            });

            $("#intotal").val(intotal);

            $("#bill_list").html(output);
        }
    });
}

function tradeBillCollection(){
    var amount = parseInt($("#intotal").val()) || 0;
    var sonod_no = $("#sonod_no").val();

    if(amount <= 0){
        $("#error_msg").html('Total amount is zero. Please search and try again.');

        return;
    }

    if(sonod_no == ''){
        $("#error_msg").html('Nothing search. Please search and try again.');

        return;
    }

    swal({
        title: "অনুমোদন",
        text: "আপনি কি এই ইনভয়েচ এর "+amount+" টাকা পেইড করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + "/trade/bill/collection/save",
                type: "POST",
                dataType: "JSON",
                data: {
                    sonod_no: sonod_no,
                    _token: trade_certificate_csrf
                },
                success: function(response) {
                    // reset
                    tradeBillCollectionReset();
                    $("#sonod_"+response.data.sonod_no).remove();

                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showConfirmButton: (response.status == "success") ? true : false,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "<a href='"+url+"/trade/print_bn/"+response.data.sonod_no+"' >প্রিন্ট" +
                            " করুন</a>",
                        showCancelButton: true,
                        cancelButtonText: "Ok",
                        showLoaderOnConfirm: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false


                    })
                }
            });
        }
    });
}

// reset
function tradeBillCollectionReset(){
    $("#search_id").val('')
    $("#error_msg").html('');
    $("#bill_list").html('');
    $("#intotal").val(0);
    $("#payment_date").datepicker("setDate", new Date());

    $(".voucher_ids").each(function (){
        $("#voucher_"+$(this).val()).css('background-color','white');
    })
}

// ==== END ==== //

// ==== Due Bill Module ==== //
var intotal = 0;

function trade_sonod_search(){
    var search_id = $("#search_id").val() || 0;

    // reset
    dueBillReset();

    if(search_id <= 0){
        $("#error_msg").html('Invalid! Please search with Sonod No');
        return;
    }

    // get invoice data
    $.ajax({
        url: url + "/trade/due/bill/sonod_data",
        type: "GET",
        data: {search_id: search_id},
        dataType: "JSON",
        success: function(response){
            if(response.status == 'error'){
                $("#error_msg").html(response.message);

                return;
            }

            $("#tracking").html(response.data.tracking);
            $("#mobile_no").html(response.data.mobile_no);
            $("#business_name").html(response.data.business_name);
            $("#business_type_name").html(response.data.business_type_name);
            $("#sonod_no").val(response.data.sonod_no);

            $("#bill_list").show();
        }
    });
}

function dueBillCalculate(){
    var license_fee = parseInt($("#license_fee").val()) || 0;
    var signboard_fee = parseInt($("#signboard_fee").val()) || 0;
    var vat = parseInt($("#vat").val()) || 0;
    var source_vat = parseInt($("#source_vat").val()) || 0;
    var sar_charge = parseInt($("#sar_charge").val()) || 0;

    intotal = license_fee + signboard_fee + vat + source_vat + sar_charge;

    $("#intotal").val(intotal);
}

function dueBillSave(){
    var amount = parseInt($("#intotal").val()) || 0;
    var sonod_no = $("#sonod_no").val();
    var fiscal_year_id = $("#fiscal_year_id").val();
    var license_fee = $("#license_fee").val();
    var signboard_vat = $("#signboard_fee").val();
    var vat = $("#vat").val();
    var source_vat = $("#source_vat").val();
    var sar_charge = $("#sar_charge").val();

    if(amount <= 0){
        $("#error_msg").html('Total amount is zero. Please search and try again.');

        return;
    }

    if(sonod_no == ''){
        $("#error_msg").html('Nothing search. Please search and try again.');

        return;
    }

    if(fiscal_year_id == ''){
        $("#error_msg").html('Empty fiscal year.');

        return;
    }

    $("#error_msg").html('');

    swal({
        title: "অনুমোদন",
        text: "আপনি কি এই সনদ এ বকেয়া "+amount+" টাকা যোগ করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + "/trade/due/bill/save",
                type: "POST",
                dataType: "JSON",
                data: {
                    sonod_no: sonod_no,
                    fiscal_year_id: fiscal_year_id,
                    license_fee: license_fee,
                    signboard_vat: signboard_vat,
                    vat: vat,
                    source_vat: source_vat,
                    sar_charge: sar_charge,
                    _token: trade_certificate_csrf
                },
                success: function(response) {
                    // reset
                    dueBillReset();

                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                }
            });
        }
    });
}

// reset
function dueBillReset(){
    $("#error_msg").html('');

    $("#search_id").val('');
    $("#tracking").html('');
    $("#mobile_no").html('');
    $("#business_name").html('');
    $("#business_type_name").html('');
    $("#fiscal_year_id").val('');
    $("#license_fee").val('');
    $("#signboard_fee").val('');
    $("#vat").val('');
    $("#source_vat").val('');
    $("#sar_charge").val('');
    $("#sonod_no").val('');


    $("#bill_list").hide();
    $("#intotal").val(0);
}

// ==== END ==== //

// === collectTradeInvoiceMoney === //
// function collectTradeInvoiceMoney(invoice_id, amount) {

//     swal({
//         title: "অনুমোদন",
//         text: "আপনি কি এই ইনভয়েচ এর "+amount+" টাকা পেইড করতে চান ?",
//         type: "warning",
//         showConfirmButton: true,
//         confirmButtonClass: "btn-success",
//         confirmButtonText: "হ্যাঁ",
//         showCancelButton: true,
//         cancelButtonText: "না",
//         showLoaderOnConfirm: true,
//         preConfirm: function() {
//             $.ajax({
//                 url: url + "/trade/invoice/collection",
//                 type: "POST",
//                 dataType: "JSON",
//                 data: {
//                     invoice_id: invoice_id,
//                     _token: trade_certificate_csrf
//                 },
//                 success: function(response) {
//                     swal({
//                         title: "Response",
//                         text: response.message,
//                         type: response.status,
//                         showCancelButton: false,
//                         showConfirmButton: true,
//                         closeOnConfirm: true,
//                         allowEscapeKey: false
//                     })

//                     trade_certi_table.ajax.reload();
//                 }
//             });
//         }
//     });
// }

//this is for trade certificate list search


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

    $("#trade_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#trade_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;
    $("#trade_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year = fiscal_year;

    prev_certi_table.ajax.reload();
}


//====trade re-generate====//
function trade_regenerate(row_index) {

    var row_data = $('#trade_certificate_table').DataTable().row(row_index).data();

    // console.log(row_data);
    // console.log(general_settings);

     // bill genertate modal all fee reset
    $('#fee').val('');
    $('#discount').val('');
    $('#vat').val('');
    $('#bibidh').val('');
    $('#source_tax').val('');
    $('#signbord_vat').val('');
    $('#sarcharge').val('');
    $('#due').val('');
    $('#total').val('');
    $("#expired_error").html('');

    $("#license_fee_error").html('');
    $("#signboard_fee_error").html('');
    $("#source_tax_error").html('');

    var row_data = trade_certi_table.row(row_index).data();

    // set default value
    if(typeof general_settings['vat'] == 'undefined'){
        general_settings['vat'] = 15;
    }

    if(typeof general_settings['max_source_tax'] == 'undefined'){
        general_settings['max_source_tax'] = 0;
    }

    if(typeof general_settings[row_data.signboard_type] == 'undefined'){
        $("#signboard_fee_error").html('Signboard fee system settings not found');
        general_settings[row_data.signboard_type] = 0;
    }

    if(row_data.signboard_type == null){
        $("#signboard_fee_error").html('');
    }

    var total = 0;

    // console.log(row_data);

    // console.log(typeof business_fee[row_data.business_type] == 'undefined');
    // console.log(business_fee[row_data.business_type]);

    // assign fees
    if(typeof business_fee[row_data.business_type] == 'undefined'){
        $("#license_fee_error").html('Business type fee system settings not found');
        business_fee[row_data.business_type] = 0;
    }

    var signboard_fee = 0;
    var signboard_tax = 0;

    if(row_data.signboard_type && row_data.signboard_length && row_data.signboard_width){
        var signboard_fee = general_settings[row_data.signboard_type];
        var signboard_tax = signboard_fee * parseInt(((parseInt(row_data.signboard_length) || 0) + (parseInt(row_data.signboard_width) || 0)) / 2 );
    }

    // console.log(signboard_fee);
    // console.log(signboard_tax);

    // vat on TL fee and signboard fee
    var vat = (+business_fee[row_data.business_type] + +signboard_tax) * (general_settings['vat'] / 100);

    total = parseInt(business_fee[row_data.business_type]) + parseInt(vat) + parseInt(signboard_tax) + parseInt(row_data.total_due);

    $("#fee").val(business_fee[row_data.business_type]);
    $("#vat").val(Math.round(vat));
    $("#due").val(row_data.total_due);
    $("#signbord_vat").val(signboard_tax);
    $("#source_tax").val(general_settings['max_source_tax']);

    // for account list show
    // account_list();

    $("#tracking").val(row_data.tracking);
    $("#organization_name_bn").val(row_data.organization_name_bn);

    if (row_data.owner_type == 1) {
        $("#owner_type").val('ব্যক্তিগত');
    } else if (row_data.owner_type == 2) {
        $("#owner_type").val('যৌথ');
    } else {
        $("#owner_type").val('কোম্পানি');
    }

    var sgn_type = (row_data.signboard_type == 'lighting') ? "আলোকসজ্জা" : (row_data.signboard_type == 'nion' ? "নিয়ন" : (row_data.signboard_type == 'general' ? "সাধারন" : ''));

    $("#signboard_type").val(sgn_type);
    $("#signboard_length").val(row_data.signboard_length);
    $("#signboard_width").val(row_data.signboard_width);

    $("#business_type").val(row_data.business_type_bn);
    $("#certificate_id").val(row_data.certificate_id);

    $("#tr_sonod_no").val(row_data.sonod_no);
    $("#sonod_no").val(row_data.sonod_no);

    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.trade_upazila_id);
    $("#district_id").val(row_data.trade_district_id);

    $("#trade_regenerate_modal").modal('show');

}


//====trade re-generate save===//
function re_generate_save(){

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
    var bibidh = $("#bibidh").val();
    var vat = $("#vat").val();
    var signbord_vat = $("#signbord_vat").val();
    var pesha_vat = $("#pesha_vat").val();
    var sarcharge = $("#sarcharge").val();
    var total = $("#total").val();

    var error_status = false;

    var error_status = false;

    var exp_d = new Date(expire_date);
    exp_d.setHours(0,0,0,0);

    var today = new Date();
    today.setHours(0,0,0,0);

    if(exp_d.getTime() > today.getTime()){  // if TL not expired yet
        $("#expired_error").html('এই সনদটি এখনো মেয়াদ উত্তীর্ণ হয়নি। এক অর্থ বছরে একবারই সনদ জেনারেট করা যাবে।');

        error_status = true;
    } else {
        $("#expired_error").html('');
    }

    if (fee == null || fee < 1) {
        $('#license_fee_error').html('লাইসেন্স ফি দিতে হবে');

        error_status = true;

    } else {
        $('#license_fee_error').html('');
    }

    if((signboard_length > 0 && signboard_width > 0) && signbord_vat <= 0){
        $("#signboard_fee_error").html('সাইনবোর্ড ফি দিতে হবে');

        error_status = true;
    } else {
        $('#signboard_fee_error').html('');
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
                    url: url+"/trade/regenerate",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        sonod_no: sonod_no,
                        tracking: tracking,
                        expire_date: expire_date,
                        issue_date: issue_date,
                        union_id: union_id,
                        district_id: district_id,
                        upazila_id: upazila_id,
                        certificate_id: certificate_id,
                        fee: fee,
                        discount: discount,
                        bibidh: bibidh,
                        vat: vat,
                        signbord_vat: signbord_vat,
                        sarcharge: sarcharge,
                        total: total,

                        _token: trade_certificate_csrf
                    },
                    success: function(response) {
                        $("#trade_regenerate_modal").modal('hide');

                        if(response.status == 'error'){
                            swal({
                                title: "Response",
                                text: response.message,
                                type: response.status,
                                showCancelButton: true,
                                cancelButtonText: "বাতিল",
                                showConfirmButton: true,
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                                allowEscapeKey: false
                            });

                            return;
                        }

                        swal({
                            title: "ধন্যবাদ",
                            text: response.message,
                            type: response.status,
                            showCancelButton: true,
                            cancelButtonText: "বাতিল",
                            showConfirmButton: true,
                            confirmButtonText: '<a href="' + trade_money_receipt_data_url + '/' + response.voucher_no + '" target="_blank">প্রিন্ট</a>',
                            closeOnConfirm: true,
                            allowEscapeKey: false
                        })

                        trade_certi_table.ajax.reload();

                    }
                });
            }
        }).then(function() {});

    } else {
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


//===trade Business type fee list===//

var business_type_fee_table;

function trade_business_type_fee_list() {
    // fiscal_year_id = $("#fiscal_year_id").val();
    // from_date = $("#filter_from_date").val();
    // to_date = $("#filter_to_date").val();

    business_type_fee_table = $("#trade_business_type_fee_table").DataTable({
        scrollCollapse: true,
        autoWidth: false,
        // responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: url + "/trade/settings/business/fees"
        },
        columns: [
            // {
            //     data: null,
            //     name: null,
            //     render:function(data,type,row,meta){

            //         let html ="";
            //         html = "<i class='lni lni-circle-plus text-info'></i>";
            //         return html;

            //     }
            // },
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
            },
            {
                data: 'name_bn',
                name: 'name_bn'
            },
            {
                data: 'name_en',
                name: 'name_en'
            },
            {
                data: 'fee',
                name: 'fee'
            },
            // {
            //     data: 'business_id',
            //     name: 'business_id'
            // },
            {
                data: null,
                name: null,
                render: function(data, type, row, meta) {
                    var html = "<a data-toggle='tooltip' data-placement='top' title='Impersonate' class='btn btn-sm btn-info' onclick='business_edit("+ meta.row +")'>এডিট</a>";
                    return html;
                }
            }

        ]
    })
}

function business_edit(row_index){

    var business_fee_data = business_type_fee_table.row(row_index).data();
// console.log(business_fee_data.business_id);

    $("#fee").val(business_fee_data.fee);
    $("#business_id").val(business_fee_data.business_id);


    $("#business_modal").modal('toggle')




}

function update_business_type(){


    var business_fee =$("#fee").val();
    var business_id =$("#business_id").val();

    // alert(business_fee,business_id);
    // console.log(business_fee,business_id);

    $.ajax({
        url: url + "/trade/settings/business/fees/save",
        type: "post",
        dataType: "json",
        data: {
            business_fee,
            business_id,
            _token: trade_business_csrf
        },
        success: function(response) {

            $("#business_modal").modal('toggle');


            business_type_fee_table.ajax.reload();

            swal("Response", response.message, response.status);

            // $('input[name="id"]').val(response.data.id);
            // $('select[name="parent_id"]').val(response.data.parent_id);
            // $('input[name="name"]').val(response.data.name);
            // $('#img_preview').attr('src', 'public/admin/images/category/' + response.data.icon);
            // $('input[name="icon"]').val(response.data.icon);
            // imagePreview(response);
        }
    })
}
