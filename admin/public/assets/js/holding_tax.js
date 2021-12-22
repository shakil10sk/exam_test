// global
var url = $('meta[name = path]').attr("content");
var csrf = $('meta[name = csrf-token]').attr("content");

// assessment
function set_ward_name(id){
    $("#ward_name").val(ward_list[id]);
}

function calculateTotalArea(rent_area, own_area){
    var total_area = +rent_area + +own_area;
    $("#total_area").val(total_area);

    holdingTaxCalculation($("#property_type").val());
}

function holdingTaxCalculation(property_id){
    var tax_rate = parseInt(property_list[property_id]) || 0;
    $("#tax_rate").val(tax_rate);

    var total_area = $("#total_area").val();

    var arv = total_area * tax_rate;

    var annual_tax = arv;
    var monthly_tax = Math.round(annual_tax / 12);

    $("#annual_rental_value").val(arv);
    $("#final_annual_rental_value").val(arv);

    $("#annual_tax").val(annual_tax);
    $("#monthly_tax").val(monthly_tax);

}

// depreciation and appreciation calculation
function calculateAppreciationDepreciation(){
    var annual_tax = parseInt($("#annual_tax").val()) || 0;
    var depreciation = parseInt($("#depreciation").val()) || 0;
    var appreciation = parseInt($("#appreciation").val()) || 0;

    var monthly_tax = Math.round(annual_tax / 12);

    monthly_tax -= depreciation;
    monthly_tax += appreciation;

    $("#monthly_tax").val(monthly_tax);
}

var data_tbl;

function assessment_list(){
    data_tbl = $('#data_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: url + '/holding/tax/assessment',
            data: {ward_no: '', property_type: '', owner_type: ''}
        },
        columns: [
            {
                data: null,
                render: function() {
                    return data_tbl.page.info().start + data_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "name" },
            { data: "mobile_no" },
            { data: "holding_no" },
            { data: "ward_name" },
            { data: "property_name" },
            { data: "owner_type" },
            { data: "yearly_tax" },
            { data: "monthly_tax" },
            { data: "nid" },
            { data: "action" }
        ]
    });
}

function searchAssessmentList(){
    var ward_no = $("#ward_no").val();
    var property_type = $("#property_type").val();
    var owner_type = $("#owner_type").val();

    $("#data_tbl").dataTable().fnSettings().ajax.data.ward_no = ward_no;
    $("#data_tbl").dataTable().fnSettings().ajax.data.property_type = property_type;
    $("#data_tbl").dataTable().fnSettings().ajax.data.owner_type = owner_type;

    data_tbl.ajax.reload();
}

function deleteAssessment(pid){
    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + '/holding/tax/assessment/delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    pid: pid,
                    _token: csrf
                },
                success: function(response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    });

                    data_tbl.ajax.reload();
                }
            });
        }
    });
}

function holding_bill_list(){
    data_tbl = $('#data_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: url + '/holding/tax/bill/list',
        columns: [
            {
                data: null,
                render: function() {
                    return data_tbl.page.info().start + data_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "name" },
            { data: "mobile_no" },
            { data: "holding_no" },
            { data: "ward_name" },
            { data: "invoice_id" },
            { data: "voucher_no" },
            { data: "amount" },
            {
                data: null,
                render: function(data){
                    return data.is_paid == 1 ? "<span class='badge badge-success'>Paid</span>" : "<span class='badge badge-warning'>Unpaid</span>";
                }
            },
            { data: "created_at" },
            { data: "action" }
        ]
    });
}

function deleteHoldingBill(invoice_id){
    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + '/holding/tax/bill/delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    invoice_id: invoice_id,
                    _token: csrf
                },
                success: function(response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    });

                    data_tbl.ajax.reload();
                }
            });
        }
    });
}

// reset
function taxBillCollectionReset(){
    $("#search_id").val('')
    $("#error_msg").html('');
    $("#bill_list").html('');
    $("#intotal").val(0);

    $("#payment_date").datepicker("setDate", new Date());
    $("#payment_type").val(1);

    $("#invoice_id").val();
    $("#voucher_no").val();

    $("#due_option").hide();
    $("#due_fiscal_year").val('');
    $("#due_months").val('');
    $("#due_amount").val('');
}

