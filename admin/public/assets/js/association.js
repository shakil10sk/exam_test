//for url
var url = $('meta[name = path]').attr("content");
var csrf = $('meta[name = csrf-token]').attr("content");
var member_list, invoice_list;


function member_list() {
    member_list = $('#association_list_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "POST",
            url: url + "/association/member/list_data",
            data: {_token: csrf},
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: "name"
            },
            {
                data: "father_name"
            },
            {
                data: "mobile"
            },
            {
                data: "reference_name"
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return "<a class='btn btn-sm btn-primary mr-2'  href='" + url + "/association/member/bill/collection/report/" + row.id + "' target='_blank' ><i" +
                        " class='fa" +
                        " fa-sticky-note'></i> Report</a><a class='btn btn-sm btn-primary'  href='" + url + "/association/member/edit/" + row.id + "' ><i" +
                        " class='fa" +
                        " fa-pencil'></i> Edit</a> <button class='btn btn-sm btn-danger' onclick='member_delete(" + meta.row + ")'><i class='fa fa-trash'></i> Delete</button>";
                }
            },
        ],
        dom: 'Bfrtip',
    });
}


function member_delete(row_index) {
    let data = member_list.row(row_index).data();

    swal({
        title: "Confirmation",
        text: "আপনি কি এটি মুছতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $.ajax({
                url: app_url + "/association/member/delete",
                type: "POST",
                dataType: "JSON",
                data: {
                    row_id: data.id,
                    account_id: data.account_id,
                    _token: csrf
                },
                success: function (response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                    member_list.ajax.reload();
                }
            });
        }
    });

}


//==================== Association Bill Collection ========= //
var month_count = 0;
var month_ids = new Array();


function bill_collection_searching() {
    // get values
    var year_id = $("#year_id").val();
    var member_id = $("#member_id").val();

    var error_status = false;

    if (year_id == '') {
        $("#year_id").attr("style", "border: 1px solid red;");
        error_status = true;
    } else {
        $("#year_id").removeAttr("style");
    }

    if (member_id == '') {
        $("#member_id").attr("style", "border: 1px solid red;");
        error_status = true;
    } else {
        $("#member_id").removeAttr("style");
    }

    if (error_status == false) {
        $.ajax({
            url: app_url + "/association/member/bill/collection/getMemberInvoiceInfo",
            type: "POST",
            dataType: "JSON",
            data: {
                year_id: year_id,
                member_id: member_id,
                _token: csrf
            },
            success: function (response) {
                if (response.status == "success") {

                    $("#chanda_amount").val(response.member_info.chanda_amount);
                    $("#member_name").html(response.member_info.name);
                    $("#mobile_no").html(response.member_info.mobile);

                    $.each(response.invoice_info, function (key, item) {

                        if (item.is_paid == 0) {
                            $("#month_" + key).prop("disabled", false);
                            $("#month_status_" + key).html("UnPaid");
                            $("#month_status_" + key).css("color", "red");
                        } else {
                            $("#month_" + key).prop("disabled", true);
                            $("#month_status_" + key).html("Paid");
                            $("#month_status_" + key).css("color", "green");
                        }

                    });

                    // reset //
                    invoice_month = [];
                    month_count = 0;
                    uncheck_month();
                    calculation();


                } else {

                }
            }
        });
    }
}

function month_check(month_id) {

    if ($('#month_' + month_id).prop('checked')) {
        month_count++;
    } else {
        month_count--;
    }
    calculation();


}

function calculation() {
    let total_amount = 0;
    let monthly_chada = parseInt($("#chanda_amount").val());

    total_amount = month_count * monthly_chada;

    $("#total_amount").val(total_amount);
}

function check_month_list() {
    $('.month_chk').each(function () {
        if ($(this).prop('checked')) {
            month_ids.push($(this).data('month-id'));
        }
    })
}

function uncheck_month() {
    $('.month_chk').each(function () {
        $(this).prop('checked', false);
    })

}

