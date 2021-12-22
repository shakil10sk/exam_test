// filter from and to date modify
function onFiscalChange(){
    var fiscal_year = $("#fiscal_year_id").find(':selected').text();

    var fiscal_year_split = fiscal_year.split('-');

    var from_date_raw = fiscal_year_split[0] + '-07-01';
    var to_date_raw = fiscal_year_split[1] + '-06-30';

    var from_date = new Date(from_date_raw);
    var to_date = new Date(to_date_raw);

    $("#filter_from_date").datepicker("option", "minDate", from_date);
    $("#filter_from_date").datepicker("option", "maxDate", to_date);
    $("#filter_from_date").datepicker("option", "defaultDate", from_date);

    $("#filter_to_date").datepicker("option", "minDate", from_date);
    $("#filter_to_date").datepicker("option", "maxDate", to_date);
    $("#filter_to_date").datepicker("option", "defaultDate", from_date);

    $("#filter_from_date").val(from_date_raw);
    $("#filter_to_date").val(from_date_raw);

}