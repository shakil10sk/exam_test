<?php

use App\Models\Geocode\BdLocation;
use App\Models\Management\Union\UnionInformation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/migrate/{type}/{invoice_type}','MigrateController@migrate_data');


Route::get('/convert',function (){

    (new  \App\Http\Controllers\Management\Union\UnionSetupController())->businessTypesConvertEnglish();
});

Route::get('/home', function () {
    return redirect()->route('home');
});

//this is for home page
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//this is for support page
Route::get('/support', 'HomeController@support')->name('support');

Route::group(['prefix' => '/location'], function () {

    Route::get('/all-district', function () {
        return BdLocation::where('type', 2)->get();
    })->name('location.district');

    Route::get('/get-upazila/{district?}', function ($district) {
        return BdLocation::where('parent_id', $district)->get();
    })->name('location.upazila');

    Route::get('/get-union/{district?}/{upazila?}', function ($district, $upazila) {
        return UnionInformation::where([
            'district_id' => $district,
            'upazila_id' => $upazila,
        ])->get();
    })->name('location.union');
});


// 'role:super-admin',
Route::group(['prefix' => '/super_admin', 'middleware' => ['auth']], function () {

    Route::get('/union_add', 'SuperAdminController@union_add')->name('union_add')->middleware(['admin']);

    Route::post('/union_store', 'SuperAdminController@union_store')->name('union_store')->middleware(['admin']);

    Route::get('/union_edit/{id}', 'SuperAdminController@union_edit')->name('union_edit');

    Route::get('/union-delete/{id?}', 'SuperAdminController@union_delete')->name('union.delete')->middleware(['admin']);

    Route::get('/status-change/{id?}', 'SuperAdminController@status_change')->name('union.status-change');

    Route::post('/union_updates', 'SuperAdminController@union_updates')->name('union_updates');

    Route::get('/union_list', 'SuperAdminController@union_list')->name('union_list')->middleware(['admin']);

    Route::post('/union_list_data', 'SuperAdminController@union_list_data')->name('union_list_data');

    Route::post('/bd_location_save', 'SuperAdminController@bd_location_save')->name('bd_location_save');

    Route::post('/bd_location_update_save', 'SuperAdminController@bd_location_update_save')->name('bd_location_update_save');

    Route::post('/bd_location_delete', 'SuperAdminController@bd_location_delete')->name('bd_location_delete');

    Route::get('/bd_location_list', 'SuperAdminController@bd_location_list')->name('bd_location_list');

    Route::post('/bd_location_list_data', 'SuperAdminController@bd_location_list_data')->name('bd_location_list_data');

    //this is for support
    Route::get('/trade_support', 'SuperAdminController@trade_support')->name('trade_support');
    Route::post('/get_trade_fee_info', 'SuperAdminController@get_trade_fee_info')->name('get_trade_fee_info');
    Route::post('/trade_fee_update_save', 'SuperAdminController@trade_fee_update_save')->name('trade_fee_update_save');
    Route::post('/trade_fee_delete', 'SuperAdminController@trade_fee_delete')->name('trade_fee_delete');

    Route::get('/other_support', 'SuperAdminController@other_support')->name('other_support');
    Route::post('/get_fee_info', 'SuperAdminController@get_fee_info')->name('get_fee_info');
    Route::post('/fee_update', 'SuperAdminController@fee_update')->name('fee_update');
    Route::post('/fee_delete', 'SuperAdminController@fee_delete')->name('fee_delete');

    //for fiscal years
    Route::get('/fiscal_year_list', 'SuperAdminController@fiscal_year_list')->name('fiscal_year_list');
    Route::post('/fiscal_year_save', 'SuperAdminController@fiscal_year_save')->name('fiscal_year_save');
    // Route::post('/fiscal_year_delete', 'SuperAdminController@fiscal_year_delete')->name('fiscal_year_delete');

    // designation
    Route::get('/designation', 'SuperAdminController@designation')->name('designation');
    Route::post('/designation_store', 'SuperAdminController@designationStore')->name('designation.store');
    Route::post('/designation_update', 'SuperAdminController@designationUpdate')->name('designation.update');
    Route::get('/designation_delete/{row_id}', 'SuperAdminController@designationDelete');

});

Route::get('/geo/searchLocation', 'GeoCodeController@searchLocation');

// Bangladesh GeoCode route group
Route::group(['prefix' => '/geo/code', 'middleware' => 'api'], function () {

    Route::get('/', 'GeoCodeController@getDistrict');

    Route::post('/get', 'GeoCodeController@getLocation');
});

// Route::get("/")
Route::group(['prefix' => 'global', 'middleware' => 'auth'], function () {

    Route::post('/account_list', 'GlobalController@account_list')->name('account_list');

    Route::post('/get_location', 'GlobalController@get_location')->name('get_location');

    Route::post('/all_union_list', 'GlobalController@all_union_list')->name('all_union_list');
});

//===this route start for nagorik ========//
Route::group(['prefix' => 'nagorik', 'middleware' => ['auth', 'web']], function () {
    Route::get('/create', 'Applications\NagorikController@create')->name('nagorik_application');

    Route::post('/store', 'Applications\NagorikController@store')->name('nagorik_store');

    Route::get('/preview/{tracking}', 'Applications\NagorikController@preview')->name('nagorik_preview');

    Route::get('/applicant_list', 'Applications\NagorikController@applicant_list')->name('nagorik_applicant_list')->middleware('permission:application');

    Route::get('/list', 'Applications\NagorikController@nagorik_list')->name('nagorik_list');

    Route::post('/applicant_data', 'Applications\NagorikController@applicant_data')->name('applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\NagorikController@edit')->name('nagorik_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\NagorikController@update')->name('nagorik_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\NagorikController@sonod_generate')->name('sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\NagorikController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\NagorikController@sonod_print_bn')->name('sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\NagorikController@sonod_print_en')->name('sonod_print_en');

    Route::post('/delete', 'Applications\NagorikController@delete')->name('nagorik_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\NagorikController@certificate_list')->name('certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\NagorikController@certificate_list_data')->name('certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\NagorikController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\NagorikController@register')->name('register');

    Route::get('/register/list','Applications\NagorikController@register_show')->name('nagorik_register_show');

});

//====this route start for trade license====//
Route::group(['prefix' => 'trade', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\TradelicenseController@create')->name('trade_application');

    Route::post('/store', 'Applications\TradelicenseController@store')->name('tradelicense_store');

    Route::get('/preview/{fiscal_year_id}/{tracking}', 'Applications\TradelicenseController@preview')->name('trade_preview');

    Route::get('/applicant_list', 'Applications\TradelicenseController@applicant_list')->name('trade_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\TradelicenseController@applicant_data')->name('applicant_data')->middleware('permission:application');

    Route::get('/edit/{fiscal_year_id}/{tracking}', 'Applications\TradelicenseController@edit')->name('trade_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\TradelicenseController@update')->name('trade_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\TradelicenseController@sonod_generate')->name('sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\TradelicenseController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\TradelicenseController@sonod_print_bn')->name('sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\TradelicenseController@sonod_print_en')->name('sonod_print_en');

    Route::get('/previous_print_bn/{sonod_no}/{fiscal_year_id}', 'Applications\TradelicenseController@previous_sonod_print_bn')->name('previous_sonod_print_bn');

    Route::get('/previous_print_en/{sonod_no}/{fiscal_year_id}', 'Applications\TradelicenseController@previous_sonod_print_en')->name('previous_sonod_print_en');

    Route::post('/delete', 'Applications\TradelicenseController@delete')->name('trade_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\TradelicenseController@certificate_list')->name('trade_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\TradelicenseController@certificate_list_data')->name('certificate_list_data')->middleware('permission:certificate');

    Route::get('/previous_certificate_list', 'Applications\TradelicenseController@previous_certificate_list')->name('previous_certificate_list')->middleware('permission:certificate');

    Route::post('/previous_certificate_list_data', 'Applications\TradelicenseController@previous_certificate_list_data')->name('previous_certificate_list_data')->middleware('permission:certificate');

    Route::get('/expire_certificate_list', 'Applications\TradelicenseController@expire_certificate_list')->name('expire_certificate_list')->middleware('permission:certificate');

    Route::get('/money_receipt/{tracking}', 'Applications\TradelicenseController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\TradelicenseController@register')->name('register')->middleware('permission:registers');

    Route::get('/register_print', 'Applications\TradelicenseController@register_print');

    Route::get('/dabi_aday_print', 'Applications\TradelicenseController@dabi_aday_print');

    Route::get('/tax_register/{from_date}/{to_date}', 'Applications\TradelicenseController@tax_register')->name('tax_register');

    Route::get('/daily_trade_pesha_report/{from_date}/{to_date}', 'Applications\TradelicenseController@daily_trade_pesha_report')->name('daily_trade_pesha_report')->middleware('permission:everyday-reports');

    Route::get('/daily_vat_report/{from_date}/{to_date}', 'Applications\TradelicenseController@daily_vat_report')->name('daily_vat_report')->middleware('permission:everyday-reports');

    Route::get('/collect_pesha_kor', 'Applications\TradelicenseController@collect_pesha_kor')->name('collect_pesha_kor')->middleware('permission:income-tax');

    Route::post('/pesha_kor_list', 'Applications\TradelicenseController@pesha_kor_list')->name('pesha_kor_list')->middleware('permission:income-tax');

    Route::get('/peshakor_money_receipt/{sonod_no}', 'Applications\TradelicenseController@peshakor_money_receipt')->name('peshakor_money_receipt')->middleware('permission:income-tax-invoice');

    Route::post('/get_pesha_kor_data', 'Applications\TradelicenseController@get_pesha_kor_data')->name('get_pesha_kor_data')->middleware('permission:income-tax');

    Route::post('/pesha_kor_save', 'Applications\TradelicenseController@pesha_kor_save')->name('pesha_kor_save')->middleware('permission:add-income-tax');

	Route::get('/peshakor_register/{from_date}/{to_date}', 'Applications\TradelicenseController@peshakor_register')->name('peshakor_register')->middleware('permission:registers');

    // bill list
    Route::get("/bill/list", "Applications\TradelicenseController@bill_list")->name("trade_bill_list");

    // bill collection
	Route::get("/bill/collection", "Applications\TradelicenseController@bill_collection")->name("trade_bill_collection");

    Route::get("/bill/invoice_data", "Applications\TradelicenseController@invoice_data");

    Route::post("/bill/collection/save", "Applications\TradelicenseController@bill_collection_save");

    // due bill entry
	Route::get("/due/bill", "Applications\TradelicenseController@due_bill")->name("trade_due_bill");

    Route::get("/due/bill/sonod_data", "Applications\TradelicenseController@sonod_data");

    Route::post("/due/bill/save", "Applications\TradelicenseController@due_bill_save");

    // trade settings
    Route::get("/settings/{type?}", "Applications\TradelicenseController@settings")->name("trade.settings");
    Route::post("/settings/action", "Applications\TradelicenseController@settings_save")->name("trade.settings.save");
    Route::get("/settings/getConfig/{fiscal_year_id}", "Applications\TradelicenseController@getConfig");

    // trade business fee setting //
    Route::get("/settings/business/fees", "Applications\TradelicenseController@businessFeeSettings")->name("business.fee.settings");

    Route::post("/settings/business/fees/save", "Applications\TradelicenseController@businessFeeSettingsSave");

    Route::get("/settings/business/GetFees/{fiscal_year_id}", "Applications\TradelicenseController@getBusinessFees");
    // trade business fee setting //

    // report //
    Route::group(['prefix' => 'report','middleware' => 'auth' ],function (){
        Route::get("/register", "Applications\TradelicenseController@register_dialogue")->name("trade_register");

        Route::get("/dabi_aday", "Applications\TradelicenseController@dabi_aday_register_dialogue")->name("trade_dabi_aday_register");

        Route::get("/fiscal_year_wise", "Applications\TradelicenseController@fiscalYearWiseReport")->name("fiscal_year_wise_report");

        Route::get("/business_wise", "Applications\TradelicenseController@businessTypeWiseReport")->name("business_type_wise_report");

        Route::get("/road_wise", "Applications\TradelicenseController@roadWiseReport")->name("road_wise_report");

        Route::get("/fee_wise", "Applications\TradelicenseController@feeWiseReport")->name("fee_wise_report");

        Route::get("/new_license", "Applications\TradelicenseController@newLicenseReport")->name("new_license_report");

        Route::get("/renew_license", "Applications\TradelicenseController@renewLicenseReport")->name("renew_license_report");

        Route::get("/due_license", "Applications\TradelicenseController@dueLicenseReport")->name("due_license_report");

        Route::get("/certificate_report_print", "Applications\TradelicenseController@certificateReportPrint")->name
        ("certificate_report_print");
    });


    Route::get("/fee_settings", "Applications\TradelicenseController@fee_settings");
    Route::get("/get_unpaid_list", "Applications\TradelicenseController@getUnPaidSonodList");

    // number converting testing
    Route::get("/number_convert", "Applications\TradelicenseController@number_convert");

    Route::get("/migrate_invoice_date", "Applications\TradelicenseController@migrate_invoice_date");

});


