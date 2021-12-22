//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");

//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


//===datepicker===//
$('#animal_generate_date, #issue_date, #payment_date, #trade_generate_date, #from_date, #to_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});

//fee calculation
function calculation() {

    $('#vat').val('');
    $('#total').val('');

    var fee = $("#fee").val();
    var due = $("#due").val();
    var discount = $("#discount").val();
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

var animal_table, fiscal_year_id, from_date, to_date;

 //===animal applicant list===//
 function animal_applicant_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

         animal_table =    $('#animal_applicant_table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                dataType: "JSON",
                type: "post",
                url : animal_applicant_data_url,
                data: {
                    fiscal_year_id: fiscal_year_id,
                    from_date: from_date,
                    to_date: to_date,
                    _token: animal_applicant_csrf
                },

            },
            columns:[
                {
                    data: null,
                    render: function(){
                        return animal_table.page.info().start + animal_table.column(0).nodes().length;
                    }
                },

                {
                    data: null,
                    render: function(data, type, row) {

                        return "<img width='50' src='"+img_path+'/'+data.photo+"' class='img-circle img-responsive' />";
                    }
                },

                {
                    data: null,
                    render:function(data, type, row) {
                        return "<a class='link_color'  href='edit/"+data.tracking+"'>"+data.name_bn+"</a>";
                    }
                },
                { data: "father_name_bn" },
                { data: "tracking" },
                { data: "pin" },
                { data: "mobile" },
                { data: "created_time" },
                {
                    data: null,
                    render: function(data, type, row, meta){
                        var edit = '', del = '', generate = '';

                        if($('#generate').val()){
                            generate = "<a  href='javascript:void(0)' onclick='animal_generate("+meta.row+")' ><p class='btn btn-sm btn-primary'>জেনারেট</p></a> ";
                        }

                        if($('#edit').val()){
                            edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                        }

                        if($('#delete').val()){
                            del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='animal_delete("+data.application_id+")' >ডিলিট</p></a> ";
                        }

                        return generate+edit+"<a  href='preview/" + data.tracking + "' target='_blank'><p class='btn btn-sm btn-success'>আবেদন প্র্রিন্ট</p></a> "+del;
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

 //====animal applicant search====//
 function applicant_list_search(){
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#animal_applicant_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#animal_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#animal_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    animal_table.ajax.reload();
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
                            option += '<option value ="' + data.id + '"> ভোটার আইডি স্থানান্তর সনদ</option>';

                        else
                            option += '<option value ="'+data.id+'">'+data.account_name+'</option>';

                    });

                    $("#account").html(option)
                    
                }else{

                }
            }

        });
    }

    //====animal generate====//
    function animal_generate(row_index){

        var row_data = animal_table.row(row_index).data();

        // console.log(row_data);

        //for account list show
        account_list();

        //otter feild value set
        var animal_type = '';

        if(row_data.animal_type == 1){
            animal_type = 'কুকুর';
        } else if(row_data.animal_type == 2){
            animal_type = 'বিড়াল';
        } else if(row_data.animal_type == 3){
            animal_type = 'হাতি';
        } else if(row_data.animal_type == 4){
            animal_type = 'ঘোড়া';
        } else if(row_data.animal_type == 5){
            animal_type = 'হরিণ';
        } else if(row_data.animal_type == 6){
            animal_type = 'খরগোস';
        } else if(row_data.animal_type == 7){
            animal_type = 'বাঘ';
        } else if(row_data.animal_type == 8){
            animal_type = 'সিংহ';
        }

        $("#tracking").val(row_data.tracking);
        $("#pin").val(row_data.pin);
        $("#name").val(row_data.name_bn);
        $("#animal_name").val(row_data.animal_name_bn);

        $("#animal_type").val(animal_type);

        $("#application_id").val(row_data.application_id);
        $("#union_id").val(row_data.union_id);
        $("#upazila_id").val(row_data.permanent_upazila_id);
        $("#district_id").val(row_data.permanent_district_id);

        $("#animal_generate_modal").modal('show');
    }

    //====animal generate save===//
    function generate_save()
    {
        var tracking = $("#tracking").val();
        var pin = $("#pin").val();
        var application_id = $("#application_id").val();
        var account_id = $("#account").val();
        var fee = $("#fee").val();
        var due = $("#due").val();
        var discount = $("#discount").val();
        var vat = $("#vat").val();
        var source_tax = $("#source_tax").val();
        var sarcharge = $("#sarcharge").val();
        var expire_date = $("#expire_date").val();
        var generate_date = $("#issue_date").val();
        var payment_date = $("#payment_date").val();

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
             preConfirm: function() {
                $.ajax({
                  url: animal_generate_url,
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    tracking : tracking,
                    pin : pin,
                    credit_id : account_id,
                    fee : fee,
                    due : due,
                    discount : discount,
                    vat : vat,
                    source_tax : source_tax,
                    sarcharge : sarcharge,
                    expire_date : expire_date,
                    generate_date : generate_date,
                    payment_date : payment_date,
                    union_id : union_id,
                    upazila_id : upazila_id,
                    district_id : district_id,
                    application_id : application_id,
                    _token : animal_generate_csrf
                  },
                 success: function(response) {

                    $("#animal_generate_modal").modal('hide');

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText:"বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="'+animal_bangla_sonod_url+'/'+response.sonod_no+'/'+response.voucher+'" target="_blank">প্রিন্ট করুন</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                     })

                    animal_table.ajax.reload();
                }
                });
             }
        }).then(function(){

        });
    }

    //===animal delete===//
    function animal_delete(appId) {

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
            preConfirm: function() {
                $.ajax({
                    url: animal_delete_url,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        deleteId : appId,
                        _token : animal_delete_csrf
                    },
                    success: function(response) {
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
        }).then(function(){
            animal_table.ajax.reload();
        });
 }

 // this is for animal certificate list
 var animal_certi_table;


//==for animal certificate list===//
 function animal_certificate_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();
     
     animal_certi_table = $('#animal_certificate_table').DataTable({
         scrollCollapse: true,
         autoWidth: false,
         responsive: true,
         serverSide: true,
         processing: true,
         ajax: {
             type: "post",
             url: animal_certificate_data_url,
             data: {
                 fiscal_year_id: fiscal_year_id,
                 from_date: from_date,
                 to_date: to_date,
                 _token: animal_certificate_csrf
             },

         },
         columns: [{
                 data: null,
                 render: function() {
                     return animal_certi_table.page.info().start + animal_certi_table.column(0).nodes().length;
                 }
             }, {
                 data: null,
                 render: function(data, type, row) {
                     return "<img width='50' src='" + img_path + '/' + data.photo + "' class='img-circle img-responsive' />";
                 }
             },
             {
                data: null,
                render:function(data, type, row) {
                    return "<a class='link_color' href='edit/"+data.tracking+"'>"+data.name_bn+"</a>";
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
                 render : function(data, type, row){

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
                 render: function(data, type, row, meta) {
                    var edit = '', regenerate = '', invoice = '';
                    if($('#regenerate').val()){
                        regenerate = "<a  href='javascript:void(0)' onclick='regenerate("+meta.row+")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }
                    if($('#edit').val()){
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                    }
                    if($('#invoice').val()){
                        invoice = "<a  href='money_receipt/" + data.sonod_no + "/" + data.voucher + "' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                    }
                     return "<a  href='print_bn/" + data.sonod_no + "/" + data.voucher + "' target='_blank' ><p class='btn btn-sm btn-primary '>বাংলা</p></a>  <a  href='print_en/" + data.sonod_no + "/" + data.voucher + "' target='_blank' ><p class='btn btn-sm btn-success'>ইংরেজি</p></a> "+edit+regenerate+invoice;
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

//this is for animal certificate list search
 function certificate_list_search() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#animal_certificate_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#animal_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#animal_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    animal_certi_table.ajax.reload();
 }

 //====animal re-generate====//
function regenerate(row_index){
    var row_data = animal_certi_table.row(row_index).data();

    // console.log(row_data);

    //for account list show
    account_list();

    //otter feild value set
    var animal_type = '';

    if(row_data.animal_type == 1){
        animal_type = 'কুকুর';
    } else if(row_data.animal_type == 2){
        animal_type = 'বিড়াল';
    } else if(row_data.animal_type == 3){
        animal_type = 'হাতি';
    } else if(row_data.animal_type == 4){
        animal_type = 'ঘোড়া';
    } else if(row_data.animal_type == 5){
        animal_type = 'হরিণ';
    } else if(row_data.animal_type == 6){
        animal_type = 'খরগোস';
    } else if(row_data.animal_type == 7){
        animal_type = 'বাঘ';
    } else if(row_data.animal_type == 8){
        animal_type = 'সিংহ';
    }

    $("#tracking").val(row_data.tracking);
    $("#sonod_no").val(row_data.sonod_no);
    $("#pin").val(row_data.pin);
    $("#name").val(row_data.name_bn);
    $("#animal_name").val(row_data.animal_name_bn);

    $("#animal_type").val(animal_type);

    $("#application_id").val(row_data.application_id);
    $("#union_id").val(row_data.union_id);
    $("#upazila_id").val(row_data.permanent_upazila_id);
    $("#district_id").val(row_data.permanent_district_id);

    $("#regenerate_modal").modal('show');
}

    //====animal re-generate save===//
    function regenerate_save()
    {
        var tracking = $("#tracking").val();
        var sonod_no = $("#sonod_no").val();
        var pin = $("#pin").val();
        var application_id = $("#application_id").val();
        var account_id = $("#account").val();
        var fee = $("#fee").val();
        var due = $("#due").val();
        var discount = $("#discount").val();
        var vat = $("#vat").val();
        var source_tax = $("#source_tax").val();
        var sarcharge = $("#sarcharge").val();
        var expire_date = $("#expire_date").val();
        var generate_date = $("#issue_date").val();
        var payment_date = $("#payment_date").val();

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
             preConfirm: function() {
                $.ajax({
                  url: animal_regenerate_url,
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    tracking : tracking,
                    sonod_no : sonod_no,
                    pin : pin,
                    credit_id : account_id,
                    fee : fee,
                    due : due,
                    discount : discount,
                    vat : vat,
                    source_tax : source_tax,
                    sarcharge : sarcharge,
                    expire_date : expire_date,
                    generate_date : generate_date,
                    payment_date : payment_date,
                    union_id : union_id,
                    upazila_id : upazila_id,
                    district_id : district_id,
                    application_id : application_id,
                    _token : animal_regenerate_csrf
                  },
                 success: function(response) {

                    $("#regenerate_modal").modal('hide');

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText:"বাতিল",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="'+animal_bangla_sonod_url+'/'+response.sonod_no+'/'+response.voucher_no+'" target="_blank">প্রিন্ট করুন</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                     })

                     animal_certi_table.ajax.reload();
                }
                });
             }
        });
    }
