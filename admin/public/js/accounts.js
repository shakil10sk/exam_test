//for url
var url  = $('meta[name = path]').attr("content");
var csrf    = $('mata[name = csrf-token]').attr("content");


//for date picker
$('#from_date, #to_date').datepicker({
    language: 'en',
    autoClose: true,
    dateFormat: 'yy-mm-dd',
});


//register show

function register_show(){

    var type = $("#type").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    var error_status = false;

    if(type == '') {
        $("#type_error").html("ধরন সিলেক্ট করুন");
        error_status = true;

    }else{

        $("#type_error").html("");
    }


    if(to_date == '') {

        $("#to_date_error").html("তারিখ প্রদান করুন");
        error_status = true;

    }else{

        $("#to_date_error").html("");
    }

    if(from_date == '') {

        $("#from_date_error").html("তারিখ প্রদান করুন");
        error_status = true;

    }else{

        $("#from_date_error").html("");
    }

    if (error_status == true) {

        return false;

    }else{

        if(type == 1){

            window.open(url + "/nagorik/register/" + from_date + "/" + to_date);

        }else if(type == 2){

             window.open(url + "/death/register/" + from_date + "/" + to_date);

        }else if(type == 3){

             window.open(url + "/obibahito/register/" + from_date + "/" + to_date);

        }else if(type == 4){

             window.open(url + "/punobibaho/register/" + from_date + "/" + to_date);

        }else if(type == 5){

             window.open(url + "/ekoinam/register/" + from_date + "/" + to_date);

        }else if(type == 6){

             window.open(url + "/sonaton/register/" + from_date + "/" + to_date);

        }else if(type == 7){

             window.open(url + "/prottyon/register/" + from_date + "/" + to_date);

        }else if(type == 8){

             window.open(url + "/nodibanga/register/" + from_date + "/" + to_date);

        }else if(type == 9){

             window.open(url + "/character/register/" + from_date + "/" + to_date);

        }else if(type == 10){

             window.open(url + "/vumihin/register/" + from_date + "/" + to_date);

        }else if(type == 11){

             window.open(url + "/yearlyincome/register/" + from_date + "/" + to_date);

        }else if(type == 12){

             window.open(url + "/protibondi/register/" + from_date + "/" + to_date);

        }else if(type == 13){

             window.open(url + "/onumoti/register/" + from_date + "/" + to_date);

        }else if(type == 14){

             window.open(url + "/voter/register/" + from_date + "/" + to_date);

        }else if(type == 15){

             window.open(url + "/onapotti/register/" + from_date + "/" + to_date);

        }else if(type == 16){

             window.open(url + "/roadcutting/register/" + from_date + "/" + to_date);

        }else if(type == 17){

             window.open(url + "/warish/register/" + from_date + "/" + to_date);

        }else if(type == 18){

             window.open(url + "/family/register/" + from_date + "/" + to_date);

        }else if(type == 19){

             window.open(url + "/trade/register/" + from_date + "/" + to_date);

        }else if(type == 20){

             window.open(url + "/bibahito/register/" + from_date + "/" + to_date);

        }else if(type == 21){

             window.open(url + "/trade/peshakor_register/" + from_date + "/" + to_date);

        }else if(type == 22){

             window.open(url + "/accounts/home_tax_register/" + from_date + "/" + to_date);

        }
    }


}

//daily report show
function daily_report_show(){

    var type = $("#type").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();

    var error_status = false;

    if(type == '') {

        $("#type_error").html("ধরন সিলেক্ট করুন");
        error_status = true;

    }else{

        $("#type_error").html("");
    }


    if(to_date == '') {

        $("#to_date_error").html("তারিখ প্রদান করুন");
        error_status = true;

    }else{

        $("#to_date_error").html("");
    }

    if(from_date == '') {

        $("#from_date_error").html("তারিখ প্রদান করুন");
        error_status = true;

    }else{

        $("#from_date_error").html("");
    }

    if (error_status == true) {

        return false;

    }else{

        if(type == 1){

            window.open(url + "/trade/daily_trade_pesha_report/" + from_date + "/" + to_date);

        }else if(type == 2){

             window.open(url + "/trade/daily_vat_report/" + from_date + "/" + to_date);

        }else if(type == 3){

             window.open(url + "/accounts/daily_all_collection/" + from_date + "/" + to_date);

        }else if(type == 4){

             window.open(url + "/accounts/home_tax_collection_report/" + from_date + "/" + to_date);

        }


    }


}



 