//====this route start for warish certificate====//
Route::group(['prefix' => 'warish', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\WarishController@index')->name('warish_application');

    Route::get('/create', 'Applications\WarishController@create')->name('warish_application');

    Route::post('/store', 'Applications\WarishController@store')->name('warish_store');

    Route::get('/preview/{tracking}', 'Applications\WarishController@preview')->name('warish_preview');

    Route::get('/applicant_list', 'Applications\WarishController@applicant_list')->name('warish_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\WarishController@applicant_data')->name('warish_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}/{sonod_no?}', 'Applications\WarishController@edit')->name('warish_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\WarishController@update')->name('warish_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\WarishController@sonod_generate')->name('warish_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\WarishController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\WarishController@sonod_print_bn')->name('warish_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\WarishController@sonod_print_en')->name('warish_sonod_print_en');

    Route::post('/delete', 'Applications\WarishController@delete')->name('warish_delete')->middleware('permission:delete');

    Route::post('/delete-member/', 'Applications\WarishController@memberRemoveAjax')->name('warish.delete.member')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\WarishController@certificate_list')->name('warish_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\WarishController@certificate_list_data')->name('warish_certificate_list_data')->middleware('permission:certificate');

    // expire warish certificate
    Route::get('/expire_certificate_list', 'Applications\WarishController@expire_certificate_list')->name('warish_expire_certificate_list');

    Route::post('/expire_certificate_list_data', 'Applications\WarishController@expire_certificate_list_data')->name('warish_expire_certificate_list_data');
    // end

    Route::get('/money_receipt/{sonod_no}', 'Applications\WarishController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\WarishController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\WarishController@register_show')->name('warish_register_show');

});

//====this route start for family certificate====//
Route::group(['prefix' => 'family', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\FamilyController@index')->name('family_application');

    Route::get('/create', 'Applications\FamilyController@create')->name('family_application');

    Route::post('/store', 'Applications\FamilyController@store')->name('family_store');

    Route::get('/preview/{tracking}', 'Applications\FamilyController@preview')->name('family_preview');

    Route::get('/applicant_list', 'Applications\FamilyController@applicant_list')->name('family_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\FamilyController@applicant_data')->name('family_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}/{sonod_no?}', 'Applications\FamilyController@edit')->name('family_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\FamilyController@update')->name('family_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\FamilyController@sonod_generate')->name('family_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\FamilyController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\FamilyController@sonod_print_bn')->name('family_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\FamilyController@sonod_print_en')->name('family_sonod_print_en');

    Route::post('/delete-member/', 'Applications\FamilyController@memberRemoveAjax')->name('family.delete.member')->middleware('permission:delete');

    Route::post('/delete', 'Applications\FamilyController@delete')->name('family_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\FamilyController@certificate_list')->name('family_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\FamilyController@certificate_list_data')->name('family_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\FamilyController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\FamilyController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\FamilyController@register_show')->name('family_register_show');
});

//====this route start for character certificate====//
Route::group(['prefix' => 'character', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\CharacterController@index')->name('character_application');

    Route::get('/create', 'Applications\CharacterController@create')->name('character_application');

    Route::post('/store', 'Applications\CharacterController@store')->name('character_store');

    Route::get('/preview/{tracking}', 'Applications\CharacterController@preview')->name('character_preview');

    Route::get('/applicant_list', 'Applications\CharacterController@applicant_list')->name('character_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\CharacterController@applicant_data')->name('character_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\CharacterController@edit')->name('character_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\CharacterController@update')->name('character_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\CharacterController@sonod_generate')->name('character_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\CharacterController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\CharacterController@sonod_print_bn')->name('character_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\CharacterController@sonod_print_en')->name('character_sonod_print_en');

    Route::post('/delete', 'Applications\CharacterController@delete')->name('character_delete')->middleware('permission:delete');


    Route::get('/certificate_list', 'Applications\CharacterController@certificate_list')->name('character_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\CharacterController@certificate_list_data')->name('character_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\CharacterController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\CharacterController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\CharacterController@register_show')->name('character_register_show');
});


//====this route start for bibahito certificate====//
Route::group(['prefix' => 'bibahito', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\BibahitoController@index')->name('bibahito_application');

    Route::get('/create', 'Applications\BibahitoController@create')->name('bibahito_application');

    Route::post('/store', 'Applications\BibahitoController@store')->name('bibahito_store');

    Route::get('/preview/{tracking}', 'Applications\BibahitoController@preview')->name('bibahito_preview');

    Route::get('/applicant_list', 'Applications\BibahitoController@applicant_list')->name('bibahito_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\BibahitoController@applicant_data')->name('bibahito_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\BibahitoController@edit')->name('bibahito_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\BibahitoController@update')->name('bibahito_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\BibahitoController@sonod_generate')->name('bibahito_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\BibahitoController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\BibahitoController@sonod_print_bn')->name('bibahito_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\BibahitoController@sonod_print_en')->name('bibahito_sonod_print_en');

    Route::post('/delete', 'Applications\BibahitoController@delete')->name('bibahito_delete')->middleware('permission:delete');


    Route::get('/certificate_list', 'Applications\BibahitoController@certificate_list')->name('bibahito_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\BibahitoController@certificate_list_data')->name('bibahito_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\BibahitoController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\BibahitoController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\BibahitoController@register_show')->name('bibahito_register_show');

});


//====this route start for vumihin certificate====//
Route::group(['prefix' => 'vumihin', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\VumihinController@index')->name('vumihin_application');

    Route::get('/create', 'Applications\VumihinController@create')->name('vumihin_application');

    Route::post('/store', 'Applications\VumihinController@store')->name('vumihin_store');

    Route::get('/preview/{tracking}', 'Applications\VumihinController@preview')->name('vumihin_preview');

    Route::get('/applicant_list', 'Applications\VumihinController@applicant_list')->name('vumihin_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\VumihinController@applicant_data')->name('vumihin_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\VumihinController@edit')->name('vumihin_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\VumihinController@update')->name('vumihin_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\VumihinController@sonod_generate')->name('vumihin_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\VumihinController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\VumihinController@sonod_print_bn')->name('vumihin_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\VumihinController@sonod_print_en')->name('vumihin_sonod_print_en');

    Route::post('/delete', 'Applications\VumihinController@delete')->name('vumihin_delete')->middleware('permission:delete');


    Route::get('/certificate_list', 'Applications\VumihinController@certificate_list')->name('vumihin_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\VumihinController@certificate_list_data')->name('vumihin_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\VumihinController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\VumihinController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\VumihinController@register_show')->name('vumihin_register_show');


});

