// =====  Market Module  ===== //
var market_list_tbl;
var shop_owner_list;

function market_list(){
    market_list_tbl = $('#market_list_tbl').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "get",
            url: app_url + "/market/list_data",
            data: {},
        },
        columns: [
            {
                data: null,
                render: function() {
                    return market_list_tbl.page.info().start + market_list_tbl.column(0).nodes().length;
                }
            },
            {
                data: "name"
            },
            {
                data: "address"
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return "<button class='btn btn-sm btn-primary' onclick='marketListEdit("+meta.row+")'><i class='fa fa-pencil'></i> Edit</button> <button class='btn btn-sm btn-danger' onclick='marketListDelete("+meta.row+")'><i class='fa fa-trash'></i> Delete</button>";
                }
            },
        ],
        dom: 'Bfrtip',
    });
}

function marketListEdit(pid){
    var row_data = market_list_tbl.row(pid).data();

    $("#pid").val(row_data.id);
    $("#name").val(row_data.name);
    $("#address").val(row_data.address);

    $("#operation_edit_modal").modal('show');

}

function marketListDelete(pid){
    var row_data = market_list_tbl.row(pid).data();

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
        preConfirm: function() {
           $.ajax({
             url: app_url + "/market/delete",
             type: "POST",
             dataType: "JSON",
             data: {
               pid: row_data.id,
               _token: csrf_token
             },
            success: function(response) {
               swal({
                   title: "Response",
                   text: response.message,
                   type: response.status,
                   showCancelButton: true,
                   showConfirmButton: true,
                   closeOnConfirm: true,
                   allowEscapeKey: false
                })

                market_list_tbl.ajax.reload();
           }
           });
        }
   });
}

// =====  Shop Module  ===== //
var shop_list_tbl;

function shop_list(){
    shop_list_tbl = $('#shop_list_tbl').DataTable({
        dom: 'lfrtip',
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "get",
            url: app_url + "/shop/list_data",
            data: {},
        },
        columns: [
            {
                data: null,
                render: function() {
                    return shop_list_tbl.page.info().start + shop_list_tbl.column(0).nodes().length;
                }
            },
            {
                data: "market_name"
            },
            {
                data: "name"
            },
            {
                data: "selami"
            },
            {
                data: "rent"
            },
            {
                data: null,
                render: function(data, type, row, meta) {
                    return "<button class='btn btn-sm btn-primary' onclick='shopListEdit("+meta.row+")'><i class='fa fa-pencil'></i> Edit</button> <button class='btn btn-sm btn-danger' onclick='shopListDelete("+meta.row+")'><i class='fa fa-trash'></i> Delete</button>";
                }
            },
        ],
    });
}

var row_id = 1;

function addNewShop(){
    // get values
    var shop_no = $("#shop_no").val();
    var selami = $("#selami").val();
    var rent = $("#rent").val();
    var error_status = false;

    if(shop_no == ''){
        $("#shop_no").attr("style", "border: 1px solid red;");
        error_status = true;
    } else {
        $("#shop_no").removeAttr("style");
    }
    
    if(selami == ''){
        $("#selami").attr("style", "border: 1px solid red;");
        error_status = true;
    } else {
        $("#selami").removeAttr("style");
    }
    
    if(rent == ''){
        $("#rent").attr("style", "border: 1px solid red;");
        error_status = true;
    } else {
        $("#rent").removeAttr("style");
    }

    if(!error_status){
        var output = '<div class="col-md-12" id="shop'+row_id+'" style="margin-top: 10px;">';
        output += '<div class="col-md-4 float-left">';
        output += '<input type="text" name="shop_no[]" class="form-control" value="'+shop_no+'" readonly>';
        output += '</div>';
        
        output += '<div class="col-md-4 float-left">';
        output += '<input type="text" name="selami[]" class="form-control" value="'+selami+'" readonly>';
        output += '</div>';
        
        output += '<div class="col-md-3 float-left">';
        output += '<input type="text" name="rent[]" class="form-control" value="'+rent+'" readonly>';
        output += '</div>';

        output += '<div class="col-md-1 float-left">';
        output += '<button type="button" class="btn btn-sm btn-danger" onclick="removeShop('+row_id+')">-</button>';
        output += '</div>';
        output += '</div>';

        row_id++;

        // reset values
        $("#shop_no").val('');
        $("#selami").val('');
        $("#rent").val('');

        $("#output").append(output);
    }
}

