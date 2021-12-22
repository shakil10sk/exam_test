//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");
//===success msg hide===//
setTimeout(function() {
    $(".alert-success").hide('slow');
}, 3000);


//===datepicker===//
$('#from_date, #to_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});


var newholding_table, fiscal_year_id, from_date, to_date;
 
 function newholding_applicant_list() {
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    newholding_table =    $('#newholding_applicant_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url : newholding_applicant_data_url,
            data: {
                fiscal_year_id: fiscal_year_id,
                from_date: from_date,
                to_date: to_date,
                _token: newholding_applicant_csrf
            },

        },
        columns:[
            {
                data: null,
                render: function(){
                    return newholding_table.page.info().start + newholding_table.column(0).nodes().length;
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
                    if($('#edit').val()){
                        edit = "<a  href='edit/" + data.tracking + "'><p class='btn btn-sm btn-warning'>এডিট</p></a> ";
                    }
                    if($('#delete').val()){
                        del = "<a  href='javascript:void(0)'><p class='btn btn-sm btn-danger'" +
                            " onclick='newholding_delete("+meta.row+")'" +
                            " >ডিলিট</p></a> ";
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

 //====death applicant search====//
 function applicant_list_search(){
    fiscal_year_id = $("#fiscal_year_id").val();
    from_date = $("#filter_from_date").val();
    to_date = $("#filter_to_date").val();

    $("#newholding_applicant_table").dataTable().fnSettings().ajax.data.fiscal_year_id = fiscal_year_id;
    $("#newholding_applicant_table").dataTable().fnSettings().ajax.data.from_date = from_date;
    $("#newholding_applicant_table").dataTable().fnSettings().ajax.data.to_date = to_date;

    newholding_table.ajax.reload();

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
                            option += '<option value ="' + data.id + '"> মৃত্যু সনদ</option>';

                        else
                            option += '<option value ="'+data.id+'">'+data.account_name+'</option>';

                    });

                    $("#account").html(option)

                }else{

                }
            }

        });
    }



    //===newholding delete===//
    function newholding_delete(row_index) {

     let data = newholding_table.row(row_index).data();



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
                    url: newholding_delete_url,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        deleteId : data.application_id,
                        newholdingId:data.newholding_id,
                        _token : newholding_delete_csrf
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
                    }
                });
            }
        }).then(function(){
            newholding_table.ajax.reload();
        });
 }


