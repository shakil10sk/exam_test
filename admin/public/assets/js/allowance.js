$('document').ready(function(){
    let fromDate, toDate;
    let loc         = $('meta[name=path]').attr("content");
    let asset_url   = loc + '/public/assets';
    let type        = $('#allowance').val();
    let token       = $('meta[name=csrf-token]').attr("content");

    //===Notice list===//
    function allowanceList(type) {

            fromDate  =	$("#fromDate").val();
            toDate    =	$("#toDate").val();         

            allowanceTable =	$('#allowanceTable').DataTable({
                    scrollCollapse: true,
                    autoWidth: false,
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    "lengthMenu": [[10, 25, 50, -1], ["১০জন", "২৫জন", "৫০জন","সব"]],
                    "language": {
                        "info": "মোট _TOTAL_ ভাতার তালিকা -এর _START_-_END_ টি",
                        "infoFiltered":   "(দেখাও _START_ থেকে _END_ পেজ -এর _TOTAL_ জন)",
                        "infoEmpty":      "কোনো তথ্য পাওয়া যায়নি!",
                        "zeroRecords":    "কোনো তথ্য পাওয়া যায়নি!",
                        "emptyTable":     "কোনো তথ্য পাওয়া যায়নি!",
                        "processing":     "প্রসেসিং...",
                        "loadingRecords": "লোডিং...",
                        "lengthMenu":     "দেখাও _MENU_ জন",
                        searchPlaceholder: "সার্চ করুন",
                        "paginate": {
                            "previous": "প্রিভিউস",
                            "next":     "পরবর্তী",
                            "first":    "প্রথম",
                            "last":     "শেষ",
                        },
                    },
                    ajax: {
                    dataType: "JSON",
                    type: "post",
                    url : loc+'/management/allowance/get',
                    data: {
                        fromDate    : fromDate,
                        toDate      : toDate,
                        type        : type,
                        _token      : token
                    },

                },
                columns:[
            {
                data: null,
                render: function(){
                    return allowanceTable.page.info().start + allowanceTable.column(0).nodes().length;
                }
            },
            { data: null,
            render : function(data){
                if(data.photo)
                {
                    return "<img width='50' src='"+asset_url+'/images/allowance/'+data.photo+"' class='img-circle img-responsive' />";
                }
                else
                {
                    return "<img width='50' src='"+asset_url+'/images/allowance/defult_user.jpg'+"' class='img-circle img-responsive' />";
                }
            }
         },
         { data: "name"},
         { data: "nid"},
         { data: "father_name"},
        { data: "mobile" },
        { data: "ward_no" },
        { data: "amount_of_allowance" },
        {
            data : null,
            render: function(data){
                let editVata = '';
                let deleteVata = '';
                let deleteForm = '';
                let vataPayment= '';
                let vataProfile= '';
                if($('#edit-vata').val()){
                    editVata = '<a href="'+loc+'/management/allowance/edit/'+data.id+'" class="btn btn-outline-primary"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i> এডিট করুন</a>';
                }
                if($('#vata-payment').val()){
                    vataPayment = '<button type="button" class="btn btn-outline-info" onclick="vataPaymentForm('+data.id+')" ><i class="icon-copy fa fa-money" aria-hidden="true"></i> ভাতা প্রদান</button>';
                }
                if($('#vata-profile').val()){
                    vataProfile = '<a href="'+loc+'/management/allowance/profile/'+data.type+'/'+data.id+'" class="btn btn-outline-info"><i class="icon-copy fa fa-vcard-o" aria-hidden="true"></i> প্রোফাইল</a>';
                }
                if($('#delete-vata').val()){
                    deleteVata = '<button type="button" class="btn btn-outline-warning" onclick="warning($(this).val())" value="'+data.id+'"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i> ডিলিট</button>';
                    deleteForm = '<form id="delete-form_'+data.id+'" action="'+loc+'/management/allowance/delete'+'" method="POST" style="display: none;"><input type="hidden" name="id" value="'+data.id+'"><input type="hidden" name="_token" value="'+token+'"></form>';
                }
                return '<div class="btn-group">'+editVata+vataPayment+vataProfile+deleteVata+'</div>'+deleteForm;
            }
        }
        ],

                dom: 'Bfrtip',
                buttons: [
                'copy', 'csv', 'pdf', 'print'
                ]
                });
    }
    allowanceList(type); 
});

//===datepicker===//
$('#fromDate, #toDate, #allowance_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});

let loc     = $('meta[name=path]').attr("content");

//====nagorik applicant search====//
function allowanceListSearch(){


    fromDate = $("#fromDate").val();
    toDate = $("#toDate").val();

    $("#allowanceTable").dataTable().fnSettings().ajax.data.fromDate = fromDate;
    $("#allowanceTable").dataTable().fnSettings().ajax.data.toDate = toDate;

    allowanceTable.ajax.reload();

    }

function vataPaymentForm(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'POST',
        url:loc+'/management/allowance/get/info',
        beforeSend: function() { $(".pre-loader").fadeToggle("medium"); },
        complete: function() { $('.pre-loader').fadeOut(); },
        data:{id : id},
        success: function (data) {
            if(data.type == 1){
                $('#heading').text(' মুক্তিযোদ্ধা ভাতা প্রদান')
            }
            else if(data.type == 2){
                $('#heading').text(' দুস্থ ও দরিদ্র ভাতা প্রদান')
            }
            else if(data.type == 3){
                $('#heading').text(' বয়স্ক ভাতা প্রদান')
            }
            else if(data.type == 4){
                $('#heading').text(' মাতৃত্যকালিন ভাতা প্রদান')
            }
            else if(data.type == 5){
                $('#heading').text(' বিধবা ভাতা প্রদান')
            }
            else if(data.type == 6){
                $('#heading').text(' প্রতিবন্ধী ভাতা প্রদান')
            }
            else if(data.type == 7){
                $('#heading').text(' ভি জি ডি ভাতা প্রদান')
            }

            $('#name').val(data.name);
            $('#allowance_id').val(data.allowance_id);
            $('#allowance_id').val(data.allowance_id);
            $('#type').val(data.type);
            $('#vata-payment-form').modal();
        }
    });
}
    
//This is for SweetAlert
function warning(id) {
    swal({
        title: 'ডিলিট!',
        text: "আপনি কি ডিলিট করতে চান?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        confirmButtonText: 'হ্যাঁ, ডিলিট!',
        cancelButtonText: 'বাতিল'
    }).then(function (result) {
        if (result.value){
            swal(
                'মোছা হয়েছে!',
                'আপনার ফাইলটি মুছে ফেলা হয়েছে।',
                'success'
            ).then(function () {
                $('#delete-form_'+id).submit();
            });
        }
    })
}