function removeShop(row_id){
    $("#shop"+row_id).remove();
}

function shopListEdit(pid){
    var row_data = shop_list_tbl.row(pid).data();

    $("#pid").val(row_data.id);
    $("#edit_market_id").val(row_data.market_id);
    $("#edit_shop_no").val(row_data.name);
    $("#edit_selami").val(row_data.selami);
    $("#edit_rent").val(row_data.rent);

    $("#operation_edit_modal").modal('show');

}

function shopListDelete(pid){
    var row_data = shop_list_tbl.row(pid).data();

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
        preConfirm: function() {
           $.ajax({
             url: app_url + "/shop/delete",
             type: "POST",
             dataType: "JSON",
             data: {
               pid: row_data.id,
               _token: csrf_token
             },
            success: function(response) {
               swal({
                   title: "Response",
                   text: response.message,
                   type: response.status,
                   showCancelButton: true,
                   showConfirmButton: true,
                   closeOnConfirm: true,
                   allowEscapeKey: false
                })

                shop_list_tbl.ajax.reload();
           }
           });
        }
   });
}
// =====  Shop Owner Module  ===== //

function shop_owner() {
    $('#owner_form')[0].reset();
    $('#owner_form').parsley().reset();
    $("#owner_form").attr('onsubmit','shop_owner_save()');
    getShopByMarketId();
    $("#shop_owner_modal").modal('show');
}


  function shop_owner_save() {
      let owner_data = new FormData($("#owner_form")[0]);

      if ($('#owner_form').parsley().isValid()) {
          $.ajax({
              url: app_url + "/shopowner/store",
              type: 'POST',
              data: owner_data,
              processData: false,
              contentType: false,
              dataType:'JSON',
              success: function (response) {
                    swal({
                        title: response.status == "success" ? "ধন্যবাদ" : "ব্যর্থ",
                        text: response.message,
                        type: response.status
                    })

                    shop_owner_list.ajax.reload();

                    $("#shop_owner_modal").modal('hide');
                    $('#owner_form')[0].reset();
                    $('#owner_form').parsley().reset();
              },
              error: function (request, status, error) {
                  let errors_data = JSON.parse(request.responseText);
                  // object to array convert
                  let errors_data_array = Object.entries(errors_data.errors);

                  errors_data_array.forEach(function(item){
                      $("." + item[0] + "_feedback").html(item[1]);
                  })


              }
          })
      }
  }

  function shop_owner_list() {
      shop_owner_list = $('#shopowner_list_tbl').DataTable({
          scrollCollapse: true,
          autoWidth: false,
          responsive: true,
          serverSide: true,
          processing: true,
          ajax: {
              dataType: "JSON",
              type: "get",
              url: app_url + "/shopowner/list_data",
              data: {},
          },
          columns: [
              {
                  data: null,
                  render: function () {
                      return shop_owner_list.page.info().start + shop_owner_list.column(0).nodes().length;
                  }
              },
              {
                  data: "market_name"
              },
              {
                  data: "shop_name"
              },
              {
                  data: "name"
              },
              {
                  data: "father_name"
              },
              {
                  data: "mobile_no"
              },
              {
                  data: "selami_amount"
              },
              {
                  data: "rent_amount"
              },
              {
                  data: null,
                  render: function(data, type, row, meta){
                      var btn_class = data.status == 1 ? 'success' : 'danger';
                      var btn_text = data.status == 1 ? 'Current' : 'Old';

                      return '<span class="badge badge-'+btn_class+'">'+btn_text+'</span>';
                  }
              },
              {
                  data: null,
                  render: function (data, type, row, meta) {
                      var action = "<button class='btn btn-sm btn-primary' onclick='shop_owner_edit(" + meta.row + ")'><i class='fa fa-pencil'></i> Edit</button> <button class='btn btn-sm btn-danger' onclick='shop_owner_delete(" + meta.row + ")'><i class='fa fa-trash'></i> Delete</button>";

                    //   action += data.status == 1 ? "<button class='btn btn-sm btn-warning' onclick='update_contract(" + meta.row + ", 2)'><i class='fa fa-times'></i>Cancel Contract</button>" : "<button class='btn btn-sm btn-success' onclick='update_contract(" + meta.row + ", 1)'><i class='fa fa-check'></i>Renew Contract</button>";

                      return action;
                  }
              },
          ],
          dom: 'Bfrtip',
      });

      
  }

  function shop_owner_edit(index) {
      
      $("#owner_form").attr('onsubmit', 'shop_owner_update()');

      let owner_data = shop_owner_list.row(index).data();

      $("#market_id").val(owner_data.market_id);
      getShopByMarketId(owner_data.market_id, owner_data.shop_id)
      $("#name").val(owner_data.name);
      $("#father_name").val(owner_data.father_name);
      $("#mother_name").val(owner_data.mother_name);
      $("#address").val(owner_data.address);
      $("#nid").val(owner_data.address);
      $("#mobile_no").val(owner_data.mobile_no);
      $("#selami_amount").val(owner_data.selami_amount);
      $("#rent_amount").val(owner_data.rent_amount);
      $("#starting_date").val(owner_data.starting_date);
      $("#row_id").val(owner_data.id);
      $("#shop_owner_modal").modal('show');
  }

  function shop_owner_update() {
    let owner_data = new FormData($("#owner_form")[0]);


    if ($('#owner_form').parsley().isValid()) {
        $.ajax({
            url: app_url + "/shopowner/update",
            type: 'POST',
            data: owner_data,
            processData: false,
            contentType: false,
            dataType: 'JSON',
            success: function (response) {
                if (response.status == "success") {
                    swal({
                        title: response.status == "success" ? "ধন্যবাদ" : "ব্যর্থ",
                        text: response.message,
                        type: response.status
                    })

                    shop_owner_list.ajax.reload();

                    $("#shop_owner_modal").modal('hide');
                    $('#owner_form')[0].reset();
                    $('#owner_form').parsley().reset();

                }
            },
            error: function (request, status, error) {
                console.log(request.responseText);
            }
        })
    }
  }

  function shop_owner_delete(index){
      let owner_data = shop_owner_list.row(index).data();

      swal({
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
                  url: app_url + "/shopowner/delete",
                  type: 'POST',
                  data: { row_id: owner_data.id, _token: csrf_token},
                  dataType: 'JSON',
                  success: function (response) {
                      if (response.status == "success") {
                          swal({
                              title: "ধন্যবাদ",
                              text: response.message,
                              type: response.status,
                          })
            
                          shop_owner_list.ajax.reload();

                          
                      }
                  }
              })
          }
      }).then(function () { });
  }

  // shop ownership change
  function shop_ownership_change(){
    if ($('#owner_form').parsley().isValid()) {
        return true;
    } else {
        return false;
    }
  }

  function update_contract(index, contractType){
    let row_data = shop_owner_list.row(index).data();

    var txt = contractType == 1 ? "Are you want to renew contract with this owner ?" : "Are you want to cancel contract with this owner ?";

      swal({
          title: "Confirmation",
          text: txt,
          type: "warning",
          showConfirmButton: true,
          confirmButtonClass: "btn-success",
          confirmButtonText: "Yes",
          showCancelButton: true,
          cancelButtonText: "No",
          showLoaderOnConfirm: true,
          closeOnConfirm: false,
          preConfirm: function () {
              $.ajax({
                  url: app_url + "/shopowner/cancelContract",
                  type: 'POST',
                  data: {
                      row_id: row_data.id,
                      shop_id: row_data.shop_id,
                      contractType: contractType,
                      _token: csrf_token
                    },
                  dataType: 'JSON',
                  success: function (response) {
                    swal({
                        title: "Response",
                        text: response.message,
                        type: response.status,
                    })

                    shop_owner_list.ajax.reload();
                  }
              })
          }
      });
  }

  var shop_list_data = [];

  function getShopByMarketId(market_id = null, selected_index = null){

    if (market_id){

        $.ajax({
            url:app_url + "/shopowner/getShopByMarketId/"+market_id,
            type:'GET',
            success:function(response) {
                shop_list_data = response.data;

               let htmlrender = '<option value="" >নির্বাচন করুন</option>';
               response.data.forEach(function(value){
                   let selected = '';

                   if (selected_index != null ) {
                       selected = (value.id == selected_index) ? 'selected':'';
                   }


                   htmlrender += '<option value="' + value.id + '" ' + selected+' >'+value.name+'</option>';
               });

                 $("#shop_id").html(htmlrender);

            }
        })

    } else {
           $("#shop_id").html('<option value="" >নির্বাচন করুন</option>');
    }
  }

  function getSelamiRent(shop_id){
    var selami = '';
    var rent = ''  ;

    shop_list_data.forEach(function(item){
        if(item.id == shop_id){
            selami = item.selami;
            rent = item.rent;
          }
      });

      // fee
      var fee_amount = rent * 14; // 14 months fee as ownership change fee

      var total_amount = parseInt(selami) + fee_amount;

      $("#selami_amount").val(selami);
      $("#rent_amount").val(rent);
      $("#fee_amount").val(fee_amount);
      $("#total_amount").val(total_amount);
  }