//====this route start for Otistic certificate====//
Route::group(['prefix' => 'protibondi', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\ProtibondiController@index')->name('protibondi_application');

    Route::get('/create', 'Applications\ProtibondiController@create')->name('protibondi_application');

    Route::post('/store', 'Applications\ProtibondiController@store')->name('protibondi_store');

    Route::get('/preview/{tracking}', 'Applications\ProtibondiController@preview')->name('protibondi_preview');

    Route::get('/applicant_list', 'Applications\ProtibondiController@applicant_list')->name('protibondi_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\ProtibondiController@applicant_data')->name('protibondi_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\ProtibondiController@edit')->name('protibondi_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\ProtibondiController@update')->name('protibondi_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\ProtibondiController@sonod_generate')->name('protibondi_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\ProtibondiController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\ProtibondiController@sonod_print_bn')->name('protibondi_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\ProtibondiController@sonod_print_en')->name('protibondi_sonod_print_en');

    Route::post('/delete', 'Applications\ProtibondiController@delete')->name('protibondi_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\ProtibondiController@certificate_list')->name('protibondi_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\ProtibondiController@certificate_list_data')->name('protibondi_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\ProtibondiController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\ProtibondiController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\ProtibondiController@register_show')->name('protibondi_register_show');

});

//====this route start for Onumoti certificate====//
Route::group(['prefix' => 'onumoti', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\OnumotiController@index')->name('onumoti_application');

    Route::get('/create', 'Applications\OnumotiController@create')->name('onumoti_application');

    Route::post('/store', 'Applications\OnumotiController@store')->name('onumoti_store');

    Route::get('/preview/{tracking}', 'Applications\OnumotiController@preview')->name('onumoti_preview');

    Route::get('/applicant_list', 'Applications\OnumotiController@applicant_list')->name('onumoti_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\OnumotiController@applicant_data')->name('onumoti_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\OnumotiController@edit')->name('onumoti_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\OnumotiController@update')->name('onumoti_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\OnumotiController@sonod_generate')->name('onumoti_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\OnumotiController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\OnumotiController@sonod_print_bn')->name('onumoti_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\OnumotiController@sonod_print_en')->name('onumoti_sonod_print_en');

    Route::post('/delete', 'Applications\OnumotiController@delete')->name('onumoti_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\OnumotiController@certificate_list')->name('onumoti_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\OnumotiController@certificate_list_data')->name('onumoti_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\OnumotiController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\OnumotiController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\OnumotiController@register_show')->name('onumoti_register_show');
});

//====this route start for Sonaton certificate====//
Route::group(['prefix' => 'sonaton', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\SonatondhormoController@index')->name('sonatondhormo_application');

    Route::get('/create', 'Applications\SonatondhormoController@create')->name('sonaton_application');

    Route::post('/store', 'Applications\SonatondhormoController@store')->name('sonaton_store');

    Route::get('/preview/{tracking}', 'Applications\SonatondhormoController@preview')->name('sonaton_preview');

    Route::get('/applicant_list', 'Applications\SonatondhormoController@applicant_list')->name('sonaton_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\SonatondhormoController@applicant_data')->name('sonaton_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\SonatondhormoController@edit')->name('sonaton_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\SonatondhormoController@update')->name('sonaton_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\SonatondhormoController@sonod_generate')->name('sonaton_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\SonatondhormoController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\SonatondhormoController@sonod_print_bn')->name('sonaton_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\SonatondhormoController@sonod_print_en')->name('sonaton_sonod_print_en');

    Route::post('/delete', 'Applications\SonatondhormoController@delete')->name('sonaton_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\SonatondhormoController@certificate_list')->name('sonaton_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\SonatondhormoController@certificate_list_data')->name('sonaton_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\SonatondhormoController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\SonatondhormoController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\SonatondhormoController@register_show')->name('sonaton_register_show');



});

//====this route start for Obibahito certificate====//
Route::group(['prefix' => 'obibahito', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\ObibahitoController@index')->name('obibahito_application');

    Route::get('/create', 'Applications\ObibahitoController@create')->name('obibahito_application');

    Route::post('/store', 'Applications\ObibahitoController@store')->name('obibahito_store');

    Route::get('/preview/{tracking}', 'Applications\ObibahitoController@preview')->name('obibahito_preview');

    Route::get('/applicant_list', 'Applications\ObibahitoController@applicant_list')->name('obibahito_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\ObibahitoController@applicant_data')->name('obibahito_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\ObibahitoController@edit')->name('obibahito_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\ObibahitoController@update')->name('obibahito_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\ObibahitoController@sonod_generate')->name('obibahito_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\ObibahitoController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\ObibahitoController@sonod_print_bn')->name('obibahito_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\ObibahitoController@sonod_print_en')->name('obibahito_sonod_print_en');

    Route::post('/delete', 'Applications\ObibahitoController@delete')->name('obibahito_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\ObibahitoController@certificate_list')->name('obibahito_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\ObibahitoController@certificate_list_data')->name('obibahito_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\ObibahitoController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\ObibahitoController@register')->name('register')->middleware('permission:registers');


    Route::get('/register/list','Applications\ObibahitoController@register_show')->name('obibahito_register_show');

});

//====this route start for Death certificate====//
Route::group(['prefix' => 'death', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\DeathController@index')->name('death_application');

    Route::get('/create', 'Applications\DeathController@create')->name('death_application');

    Route::post('/store', 'Applications\DeathController@store')->name('death_store');

    Route::get('/preview/{tracking}', 'Applications\DeathController@preview')->name('death_preview');

    Route::get('/applicant_list', 'Applications\DeathController@applicant_list')->name('death_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\DeathController@applicant_data')->name('death_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\DeathController@edit')->name('death_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\DeathController@update')->name('death_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\DeathController@sonod_generate')->name('death_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\DeathController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\DeathController@sonod_print_bn')->name('death_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\DeathController@sonod_print_en')->name('death_sonod_print_en');

    Route::post('/delete', 'Applications\DeathController@delete')->name('death_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\DeathController@certificate_list')->name('death_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\DeathController@certificate_list_data')->name('death_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\DeathController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\DeathController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\DeathController@register_show')->name('death_register_show');
});

//====this route start for Punobibaho certificate====//
Route::group(['prefix' => 'punobibaho', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\PunobibahoController@index')->name('punobibaho_application');

    Route::get('/create', 'Applications\PunobibahoController@create')->name('punobibaho_application');

    Route::post('/store', 'Applications\PunobibahoController@store')->name('punobibaho_store');

    Route::get('/preview/{tracking}', 'Applications\PunobibahoController@preview')->name('punobibaho_preview');

    Route::get('/applicant_list', 'Applications\PunobibahoController@applicant_list')->name('punobibaho_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\PunobibahoController@applicant_data')->name('punobibaho_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\PunobibahoController@edit')->name('punobibaho_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\PunobibahoController@update')->name('punobibaho_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\PunobibahoController@sonod_generate')->name('punobibaho_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\PunobibahoController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\PunobibahoController@sonod_print_bn')->name('punobibaho_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\PunobibahoController@sonod_print_en')->name('punobibaho_sonod_print_en');

    Route::post('/delete', 'Applications\PunobibahoController@delete')->name('punobibaho_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\PunobibahoController@certificate_list')->name('punobibaho_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\PunobibahoController@certificate_list_data')->name('punobibaho_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\PunobibahoController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\PunobibahoController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\PunobibahoController@register_show')->name('punobibaho_register_show');

});

//====this route start for onapotti id certificate====//
Route::group(['prefix' => 'onapotti', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\OnapottiController@create')->name('onapotti.application');

    Route::post('/store', 'Applications\OnapottiController@store')->name('onapotti.store');

    Route::get('/preview/{tracking}', 'Applications\OnapottiController@preview')->name('onapotti.preview');

    Route::get('/applicant_list', 'Applications\OnapottiController@applicant_list')->name('onapotti_applicant_list');

    Route::post('/applicant_data', 'Applications\OnapottiController@applicant_data')->name('onapotti_applicant_data');

    Route::get('/edit/{tracking}', 'Applications\OnapottiController@edit')->name('onapotti_edit');

    Route::post('/update', 'Applications\OnapottiController@update')->name('onapotti_update');

    Route::post('/generate', 'Applications\OnapottiController@sonod_generate')->name('onapotti_sonod_generate');

    Route::post('/regenerate', 'Applications\OnapottiController@sonod_regenerate')->name('sonod_regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\OnapottiController@sonod_print_bn')->name('onapotti_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\OnapottiController@sonod_print_en')->name('onapotti_sonod_print_en');

    Route::post('/delete', 'Applications\OnapottiController@delete')->name('onapotti_delete');

    Route::get('/certificate_list', 'Applications\OnapottiController@certificate_list')->name('onapotti_certificate_list');

    Route::post('/certificate_list_data', 'Applications\OnapottiController@certificate_list_data')->name('onapotti_certificate_list_data');

    Route::get('/money_receipt/{sonod_no}', 'Applications\OnapottiController@money_receipt')->name('money_receipt');

    Route::get('/register/{from_date}/{to_date}', 'Applications\OnapottiController@register')->name('register');

    Route::get('/register/list','Applications\OnapottiController@register_show')->name('onapotti_register_show');
});


//====this route start for Voter id certificate====//
Route::group(['prefix' => 'voter', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\VoterController@index')->name('voter_application');

    Route::get('/', 'Applications\VoterController@index')->name('voter_application');

    Route::get('/create', 'Applications\VoterController@create')->name('voter_application');

    Route::post('/store', 'Applications\VoterController@store')->name('voter_store');

    Route::get('/preview/{tracking}', 'Applications\VoterController@preview')->name('voter_preview');

    Route::get('/applicant_list', 'Applications\VoterController@applicant_list')->name('voter_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\VoterController@applicant_data')->name('voter_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\VoterController@edit')->name('voter_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\VoterController@update')->name('voter_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\VoterController@sonod_generate')->name('voter_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\VoterController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\VoterController@sonod_print_bn')->name('voter_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\VoterController@sonod_print_en')->name('voter_sonod_print_en');

    Route::post('/delete', 'Applications\VoterController@delete')->name('voter_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\VoterController@certificate_list')->name('voter_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\VoterController@certificate_list_data')->name('voter_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\VoterController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\VoterController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\VoterController@register_show')->name('voter_register_show');
});

