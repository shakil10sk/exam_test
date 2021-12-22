//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");


//get all_location
function get_location(parent_id, type, target_id){

     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: url + "/global/get_location",
        type:"POST",
        dataType:"JSON",
        data:{
            parent_id:parent_id,
            type:type,
        },
        success:function(response){

            if (response.status == 'success') {

                var list = "<option value=''>সিলেক্ট করুন</option>";

                response.data.forEach(function(item){

                    list += "<option value='"+item.id+"'>"+item.bn_name+"</option>";

                });

                $("#"+target_id).html(list);

            }else{

                $("#"+target_id).html("<option value=''>Not Found</option>");
            }

        }

     });

}


var union_table, district_id, upazila_id, union_code;


//===union list===//
function union_list() {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     union_table =    $('#union_list_table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "post",
            url : url + '/super_admin/union_list_data',
            data: {
                district_id:district_id,
                upazila_id:upazila_id,
                union_code:union_code,
            },

        },
        columns:[
            {
                data: null,
                render: function(){
                    return union_table.page.info().start + union_table.column(0).nodes().length;
                }
            },


            {
                data: "union_code",
                render: function(data, type, row){
                    let badge = '<span class="badge rounded-pill bg-success">&nbsp;&nbsp;</span>&nbsp;';
                    if(! +(row.is_active))
                    {
                        badge = '<span class="badge rounded-pill bg-danger">&nbsp;&nbsp;</span>&nbsp;';
                    }

                    return badge + data;
                }
            },
            { data: "bn_name" },
            { data: "username" },
            { data: "sub_domain" },
            { data: "mobile" },
            // {
            //     data: null,
            //     render:function(data, type, row, meta){
            //         return data.village_bn+", "+data.union_upazila_name_bn+", "+data.union_district_name_bn;
            //     }
            // },

            {
                data: null,
                render: function(data, type, row, meta){

                    if(+(data.is_active))
                    {
                        status_button =" <a  href='"+url+"/super_admin/status-change/"+data.id+"' class='btn btn-sm btn-secondary'>ডিএকটিভেট</a> ";
                    }
                    else
                    {
                        status_button =" <a  href='"+url+"/super_admin/status-change/"+data.id+"' class='btn btn-sm btn-success'>একটিভ</a> ";
                    }

                    return "<a href='"+url+"/impersonate/user/"+data.username+"' data-toggle='tooltip' data-placement='top' title='Impersonate' class='btn btn-sm btn-primary'><i class='fa fa-user-secret fa-lg'></i>Login AS</a>"+
                    status_button+
                    " <a  href='"+url+"/super_admin/union_edit/"+data.id+"' class='btn btn-sm btn-warning'>এডিট</a> "+
                    " <button data-id='"+data.id+"' class='btn btn-sm btn-danger delete_union_btn'>ডিলিট</button>";
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


//union list search
function union_list_search(){

    district_id = $("#district_id").val();
    upazila_id = $("#upazila_id").val();
    union_code = $("#union_code").val();

    $("#union_list_table").dataTable().fnSettings().ajax.data.district_id = district_id;
    $("#union_list_table").dataTable().fnSettings().ajax.data.upazila_id = upazila_id;
    $("#union_list_table").dataTable().fnSettings().ajax.data.union_code = union_code;

    union_table.ajax.reload();

}


//for bd location list table

var bdlocation, district_search_id, upazila_search_id, postoffice_search_id;

function bd_location_list() {

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     bdlocation =  $('#bd_location_list_table').DataTable({
            scrollCollapse: true,
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
            dataType: "JSON",
            type: "post",
            url : url + '/super_admin/bd_location_list_data',
            data: {
                district_id:district_search_id,
                upazila_id:upazila_search_id,
                postoffice_id:postoffice_search_id,
            },

        },
        columns:[
            {
                data: null,
                render: function(){
                    return bdlocation.page.info().start + bdlocation.column(0).nodes().length;
                }
            },

            {
                data: "dis_bn",
                render: function(data,type,row){

                    if(row.type==2)
                        return row.post_bn;
                    else if(row.type==3)
                        return row.upa_bn;
                    else if(row.type==4)
                        return row.dis_bn;
                    else
                        return data;
                }
            },
            {
                data: "upa_bn",
                render: function (data,type,row) {
                    if(row.type==2)
                        return null;
                    else if(row.type==3)
                        return row.post_bn;
                    else if(row.type==4)
                        return row.upa_bn;
                    else
                        return data;
                }
            },
            {
                data: "post_bn",
                render: function(data,type,row){
                    if(row.type==2)
                        return null;
                    else if(row.type==3)
                        return null;

                    else if(row.type==4)
                        return row.post_bn;
                    else
                        return data;
                }
            },

            {
                data: null,
                render: function(data, type, row, meta){
                    return '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="edit_bd_location('+meta.row+')"> <i class="fa fa-pencil"></i> Edit</a>'+'<button class="btn btn-danger btn-sm" onclick="bdlocation_delete('+data.id+')"><i class="fa fa-trash"></i> Delete'+"</button>";
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
        // dom: 'Bfrtip',
        // buttons: [
        // 'copy', 'csv', 'pdf', 'print'
        // ]
        });

 }

 //===bd location search====//
 // date to date searching
function bd_locatin_search() {

    district_search_id  = $("#district_id").val();
    upazila_search_id = $("#upazila_id").val();
    postoffice_search_id = $("#postoffice_id").val();

    $("#bd_location_list_table").dataTable().fnSettings().ajax.data.district_id = district_search_id;
    $("#bd_location_list_table").dataTable().fnSettings().ajax.data.upazila_id = upazila_search_id;
    $("#bd_location_list_table").dataTable().fnSettings().ajax.data.postoffice_id = postoffice_search_id;

    bdlocation.ajax.reload();
}

//add location
function add_bd_location(){

  $("#upazila_show").hide();
  $("#save_button").show();
  $("#update_button").hide();

  $("#district").val("");
  $("#upazila").val("");
  $("#en_name").val("");
  $("#bn_name").val("");
  $("#post_code").val("");

  $.ajax({
      url: url + "/global/get_location",
      type: "POST",
      dataType:"JSON",
      data: {},
      success:function(response){

          if (response.status == "success") {

            var district_list = "<option value=''>Select</option>";

            response.data.forEach(function(item){

              district_list += "<option value='" + item.id + "'>" + item.en_name + "</option>";
            });

            $("#district").html(district_list);

          }


          $("#upazila_show").hide();
          $("#show_post_code").hide();

      }
  });

  $("#add_bdlocation_modal").modal("toggle");

}

//===get upazila by district id===//

function get_bd_upazila(parent_id, type){

  $("#show_post_code").hide();

   $.ajax({
        url: url + "/global/get_location",
        type:"POST",
        dataType:"JSON",
        data:{
            parent_id:parent_id,
            type:type,
        },
        success:function(response){

            if (response.status == 'success') {


                var list = "<option value=''>সিলেক্ট করুন</option>";

                response.data.forEach(function(item){

                    list += "<option value='"+item.id+"'>"+item.en_name+"</option>";

                });

                $("#upazila_show").show();
                $("#upazila").html(list);
                // console.log(response.data);

            }else{

                $("#upazila").html("<option value=''>Not Found</option>");

                $("#upazila_show").hide();
            }

        }

     });
}

//====post code show====//

function post_code_show(value){

    if(value > 0){
        $("#show_post_code").show();
    }else{
        $("#show_post_code").hide();
    }
}


//===save bd location====//

function bd_location_save(){

  var district_id = $('#district').val();
  var upazila_id = $('#upazila').val();
  var en_name = $("#en_name").val();
  var bn_name = $("#bn_name").val();
  var post_code = $("#post_code").val();

  var error_status = false;

  if (en_name == "") {

      $("#en_name_error").html("Empty");
      error_status = true;

  }else{

      $("#en_name_error").html("");
  }

  if (bn_name == "") {

      $("#bn_name_error").html("Empty");
      error_status = true;

  }else{

      $("#bn_name_error").html("");
  }


  if (error_status == false) {

      $.ajax({
        url:url +"/super_admin/bd_location_save",
        dataType:"JSON",
        type:"POST",
        data:{
          district_id : district_id,
          upazila_id : upazila_id,
          en_name : en_name,
          bn_name : bn_name,
          post_code : post_code,
        },
        success:function(response){

            swal({
                  title: "Response",
                  text: response.message,
                  type: response.status,
                  showCancelButton: false,
                  showConfirmButton: true,
                  closeOnConfirm: true,
                  allowEscapeKey: false
            });

            bdlocation.ajax.reload();

        }

      });

      $("#add_bdlocation_modal").modal("toggle");

    }else{
      return false;
    }

}


//====bd location update=====//

function edit_bd_location(row_index){

    $("#save_button").hide();
    $("#update_button").show();

    var row_data =  bdlocation.row(row_index).data();

    $.ajax({
      "url": url+"/global/get_location",
      "type": "POST",
      "dataType":"JSON",
      "data": {},
      success:function(response){
        //   console.log(row_data);

        if (response.status == "success") {

            var district_id, upazila_id;

            var list = "<option value=''>Select</option>";

            response.data.forEach(function(item){

              list += "<option value='" + item.id + "'>" + item.en_name + "</option>";
            });

            $("#district").html(list);

             if (row_data.type==2){

                $("#en_name").val(row_data.post_en);
                $("#bn_name").val(row_data.post_bn);

                //post code hide and empty
                $("#show_post_code").hide();
                $("#post_code").val("");

             }else if(row_data.type == 3) {

                $("#district").val(row_data.parent_id);

                $("#en_name").val(row_data.post_en);
                $("#bn_name").val(row_data.post_bn);

                get_bd_upazila(row_data.parent_id, 3);

                //post code hide and empty
                $("#show_post_code").hide();
                $("#post_code").val("");

            }else if(row_data.type == 6) {

                district_id = row_data.dis_id;
                upazila_id = row_data.upa_id;
                post_office_id = row_data.id;

                //district name selected
                $("#district").val(row_data.dis_id);

                //post office name assign
                $("#en_name").val(row_data.post_en);
                $("#bn_name").val(row_data.post_bn);

                //get all upazila by district id
                get_bd_upazila(district_id, 3);

                setTimeout(function(){

                    //upazila name selected
                    $("#upazila").val(row_data.upa_id);

                }, 1500);


                //if has post code
                //post code show end value assign
                $("#show_post_code").show();
                $("#post_code").val(row_data.post_code);

            }

            $("#row_id").val(row_data.id);


        }


          $("#upazila_show").hide();
          $("#show_postoffice").hide();
      }
  });


  $("#add_bdlocation_modal").modal("toggle");

}


//===bd location update save====//

function bd_location_update_save(){

      var row_id = $("#row_id").val();

      var district_id = $('#district').val();
      var upazila_id = $('#upazila').val();
      var en_name = $("#en_name").val();
      var bn_name = $("#bn_name").val();
      var post_code = $("#post_code").val();

    // console.log("row_id "+ row_id);
    // console.log("district_id "+district_id);
    // console.log("upazila_id "+upazila_id);
    // console.log("en_name "+en_name);
    // console.log("bn_name "+bn_name);
    // console.log("post_code "+post_code);
    // return;

      var error_status = false;

      if (en_name == "") {

          $("#en_name_error").html("Empty");
          error_status = true;

      }else{

          $("#en_name_error").html("");
      }

      if (bn_name == "") {

          $("#bn_name_error").html("Empty");
          error_status = true;

      }else{

          $("#bn_name_error").html("");
      }


  if (error_status == false) {

      $.ajax({
        url:url +"/super_admin/bd_location_update_save",
        dataType:"JSON",
        type:"POST",
        data:{
          district_id : district_id,
          upazila_id : upazila_id,
          en_name : en_name,
          bn_name : bn_name,
          post_code : post_code,
          row_id : row_id,
        },
        success:function(response){

            swal({
                  title: "Response",
                  text: response.message,
                  type: response.status,
                  showCancelButton: false,
                  showConfirmButton: true,
                  closeOnConfirm: true,
                  allowEscapeKey: false
            });

            bdlocation.ajax.reload();

        }

      });

      $("#add_bdlocation_modal").modal("toggle");

    }else{
      return false;
    }

}



//======bd location delete======//

function bdlocation_delete(id) {

    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/super_admin/bd_location_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : id

                },
                success: function(response) {
                    swal({
                        title: "ধন্যবাদ",
                        text: response.status,
                        type: 'success',
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
        bdlocation.ajax.reload();
    });
}

//get all union by upazila id
function get_all_union(upazila_id, target_id){

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: url + "/global/all_union_list",
        type:"POST",
        dataType:"JSON",
        data:{
            upazila_id:upazila_id,

        },
        success:function(response){

            if (response.status == 'success') {

                var list = "<option value=''>সিলেক্ট করুন</option>";

                response.data.forEach(function(item){

                    list += "<option value='"+item.union_code+"'>"+item.bn_name+"</option>";

                });

                $("#"+target_id).html(list);

            }else{

                $("#"+target_id).html("<option value=''>Not Found</option>");
            }

        }

     });
}

//get fee info
function get_fee_info(){

    var union_id = $('#union_id').val();
    var voucher = $('#voucher').val();

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: url + "/super_admin/get_fee_info",
        type:"POST",
        dataType:"JSON",
        data:{
            union_id:union_id,
            voucher:voucher,

        },
        success:function(res){
            // console.log(res);

           if(res.status == 'success'){

                $(".fee_table").show();
                $("#data_message").hide();

                $('#credit_account').html(res.data.credit_account);
                $('#debit_account').html(res.data.debit_account);
                $('#voucher_no').html(res.data.voucher);
                $('#amount').val(res.data.amount);
                $('#row_id').val(res.data.id);
                $('#unionid').val(res.data.union_id);
                $('#created_time').html(res.data.created_time);


           }else{
                $("#data_message").show();
                $(".fee_table").hide();

           }

        }

     });
}

//support panel fee update
function update_fee() {

    var id = $('#row_id').val();
    var union_id = $('#unionid').val();
    var amount = $('#amount').val();

    swal({
        title: "অনুমোদন",
        text: "আপনি কি ফি সংশোধন করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/super_admin/fee_update',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : id,
                    union_id : union_id,
                    amount : amount,

                },
                success: function(response) {
                    swal({
                        title: (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত",
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

    });
}

//support panel fee delete
function delete_fee(){

    var row_id = $('#row_id').val();
    var union_id = $('#unionid').val();

    swal({
        title: "অনুমোদন",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url + '/super_admin/fee_delete',
                type: "POST",
                dataType: "JSON",
                data: {
                    id : row_id,
                    union_id : union_id,

                },
                success: function(response) {
                    swal({
                        title: (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত",
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
        location.reload();
    });

}

//get trade fee info
function get_trade_fee_info(){

    var union_id = $('#union_id').val();
    var voucher = $('#voucher').val();

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url: url + "/super_admin/get_trade_fee_info",
        type:"POST",
        dataType:"JSON",
        data:{
            union_id:union_id,
            voucher:voucher,

        },
        success:function(res){
            // console.log(res);

           if(res.status == 'success'){

                $(".fee_table").show();
                $("#data_message").hide();


                $('#row_id').val(res.data.id);
                $('#unionid').val(res.data.union_id);
                $('#created_time').html(res.data.created_time);


           }else{
                $("#data_message").show();
                $(".fee_table").hide();

           }

        }

     });
}

// ============ street setup ==================== //

var streetlist;

//add street
function add_street(){

    $("#save_button").show();
    $("#update_button").hide();

    $("#en_name").val("");
    $("#bn_name").val("");

    $("#street_modal").modal("toggle");

}

function streetStore(){

    var en_name = $("#en_name").val();
    var bn_name = $("#bn_name").val();

    var error_status = false;

    if (en_name == "") {

        $("#en_name_error").html("ইংরেজি নাম প্রদান করুন");
        error_status = true;

    }else{

        $("#en_name_error").html("");
    }

    if (bn_name == "") {

        $("#bn_name_error").html("বাংলা নাম প্রদান করুন");
        error_status = true;

    }else{

        $("#bn_name_error").html("");
    }


    if (error_status == false) {

        $.ajax({
            url:url +"/union/setup/street/store",
            dataType:"JSON",
            type:"POST",
            data:{
                name_en : en_name,
                name_bn : bn_name,
            },
            success:function(response){

                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                streetlist.ajax.reload();

            }

        });

        $("#street_modal").modal("toggle");

    }else{
        return false;
    }

}


function streetList(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    streetlist =  $('#street_list').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "GET",
            url : url +"/union/setup/street",
        },
        columns:[
            {
                data: 'DT_RowIndex',

            },

            {
                data: "name_bn",

            },
            {
                data: "name_en",

            },
            {
                data:null,
                render: function(data, type, row, meta){


                    return" <button  onclick='streetEdit("+meta.row+")' class='btn btn-sm" +
                        " btn-warning'>এডিট</button> "+
                        " <button onclick='streetDelete("+meta.row+")'  class='btn btn-sm btn-danger delete_union_btn'>ডিলিট</button>";
                }
            }

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

    });
}



function streetEdit(rowIndex){


    let data = streetlist.row(rowIndex).data();



    $("#save_button").hide();
    $("#update_button").show();

    $("#en_name").val(data.name_en);
    $("#bn_name").val(data.name_bn);
    $("#row_id").val(data.id);

    $("#street_modal").modal("toggle");



}


function streetUpdate(){

    var en_name = $("#en_name").val();
    var bn_name = $("#bn_name").val();
    var row_id = $("#row_id").val();

    var error_status = false;

    if (en_name == "") {

        $("#en_name_error").html("ইংরেজি নাম প্রদান করুন");
        error_status = true;

    }else{

        $("#en_name_error").html("");
    }

    if (bn_name == "") {

        $("#bn_name_error").html("বাংলা নাম প্রদান করুন");
        error_status = true;

    }else{

        $("#bn_name_error").html("");
    }


    if (error_status == false) {

        $.ajax({
            url:url +"/union/setup/street/update",
            dataType:"JSON",
            type:"POST",
            data:{
                name_en : en_name,
                name_bn : bn_name,
                id:row_id
            },
            success:function(response){

                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                    showCancelButton: false,
                    showConfirmButton: true,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                });

                streetlist.ajax.reload();

            }

        });

        $("#street_modal").modal("toggle");

    }else{
        return false;
    }

}


function streetDelete(rowIndex){

    let data = streetlist.row(rowIndex).data();

    swal({
        title: "Warning",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url +"/union/setup/street/delete/"+data.id,
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    swal({
                        title: (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                    streetlist.ajax.reload();
                }
            });
        }
    }).then(function(){

    });
}

// ============ street setup end ==================== //


// ============= designation =========== //

var designation_table;

function designationtList(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    designation_table =  $('#designation_list_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "GET",
            url : url +"/super_admin/designation",
        },
        columns:[
            {
                data: 'DT_RowIndex',

            },

            {
                data: "name",

            },
            {
                data:null,
                render: function(data, type, row, meta){
                    let htmlRender = " <button  onclick='designationEdit("+meta.row+")' class='btn btn-sm" +
                        " btn-warning'>এডিট</button> "+
                        " <button onclick='DesignationDelete("+meta.row+")'  class='btn btn-sm btn-danger" +
                        " delete_union_btn'>ডিলিট</button>";

                    return (row.is_system != 1) ? htmlRender : 'N/A';
                }
            }

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

    });
}

function designationEdit(row_index){

    let data = designation_table.row(row_index).data();

    $("#name").val(data.name);
    $("#row_id").val(data.id);

    $("#designation_update_modal").modal('toggle');

}

function DesignationDelete(rowIndex){

    let data = designation_table.row(rowIndex).data();

    swal({
        title: "Warning",
        text: "আপনি কি ডিলিট করতে চান?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url +"/super_admin/designation_delete/"+data.id,
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    swal({
                        title: (response.status == 'success') ? "ধন্যবাদ" : "দুঃখিত",
                        text: response.message,
                        type: response.status,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'ঠিক আছে',
                        closeOnConfirm: true,
                        allowEscapeKey: false
                    })
                    designation_table.ajax.reload();
                }
            });
        }
    }).then(function(){

    });
}