function getShopInfo(shop_id){
    if (shop_id) {

        $.ajax({
            url: app_url + "/shop/getshopinfo/" + shop_id,
            type: 'GET',
            success: function (response) {
                 console.log(response);
                $("#selami_amount").val(response.data.selami || '' );
                $("#rent_amount").val(response.data.rent || '' );
            }
        })

    } else {
        $("#selami_amount").val('');
        $("#rent_amount").val('');
    }
}

//==============  ownership expire =========//

var ownership_expire_list;
function expire_owner_list() {
    ownership_expire_list =  $('#expire_owner_list').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "get",
            url: app_url + "/shopowner/expire/list_data",
            data: {},
        },
        columns: [
            { data: 'DT_RowIndex'},
            {
                data: "market_name"
            },
            {
                data: "shop_name"
            },
            {
                data: "name"
            },
            {
                data: "father_name"
            },
            {
                data: "mobile_no"
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    var action = "<button class='btn btn-sm btn-primary' onclick='shop_ownership_renew(" + meta.row + ")'><i class='fa fa-pencil'></i> renew</button> <button class='btn btn-sm btn-danger' onclick='shop_ownership_cancel(" + meta.row + ")'><i class='fa fa-trash'></i> cancel</button>";

                    //   action += data.status == 1 ? "<button class='btn btn-sm btn-warning' onclick='update_contract(" + meta.row + ", 2)'><i class='fa fa-times'></i>Cancel Contract</button>" : "<button class='btn btn-sm btn-success' onclick='update_contract(" + meta.row + ", 1)'><i class='fa fa-check'></i>Renew Contract</button>";

                    return action;
                }
            },
        ],
        dom: 'Bfrtip',
    });


}