//====this route start for Ekoinam certificate====//
Route::group(['prefix' => 'ekoinam', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\EkoinamController@index')->name('ekoinam_application');

    Route::get('/create', 'Applications\EkoinamController@create')->name('ekoinam_application');

    Route::post('/store', 'Applications\EkoinamController@store')->name('ekoinam_store');

    Route::get('/preview/{tracking}', 'Applications\EkoinamController@preview')->name('ekoinam_preview');

    Route::get('/applicant_list', 'Applications\EkoinamController@applicant_list')->name('ekoinam_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\EkoinamController@applicant_data')->name('ekoinam_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\EkoinamController@edit')->name('ekoinam_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\EkoinamController@update')->name('ekoinam_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\EkoinamController@sonod_generate')->name('ekoinam_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\EkoinamController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\EkoinamController@sonod_print_bn')->name('ekoinam_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\EkoinamController@sonod_print_en')->name('ekoinam_sonod_print_en');

    Route::post('/delete', 'Applications\EkoinamController@delete')->name('ekoinam_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\EkoinamController@certificate_list')->name('ekoinam_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\EkoinamController@certificate_list_data')->name('ekoinam_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\EkoinamController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\EkoinamController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\EkoinamController@register_show')->name('ekoinam_register_show');
});

//====this route start for yearly income certificate====//
Route::group(['prefix' => 'yearlyincome', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\YearlyincomeController@index')->name('yearlyincome_application');

    Route::get('/create', 'Applications\YearlyincomeController@create')->name('yearlyincome_application');

    Route::post('/store', 'Applications\YearlyincomeController@store')->name('yearlyincome_store');

    Route::get('/preview/{tracking}', 'Applications\YearlyincomeController@preview')->name('yearlyincome_preview');

    Route::get('/applicant_list', 'Applications\YearlyincomeController@applicant_list')->name('yearlyincome_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\YearlyincomeController@applicant_data')->name('yearlyincome_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\YearlyincomeController@edit')->name('yearlyincome_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\YearlyincomeController@update')->name('yearlyincome_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\YearlyincomeController@sonod_generate')->name('yearlyincome_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\YearlyincomeController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\YearlyincomeController@sonod_print_bn')->name('yearlyincome_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\YearlyincomeController@sonod_print_en')->name('yearlyincome_sonod_print_en');

    Route::post('/delete', 'Applications\YearlyincomeController@delete')->name('yearlyincome_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\YearlyincomeController@certificate_list')->name('yearlyincome_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\YearlyincomeController@certificate_list_data')->name('yearlyincome_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\YearlyincomeController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\YearlyincomeController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\YearlyincomeController@register_show')->name('yearlyincome_register_show');
});

//====this route start for prottyon certificate====//
Route::group(['prefix' => 'prottyon', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\ProttyonController@index')->name('prottyon_application');

    Route::get('/create', 'Applications\ProttyonController@create')->name('prottyon_application');

    Route::post('/store', 'Applications\ProttyonController@store')->name('prottyon_store');

    Route::get('/preview/{tracking}', 'Applications\ProttyonController@preview')->name('prottyon_preview');

    Route::get('/applicant_list', 'Applications\ProttyonController@applicant_list')->name('prottyon_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\ProttyonController@applicant_data')->name('prottyon_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\ProttyonController@edit')->name('prottyon_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\ProttyonController@update')->name('prottyon_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\ProttyonController@sonod_generate')->name('prottyon_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\ProttyonController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\ProttyonController@sonod_print_bn')->name('prottyon_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\ProttyonController@sonod_print_en')->name('prottyon_sonod_print_en');

    Route::post('/delete', 'Applications\ProttyonController@delete')->name('prottyon_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\ProttyonController@certificate_list')->name('prottyon_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\ProttyonController@certificate_list_data')->name('prottyon_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\ProttyonController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\ProttyonController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\ProttyonController@register_show')->name('prottyon_register_show');

});

//====this route start for Nodibanga certificate====//
Route::group(['prefix' => 'nodibanga', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\NodibangaController@index')->name('nodibanga_application');

    Route::get('/create', 'Applications\NodibangaController@create')->name('nodibanga_application');

    Route::post('/store', 'Applications\NodibangaController@store')->name('nodibanga_store');

    Route::get('/preview/{tracking}', 'Applications\NodibangaController@preview')->name('nodibanga_preview');

    Route::get('/applicant_list', 'Applications\NodibangaController@applicant_list')->name('nodibanga_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\NodibangaController@applicant_data')->name('nodibanga_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\NodibangaController@edit')->name('nodibanga_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\NodibangaController@update')->name('nodibanga_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\NodibangaController@sonod_generate')->name('nodibanga_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\NodibangaController@sonod_regenerate')->name('sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\NodibangaController@sonod_print_bn')->name('nodibanga_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\NodibangaController@sonod_print_en')->name('nodibanga_sonod_print_en');

    Route::post('/delete', 'Applications\NodibangaController@delete')->name('nodibanga_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\NodibangaController@certificate_list')->name('nodibanga_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\NodibangaController@certificate_list_data')->name('nodibanga_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\NodibangaController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\NodibangaController@register')->name('register')->middleware('permission:registers');

    Route::get('/register/list','Applications\NodibangaController@register_show')->name('nodivanga_register_show');
});

//==== Animal Certificate ====//
Route::group(['prefix' => 'animal', 'middleware' => 'auth'], function () {

    Route::get('/create', 'Applications\AnimalController@create')->name('animal_application');

    Route::post('/store', 'Applications\AnimalController@store')->name('animal_store');

    Route::get('/preview/{tracking}', 'Applications\AnimalController@preview')->name('animal_preview');

    Route::get('/applicant_list', 'Applications\AnimalController@applicant_list')->name('animal_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\AnimalController@applicant_data')->name('animal_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\AnimalController@edit')->name('animal_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\AnimalController@update')->name('animal_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\AnimalController@sonod_generate')->name('animal_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\AnimalController@sonod_regenerate')->name('animal_sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}/{voucher_no}', 'Applications\AnimalController@sonod_print_bn')->name('animal_sonod_print_bn');

    Route::get('/print_en/{sonod_no}/{voucher_no}', 'Applications\AnimalController@sonod_print_en')->name('animal_sonod_print_en');

    Route::post('/delete', 'Applications\AnimalController@delete')->name('animal_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\AnimalController@certificate_list')->name('animal_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\AnimalController@certificate_list_data')->name('animal_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}/{voucher_no}', 'Applications\AnimalController@money_receipt')->name('animal_money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\AnimalController@register')->name('animal_register')->middleware('permission:registers');
});

//==== Road Excavation Certificate ====//
Route::group(['prefix' => 'roadexcavation', 'middleware' => 'auth'], function () {

    Route::get('/create', 'Applications\RoadExcavationController@create')->name('road_application');

    Route::post('/store', 'Applications\RoadExcavationController@store')->name('road_store');

    Route::get('/preview/{tracking}', 'Applications\RoadExcavationController@preview')->name('road_preview');

    Route::get('/applicant_list', 'Applications\RoadExcavationController@applicant_list')->name('road_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\RoadExcavationController@applicant_data')->name('road_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\RoadExcavationController@edit')->name('road_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\RoadExcavationController@update')->name('road_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\RoadExcavationController@sonod_generate')->name('road_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\RoadExcavationController@sonod_regenerate')->name('road_sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\RoadExcavationController@sonod_print_bn')->name('road_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\RoadExcavationController@sonod_print_en')->name('road_sonod_print_en');

    Route::post('/delete', 'Applications\RoadExcavationController@delete')->name('road_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\RoadExcavationController@certificate_list')->name('road_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\RoadExcavationController@certificate_list_data')->name('road_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}/{voucher_no}', 'Applications\RoadExcavationController@money_receipt')->name('road_money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\RoadExcavationController@register')->middleware('permission:registers');

    Route::get('/register/list','Applications\RoadExcavationController@register_show')->name('road_register_show');

});

//==== Land Use Certificate ====//
Route::group(['prefix' => 'landuse', 'middleware' => 'auth'], function () {

    Route::get('/create', 'Applications\LandUseController@create')->name('land_use_application');

    Route::post('/store', 'Applications\LandUseController@store')->name('land_use_store');

    Route::get('/preview/{tracking}', 'Applications\LandUseController@preview')->name('land_use_preview');

    Route::get('/applicant_list', 'Applications\LandUseController@applicant_list')->middleware('permission:application')->name('land_use_application_list');

    Route::post('/applicant_data', 'Applications\LandUseController@applicant_data')->middleware('permission:application')->name('land_use_applicant_data');

    Route::get('/edit/{tracking}', 'Applications\LandUseController@edit')->middleware('permission:edit')->name('land_use_edit');

    Route::post('/update', 'Applications\LandUseController@update')->middleware('permission:edit')->name('land_use_update');

    Route::post('/generate', 'Applications\LandUseController@sonod_generate')->middleware('permission:generate')->name('land_use_sonod_generate');

    Route::post('/regenerate', 'Applications\LandUseController@sonod_regenerate')->middleware('permission:regenerate')->name('land_use_sonod_regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\LandUseController@sonod_print_bn')->name('land_use_sonod_print_bn');

    Route::get('/note/{sonod_no}', 'Applications\LandUseController@note')->name('land_use_note');

    Route::post('/delete', 'Applications\LandUseController@delete')->middleware('permission:delete')->name('land_use_delete');

    Route::get('/certificate_list', 'Applications\LandUseController@certificate_list')->middleware('permission:certificate')->name('land_use_certificate_list');

    Route::post('/certificate_list_data', 'Applications\LandUseController@certificate_list_data')->middleware('permission:certificate')->name('land_use_certificate_list_data');

    Route::get('/money_receipt/{sonod_no}', 'Applications\LandUseController@money_receipt')->middleware('permission:invoice')->name('land_use_money_receipt');

    Route::get('/register/{from_date}/{to_date}', 'Applications\LandUseController@register')->middleware('permission:registers')->name('land_use_register');
});

