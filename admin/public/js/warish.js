//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");
//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


//===datepicker===//
$('#warish_generate_date, #from_date, #to_date').datepicker({
        language: 'en',
        autoClose: true,
        dateFormat: 'yy-mm-dd',
});

var warish_table, from_date, to_date;
 //===warish applicant list===//
 function warish_applicant_list() {

        from_date = $("#from_date").val();
        to_date =   $("#to_date").val();

         warish_table =    $('#warish_applicant_table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                dataType: "JSON",
                type: "post",
                url : warish_applicant_data_url,
                data: {
                    from_date : from_date,
                    to_date : to_date,
                    _token : warish_applicant_csrf
                },

            },
            columns:[
                {
                    data: null,
                    render: function(){
                        return warish_table.page.info().start + warish_table.column(0).nodes().length;
                    }
                },

                { 
                    data: null,
                    render:function(data, type, row) {

                         return "<a class='link_color' href='edit/"+data.tracking+"'>"+data.name_bn+"</a>";
                    }
                },
                { data: "father_name_bn" },
                { data: "tracking" },
                { data: "pin" },
                { 
                    data    : null,
                    render  : function(data){
                        if(data.mobile == null){
                            return "---";
                        }else{
                            return data.mobile;
                        }
                    }
                },
                { data: "created_time" },
                {  
                    data: null,
                    render: function(data, type, row, meta){
                        var edit = '', del = '', generate = '';
                        if($('#generate').val()){
                            generate = "<a  href='javascript:void(0)' onclick='warish_generate("+meta.row+")' ><p class='btn btn-sm btn-primary'>জেনারেট</p></a> ";
                        }
                        if($('#edit').val()){
                            edit = "<a  href='edit/"+data.tracking+"'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                        }
                        if($('#delete').val()){
                            del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger' onclick='warish_delete("+data.application_id+", "+data.tracking+")' >ডিলিট</p></a> ";
                        }
                        return generate+edit+"<a  href='preview/" + data.tracking +"' target='_blank'><p class='btn btn-sm btn-success'>আবেদন প্র্রিন্ট</p></a> "+del;
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

 //====warish applicant search====//
 function applicant_list_search(){


        from_date = $("#from_date").val();
        to_date = $("#to_date").val();

        // alert(from_date);

        $("#warish_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
        $("#warish_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

          warish_table.ajax.reload();

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

                        option += '<option value ="'+data.id+'">'+data.account_name+'</option>';

                    });

                    $("#account").html(option)
                    
                }else{

                }
            }

        });
    }



    //====warish generate====//
    function warish_generate(row_index){

        var row_data = warish_table.row(row_index).data();

        //for account list show
        account_list();

        $("#tracking").val(row_data.tracking);
        $("#pin").val(row_data.pin);
        $("#name").val(row_data.name_bn);
        $("#application_id").val(row_data.application_id);

        $("#union_id").val(row_data.union_id);
        $("#upazila_id").val(row_data.permanent_upazila_id);
        $("#district_id").val(row_data.permanent_district_id);

        $("#warish_generate_modal").modal('show');
    }

    //====warish generate save===//
    function generate_save()
    {
     
        var tracking = $("#tracking").val();
        var pin = $("#pin").val();
        var application_id = $("#application_id").val();
        var account_id = $("#account").val();
        var fee = $("#fee").val();
        var generate_date = $("#warish_generate_date").val();
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
                  url: warish_generate_url,
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    tracking : tracking,
                    pin : pin,
                    union_id : union_id,
                    credit_id : account_id,
                    fee : fee,
                    generate_date : generate_date,
                    upazila_id : upazila_id,
                    district_id : district_id,
                    application_id : application_id,
                    _token : warish_generate_csrf
                  },
                 success: function(response) {

                    $("#warish_generate_modal").modal('hide');

                    console.log(response);

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText:"Close",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="'+warish_bangla_sonod_url+'/'+response.sonod_no+'" target="_blank">Print</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                     })

                    warish_table.ajax.reload();
                }
                });
             }
        }).then(function(){

        });



    }

    //===warish delete===//
    function warish_delete(appId, tracking) {

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
                  url: warish_delete_url,
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    appId : appId,
                    tracking : tracking,
                    _token : warish_delete_csrf
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

                    warish_table.ajax.reload();
                }
                });
             }
        })
 }

 // this is for warish certificate list
 var warish_certi_table;