function shop_ownership_renew(row_index){
    let data = ownership_expire_list.row(row_index).data();
    console.log(data);
    $("#owner_id").val(data.id);
    $("#owner_name").val(data.name);
    $("#previous_rent").val(data.rent_amount);
    $("#previous_selami").val(data.selami_amount);
    $("#ownership_renew_modal").modal('show');
}

function shop_ownership_renew_save(){

    let rent = parseInt($("#rent").val());
    let salami = parseInt($("#selami").val());
    let owner_id = $("#owner_id").val();
    let starting_date = $("#starting_date").val();
    let error_status = false;

    if (isNaN(rent)) {
        $(".rent_error").html("ভাড়া প্রদান করুন");
        error_status = true;
    } else {
        $(".rent_error").html("");
    }

    if (isNaN(salami)) {
        $(".selami_error").html("সালামী প্রদান করুন");
        error_status = true;
    } else {
        $(".selami_error").html("");
    }

    if (error_status == false) {

        swal({
            text: "আপনি কি দোকানটি নবায়ন করতে আগ্রহী ?",
            type: "warning",
            showConfirmButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes",
            showCancelButton: true,
            cancelButtonText: "No",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                $.ajax({
                    url: app_url + "/shopowner/expire/ownership_renew_store",
                    type: 'POST',
                    data: {
                        rent: rent,
                        salami: salami,
                        staring_date: starting_date,
                        owner_id: owner_id,
                        _token: csrf_token
                    },
                    success: function (response) {
                        if (response.status == "success") {
                            swal({
                                title: "ধন্যবাদ",
                                text: response.message,
                                type: response.status,
                            })
                            $("#ownership_renew_modal").modal('hide');
                            ownership_expire_list.ajax.reload();
                       }
                    }
                })
            }
        }).then(function () { });
        
        

    }

    
}