//==== Premises license Certificate ====//
Route::group(['prefix' => 'premises', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\PremiseslicenseController@index')->name('premises_application');

    Route::get('/create', 'Applications\PremiseslicenseController@create')->name('premises_application');

    Route::post('/store', 'Applications\PremiseslicenseController@store')->name('premises_store');

    Route::get('/preview/{tracking}', 'Applications\PremiseslicenseController@preview')->name('premises_preview');

    Route::get('/applicant_list', 'Applications\PremiseslicenseController@applicant_list')->name('premises_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\PremiseslicenseController@applicant_data')->name('premises_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\PremiseslicenseController@edit')->name('premises_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\PremiseslicenseController@update')->name('premises_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\PremiseslicenseController@sonod_generate')->name('premises_sonod_generate')->middleware('permission:generate');

    Route::post('/regenerate', 'Applications\PremiseslicenseController@sonod_regenerate')->name('premises_sonod_regenerate')->middleware('permission:regenerate');

    Route::get('/print_bn/{sonod_no}', 'Applications\PremiseslicenseController@sonod_print_bn')->name('premises_sonod_print_bn');

    Route::get('/print_en/{sonod_no}', 'Applications\PremiseslicenseController@sonod_print_en')->name('premises_sonod_print_en');

    Route::post('/delete', 'Applications\PremiseslicenseController@delete')->name('premises_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\PremiseslicenseController@certificate_list')->name('premises_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\PremiseslicenseController@certificate_list_data')->name('premises_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\PremiseslicenseController@money_receipt')->name('premises_money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\PremiseslicenseController@register')->name('premises_register')->middleware('permission:registers');

    Route::get('/previous_certificate_list', 'Applications\PremiseslicenseController@previous_certificate_list')
        ->name('premises_previous_certificate_list')->middleware('permission:certificate');

    Route::get('/expire_certificate_list', 'Applications\PremiseslicenseController@expire_certificate_list')->name('premises_expire_certificate_list')->middleware('permission:certificate');

    Route::get('/register/list','Applications\PremiseslicenseController@register_show')->name('premises_register_show');
});

//==== New Holding license Certificate ====//
Route::group(['prefix' => 'newholding', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\NewholdingController@index')->name('newholding_application');

    Route::get('/create', 'Applications\NewholdingController@create')->name('newholding_application');

    Route::post('/store', 'Applications\NewholdingController@store')->name('newholding_store');

    Route::get('/preview/{tracking}', 'Applications\NewholdingController@preview')->name('newholding_preview');

    Route::get('/applicant_list', 'Applications\NewholdingController@applicant_list')->name('newholding_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\NewholdingController@applicant_data')->name('newholding_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\NewholdingController@edit')->name('newholding_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\NewholdingController@update')->name('newholding_update')->middleware('permission:edit');

    Route::post('/delete', 'Applications\NewholdingController@delete')->name('newholding_delete')->middleware('permission:delete');


});

//==== Holding-Namjari license Certificate ====//
Route::group(['prefix' => 'holdingnamjari', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\HoldingNamjariController@index')->name('holdingnamjari');

    Route::get('/create', 'Applications\HoldingNamjariController@create')->name('holdingnamjari_application');

    Route::post('/store', 'Applications\HoldingNamjariController@store')->name('holdingnamjari_store');

    Route::get('/preview/{tracking}', 'Applications\HoldingNamjariController@preview')->name('holdingnamjari_preview');

    Route::get('/applicant_list', 'Applications\HoldingNamjariController@applicant_list')->name('holdingnamjari_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\HoldingNamjariController@applicant_data')->name('holdingnamjari_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\HoldingNamjariController@edit')->name('holdingnamjari_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\HoldingNamjariController@update')->name('holdingnamjari_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\HoldingNamjariController@sonod_generate')->name('holdingnamjari_sonod_generate')->middleware('permission:generate');


    Route::get('/print_bn/{sonod_no}', 'Applications\HoldingNamjariController@sonod_print_bn')->name('holdingnamjari_sonod_print_bn');

    Route::get('/note/{sonod_no}', 'Applications\HoldingNamjariController@note')->name('holdingnamjari_sonod_print_en');

    Route::post('/delete', 'Applications\HoldingNamjariController@delete')->name('holdingnamjari_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\HoldingNamjariController@certificate_list')->name('holdingnamjari_certificate_list')->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\HoldingNamjariController@certificate_list_data')->name('holdingnamjari_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\HoldingNamjariController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\HoldingNamjariController@register')->name('register')->middleware('permission:registers');

    Route::post('/regenerate', 'Applications\HoldingNamjariController@sonod_regenerate')->name('holdingnamjari_sonod_generate')->middleware('permission:generate');
});

//==== Imarot license Certificate ====//
Route::group(['prefix' => 'emarot', 'middleware' => 'auth'], function () {

    Route::get('/', 'Applications\EmarotController@index')->name('hoholdingnamjari');

    Route::get('/create', 'Applications\EmarotController@create')->name('emarot_application');

    Route::post('/store', 'Applications\EmarotController@store')->name('emarot_store');

    Route::get('/preview/{tracking}', 'Applications\EmarotController@preview')->name('emarot_preview');

    Route::get('/applicant_list', 'Applications\EmarotController@applicant_list')->name('emarat_applicant_list')->middleware('permission:application');

    Route::post('/applicant_data', 'Applications\EmarotController@applicant_data')->name('holdingnamjari_applicant_data')->middleware('permission:application');

    Route::get('/edit/{tracking}', 'Applications\EmarotController@edit')->name('emarot_edit')->middleware('permission:edit');

    Route::post('/update', 'Applications\EmarotController@update')->name('emarot_update')->middleware('permission:edit');

    Route::post('/generate', 'Applications\EmarotController@sonod_generate')->name('holdingnamjari_sonod_generate')->middleware('permission:generate');


    Route::get('/print_bn/{sonod_no}', 'Applications\EmarotController@sonod_print_bn')->name('holdingnamjari_sonod_print_bn');

    Route::get('/note/{sonod_no}', 'Applications\EmarotController@note')->name('holdingnamjari_sonod_print_en');

    Route::post('/delete', 'Applications\EmarotController@delete')->name('holdingnamjari_delete')->middleware('permission:delete');

    Route::get('/certificate_list', 'Applications\EmarotController@certificate_list')->name('emarot_certificate_list')
        ->middleware('permission:certificate');

    Route::post('/certificate_list_data', 'Applications\EmarotController@certificate_list_data')->name('holdingnamjari_certificate_list_data')->middleware('permission:certificate');

    Route::get('/money_receipt/{sonod_no}', 'Applications\EmarotController@money_receipt')->name('money_receipt')->middleware('permission:invoice');

    Route::get('/register/{from_date}/{to_date}', 'Applications\EmarotController@register')->name('register')->middleware('permission:registers');

    Route::post('/regenerate', 'Applications\EmarotController@sonod_regenerate')->name('register')->middleware('permission:generate');

    Route::get('/register/list','Applications\EmarotController@register_show')->name('emarot_register_show');
});

// === Holding tax module ==== //

Route::group(['prefix' => 'holding/tax', 'middleware' => 'auth'], function(){
    Route::get('/assessment', 'HoldingTaxController@assessment_list')->name('holding.tax.assessment');

    Route::get('/assessment/create', 'HoldingTaxController@assessment')->name('holding.tax.assessment.create');

    Route::post('/assessment/store', 'HoldingTaxController@assessment_store')->name('holding.assessment.store');

    Route::get('/assessment/print/{id}', 'HoldingTaxController@assessment_print')->name('holding.tax.assessment.print');

    Route::get('/assessment/edit/{id}', 'HoldingTaxController@assessment_edit')->name('holding.tax.assessment.edit');

    Route::post('/assessment/update', 'HoldingTaxController@assessment_update')->name('holding.assessment.update');

    Route::post('/assessment/delete', 'HoldingTaxController@assessment_delete');

    Route::get("/assessment/bill/generate/{id?}", "HoldingTaxController@bill_generate")->name("holding.assessment.bill.generate");

    Route::post("/assessment/bill/generate/action", "HoldingTaxController@bill_generate_action")->name("holding.assessment.bill.generate.action");

    Route::get("/bill/list", "HoldingTaxController@bill_list")->name("holding.tax.bill.list");

    Route::get("/bill/print/{invoice_id}", "HoldingTaxController@bill_print")->name("holding.tax.bill.print");

    Route::post("/bill/delete", "HoldingTaxController@bill_delete");

    Route::get("/bill/collection/{invoice_id?}", "HoldingTaxController@bill_collection")->name("holding.tax.bill.collection");

    Route::get("/bill/invoice_data", "HoldingTaxController@invoice_data");

    Route::post("/bill/collection/save", "HoldingTaxController@collection_save");

    Route::get("/report/cash", "HoldingTaxController@report_cash")->name('holding.tax.report.cash');

    Route::get("/report/bank", "HoldingTaxController@report_bank")->name('holding.tax.report.bank');

    Route::get("/report/others", "HoldingTaxController@report_others")->name('holding.tax.report.others');

    Route::get("/report/action", "HoldingTaxController@report_action")->name('holding.tax.report.action');


    // settings
    // ward
    Route::get('/settings/ward', 'HoldingTaxController@ward_settings')->name('holding.settings.ward');

    Route::post('/settings/ward/store', 'HoldingTaxController@store_ward_settings');

    Route::post('/settings/ward/update', 'HoldingTaxController@update_ward_settings');

    Route::post('/settings/ward/delete', 'HoldingTaxController@delete_ward_settings');

    // moholla
    Route::get('/settings/moholla', 'HoldingTaxController@moholla_settings')->name('holding.settings.moholla');

    Route::post('/settings/moholla/store', 'HoldingTaxController@store_moholla_settings');

    Route::post('/settings/moholla/update', 'HoldingTaxController@update_moholla_settings');

    Route::post('/settings/moholla/delete', 'HoldingTaxController@delete_moholla_settings');

    // block
    Route::get('/settings/block', 'HoldingTaxController@block_settings')->name('holding.settings.block');

    Route::post('/settings/block/store', 'HoldingTaxController@store_block_settings');

    Route::post('/settings/block/update', 'HoldingTaxController@update_block_settings');

    Route::post('/settings/block/delete', 'HoldingTaxController@delete_block_settings');

    // property type
    Route::get('/settings/property_type', 'HoldingTaxController@property_type_settings')->name('holding.settings.property_type');

    Route::post('/settings/property_type/store', 'HoldingTaxController@store_property_type_settings');

    Route::post('/settings/property_type/update', 'HoldingTaxController@update_property_type_settings');

    Route::post('/settings/property_type/delete', 'HoldingTaxController@delete_property_type_settings');

    // area tax
    Route::get('/area/tax', 'HoldingTaxController@area_tax')->name('holding.tax.area.rate');

    Route::post('/area/tax/action', 'HoldingTaxController@area_tax_action')->name('holding.tax.area.rate.action');
});

