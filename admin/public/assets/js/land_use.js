//for url
var url = $('meta[name = path]').attr("content");
var csrf = $('mata[name = csrf-token]').attr("content");

//===success msg hide===//
setTimeout(function () {
    $(".alert-success").hide('slow');
}, 3000);


//===datepicker===//
$('#generate_date, #issue_date, #payment_date, #from_date, #to_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});

//fee calculation
function calculation() {

    $('#vat').val('');
    $('#total').val('');

    var fee = $("#fee").val();

    var total = 0, vat = 0, amount = 0;

    vat = (fee * 15) / 100;

    total = (parseInt(fee) + parseInt(vat));

    $("#vat").val(vat);
    $("#total_amount").val(total);
}

var land_use_table, from_date, to_date;

function land_use_applicant_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    land_use_table = $('#land_use_applicant_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url: applicant_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: applicant_csrf
            },

        },
        columns: [
            {
                data: null,
                render: function () {
                    return land_use_table.page.info().start + land_use_table.column(0).nodes().length;
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<img width='50' src='" + img_path + '/' + data.photo + "' class='img-circle img-responsive' />";
                }
            },

            {
                data: null,
                render: function (data, type, row) {
                    return "<a class='link_color'  href='edit/" + data.tracking + "'>" + data.name_bn + "</a>";
                }
            },
            {data: "father_name_bn"},
            {data: "tracking"},
            {data: "pin"},
            {data: "mobile"},
            {data: "created_time"},
            {
                data: null,
                render: function (data, type, row, meta) {
                    var edit = '', del = '', generate = '';

                    if ($('#generate').val()) {
                        generate = "<a  href='javascript:void(0)' onclick='application_generate(" + meta.row + ")' ><p class='btn btn-sm btn-primary'>জেনারেট</p></a> ";
                    }

                    if ($('#edit').val()) {
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                    }

                    if ($('#delete').val()) {
                        del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='application_delete(" + data.application_id + ")' >ডিলিট</p></a> ";
                    }

                    return generate + edit + "<a  href='preview/" + data.tracking + "' target='_blank'><p class='btn btn-sm btn-success'>আবেদন প্র্রিন্ট</p></a> " + del;
                }
            },


        ],
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "info": "_START_-_END_ of _TOTAL_ entries",
            searchPlaceholder: "Search"
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'pdf', 'print'
        ]
    });
}

//==== Road Excavation applicant search====//
function applicant_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#land_use_applicant_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#land_use_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#land_use_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    land_use_table.ajax.reload();
}

// get account list
function account_list() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url + "/global/account_list",
        type: "POST",
        dataType: "JSON",
        data: {},
        success: function (response) {

            if (response['status'] == "success") {

                var option;

                response['data'].forEach(function (data) {
                    option += '<option value ="' + data.id + '">' + data.account_name + '</option>';
                });

                $("#account").html(option)

            } else {

            }
        }

    });
}

//=== road excavation generate ===//
function application_generate(row_index) {

    var row_data = land_use_table.row(row_index).data();



    //for account list show
    account_list();

    $("#tracking").val(row_data.tracking);
    $("#pin").val(row_data.pin);
    $("#name").val(row_data.name_bn);

    $("#application_id").val(row_data.application_id);
    $("#land_id").val(row_data.land_id);
    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.permanent_upazila_id);
    $("#district_id").val(row_data.permanent_district_id);

    $("#land_use_generate_modal").modal('show');
}

//====road excavation generate save===//
function generate_save() {
    var tracking = $("#tracking").val();
    var pin = $("#pin").val();
    var application_id = $("#application_id").val();
    var account_id = $("#account").val();
    var fee = $("#fee").val();
    var generate_date = $("#generate_date").val();
    var vat = $("#vat").val();
    var memo_no = $("#memo_no").val();
    var road_consider = $("#road_consider").val();
    var union_id = $("#union_id").val();
    var upazila_id = $("#upazila_id").val();
    var district_id = $("#district_id").val();
    var land_id = $("#land_id").val();

    swal({
        title: "অনুমোদন",
        text: "আপনি কি সনদটি জেনারেট করতে চান ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $.ajax({
                url: generate_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    tracking: tracking,
                    pin: pin,
                    credit_id: account_id,
                    fee: fee,
                    vat: vat,
                    memo_no: memo_no,
                    road_consider: road_consider,
                    generate_date: generate_date,
                    union_id: union_id,
                    upazila_id: upazila_id,
                    district_id: district_id,
                    application_id: application_id,
                    land_id:land_id,
                    _token: generate_csrf
                },
                success: function (response) {

                    $("#land_use_generate_modal").modal('hide');

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText: "বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="' + bangla_sonod_url + '/' + response.sonod_no + '" target="_blank">প্রিন্ট করুন</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                    land_use_table.ajax.reload();
                }
            });
        }
    }).then(function () {

    });
}

