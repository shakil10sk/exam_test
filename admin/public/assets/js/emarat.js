//for url
var url = $('meta[name = path]').attr("content");
var csrf = $('mata[name = csrf-token]').attr("content");
//===success msg hide===//
setTimeout(function () {
    $(".alert-success").hide('slow');
}, 3000);


function emarot_amount_calculation() {

    let fee = parseInt($("#fee").val()) || 0;

    let tax = (fee / 100 ) * 15 ;
    $("#tax").val(tax)

    let total = (fee + tax);

    $("#total_amount").val(total)

}

//===datepicker===//
$('#namjari_generate_date, #from_date, #to_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});

var emarat_table, fiscal_year_id, from_date, to_date;

function emarat_applicant_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    emarat_table = $('#emarat_applicant_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url: emarat_applicant_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: emarat_applicant_csrf
            },

        },
        columns: [
            {
                data: null,
                render: function () {
                    return emarat_table.page.info().start + emarat_table.column(0).nodes().length;
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
                        generate = "<a  href='javascript:void(0)' onclick='emarot_generate(" + meta.row + ")' ><p class='btn btn-sm btn-primary'>জেনারেট</p></a> ";
                    }
                    if ($('#edit').val()) {
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                    }
                    if ($('#delete').val()) {
                        del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger'" +
                            " onclick='emarot_delete(" + data.application_id+","+data.emarot_id + ")'" +
                        " >ডিলিট</p></a> ";
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

//====prottyon applicant search====//
function applicant_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#emarat_applicant_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#emarat_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#emarat_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    emarat_table.ajax.reload();

}

//get account list
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

                    if (data.id == 28)
                        option += '<option value ="' + data.id + '">প্রত্যয়ন সনদ</option>';

                    else
                        option += '<option value ="' + data.id + '">' + data.account_name + '</option>';

                });

                $("#account").html(option)

            } else {

            }
        }

    });
}

//====prottyon generate====//
function emarot_generate(row_index) {

    var row_data = emarat_table.row(row_index).data();

    console.log(row_data);

    //for account list show
    account_list();

    //otter feild value set
    $("#tracking").val(row_data.tracking);
    $("#pin").val(row_data.pin);
    $("#name").val(row_data.name_bn);
    $("#application_id").val(row_data.application_id);
    $("#emarot_id").val(row_data.emarot_id);

    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.permanent_upazila_id);
    $("#district_id").val(row_data.permanent_district_id);

    $("#emarot_generate_modal").modal('show');
}

//====prottyon generate save===//
function generate_save() {

    var tracking = $("#tracking").val();
    var pin = $("#pin").val();
    var application_id = $("#application_id").val();
    var emarot_id =  $("#emarot_id").val();
    var account_id = $("#account").val();
    var fee = $("#fee").val();
    var tax = $("#tax").val();
    var memo_no = $("#memo_no").val();
    var generate_date = $("#prottyon_generate_date").val();
    var union_id = $("#union_id").val();
    var upazila_id = $("#upazila_id").val();
    var district_id = $("#district_id").val();

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
                url: emarat_generate_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    tracking: tracking,
                    pin: pin,
                    credit_id: account_id,
                    fee: fee,
                    vat: tax,
                    memo_no: memo_no,
                    generate_date: generate_date,
                    union_id: union_id,
                    upazila_id: upazila_id,
                    district_id: district_id,
                    application_id: application_id,
                    emarot_id_id: emarot_id,
                    _token: emarat_generate_csrf
                },
                success: function (response) {

                    $("#emarot_generate_modal").modal('hide');

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText: "বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="' + emarat_bangla_sonod_url + '/' + response.sonod_no + '" target="_blank">প্রিন্ট করুন</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                    emarat_table.ajax.reload();
                }
            });
        }
    }).then(function () {

    });


}

//===emarot_delete delete===//
function emarot_delete(appId,emarotId) {

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
                url: emarat_delete_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    deleteId: appId,
                    emarotId:emarotId,
                    _token: emarat_delete_csrf
                },
                success: function (response) {
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
                }
            });
        }
    }).then(function () {
        emarat_table.ajax.reload();
    });
}

// this is for prottyon certificate list
var emarot_certi_table;


//==for prottyon certificate list===//
function emarot_certificate_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    emarot_certi_table = $('#emarot_certificate_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            type: "post",
            url: emarot_certificate_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: emarot_certificate_csrf
            },

        },
        columns: [{
            data: null,
            render: function () {
                return emarot_certi_table.page.info().start + emarot_certi_table.column(0).nodes().length;
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
                    if($('#regenerate').val()){
                        regenerate = "<a  href='javascript:void(0)' onclick='emarot_regenerate("+meta.row+")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }
                    if ($('#edit').val()) {
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                    }
                    if ($('#invoice').val()) {
                        invoice = "<a  href='money_receipt/" + data.sonod_no + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                    }
                    return "<a  href='print_bn/" + data.sonod_no + "' target='_blank' ><p class='btn btn-sm" +
                        " btn-primary '>অনুমতি পত্র</p></a>  <a  href='note/" + data.sonod_no + "' target='_blank' ><p" +
                        " class='btn btn-sm btn-success'>নোট</p></a> " + edit + regenerate + invoice;
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

//this is for prottyon certificate list search
function certificate_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#emarot_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#emarot_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#emarot_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    emarot_certi_table.ajax.reload();
}

//==== emarot re-generate====//
function emarot_regenerate(row_index) {

    var row_data = emarot_certi_table.row(row_index).data();

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

    $("#emarot_regenerate_modal").modal('show');
}

//==== emarot re-generate save===//
function regenerate_save() {

    var tracking = $("#tracking").val();
    var sonod_no = $("#sonod_no").val();
    var pin = $("#pin").val();
    var application_id = $("#application_id").val();
    var account_id = $("#account").val();
    var fee = $("#fee").val();
    var tax = $("#tax").val();
    var memo_no = $("#memo_no").val();
    var generate_date = $("#emarot_generate_date").val();
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
                url: emarot_regenerate_url,
                type: "POST",
                dataType: "JSON",
                data: {
                    tracking: tracking,
                    sonod_no: sonod_no,
                    pin: pin,
                    credit_id: account_id,
                    fee: fee,
                    vat: tax,
                    memo_no: memo_no,
                    generate_date: generate_date,
                    union_id: union_id,
                    upazila_id: upazila_id,
                    district_id: district_id,
                    application_id: application_id,
                    _token: emarot_regenerate_csrf
                },
                success: function (response) {

                    $("#emarot_regenerate_modal").modal('hide');

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText: "বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="' + emarot_bangla_sonod_url + '/' + response.sonod_no + '" target="_blank">প্রিন্ট করুন</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })

                    emarot_certi_table.ajax.reload();
                }
            });
        }
    }).then(function () {

    });


}