//==for warish certificate list===//
 function warish_certificate_list() {
     from_date = $("#from_date").val();
     to_date = $("#to_date").val();
     // alert(from_date);
     warish_certi_table = $('#warish_certificate_table').DataTable({
         scrollCollapse: true,
         autoWidth: false,
         responsive: true,
         serverSide: true,
         processing: true,
         ajax: {
             dataType: "JSON",
             type: "post",
             url: warish_certificate_data_url,
             data: {
                 from_date: from_date,
                 to_date: to_date,
                 _token: warish_certificate_csrf
             },
         },
         columns: [{
                 data: null,
                 render: function() {
                     return warish_certi_table.page.info().start + warish_certi_table.column(0).nodes().length;
                 }
             },  
             { 
                data: null,
                render:function(data, type, row) {
                     return "<a class='link_color' href='edit/"+data.tracking+"'>"+data.name_bn+"</a>";
                }
            },
             { data: "father_name_bn" },
             {
                 data: "tracking"
             }, 
             {
                 data: "pin"
             }, 
             {
                 data: "sonod_no"
             }, 
             { 
                data    : null,
                render  : function(data){
                    if(data.mobile == null){
                        return "---";
                    }else{
                        return data.mobile;
                    }
                }
            }, 
             {
                 data: "generate_date"
             }, 
             {
                 data: null,
                 render: function(data, type, row, meta) {
                    var edit = '', regenerate = '', invoice = '';
                    if($('#regenerate').val()){
                        regenerate = "<a  href='javascript:void(0)' onclick='warish_regenerate("+meta.row+")' ><p class='btn btn-sm btn-primary custom_button'>রি-জেনারেট</p></a> ";
                    }
                    if($('#edit').val()){
                        edit = "<a  href='edit/"+data.tracking+"'><p class='btn btn-sm btn-warning' >এডিট</p></a> ";
                    }
                    if($('#invoice').val()){
                        invoice = "<a  href='money_receipt/"+data.sonod_no+"' target='_blank'><p class='btn btn-sm custom_button_violet'>রশিদ</p></a>";
                    }
                     return "<a  href='print_bn/" + data.sonod_no + "' target='_blank' ><p class='btn btn-sm btn-primary '>বাংলা</p></a>  <a  href='print_en/" + data.sonod_no + "' target='_blank' ><p class='btn btn-sm btn-success'>ইংরেজি</p></a> "+edit+regenerate+invoice;
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

//this is for warish certificate list search
 function certificate_list_search() {

     from_date = $("#from_date").val();
     to_date = $("#to_date").val();

     // alert(from_date);
     $("#warish_certificate_table").dataTable().fnSettings().ajax.data.from_date = from_date;

     $("#warish_certificate_table").dataTable().fnSettings().ajax.data.to_date = to_date;

     warish_certi_table.ajax.reload();
 }

 //====warish re-generate====//
    function warish_regenerate(row_index){

        var row_data = warish_certi_table.row(row_index).data();

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

        $("#warish_regenerate_modal").modal('show');
    }

    //====warish re-generate save===//
    function regenerate_save()
    {
     
        var tracking = $("#tracking").val();
        var sonod_no = $("#sonod_no").val();
        var pin = $("#pin").val();
        var application_id = $("#application_id").val();
        var account_id = $("#account").val();
        var fee = $("#fee").val();
        var generate_date = $("#warish_generate_date").val();
        var union_id = $("#union_id").val();
        var upazila_id = $("#upazila_id").val();
        var district_id = $("#district_id").val();

        swal({
             title: "অনুমোদন",
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
                  url: warish_regenerate_url,
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    tracking : tracking,
                    sonod_no : sonod_no,
                    pin : pin,
                     credit_id : account_id,
                    fee : fee,
                    generate_date : generate_date,
                    union_id : union_id,
                    upazila_id : upazila_id,
                    district_id : district_id,
                    application_id : application_id,
                    _token : warish_regenerate_csrf
                  },
                 success: function(response) {

                    $("#warish_regenerate_modal").modal('hide');

                    console.log(response);

                    swal({
                        title: "ধন্যবাদ",
                        text: response.message,
                        type: response.status,
                        showCancelButton: true,
                        cancelButtonText:"Close",
                        showConfirmButton: true,
                        confirmButtonText: '<a href="'+warish_bangla_sonod_url+'/'+response.sonod_no+'" target="_blank">Print</a>',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                     })

                    warish_certi_table.ajax.reload();
                }
                });
             }
        }).then(function(){

        });



    }