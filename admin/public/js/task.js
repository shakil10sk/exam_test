$(document).ready(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);

    $('.sa-warning').click(function () {
        var id = $(this).val();
        swal({
            title: 'আপনি কি কাজটি সম্পন্ন করেছেন?',
            text: "আপনার কাজটি পরবর্তীতে সংরক্ষণ করা হবে!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
        }).then(function (result) {
            if (result.value){
                swal({
                    title: 'ধন্যবাদ!',
                    text: 'কাজটি সরিয়ে ফেলা হয়েছে!',
                    type: 'success',
                    confirmButtonText: 'ওকে'
                }).then(function () {
                    $('#task-'+id).prop("checked", true);
                });
            }else{
                $('#task-'+id).prop("checked", false);
            }
        })
    });
})();