// === END === //

//===this route start for accounts ========//
Route::group(['prefix' => 'accounts', 'middleware' => 'auth'], function () {

    //this is start for registers
    Route::get('/registers', 'Accounts\AccountsController@registers')->name('registers')->middleware('permission:registers');

    // this is for reports
    Route::get('/daily_reports', 'Accounts\AccountsController@daily_reports')->name('daily_reports')->middleware('permission:everyday-reports');

    //for daily all collection
    Route::get('/daily_all_collection/{from_date}/{to_date}', 'Accounts\AccountsController@daily_all_collection')->name('daily_all_collection')->middleware('permission:everyday-reports');

    Route::get('/daily_deposit_expense_report/{from_date}/{to_date}', 'Accounts\AccountsController@daily_deposit_expense_report')->name('daily_deposit_expense_report');

    //check assesment data
    Route::post('/check_assesment', 'Accounts\AccountsController@check_assesment')->name('check_assesment')->middleware('permission:home-tax');

    //this is for assesment list
    Route::get('/assesment_application', 'Accounts\AccountsController@assesment_application')->name('assesment_application')->middleware('permission:add-home');

    Route::post('/assesment_store', 'Accounts\AccountsController@assesment_store')->name('assesment_store')->middleware('permission:add-home');

    Route::get('/assesment_edit/{pin}', 'Accounts\AccountsController@assesment_edit')->name('assesment_edit')->middleware('permission:edit-home');

    Route::post('/assesment_update', 'Accounts\AccountsController@assesment_update')->name('assesment_update')->middleware('permission:edit-home');

    Route::get('/assesment_list', 'Accounts\AccountsController@assesment_list')->name('assesment_list')->middleware('permission:home-tax');

    Route::post('/assesment_list_data', 'Accounts\AccountsController@assesment_list_data')->name('assesment_list_data')->middleware('permission:home-tax');

    Route::post('/home_tax_save', 'Accounts\AccountsController@home_tax_save')->name('home_tax_save')->middleware('permission:add-home-tax');

    Route::get('/home_tax_money_receipt/{pin}', 'Accounts\AccountsController@home_tax_money_receipt')->name('home_tax_money_receipt')->middleware('permission:home-tax-invoice');

    Route::get('/home_tax_register/{from_date}/{to_date}', 'Accounts\AccountsController@home_tax_register')->name('home_tax_register')->middleware('permission:registers');

    Route::get('/home_tax_collection_report/{from_date}/{to_date}', 'Accounts\AccountsController@home_tax_collection_report')->name('home_tax_collection_report')->middleware('permission:everyday-reports');

    //this is start for account settings
    Route::get('/account_list', 'Accounts\SettingsController@account_list')->name('account_list')->middleware('permission:add-accounts');

    Route::post('/account_list_data', 'Accounts\SettingsController@account_list_data')->name('account_list_data')->middleware('permission:add-accounts');

    Route::post('/account_save', 'Accounts\SettingsController@account_save')->name('account_save')->middleware('permission:add-accounts');

    Route::post('/account_update', 'Accounts\SettingsController@account_update')->name('account_update')->middleware('permission:edit-accounts');

    Route::post('/account_delete', 'Accounts\SettingsController@account_delete')->name('account_delete')->middleware('permission:delete-accounts');

    //this is start for cashbook
    Route::get('/cashbook', 'Accounts\CashbookController@cashbooks')->name('cashbooks')->middleware('permission:registers');
    Route::get('/generelcashbook/{from_date}/{to_date}', 'Accounts\CashbookController@generel_cashbook')->name('generel_cashbook');
    Route::get('/lgspcashbook/{from_date}/{to_date}', 'Accounts\CashbookController@lgsp_cashbook')->name('lgsp_cashbook');
    Route::get('/sthaborcashbook/{from_date}/{to_date}', 'Accounts\CashbookController@sthabor_cashbook')->name('sthabor_cashbook');
    Route::get('/birthdiecashbook/{from_date}/{to_date}', 'Accounts\CashbookController@birth_die_cashbook')->name('birth_die_cashbook');

    //this if for fund
    Route::get('/fund', 'Accounts\SettingsController@fund')->name('fund');
    Route::post('/fund_list_data', 'Accounts\SettingsController@fund_list_data')->name('fund_list_data');
    Route::post('/fund_store', 'Accounts\SettingsController@fund_store')->name('fund_store');
    Route::post('/fund_update_save', 'Accounts\SettingsController@fund_update_save')->name('fund_update_save');
    // Route::post('/fund_update_save', 'Accounts\SettingsController@fund_update_save')->name('fund_update_save');

    //this is for daily deposit and expense
    Route::get('/deposit', 'Accounts\DepositExpenseController@daily_deposit')->name('daily_deposit');
    Route::get('/expense', 'Accounts\DepositExpenseController@daily_expense')->name('daily_expense');
    Route::post('/acc_subcategory', 'Accounts\DepositExpenseController@acc_subcategory')->name('acc_subcategory');
    Route::post('/daily_deposit_save', 'Accounts\DepositExpenseController@daily_deposit_save')->name('daily_deposit_save');

    Route::post('/account_balance', 'Accounts\DepositExpenseController@account_balance')->name('account_balance');

    // all rosid list
    Route::get('/rosid-list', 'Accounts\AccountsController@rosidList')->name('rosid_list');
});


// market module
Route::group(['prefix' => 'market', 'middleware' => 'auth'], function () {
    Route::get('/list', 'Applications\MarketController@index')->name('market.list');

    Route::get('/list_data', 'Applications\MarketController@list_data');

    Route::post('/store', 'Applications\MarketController@store')->name('market.store');

    Route::post('/update', 'Applications\MarketController@update')->name('market.update');

    Route::post('/delete', 'Applications\MarketController@delete');
});
// end

// shop module
Route::group(['prefix' => 'shop', 'middleware' => 'auth'], function () {
    Route::get('/list', 'Applications\ShopController@index')->name('shop.list');

    Route::get('/list_data', 'Applications\ShopController@list_data');

    Route::post('/store', 'Applications\ShopController@store')->name('shop.store');

    Route::post('/update', 'Applications\ShopController@update')->name('shop.update');

    Route::post('/delete', 'Applications\ShopController@delete');

    Route::get('/report/list', 'Applications\ShopController@shop_list_report')->name("shop.list.report");

    Route::get('/report/list/action', 'Applications\ShopController@shop_list_report_action')->name("shop.list.report.action");

    Route::get('/owner/report/list', 'Applications\ShopOwnerController@shop_owner_list_report')->name("shop.owner.list.report");

    Route::get('/owner/report/list/action', 'Applications\ShopOwnerController@shop_owner_list_report_action')->name("shop.owner.list.report.action");

    Route::get('/getshopinfo/{shop_id}', 'Applications\ShopController@getShopInfo');
});
// end

// shop owner module
Route::group(['prefix' => 'shopowner', 'middleware' => 'auth'], function () {
    Route::get('/list', 'Applications\ShopOwnerController@index')->name('shop.owner.list');

    Route::get('/list_data', 'Applications\ShopOwnerController@list_data');

    Route::post('/store', 'Applications\ShopOwnerController@store')->name('shop.owner.store');

    Route::post('/update', 'Applications\ShopOwnerController@update')->name('shop.owner.update');

    Route::post('/delete', 'Applications\ShopOwnerController@delete');

    Route::get('/getShopByMarketId/{market_id}', 'Applications\ShopOwnerController@getShopByMarketId');

    Route::post('/cancelContract', 'Applications\ShopOwnerController@cancelContract');

    Route::get('/report/list', 'Applications\ShopOwnerController@shop_owner_list_report')->name("shop.owner.list.report");

    Route::get('/report/list/action', 'Applications\ShopOwnerController@shop_owner_list_report_action')->name("shop.owner.list.report.action");

    Route::get('/change/ownership', 'Applications\ShopOwnerController@shop_ownership_change')->name("shop.owner.change");

    Route::post('/change/ownership/confirm', 'Applications\ShopOwnerController@shop_ownership_change_confirm')->name("shop.owner.change.confirm");

    Route::post('/change/ownership/store', 'Applications\ShopOwnerController@shop_ownership_change_store')->name("shop.owner.change.store");

    // ownership expire //
    Route::prefix('/expire')->group(function () {
        Route::get('/list', 'Applications\ShopOwnerController@expire_owner_list')->name("shop.owner.expirelist");
        Route::get('/list_data', 'Applications\ShopOwnerController@expire_owner_list_data');
        Route::post('/ownership_renew_store', 'Applications\ShopOwnerController@ownership_renew_store');
        Route::post('/ownership_cancel_store', 'Applications\ShopOwnerController@ownership_cancel_store');
    });
    // ownership expire //

});
// end

// market accounts register
// Route::get('/market/accounts', 'Shop\BillCollectionController@accounts')->name('shop.market.accounts');

Route::get('/market/accounts/register/{from_date}/{to_date}', 'Shop\BillCollectionController@register')->name('shop.market.register');
// end

// bill generate module
Route::group(['prefix' => 'shop/bill/generate', 'middleware' => 'auth'], function () {

    Route::get('/', 'Shop\BillGenerateController@index')->name('shop_bill_generate');

    Route::get('/list', 'Shop\BillGenerateController@invoice_list')->name('invoice_list');

    Route::post('/list_data', 'Shop\BillGenerateController@invoice_list_data');

    Route::post('/store', 'Shop\BillGenerateController@store')->name('shop.owner.store');

    Route::post('/update', 'Shop\BillGenerateController@update')->name('shop.owner.update');

    Route::post('/delete', 'Shop\BillGenerateController@delete');

    Route::get('/invoice/print/{invoice_id}', 'Shop\BillGenerateController@invoice_print');

    Route::get('/sms', 'Shop\BillGenerateController@BillGenerateSms')->name('shop_bill_generate_sms');

    Route::post('/sms/send', 'Shop\BillGenerateController@BillGenerateSmsSend');

});
// end