function taxBillCollection(){
    var amount = parseInt($("#intotal").val()) || 0;
    var invoice_id = $("#invoice_id").val();
    var voucher_no = $("#voucher_no").val();
    
    var payment_date = $("#payment_date").val();
    var payment_type = $("#payment_type").val();

    var due_fiscal_year = $("#due_fiscal_year").val();
    var due_months = $("#due_months").val();
    var due_amount = $("#due_amount").val();

    var error_status = false;

    if(amount <= 0){
        $("#error_msg").html('Total amount is zero. Please search and try again.');

        return;
    }

    if(invoice_id == ''){
        $("#error_msg").html('Nothing search. Please search and try again.');

        return;
    }

    if(due_fiscal_year != '' || due_months != '' || due_amount != ''){
        if(due_fiscal_year == ''){
            $("#due_fiscal_year_error").html('Empty fiscal year');
            error_status = true;
        } else {
            $("#due_fiscal_year_error").html('');
        }
        
        if(due_months == ''){
            $("#due_months_error").html('Empty due months');
            error_status = true;
        } else {
            $("#due_months_error").html('');
        }
        
        if(due_amount == ''){
            $("#due_amount_error").html('Empty due amount');
            error_status = true;
        } else {
            $("#due_amount_error").html('');
        }
    }

    if(error_status){return;}

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
                url: url + "/holding/tax/bill/collection/save",
                type: "POST",
                dataType: "JSON",
                data: {
                    invoice_id: invoice_id,
                    voucher_no: voucher_no,
                    due_fiscal_year: due_fiscal_year,
                    due_months: due_months,
                    due_amount: due_amount,
                    payment_date: payment_date,
                    payment_type: payment_type,
                    _token: csrf
                },
                success: function(response) {
                    // reset
                    taxBillCollectionReset();

                    // $("#sonod_"+response.data.sonod_no).remove();

                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showConfirmButton: (response.status == "success") ? true : false,
                        confirmButtonClass: "btn-primary",
                        confirmButtonText: "<a href='"+url+"/holding/tax/bill/print/"+invoice_id+"' >প্রিন্ট" +
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

var month_list = ['&nbsp', 'জানুয়ারি', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];

var intotal = 0;

function tax_bill_search(){
    var search_id = $("#search_id").val() || 0;

    // reset
    $("#error_msg").html('');
    $("#bill_list").html('');

    $("#due_option").hide();
    $("#due_fiscal_year").val('');
    $("#due_months").val('');
    $("#due_amount").val('');
    
    $("#intotal").val(0);
    $("#payment_date").datepicker("setDate", new Date());

    // console.log(month_list);return;

    var output = '';
    var sub_total = 0;

    if(search_id <= 0){
        $("#error_msg").html('Invalid! Please search with Invoice No or Voucher No or Holding no');
        return;
    }

    // $("#sonod_"+search_id).css('background-color','#72b972');

    // $(".sonod_nos").each(function (){
    //     if ( $(this).val() != search_id ){
    //         $("#sonod_"+$(this).val()).css('background-color','white');
    //     }
    // })


    // get invoice data
    $.ajax({
        url: url + "/holding/tax/bill/invoice_data",
        type: "GET",
        data: {search_id: search_id},
        dataType: "JSON",
        success: function(response){
            if(response.status == 'error'){
                $("#error_msg").html(response.message);

                return;
            }

            // console.log(response.data);
            // return;

            var invoice_info = response.data;
            var voucher_info = Object.entries(invoice_info.details);

            // console.log();

            $("#invoice_id").val(response.data.invoice_id);
            $("#voucher_no").val(response.data.voucher_no);

            // response.data.forEach(function(pitem){
                output += '<h4 class="fiscal-year">অর্থ বছরঃ '+ invoice_info.fiscal_year_name +' <span class="inv">INV No: '+ invoice_info.invoice_id +'</span></h4>';

                output += '<table class="inv-tbl">';

                sub_total = 0;

                voucher_info.forEach(function(item, key){
                    output += '<tr>';
                    output += '<td>'+ (key+1) +'. </td>';
                    output += '<td>'+ month_list[item[0]] +'</td>';
                    output += '<td>'+ item[1] +'</td>';
                    output += '</tr>';

                    sub_total += +item[1];
                    intotal += +item[1];

                });

                output += '<tr style="border-top: 1px solid black;"><td>&nbsp;</td><td>মোট</td><td>'+sub_total+'</td></tr></table><br/>';

            // });

            $("#intotal").val(intotal);

            $("#bill_list").html(output);
            $("#due_option").show();
        }
    });
}

function calculate_due(due_amount){
    var total = intotal + (parseInt(due_amount) || 0);
    $("#intotal").val(total);
}

// ward settings
var data_tbl;

function ward_list(){
    data_tbl = $('#data_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: url + '/holding/tax/settings/ward',
        columns: [
            {
                data: null,
                render: function() {
                    return data_tbl.page.info().start + data_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "ward_no" },
            { data: "name" },
            {
                data: null,
                render: function(data, type, row, meta){
                    return '<button class="btn btn-sm btn-primary" onclick="editWard('+meta.row+')"><i class="fa fa-pencil"></i> Edit</button>&nbsp' + data.action;
                }
            }
        ]
    });
}

function addNewWard(){

    $("#ward_no").val('');
    $("#ward_name").val('');

    $("#action_btn").html("Save");
    $("#action_btn").attr("onclick", "saveWard()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function saveWard(){
    var ward_no = $("#ward_no").val();
    var ward_name = $("#ward_name").val();

    var error_status = false;

    if(ward_no == ''){
        $("#ward_no_error").html('Empty ward no');
        error_status = true;
    } else {
        $("#ward_no_error").html('');
    }
    
    if(ward_name == ''){
        $("#ward_name_error").html('Empty ward name');
        error_status = true;
    } else {
        $("#ward_name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/ward/store',
            type: "POST",
            dataType: "JSON",
            data: {
                ward_no: ward_no,
                ward_name: ward_name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function editWard(row_id){
    var data = data_tbl.row(row_id).data();

    $("#pid").val(data.id);
    $("#ward_no").val(data.ward_no);
    $("#ward_name").val(data.name);

    $("#action_btn").html("Update");
    $("#action_btn").attr("onclick", "updateWard()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function updateWard(){
    var pid = $("#pid").val();
    var ward_no = $("#ward_no").val();
    var ward_name = $("#ward_name").val();

    var error_status = false;

    if(ward_no == ''){
        $("#ward_no_error").html('Empty ward no');
        error_status = true;
    } else {
        $("#ward_no_error").html('');
    }
    
    if(ward_name == ''){
        $("#ward_name_error").html('Empty ward name');
        error_status = true;
    } else {
        $("#ward_name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/ward/update',
            type: "POST",
            dataType: "JSON",
            data: {
                pid: pid,
                ward_no: ward_no,
                ward_name: ward_name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function deleteWard(pid){
    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + '/holding/tax/settings/ward/delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    pid: pid,
                    _token: csrf
                },
                success: function(response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    });

                    data_tbl.ajax.reload();
                }
            });
        }
    });
}

// moholla settings
var data_tbl;

function moholla_list(){
    data_tbl = $('#data_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: url + '/holding/tax/settings/moholla',
        columns: [
            {
                data: null,
                render: function() {
                    return data_tbl.page.info().start + data_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "name" },
            {
                data: null,
                render: function(data, type, row, meta){
                    return '<button class="btn btn-sm btn-primary" onclick="editMoholla('+meta.row+')"><i class="fa fa-pencil"></i> Edit</button>&nbsp' + data.action;
                }
            }
        ]
    });
}

function addNewMoholla(){

    $("#name").val('');

    $("#action_btn").html("Save");
    $("#action_btn").attr("onclick", "saveMoholla()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function saveMoholla(){
    var name = $("#name").val();

    var error_status = false;

    if(name == ''){
        $("#name_error").html('Empty name');
        error_status = true;
    } else {
        $("#name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/moholla/store',
            type: "POST",
            dataType: "JSON",
            data: {
                name: name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function editMoholla(row_id){
    var data = data_tbl.row(row_id).data();

    $("#pid").val(data.id);
    $("#name").val(data.name);

    $("#action_btn").html("Update");
    $("#action_btn").attr("onclick", "updateMoholla()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function updateMoholla(){
    var pid = $("#pid").val();
    var name = $("#name").val();

    var error_status = false;

    if(name == ''){
        $("#name_error").html('Empty name');
        error_status = true;
    } else {
        $("#name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/moholla/update',
            type: "POST",
            dataType: "JSON",
            data: {
                pid: pid,
                name: name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function deleteMoholla(pid){
    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + '/holding/tax/settings/moholla/delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    pid: pid,
                    _token: csrf
                },
                success: function(response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    });

                    data_tbl.ajax.reload();
                }
            });
        }
    });
}

// block settings
var data_tbl;

function block_list(){
    data_tbl = $('#data_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: url + '/holding/tax/settings/block',
        columns: [
            {
                data: null,
                render: function() {
                    return data_tbl.page.info().start + data_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "name" },
            {
                data: null,
                render: function(data, type, row, meta){
                    return '<button class="btn btn-sm btn-primary" onclick="editBlock('+meta.row+')"><i class="fa fa-pencil"></i> Edit</button>&nbsp' + data.action;
                }
            }
        ]
    });
}

function addNewBlock(){

    $("#name").val('');

    $("#action_btn").html("Save");
    $("#action_btn").attr("onclick", "saveBlock()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function saveBlock(){
    var name = $("#name").val();

    var error_status = false;

    if(name == ''){
        $("#name_error").html('Empty name');
        error_status = true;
    } else {
        $("#name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/block/store',
            type: "POST",
            dataType: "JSON",
            data: {
                name: name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function editBlock(row_id){
    var data = data_tbl.row(row_id).data();

    $("#pid").val(data.id);
    $("#name").val(data.name);

    $("#action_btn").html("Update");
    $("#action_btn").attr("onclick", "updateBlock()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function updateBlock(){
    var pid = $("#pid").val();
    var name = $("#name").val();

    var error_status = false;

    if(name == ''){
        $("#name_error").html('Empty name');
        error_status = true;
    } else {
        $("#name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/block/update',
            type: "POST",
            dataType: "JSON",
            data: {
                pid: pid,
                name: name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function deleteBlock(pid){
    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + '/holding/tax/settings/block/delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    pid: pid,
                    _token: csrf
                },
                success: function(response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    });

                    data_tbl.ajax.reload();
                }
            });
        }
    });
}

// property type settings
var data_tbl;

function property_type_list(){
    data_tbl = $('#data_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: url + '/holding/tax/settings/property_type',
        columns: [
            {
                data: null,
                render: function() {
                    return data_tbl.page.info().start + data_tbl.column(0).nodes().length;
                },
                orderable: false,
                searchable: false
            },
            { data: "name" },
            {
                data: null,
                render: function(data, type, row, meta){
                    return '<button class="btn btn-sm btn-primary" onclick="editPropertyType('+meta.row+')"><i class="fa fa-pencil"></i> Edit</button>&nbsp' + data.action;
                }
            }
        ]
    });
}

function addNewPropertyType(){

    $("#name").val('');

    $("#action_btn").html("Save");
    $("#action_btn").attr("onclick", "savePropertyType()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function savePropertyType(){
    var name = $("#name").val();

    var error_status = false;

    if(name == ''){
        $("#name_error").html('Empty name');
        error_status = true;
    } else {
        $("#name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/property_type/store',
            type: "POST",
            dataType: "JSON",
            data: {
                name: name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function editPropertyType(row_id){
    var data = data_tbl.row(row_id).data();

    $("#pid").val(data.id);
    $("#name").val(data.name);

    $("#action_btn").html("Update");
    $("#action_btn").attr("onclick", "updatePropertyType()");

    $("#data_modal").modal({
        backdrop: 'static',
        show: true,
        keyboard: false
    });
}

function updatePropertyType(){
    var pid = $("#pid").val();
    var name = $("#name").val();

    var error_status = false;

    if(name == ''){
        $("#name_error").html('Empty name');
        error_status = true;
    } else {
        $("#name_error").html('');
    }

    if(!error_status){
        $.ajax({
            url: url + '/holding/tax/settings/property_type/update',
            type: "POST",
            dataType: "JSON",
            data: {
                pid: pid,
                name: name,
                _token: csrf
            },
            success: function(response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                $("#data_modal").modal('hide');

                data_tbl.ajax.reload();
            }
        });
    }
}

function deletePropertyType(pid){
    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
            $.ajax({
                url: url + '/holding/tax/settings/property_type/delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    pid: pid,
                    _token: csrf
                },
                success: function(response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    });

                    data_tbl.ajax.reload();
                }
            });
        }
    });
}