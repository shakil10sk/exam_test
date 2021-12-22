$(document).ready(function() {
    let loc = $('meta[name=path]').attr("content");
    let path = $('meta[name=url]').attr("content");
    let TypeApplication  = ['nagorik', 'death', 'obibahito', 'punobibaho', 'ekoinam', 'sonaton', 'prottyon', 'nodibanga', 'character', 'vumihin', 'yearlyincome', 'protibondi', 'onumoti', 'voter', 'onapotti', 'rastakhonon', 'warish', 'family', 'trade', 'bibahito'];

//check exting data
$('#search').click(function(){
    let searchData      = $('#search-data').val();
    let unionId         = $('#union-id').val();
    let applicationType = $('#app-type').val();
    let appType         = $('#appType').val();
    
    if(searchData == '' || applicationType == '' || appType == ''){
        Swal.fire({
            icon    : 'error',
            title   : 'দুঃখিত...',
            text    : 'আপনার কোনো তথ্য পাওয়া যায়নি!',
            confirmButtonText: 'ঠিক আছে'
          });
    }else{
        $.ajax({
            type:'POST',
            url:loc+'/api/check/exiting/application',
            data:{searchData:searchData, applicationType: applicationType, unionId:unionId},
            success: function (res) {

                console.log(res);

                let info = '';
                if(res.sonodno && appType == 2){
                    info = res.message+'<b>'+res.pin+'</b> এবং সনদ নং <b>'+res.sonodno+'</b> <br/><br/><a href="'+path+'/verify/'+res.application+'_bn/'+res.sonodno+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">সনদটি বাংলায় প্রিন্ট করুন</a> <br/><br/> <a href="'+path+'/verify/'+res.application+'_en/'+res.sonodno+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">সনদটি ইংরেজিতে প্রিন্ট করুন</a>';
                    sweetAlert(res.status, info);
                }else if(res.tracking && appType == 1){
                    info    = res.message+'<b>'+res.pin+'</b> এবং ট্র্যাকিং নং <b>'+res.tracking+'</b> <br/><br/><a href="'+path+'/verify/'+res.application+'_application/'+res.tracking+'/'+res.unionid+'/'+res.type+'" type="button" class="btn btn-info" target="_blank">আবেদনটি প্রিন্ট করুন</a>';
                    status  = 'এই সনদ এর আবেদন ইতিঃপূর্বে করা হয়েছে!';
                    sweetAlert(status, info);
                }else if(res.status404){
                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত...',
                        text: res.status404,
                        confirmButtonText: 'ঠিক আছে'
                      });
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'দুঃখিত...',
                        text: 'দুঃখিত! আপনার আবেদনটি পাওয়া যায়নি।',
                        confirmButtonText: 'ঠিক আছে'
                      }); 
                }
                
            },
            error: function (e) {
                Swal.fire({
                    icon: 'error',
                    title: 'দুঃখিত...',
                    text: 'দুঃখিত! সার্ভার উপলব্ধ নয়।',
                    confirmButtonText: 'ঠিক আছে'
                  }); 
            }
        });
    }

    function sweetAlert(status, info){
        Swal.fire({
            title   : '<strong>'+status+'</strong>',
            icon    : 'success',
            html    : info,
            showConfirmButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
              '<i class="fa fa-print-up"></i> ঠিক আছে!',
            confirmButtonAriaLabel: 'ঠিক আছে!'
          }).then(function () {
            location.reload(true);
        });
    }
    
});
});