function shop_ownership_cancel(row_index){
    let data = ownership_expire_list.row(row_index).data();

    swal({
        text: "আপনি কি চুক্তি বাদ দিতে চাচ্ছেন ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes",
        showCancelButton: true,
        cancelButtonText: "No",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $.ajax({
                url: app_url + "/shopowner/expire/ownership_cancel_store",
                type: 'POST',
                data: { owner_id: data.id, _token: csrf_token },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == "success") {
                        swal({
                            title: "ধন্যবাদ",
                            text: response.message,
                            type: response.status,
                        })

                        ownership_expire_list.ajax.reload();


                    }
                }
            })
        }
    }).then(function () { });
    
}

//==============  ownership expire =========//

// =====  Bill Generate Module  ===== //
function bill_generate_save() {

    let year_id = $("#year_id").val();
    let month_id = $("#month_id").val();
    let market_id = $("#market_id").val() || 0;
    let last_payment_date = $("#last_payment_date").val();

    let error_status = false;

    if (year_id == "") {
        $("#year_id_error").html("বছর সিলেক্ট করুন");
        error_status = true;
    }else{
        $("#year_id_error").html("");
    }

    if (month_id == "") {
        $("#month_id_error").html("মাস সিলেক্ট করুন");
        error_status = true;
    } else {
        $("#month_id_error").html("");
    }

    if (last_payment_date == "") {
        $("#last_payment_error").html("পেমেন্ট তারিখ প্রদান করুন");
        error_status = true;
    } else {
        $("#last_payment_error").html("");
    }

    if (error_status == false) {
        $.ajax({
            url: app_url +'/shop/bill/generate/store',
            type:'POST',
            data:{
                year_id:year_id,
                month_id:month_id,
                market_id:market_id,
                last_payment_date:last_payment_date,
                _token:csrf_token
            },
            success:function(response){
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                })

            }
        })
    }
   
}


