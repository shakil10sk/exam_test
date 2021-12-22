
$('#other_application').change(function () {
    var form_value = $('#other_application').val();
    var loc = window.location.toString();

    showOtherApplication(form_value, loc);
});

//===all other application show===//
function showOtherApplication(form_value, loc) {

    if (form_value == 2){ //character application
          
        loc = loc.replace(/other.*/,"");

        $('#applications').load( loc +'character');

    }else if(form_value == 3){ //bibahito application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/bibahito');

    }else if(form_value == 4){ //Vumihin application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/vumihin');

    }
    else if(form_value == 5){ //Protibondi application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/protibondi');

    }   else if(form_value == 6){ //onumoti application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/onumoti');

    }   else if(form_value == 7){ //sonatondhormo application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/sonaton');

    }   else if(form_value == 8){ //obibahito application

        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/obibahito');

    }   else if(form_value == 9){ //death application

        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/death');

    }   else if(form_value == 10){ //punobibaho application
        loc = loc.replace(/other.*/,"");

        $('#applications').load( loc +'/punobibaho');

    }   else if(form_value == 11){ //voter id application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/voter');

    }   else if(form_value == 12){ //ekoinamer application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/ekoinam');

    }   else if(form_value == 13){ //yearly application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/yearlyincome');

    }   else if(form_value == 14){ //Prottyon application
        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/prottyon');
    }else if(form_value == 15){ //Nodibanga application

        loc = loc.replace(/other.*/,"");
        $('#applications').load( loc +'/nodibanga');
    } else{
        $('#applications').html('<h1 class="text-center">No Form</h1>');
    }

}