// bill collection
Route::group(['prefix' => 'shop/bill/collection', 'middleware' => 'auth'], function () {
    Route::get('/', 'Shop\BillCollectionController@index')->name('shop_bill_collection');

    Route::get('/list', 'Shop\BillCollectionController@list');

    Route::post('/collectMoney', 'Shop\BillCollectionController@collectMoney');

    Route::get('/monthly/report', 'Shop\BillCollectionController@bill_collection_report')->name('monthly.bill.collection.report');

    Route::get('/monthly/report/action', 'Shop\BillCollectionController@bill_collection_report_action')->name('monthly.bill.collection.report.action');
});
// end

// sms module
Route::group(['prefix' => 'shop/sms', 'middleware' => 'auth'], function () {
    // bill generate
    Route::get('/bill/generate', 'Shop\BillGenerateController@BillGenerateSms')->name('shop_bill_generate_sms');
    Route::post('/bill/generate/send', 'Shop\BillGenerateController@BillGenerateSmsSend');
    // due rent s
    Route::get('/bill/duemonth', 'Shop\BillCollectionController@dueMonthSms')->name('shop_due_rent_sms');
    Route::post('/bill/duemonth/send', 'Shop\BillCollectionController@dueMonthSmsSend');
});

// Association member
Route::group(['prefix' => 'association/member', 'middleware' => 'auth'], function () {
    Route::get('/create', 'Shop\Association\MemberController@index')->name('association_member_add');

    Route::get('/list', 'Shop\Association\MemberController@list')->name('association_member_list');

    Route::post('/list_data', 'Shop\Association\MemberController@list_data');

    Route::post('/store', 'Shop\Association\MemberController@store')->name('association_member_store');

    Route::get('/edit/{id}', 'Shop\Association\MemberController@edit');

    Route::post('/update', 'Shop\Association\MemberController@update')->name('association_member_update');

    Route::post('/delete', 'Shop\Association\MemberController@delete');

});

// Association member bill collection
Route::group(['prefix' => 'association/member/bill/collection', 'middleware' => 'auth'], function () {

    Route::get('/', 'Shop\Association\BillCollectionController@index')->name('association_member_bill_collection');

    Route::post('/getMemberInvoiceInfo', 'Shop\Association\BillCollectionController@getMemberInvoiceInfo');

    Route::post('/bill_collection_save', 'Shop\Association\BillCollectionController@bill_collection_save');

    Route::get('/invoice_list', 'Shop\Association\BillCollectionController@invoice_list')->name('association_invoice_list');

    Route::post('/invoice_list_data', 'Shop\Association\BillCollectionController@invoice_list_data');
    Route::get('/invoice/{invoice_id}', 'Shop\Association\BillCollectionController@invoice_information');
    Route::get('/report/all/member', 'Shop\Association\BillCollectionController@getPaymentInformation')->name('all_member_collection_report');
    Route::get('/report/{member_id}', 'Shop\Association\BillCollectionController@getPaymentInfoByMemberId');


});

Route::group(['prefix' => 'association/expense-income', 'middleware' => 'auth' ],function (){

    Route::group(['prefix' => '/khat', 'middleware' => 'auth' ],function (){
       Route::get('/','Shop\Association\IncomeExpenseController@khat')->name('association.income-expense.khat');
       Route::post('/store','Shop\Association\IncomeExpenseController@khat_store');
    });

});


//Website management Routes//
Route::group(['prefix' => 'management', 'middleware' => 'auth'], function () {
    Route::get('/members', 'Management\Employee\MemberController@members')->name('all_members')->middleware('permission:employee-list');

    Route::get('/all/members/info', 'Management\Employee\MemberPDFController@gen')->name('gen_pdf')->middleware('permission:employee-list');

    Route::get('/add/members', 'Management\Employee\MemberController@addMembers')->name('add_member')->middleware('permission:add-employee');

    Route::post('/store/members', 'Management\Employee\MemberController@store')->name('store_member')->middleware('permission:add-employee');

    Route::post('/getEmployeeSequence', 'Management\Employee\MemberController@getEmployeeSequence')->middleware('permission:add-employee');

    Route::post('/employee/pic/update', 'Management\Employee\MemberController@updateEmployeePic')->name('update_pic')->middleware('permission:edit-employee');

    Route::get('/employee/info/edit/{id}', 'Management\Employee\MemberController@editEmployeeInfo')->name('edit_info')->middleware('permission:edit-employee');

    Route::post('/employee/info/update', 'Management\Employee\MemberController@updateEmployeeInfo')->name('update_info')->middleware('permission:edit-employee');

    Route::post('/get/employee/name', 'Management\Employee\MemberController@getNameByDesignation')->middleware('permission:edit-employee');

    Route::post('/change/sequence', 'Management\Employee\MemberController@updateSequence')->middleware('permission:edit-employee');

    Route::get('/view/member/profile/{id}', 'Management\Employee\MemberController@profile')->name('view_profile')->middleware('permission:view-employee');

    Route::get('/member/profile/status/{id}', 'Management\Employee\MemberController@changeStatus')->name('change_status')->middleware('permission:employee-status');

    Route::post('/delete/member', 'Management\Employee\MemberController@deleteMembers')->name('delete_member')->middleware('permission:delete-employee');

    //Change name, username, nid, email
    Route::post('/change/user/info', 'Management\Employee\MemberController@changeUserInfo')->name('change_user_info');

    //Change password
    Route::post('/change/password', 'Management\Employee\MemberController@changePassword')->name('change_pass');
});

//Union setup route group
Route::group(['prefix' => 'union/setup', 'middleware' => 'auth'], function () {

    Route::get('/', 'Management\Union\UnionSetupController@profile')->name('union_setup')->middleware('permission:union-setup');

    Route::post('/', 'Management\Union\UnionSetupController@store')->name('union_info')->middleware('permission:super-admin');

    Route::post('/update', 'Management\Union\UnionSetupController@update')->name('union_update')->middleware('permission:edit-union');

    Route::post('update/ui', 'Management\Union\UnionSetupController@updateUi')->name('union_ui_update')->middleware('permission:edit-union');

    Route::get('/pdf-setup', 'Management\Union\UnionSetupController@pdfSetup')->name('pdf_setup')->middleware('permission:union-setup');
    Route::post('/pdf-setup', 'Management\Union\UnionSetupController@postPdfSetup')->name('pdf_setup_post')->middleware('permission:union-setup');

    Route::post('/google/map', 'Management\Union\UnionSetupController@map')->middleware('permission:edit-union');

    // business type
    Route::get('/business-type', 'Management\Union\UnionSetupController@businessTypeList')->name('business_type.list');
    Route::post('/business-type/store', 'Management\Union\UnionSetupController@businessTypeStore')->name('business_type.store');
    Route::post('/business-type/update', 'Management\Union\UnionSetupController@businessTypeUpdate')->name('business_type.update');
    Route::get('/business-type/delete/{id?}', 'Management\Union\UnionSetupController@businessTypeDelete')->name('business_type.delete');

    // street setup
    Route::group([ 'prefix' => '/street','middleware' => 'auth' ],function (){
        Route::get('/', 'Management\Union\UnionSetupController@streetList')->name('street.list');
        Route::post('/store', 'Management\Union\UnionSetupController@streetStore')->name('street.store');
        Route::post('/update', 'Management\Union\UnionSetupController@streetUpdate')->name('street.update');
        Route::get('/delete/{id?}', 'Management\Union\UnionSetupController@streetDelete')->name('street.delete');
        Route::get('/getBnName', 'Management\Union\UnionSetupController@getStreetNameBn');
    });

});

//Union role setup route group
Route::group(['prefix' => 'setting/setup', 'middleware' => 'auth'], function () {
    Route::get('/role', 'Management\Role\RoleSetupController@index')->name('role')
        ->middleware(['role_or_permission:super-admin|role-setup']);

    Route::get('/role-list', 'Management\Role\RoleSetupController@roleList')->name('role.list')
        ->middleware(['role_or_permission:super-admin|role-setup']);

    Route::get('/role-list-data', 'Management\Role\RoleSetupController@roleListData')->name('role.list.data')
        ->middleware(['role_or_permission:super-admin|role-setup']);

    Route::get('/role/assigned-list', 'Management\Role\RoleSetupController@assignedRoleList')->name('role.assigned_role')->middleware('role_or_permission:super-admin|assign-role');

    Route::post('/check/role', 'Management\Role\RoleSetupController@checkRoleName')->middleware('role_or_permission:super-admin|create-role');

    Route::get('/role/create', 'Management\Role\RoleSetupController@showCreateRoleForm')->name('create_role')
        ->middleware('role_or_permission:super-admin|create-role');

    Route::post('/role/create', 'Management\Role\RoleSetupController@storeRole')->name('store_role')
        ->middleware('role_or_permission:super-admin|create-role');

    Route::get('/role/show/{id?}', 'Management\Role\RoleSetupController@showRole')->name('role.show')->middleware('role_or_permission:super-admin|show-role');

    Route::get('/role/edit/{id?}', 'Management\Role\RoleSetupController@editRole')->name('role.edit')->middleware('role_or_permission:super-admin|role-edit');

    Route::post('/role/update/{id}', 'Management\Role\RoleSetupController@updateRole')->name('role.update')->middleware('role_or_permission:super-admin|role-edit');

    Route::post('/role/delete', 'Management\Role\RoleSetupController@deleteRole')->name('delete_role')->middleware('role_or_permission:super-admin|delete-role');

    Route::post('/role/assign', 'Management\Role\RoleSetupController@assignRole')->name('assign_role')->middleware('role_or_permission:super-admin|assign-role');

    Route::post('/role/reset/all', 'Management\Role\RoleSetupController@resetAllRole')->name('reset_all_role')->middleware('role_or_permission:super-admin|reset-all-role');

    Route::post('/role/reset', 'Management\Role\RoleSetupController@resetRole')->name('reset_role')->middleware('role_or_permission:super-admin|reset-role');

    Route::post('/getEmployeeName', 'Management\Employee\MemberController@getEmployeeName')->middleware('role_or_permission:super-admin|assign-role');
});