var invoice_list;
function invoice_list() {
    invoice_list = $('#invoice_list_tble').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "POST",
            url: app_url + "/shop/bill/generate/list_data",
            data: function(e) {
                e.year_id = $("#filter_year_id").val() || 0,
                e.month_id = $("#filter_month_id").val() || 0,
                e.market_id = $("#filter_market_id").val() || 0,
                e._token = csrf_token
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {
                data: "year_id", name: 'year_id'
            },
            {
                data: "month_name", name: 'month_name'
            },
            {
                data: "invoice_id", name: 'invoice_id'
            },
            {
                data: "shop_name", name: 'shop_name'
            },
            {
                data: "owner_name", name: 'owner_name'
            },
            {
                data: "mobile_no", name:'mobile_no'
            },
            {
                data: "status", name:'status'
            },
            {
                data: null,
                render: function (data, type, row, meta) {
                    let disable = (row.is_paid == 1) ? 'disabled' : '';
                    var action = "<a class='btn btn-sm btn-primary' href=" + app_url +"/shop/bill/generate/invoice/print/"+row.invoice_id+"'  ><i class='fa fa-sticky-note-o'></i> Invoice</a> <button class='btn btn-sm btn-danger' onclick='invoice_delete(" + meta.row + ")' "+disable+"  ><i class='fa fa-trash'></i> Delete</button>";

                

                    return action;
                }
            },
        ],
        dom: 'Bfrtip',
    });


}

function invoice_search() {
    
    invoice_list.ajax.reload();
}

function invoice_delete(index){
    let row_data = invoice_list.row(index).data();

    swal({
        text: "আপনি কি ইনভয়েসটি মুছে ফেলতে চাচ্ছেন ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            $.ajax({
                url: app_url + "/shop/bill/generate/delete",
                type: 'POST',
                data: { row_id: row_data.id, _token: csrf_token },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == "success") {
                        swal({
                            title: "ধন্যবাদ",
                            text: response.message,
                            type: response.status,
                        })

                         invoice_list.ajax.reload();


                    }
                }
            })
        }
    }).then(function () { });
    
}

function bill_generate_sms_save(){

    let year_id = $("#year_id").val();
    let month_id = $("#month_id").val();
    let market_id = $("#market_id").val() || 0;
 
    

    let error_status = false;

    if (year_id == "") {
        $("#year_id_error").html("বছর সিলেক্ট করুন");
        error_status = true;
    } else {
        $("#year_id_error").html("");
    }

    if (month_id == "") {
        $("#month_id_error").html("মাস সিলেক্ট করুন");
        error_status = true;
    } else {
        $("#month_id_error").html("");
    }


    if (error_status == false) {
        $.ajax({
            url: app_url + '/shop/sms/bill/generate/send',
            type: 'POST',
            data: {
                year_id: year_id,
                month_id: month_id,
                market_id: market_id,
                _token: csrf_token
            },
            success: function (response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                })

            }
        })
    }
}



// ==== Bill Collection ==== //
var month_list = [];

month_list[1] = 'January';
month_list[2] = 'February';
month_list[3] = 'March';
month_list[4] = 'April';
month_list[5] = 'May';
month_list[6] = 'June';
month_list[7] = 'July';
month_list[8] = 'August';
month_list[9] = 'October';
month_list[10] = 'September';
month_list[11] = 'November';
month_list[12] = 'December';

var bill_collection_tbl, year_id, month_id, market_id;

