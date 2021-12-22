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

            
            { data: "union_code" },
            { data: "bn_name" },
            { data: "username" },
            { data: "sub_domain" },
            { data: "mobile" },
            { 
                data: null,
                render:function(data, type, row, meta){
                    return data.village_bn+", "+data.union_upazila_name_bn+", "+data.union_district_name_bn;
                }
            },
 
            {
                data: null,
                render: function(data, type, row, meta){


                        return "<a  href='javascript:void(0)' onclick='home_tax_collect("+meta.row+")'><p class='btn btn-sm btn-info' >লগইন</p></a> <a  href='"+url+"/super_admin/union_edit/"+data.id+"'><p class='btn btn-sm btn-warning' >এডিট</p></a> <a href='"+url+"/impersonate/"+data.id+"' data-toggle='tooltip' data-placement='top' title='Impersonate' class='btn btn-sm btn-primary'><i class='fa fa-user-secret fa-lg'></i>Login AS</a>"
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

            
           {data: "district_en"},
           {data: "upazila_en"},
           {data: "post_office_en"},
 
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

              district_list += "<option value='" + item.id + "'>" + item.bn_name + "</option>";
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

                    list += "<option value='"+item.id+"'>"+item.bn_name+"</option>";

                });

                $("#upazila_show").show();
                $("#upazila").html(list);

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

          if (response.status == "success") {

            var district_id, upazila_id;

            var list = "<option value=''>Select</option>";

            response.data.forEach(function(item){

              list += "<option value='" + item.id + "'>" + item.en_name + "</option>";
            });

            $("#district").html(list);

             if (row_data.district_id == null && row_data.upazila_id == null && row_data.id != null){

                $("#en_name").val(row_data.district_en);
                $("#bn_name").val(row_data.district_bn);


                //post code hide and empty
                $("#show_post_code").hide();
                $("#post_code").val("");

             }else if(district == null && upazila != null && id != null) {

                district_id = upazila;
                upazila_id = id;

                $("#district").val(row_data.district_en);

                $("#en_name").val(row_data.upazila);

                get_bd_upazila(district, 4);

                //post code hide and empty
                $("#show_post_code").hide();
                $("#post_code").val("");

            }else {

                district_id = row_data.district_id;
                upazila_id = row_data.upazila_id;
                post_office_id = row_data.id;

                //district name selected
                $("#district").val(row_data.district_id);

                //post office name assign
                $("#en_name").val(row_data.post_office_en);
                $("#bn_name").val(row_data.post_office_bn);

                //get all upazila by district id
                get_bd_upazila(district_id, 3);

                setTimeout(function(){ 

                    //upazila name selected
                    $("#upazila").val(row_data.upazila_id);

                }, 3000);
                

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




 