//Union notice route group
Route::group(['prefix' => 'management/union', 'middleware' => 'auth'], function () {
    Route::get('/all/notice', 'Management\Info\NoticeController@index')->name('all_up_notice')->middleware('permission:notice-list');

    Route::post('/all/notice', 'Management\Info\NoticeController@getNotice')->middleware('permission:notice-list');

    Route::get('/info/add', 'Management\Info\NoticeController@add')->name('add_up_notice')->middleware('permission:add-notice');

    Route::post('/info/add', 'Management\Info\NoticeController@store')->name('add_notice')->middleware('permission:add-notice');

    Route::get('/info/edit/{id}', 'Management\Info\NoticeController@edit')->name('edit')->middleware('permission:edit-notice');

    Route::post('/info/edit/', 'Management\Info\NoticeController@update')->name('edit_notice')->middleware('permission:edit-notice');

    Route::post('/info/delete/{id}', 'Management\Info\NoticeController@delete')->name('delete_notice')->middleware('permission:delete-notice');
});


//Union web slider route group
Route::group(['prefix' => 'management/slider', 'middleware' => 'auth'], function () {
    Route::get('/', 'Management\Slider\SliderController@index')->name('slider')->middleware('permission:slider-list');

    Route::post('/add/slide', 'Management\Slider\SliderController@store')->name('add-slide')->middleware('permission:add-slide');

    Route::get('/update/status/{id}', 'Management\Slider\SliderController@updateStatus')->name('change_slide_status')->middleware('permission:edit-slide');

    Route::post('/get/slide', 'Management\Slider\SliderController@getSlide')->middleware('permission:edit-slide');

    Route::post('/update/slide', 'Management\Slider\SliderController@updateSlide')->name('update-slide')->middleware('permission:edit-slide');

    Route::post('/delete/slide', 'Management\Slider\SliderController@deleteSlide')->name('delete_slide')->middleware('permission:delete-slide');

    Route::post('/sequence', 'Management\Slider\SliderController@updateSequence')->middleware('permission:edit-slide');
});


//Union web allowance routes
Route::group(['prefix' => 'management/allowance', 'middleware' => 'auth'], function () {
    Route::get('/add', 'Management\Allowance\AllowanceController@viewAllowanceAddForm')->name('add-allowance')->middleware('permission:add-vata');

    Route::post('/add', 'Management\Allowance\AllowanceController@store')->name('store-allowance')->middleware('permission:add-vata');

    Route::get('/show/{type}', 'Management\Allowance\AllowanceController@show')->name('show-allowance')->middleware('permission:vata-list');

    Route::post('/get', 'Management\Allowance\AllowanceController@getAllowance')->name('get-allowance')->middleware('permission:vata-list');

    Route::get('/edit/{id}', 'Management\Allowance\AllowanceController@showAllowanceEditForm')->name('show-allowance-edit-form')->middleware('permission:edit-vata');

    Route::post('/get/info', 'Management\Allowance\AllowanceController@getAllowanceInfo')->middleware('permission:vata-payment');

    Route::post('/vata/payment', 'Management\Allowance\AllowanceController@storeVata')->name('store_vata')->middleware('permission:vata-payment');

    Route::get('/vata/card/{type}/{id}', 'Management\Allowance\AllowanceController@stramVataCard')->name('vata_card')->middleware('permission:vata-card-print');

    Route::get('/all/vata/card/{type}', 'Management\Allowance\AllowanceController@stramAllVataCard')->name('all_vata_card')->middleware('permission:vata-card-print');

    Route::get('/profile/{type}/{id}', 'Management\Allowance\AllowanceController@showAllowanceProfile')->name('show-allowance-profile')->middleware('permission:vata-profile');

    Route::post('/update', 'Management\Allowance\AllowanceController@updateAllowance')->name('update-allowance')->middleware('permission:edit-vata');

    Route::post('/delete', 'Management\Allowance\AllowanceController@deleteAllowance')->name('delete-allowance')->middleware('permission:delete-vata');
});


//Application form request
Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::post('/nagorik', 'Applications\NagorikController@webApplly');

    Route::post('/death', 'Applications\DeathController@webApplly');

    Route::post('/obibahito', 'Applications\ObibahitoController@webApplly');

    Route::post('/punobibaho', 'Applications\PunobibahoController@webApplly');

    Route::post('/ekoinam', 'Applications\EkoinamController@webApplly');

    Route::post('/sonaton', 'Applications\SonatondhormoController@webApplly');

    Route::post('/prottyon', 'Applications\ProttyonController@webApplly');

    Route::post('/nodibanga', 'Applications\NodibangaController@webApplly');

    Route::post('/character', 'Applications\CharacterController@webApplly');

    Route::post('/vumihin', 'Applications\VumihinController@webApplly');

    Route::post('/yearlyincome', 'Applications\YearlyincomeController@webApplly');

    Route::post('/protibondi', 'Applications\ProtibondiController@webApplly');

    Route::post('/onumoti', 'Applications\OnumotiController@webApplly');

    Route::post('/voter', 'Applications\VoterController@webApplly');

    Route::post('/onapotti', 'Applications\OnapottiController@store');

    // Route::post('/rastakhonon', 'Applications\RastakhononController@webApplly');

    Route::post('/warish', 'Applications\WarishController@webApplly');

    Route::post('/family', 'Applications\FamilyController@webApplly');

    Route::post('/trade', 'Applications\TradelicenseController@webApplly');

    Route::post('/bibahito', 'Applications\BibahitoController@webApplly');

    Route::post('/premises', 'Applications\PremiseslicenseController@webApplly');
    Route::post('/roadexcavation', 'Applications\RoadExcavationController@webApplly');
    Route::post('/emarot', 'Applications\EmarotController@webApplly');
    Route::post('/landuse', 'Applications\LandUseController@webApplly');
    Route::post('/newholding', 'Applications\NewholdingController@webApplly');
    Route::post('/holdingnamjari', 'Applications\HoldingNamjariController@webApplly');
    Route::post('/animal', 'Applications\AnimalController@webApplly');


});

Route::group(['prefix' => 'reports', 'middleware' => 'auth'], function () {

    //this is for reports
    Route::get('/reports/{type}', 'Reports\ReportsController@reports')->name('reports');
    Route::post('/report_save', 'Reports\ReportsController@report_save')->name('report_save');
    Route::post('/report_delete', 'Reports\ReportsController@report_delete')->name('report_delete');

    //this is for letters
    Route::get('/letters/{type}', 'Reports\ReportsController@letters')->name('letters');
    Route::post('/letter_save', 'Reports\ReportsController@letter_save')->name('letter_save');
    Route::post('/letter_delete', 'Reports\ReportsController@letter_delete')->name('letter_delete');

    //this is for asset register
    Route::get('/asset_register', 'Reports\ReportsController@asset_register')->name('asset_register');
    Route::post('/asset_register_save', 'Reports\ReportsController@asset_register_save')->name('asset_register_save');
    Route::post('/asset_register_delete', 'Reports\ReportsController@asset_register_delete')->name('asset_register_delete');

    //this is start for projects
    Route::get('/projects', 'Reports\ReportsController@projects')->name('projects');
    Route::post('/project_save', 'Reports\ReportsController@project_save')->name('project_save');
    Route::post('/project_delete', 'Reports\ReportsController@project_delete')->name('project_delete');

    //this is for committe
    Route::get('/committee', 'Reports\CommitteeController@committee')->name('committee');
    Route::post('/committee_save', 'Reports\CommitteeController@committee_save')->name('committee_save');
    Route::get('/committee_list', 'Reports\CommitteeController@committee_list')->name('committee_list');
    Route::get('/committee_edit/{id}', 'Reports\CommitteeController@committee_edit')->name('committee_edit');
    Route::post('/committee_update_save', 'Reports\CommitteeController@committee_update_save')->name('committee_update_save');
    Route::post('/committee_delete', 'Reports\CommitteeController@committee_delete')->name('committee_delete');
});

Route::group(['prefix' => 'attendance', 'middleware' => 'auth'], function () {

    //this is for reports
    Route::get('/attendance_data', 'AttendanceController@attendance_data')->name('attendance_data');
});

    // Bank Account add section
Route::group(['prefix' => '/bank', 'middleware' => 'auth'], function () {

    Route::get('/', 'Management\bank\BankController@index')->name('bank_view');

    Route::get('/list_view', 'Management\bank\BankController@list_view')->name('bank_list_view');

    Route::post('/store', 'Management\bank\BankController@store')->name('bank_store');

    Route::get('/delete/{id}', 'Management\bank\BankController@destroy')->name('bank_delete');

    Route::post('/update/', 'Management\bank\BankController@update')->name('bank_update');
});

// --------------------- Sync ------------------ //
// web sync
Route::get('sync-web', 'Sync\WebSyncController@syncWeb')->name('sync.web_data');

// central sync
Route::get('sync-central', 'Sync\SyncCentralController@syncCentral')->name('sync.central');
Route::get('sync-central/regular', 'Sync\SyncCentralController@syncCentralRegular')->name('sync.central_regular');

// sync app table structure
Route::get('sync-table', 'Sync\SyncTableStructureController@handle')->name('sync.table_structure');

// --------------------- impersonate
Route::get('impersonate/user/{username}', 'SuperAdminController@impersonate')->name('impersonate')->middleware(['auth', 'admin']);

Route::get('impersonate/distroy', 'SuperAdminController@distroyImpersonate')->name('impersonate.distroy')->middleware(['auth']);

// --------------- fiscal year

// change fiscal yaer is current
Route::get('/change-fiscal-year', 'Sync\FiscalYearController@changeFiscalYear');
Route::get('/update-fiscal-year', 'Sync\FiscalYearController@changeFiscalYear');