//=== application delete ===//
function application_delete(appId) {

    swal({
        title: "অনুমোদন",
        text: "আপনি কি আবেদনটি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $.ajax({
                url: delete_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    deleteId: appId,
                    _token: delete_csrf
                },
                success: function (response) {
                    swal({
                        title: "ডিলিট হয়েছে!",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                }
            });
        }
    }).then(function () {
        land_use_table.ajax.reload();
    });
}

// certificate list
var certi_table;

//=== certificate list===//
function certificate_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    certi_table = $('#land_use_certificate_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            type: "post",
            url: certificate_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: certificate_csrf
            },

        },
        columns: [{
            data: null,
            render: function () {
                return certi_table.page.info().start + certi_table.column(0).nodes().length;
            }
        }, {
            data: null,
            render: function (data, type, row) {
                return "<img width='50' src='" + img_path + '/' + data.photo + "' class='img-circle img-responsive' />";
            }
        },
            {
                data: null,
                render: function (data, type, row) {
                    return "<a class='link_color' href='edit/" + data.tracking + "'>" + data.name_bn + "</a>";
                }
            },
            {
                data: "tracking"
            },
            {
                data: "pin"
            },
            {
                data: null,
                render: function (data, type, row) {
                    return String(data.sonod_no);
                }
            },
            {
                data: "mobile"
            },
            {
                data: "generate_date"
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    var edit = '', regenerate = '', invoice = '';

                    if ($('#regenerate').val()) {
                        regenerate = "<a  href='javascript:void(0)' onclick='land_use_regenerate(" + meta.row + ")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }

                    if ($('#edit').val()) {
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                    }

                    if ($('#invoice').val()) {
                        invoice = "<a  href='money_receipt/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                    }

                    return "<a  href='print_bn/" + data.sonod_no + "' target='_blank' ><p class='btn btn-sm" +
                        " btn-primary '>অনুমতি</p></a>  <a  href='note/" + data.sonod_no + "' target='_blank'" +
                        " ><p class='btn btn-sm btn-success'>নোট</p></a> " + edit + regenerate + invoice;
                }
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
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
}

// certificate list search
function certificate_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#land_use_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#land_use_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#land_use_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    certi_table.ajax.reload();
}

//====animal re-generate====//
function land_use_regenerate(row_index) {

    var row_data = certi_table.row(row_index).data();

    //for account list show
    account_list();

    $("#sonod_no").val(row_data.sonod_no);
    $("#tracking").val(row_data.tracking);
    $("#pin").val(row_data.pin);
    $("#name").val(row_data.name_bn);
    $("#application_id").val(row_data.application_id);

    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.permanent_upazila_id);
    $("#district_id").val(row_data.permanent_district_id);

    $("#land_use_regenerate_modal").modal('show');
}

//====animal re-generate save===//
function regenerate_save() {

    var tracking = $("#tracking").val();
    var sonod_no = $("#sonod_no").val();
    var pin = $("#pin").val();
    var application_id = $("#application_id").val();
    var account_id = $("#account").val();
    var fee = $("#fee").val();
    var vat = $("#vat").val();
    var memo_no = $("#memo_no").val();
    var generate_date = $("#land_generate_date").val();
    var union_id = $("#union_id").val();
    var upazila_id = $("#upazila_id").val();
    var district_id = $("#district_id").val();

    swal({
        title: "অনুমোদন",
        text: "আপনি কি সনদটি রি-জেনারেট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $.ajax({
                url: regenerate_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    tracking: tracking,
                    sonod_no: sonod_no,
                    pin: pin,
                    credit_id: account_id,
                    fee: fee,
                    vat: vat,
                    memo_no: memo_no,
                    generate_date: generate_date,
                    union_id: union_id,
                    upazila_id: upazila_id,
                    district_id: district_id,
                    application_id: application_id,
                    _token: certificate_csrf
                },
                success: function (response) {

                    $("#land_use_regenerate_modal").modal('hide');

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText: "বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="' + bangla_sonod_url + '/' + response.sonod_no + '" target="_blank">প্রিন্ট করুন</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                    certi_table.ajax.reload();
                }
            });
        }
    }).then(function () {

    });
}
