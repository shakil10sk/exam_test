$('document').ready(function(){
        //===datepicker===//
        $('#fromDate, #toDate').datepicker({
                language: 'en',
                autoClose: true,
                dateFormat: 'yy-mm-dd',
        });

        let fromDate, toDate;
        let loc = $('meta[name=path]').attr("content");
        let token = $('meta[name=csrf-token]').attr("content");

        //===Notice list===//
        function noticeList() {

                fromDate  =	$("#fromDate").val();
                toDate    =	$("#toDate").val();         

                noticeTable =	$('#noticeTable').DataTable({
                        scrollCollapse: true,
                        autoWidth: false,
                        responsive: true,
                        serverSide: true,
                        processing: true,
                        "lengthMenu": [[10, 25, 50, -1], ["১০টি", "২৫টি", "৫০টি","সব"]],
                        "language": {
                            "info": "মোট _TOTAL_ নোটিশ -এর _START_-_END_ টি",
                            "infoFiltered":   "(দেখাও _START_ থেকে _END_ পেজ -এর _TOTAL_ টি)",
                            "infoEmpty":      "নোটিশ পাওয়া যায়নি!",
                            "zeroRecords":    "নোটিশ পাওয়া যায়নি!",
                            "emptyTable":     "নোটিশ পাওয়া যায়নি!",
                            "processing":     "প্রসেসিং...",
                            "loadingRecords": "লোডিং...",
                            "lengthMenu":     "দেখাও _MENU_ টি",
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
                        url : loc+'/management/union/all/notice',
                        data: {
                            fromDate    : fromDate,
                            toDate      : toDate,
                            _token      : token
                        },

                    },
                    columns:[
            	{
                    data: null,
                    render: function(){
                        return noticeTable.page.info().start + noticeTable.column(0).nodes().length;
                    }
                },
                { data: null,
                render : function(data){
                    if(data.title.length > 10) return data.title.substring(0,10);
                }
             },
	         { data: null,
                render : function(data){
                    if(data.title.length > 30) return data.title.substring(0,30); 
                }
             },
	            { data: "post_by" },
                { data: null,
                render: function(data){
                    if(data.update_by == null){
                        return "আপডেট করা হয় হয়নি";
                    }else{
                        return data.update_by;
                    }
                }

            },
            {data: "created_at"},
            {
                data : null,
                render: function(data){
                    let editNotice = '';
                    let deleteNotice = '';
                    if($('#edit-notice').val()){
                        editNotice = '<div class="btn-group"><a href="'+loc+'/management/union/info/edit/'+data.id+'" class="btn btn-outline-primary"><i class="icon-copy fa fa-pencil-square-o" aria-hidden="true"></i> এডিট করুন</a>';
                    }
                    if($('#delete-notice').val()){
                        deleteNotice = ' <button class="btn btn-outline-warning" onclick="warning($(this).val())" value="'+data.id+'"><i class="icon-copy fa fa-trash-o" aria-hidden="true"></i> ডিলিট</button></div><form id="delete-form_'+data.id+'" action="'+loc+'/management/union/info/delete'+'" method="POST" style="display: none;"><input type="hidden" name="id" value="'+data.id+'"><input type="hidden" name="_token" value="'+token+'"></form>';
                    }
            		return editNotice+deleteNotice;
                }
            }
            ],
    
                    dom: 'Bfrtip',
                    buttons: [
                    'copy', 'csv', 'pdf', 'print'
                    ]
                    });
        }

        noticeList(); 
    });

    //====nagorik applicant search====//
    function noticetListSearch(){


        fromDate = $("#fromDate").val();
        toDate = $("#toDate").val();

        $("#noticeTable").dataTable().fnSettings().ajax.data.fromDate = fromDate;
        $("#noticeTable").dataTable().fnSettings().ajax.data.toDate = toDate;

        noticeTable.ajax.reload();

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