function bill_collection_list(){

    bill_collection_tbl = $('#bill_collection_tbl').DataTable({
        dom: 'lfrtip',
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: {
            dataType: "JSON",
            type: "get",
            url: app_url + "/shop/bill/collection/list",
            data: {year_id: year_id, month_id: month_id, market_id: market_id}
        },
        columns: [
            {
                title: "#",
                data: null,
                render: function() {
                    return bill_collection_tbl.page.info().start + bill_collection_tbl.column(0).nodes().length;
                }
            },
            {
                title: "ইনভেয়স আইডি",
                data: "invoice_id"
            },
            {
                title: "মার্কেটের নাম",
                data: "market_name"
            },
            {
                title: "দোকানের নং",
                data: "shop_no"
            },
            {
                title: "শেষ প্রদানের তারিখ",
                data: "last_payment_date"
            },
            {
                title: "টাকা",
                data: "amount"
            },
            {
                title: "মাস",
                data: null,
                render: function(data){
                    return month_list[data.month_id] + ',' + data.year_id;
                }
            },
            {
                title: "স্ট্যাটাস",
                data: null,
                render: function(data){
                    var pbtn_class = data.is_paid == 0 ? 'info' : 'success';
                    var pbtn_txt = data.is_paid == 0 ? 'Unpaid' : 'Paid';

                    return '<span class="badge badge-'+pbtn_class+'">'+pbtn_txt+'</span>';
                }
            },
            {
                title: "অ্যাকশান",
                data: null,
                render: function(data, type, row, meta) {
                    return data.is_paid == 0 ? "<button class='btn btn-sm btn-primary' onclick='invoiceMakePaid("+meta.row+")'><i class='fa fa-money'></i> Collect</button>" : '';
                }
            },
        ],
    });
}

function bill_collection_searching(){
    year_id = $("#year_id").val();
    month_id = $("#month_id").val();
    market_id = $("#market_id").val();

    $("#bill_collection_tbl").dataTable().fnSettings().ajax.data.year_id = year_id;
    $("#bill_collection_tbl").dataTable().fnSettings().ajax.data.month_id = month_id;
    $("#bill_collection_tbl").dataTable().fnSettings().ajax.data.market_id = market_id;

    bill_collection_tbl.ajax.reload();
}

function invoiceMakePaid(index){
    var row_data = bill_collection_tbl.row(index).data();

    swal({
        title: "Confirmation",
        text: "আপনি কি দোকানের ভাড়া কালেক্ট করতে চাচ্ছেন ?",
        type: "warning",
        showConfirmButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "হ্যাঁ",
        showCancelButton: true,
        cancelButtonText: "না",
        showLoaderOnConfirm: true,
        preConfirm: function() {
           $.ajax({
             url: app_url + "/shop/bill/collection/collectMoney",
             type: "POST",
             dataType: "JSON",
             data: {
               pid: row_data.id,
               _token: csrf_token
             },
            success: function(response) {

                let confrimButtonText = (response.status == "success") ? '<a href="' + app_url + '/shop/bill/generate/invoice/print/' + response.invoice_id + '" target="_blank">ইনভয়েস প্রিন্ট করুন</a>':'Ok';
                
                swal({
                    title: "ধন্যবাদ",
                    text: response.message,
                    type: response.status,
                    showCancelButton: true,
                    showConfirmButton: (response.status == "success") ? true :false,
                    confirmButtonText: confrimButtonText,
                    closeOnConfirm: true,
                    allowEscapeKey: false
                })

                bill_collection_tbl.ajax.reload();
           }
           });
        }
   });
}

// ==== END ==== //

// ==== due sms // 
function due_month_sms_send() {



    let title = $("#title").val();
    let message = $("#message").val();

    let sending_time = $("#sending_time").val();



    let error_status = false;

    if (title == "") {
        $("#title_error").html("টাইটেল লিখুন");
        error_status = true;
    } else {
        $("#title_error").html("");
    }

    if (message == "") {
        $("#message_error").html("মেসেজ লিখুন");
        error_status = true;
    } else {
        $("#message_error").html("");
    }


    if (error_status == false) {
        $.ajax({
            url: app_url + '/shop/sms/bill/duemonth/send',
            type: 'POST',
            data: {
                title:title,
                message: message,
                sending_time: sending_time,
                _token: csrf_token
            },
            success: function (response) {
                swal({
                    title: "Response",
                    text: response.message,
                    type: response.status,
                })
                if (response.status == "success") {
                    $("#title").val("");
                    $("#message").val("");
                }

            }
        })
    }
}
// ==== END ==== //