function acc_bill_collection_save() {

    let monthly_chada = $("#chanda_amount").val();
    let total_chada = $("#total_amount").val();
    let year_id = $("#year_id").val();
    let member_id = $("#member_id").val();


    if (month_count == 0) {
        swal({
            title: "Error",
            text: "দয়াকরে মাস সিলেক্ট করুন",
            type: "error",
            showCancelButton: false,
            showConfirmButton: true,
            closeOnConfirm: true,
            allowEscapeKey: false
        })
        return false;
    }

    swal({
        title: "Confirmation",
        text: "আপনি কি চাঁদা কালেকশান চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function () {

            // assign check month ids //
            check_month_list();

            $.ajax({
                url: app_url + "/association/member/bill/collection/bill_collection_save",
                type: "POST",
                dataType: "JSON",
                data: {
                    month_id: month_ids,
                    monthly_chada: monthly_chada,
                    total_chada: total_chada,
                    year_id: year_id,
                    member_id: member_id,
                    _token: csrf
                },
                success: function (response) {

                    swal({
                        title: response.status,
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })


                    if (response.status == "success") {

                        $("#member_id").prop('selectedIndex', 0);
                        $(".month_status").html('');
                        // reset //
                        month_ids = [];
                        month_count = 0;
                        uncheck_month();
                        calculation();
                    }
                }
            });
        }
    });


}


//==================== Association Bill Collection End ========= //


// ============== invoice =====================

function invoice_list() {
    invoice_list = $('#invoice_list_tble').DataTable({
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, 5000, -1], [10, 25, 50, 100, 500, 1000, 5000, "All"]],
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "POST",
            url: url + "/association/member/bill/collection/invoice_list_data",
            data: function (e) {
                e.year_id = $("#filter_year_id").val() || 0;
                e.member_id = $("#filter_member_id").val() || 0;
                e._token = csrf
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: "year_id"
            }, {
                data: "invoice_id"
            }, {
                data: "name"
            },
            {
                data: "mobile"
            },
            {
                data: "total_amount"
            }, {
                data: "payment_date"
            },
            {
                data: "status"
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return "<a class='btn btn-sm btn-primary'  href='" + url + "/association/member/bill/collection/invoice/" + row.invoice_id + "' ><i" +
                        " class='fa" +
                        " fa-sticky-note'></i> Invoice</a>";
                }
            },
        ]
    });
}

function invoice_search() {
    invoice_list.ajax.reload();
}

// ============= income & expense ================ //

var khat_table;


function add_khat(){
    $("#name").val("");
    $("#type").prop('selectedIndex',0)
    // update button hide //
    $("#update_button").hide();
    $("#khat_save_modal").modal('show');
}

function khat_save(){
    let error_status = false;
    let name = $("#name").val();
    let type =  $("#type").val();

    if(name == ""){
        $("#name_error").html("খাতের নাম প্রদান করুন");
        error_status = true;
    }else{
        $("#name_error").html("");
        error_status = false;
    }

    if(type == ""){
        $("#type_error").html("টাইপ সিলেক্ট করুন");
        error_status = true;
    }else{
        $("#type_error").html("");
        error_status = false;
    }

    if (error_status == false){
        $.ajax({
            url: app_url + "/association/expense-income/khat/store",
            type: "POST",
            dataType: "JSON",
            data: {
                name : name,
                type : type,
                _token: csrf

            },
            success: function (response) {
                console.log(response);
            }
        });
    }



}

function khat_list(){
    khat_table = $('#khat_table').DataTable({
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, 5000, -1], [10, 25, 50, 100, 500, 1000, 5000, "All"]],
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "POST",
            url: url + "/association/member/bill/collection/invoice_list_data",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {
                data: "year_id"
            }, {
                data: "invoice_id"
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    return "<a class='btn btn-sm btn-primary'  href='" + url + "/association/member/bill/collection/invoice/" + row.invoice_id + "' ><i" +
                        " class='fa" +
                        " fa-sticky-note'></i> Invoice</a>";
                }
            },
        ]
    });
}




