$('document').ready(function(){
    let loc = $('meta[name=path]').attr("content");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.changeBtn').click(function () {
        let des = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:loc+'/management/get/employee/name',
            data: {'des': des},
            success: function (data) {
                $("#drag-zone").html(data);
            }
        });
    });
    //This is for drag & drop
    $( ".drag-zone ul" ).sortable(
        {
            stop: function( event, ul ) {
                let idList = [];
                $(".drag-zone ul").children("li").each(function(){
                    idList.push($(this).val());
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type:'POST',
                    url:loc+'/management/change/sequence',
                    data: {'seq': idList},
                    success: function (data) {
                        if(data.success){
                            $('#reBtn').css('display', 'block')
                        }
                    }
                });
            }
        }
    );
    $( ".drag-zone ul" ).disableSelection();

    //This is for datatable
    $('.data-table').DataTable({
        scrollCollapse: true,
        autoWidth: false,
        responsive: true,
        columnDefs: [{
            targets: "datatable-nosort",
            orderable: false,
        }],
        "lengthMenu": [[10, 25, 50, -1], ["১০", "২৫", "৫০","সকল"]],
        "language": {
            "info": "মোট _TOTAL_ জন -এর _START_-_END_ জন",
            "infoFiltered":   "(দেখাও _START_ থেকে _END_ পেজ -এর _TOTAL_ জন)",
            "infoEmpty":      "কর্মকর্তা-কর্মচারীদের তথ্য পাওয়া যায়নি!",
            "zeroRecords":    "কর্মকর্তা-কর্মচারীদের তথ্য পাওয়া যায়নি!",
            "emptyTable":     "কর্মকর্তা-কর্মচারীদের তথ্য পাওয়া যায়নি!",
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
    });
    var table = $('.select-row').DataTable();
    $('.select-row tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    var multipletable = $('.multiple-select-row').DataTable();
    $('.multiple-select-row tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
});

//This is for SweetAlert
function warning(id) {
    let authId = $('#authId_'+id).val();
    if(authId == id){
        swal({
            title: 'দুঃখিত!',
            text: 'আপনি আপনার আইডি ডিলিট করতে পারবেন না!',
            type: 'error',
            confirmButtonText: 'আচ্ছা ঠিক আছে'
        });
    }else {
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
}
