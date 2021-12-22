<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/geo/searchLocation', 'GeoCodeController@searchLocation');

Route::get('/', [
    'uses'  => 'FrontendController@index',
    'as'    => '/'
]);

Route::get('/application/{id}', [
    'uses'  => 'CertificateFormController@showApplicationForm',
    'as'    => 'showApplicationForm'
]);

Route::get('/contact', [
    'uses'  => 'FrontendController@contact',
    'as'    => 'contact'
]);

//employee routes
Route::get('/porichalok/{id}/{unionId}', [
    'uses'  => 'Management\Employee\MemberController@viewEmployeeProfile',
    'as'    => 'employee'
]);

//notice routes
Route::get('/allunioncouncilnotice', [
    'uses'  => 'Management\Notice\NoticeController@viewAllNotice',
    'as'    => 'all_notice'
]);

Route::get('/unioncouncilnotice/{id}', [
    'uses'  => 'Management\Notice\NoticeController@viewNotice',
    'as'    => 'notice'
]);

//union info routes
Route::get('/unioncouncilinformation', [
    'uses'  => 'FrontendController@viewUnionInfo',
    'as'    => 'unionInfo'
]);

//allowance routes
Route::get('/union/info/seba/{type}', [
    'uses'  => 'Management\Allowance\AllowanceController@viewAllowance',
    'as'    => 'allowance'
]);

//union voter routes
Route::get('/union/info/voter/list', [
    'uses'  => 'Management\Voter\VoterController@viewAllVoter',
    'as'    => 'all-voter'
]);

//this route for trade renew application
Route::get('/trade_renew', 'FrontendController@trade_renew')->name('trade_renew');


//this is for all certificate and application verify.

Route::group(['prefix' => 'verify'], function(){

    Route::get('/', 'VerifyController@application')->name('application_verify');

    //for trade license
    Route::get('/trade_application/{tracking}/{union_id}/{type}', 'VerifyController@trade_application')->name('trade_application');
    Route::get('/trade_bn/{sonod_no}/{union_id}/{fiscal_year}', 'VerifyController@trade_bn')->name('trade_bn');
    Route::get('/trade_en/{sonod_no}/{union_id}/{fiscal_year}', 'VerifyController@trade_en')->name('trade_en');


    //for warish sonod
    Route::get('/warish_application/{sonod_no}/{union_id}/{type}', 'VerifyController@warish_application')->name('warish_application');
    Route::get('/warish_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@warish_bn')->name('warish_bn');
    Route::get('/warish_en/{sonod_no}/{union_id}/{type}', 'VerifyController@warish_en')->name('warish_en');


    //for family sonod
    Route::get('/family_application/{sonod_no}/{union_id}/{type}', 'VerifyController@family_application')->name('family_application');
    Route::get('/family_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@family_bn')->name('family_bn');
    Route::get('/family_en/{sonod_no}/{union_id}/{type}', 'VerifyController@family_en')->name('family_en');

    //for nagorik sonod
    Route::get('/nagorik_application/{sonod_no}/{union_id}/{type}', 'VerifyController@nagorik_application')->name('nagorik_application');
    Route::get('/nagorik_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@nagorik_bn')->name('nagorik_bn');
    Route::get('/nagorik_en/{sonod_no}/{union_id}/{type}', 'VerifyController@nagorik_en')->name('nagorik_en');

    //for death sonod
    Route::get('/death_application/{sonod_no}/{union_id}/{type}', 'VerifyController@death_application')->name('death_application');
    Route::get('/death_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@death_bn')->name('death_bn');
    Route::get('/death_en/{sonod_no}/{union_id}/{type}', 'VerifyController@death_en')->name('death_en');

    //for obibahito sonod
    Route::get('/obibahito_application/{sonod_no}/{union_id}/{type}', 'VerifyController@obibahito_application')->name('obibahito_application');
    Route::get('/obibahito_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@obibahito_bn')->name('obibahito_bn');
    Route::get('/obibahito_en/{sonod_no}/{union_id}/{type}', 'VerifyController@obibahito_en')->name('obibahito_en');

    //for punobibaho sonod
    Route::get('/punobibaho_application/{sonod_no}/{union_id}/{type}', 'VerifyController@punobibaho_application')->name('punobibaho_application');
    Route::get('/punobibaho_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@punobibaho_bn')->name('punobibaho_bn');
    Route::get('/punobibaho_en/{sonod_no}/{union_id}/{type}', 'VerifyController@punobibaho_en')->name('punobibaho_en');

    //for ekoinam sonod
    Route::get('/ekoinam_application/{sonod_no}/{union_id}/{type}', 'VerifyController@ekoinam_application')->name('ekoinam_application');
    Route::get('/ekoinam_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@ekoinam_bn')->name('ekoinam_bn');
    Route::get('/ekoinam_en/{sonod_no}/{union_id}/{type}', 'VerifyController@ekoinam_en')->name('ekoinam_en');

    //for sonaton sonod
    Route::get('/sonaton_application/{sonod_no}/{union_id}/{type}', 'VerifyController@sonaton_application')->name('sonaton_application');
    Route::get('/sonaton_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@sonaton_bn')->name('sonaton_bn');
    Route::get('/sonaton_en/{sonod_no}/{union_id}/{type}', 'VerifyController@sonaton_en')->name('sonaton_en');

    //for prottyon sonod
    Route::get('/prottyon_application/{sonod_no}/{union_id}/{type}', 'VerifyController@prottyon_application')->name('prottyon_application');
    Route::get('/prottyon_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@prottyon_bn')->name('prottyon_bn');
    Route::get('/prottyon_en/{sonod_no}/{union_id}/{type}', 'VerifyController@prottyon_en')->name('prottyon_en');

    //for nodibanga sonod
    Route::get('/nodibanga_application/{sonod_no}/{union_id}/{type}', 'VerifyController@nodibanga_application')->name('nodibanga_application');
    Route::get('/nodibanga_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@nodibanga_bn')->name('nodibanga_bn');
    Route::get('/nodibanga_en/{sonod_no}/{union_id}/{type}', 'VerifyController@nodibanga_en')->name('nodibanga_en');


    //for character sonod
    Route::get('/character_application/{tracking}/{union_id}/{type}', 'VerifyController@character_application')->name('character_application');
    Route::get('/character_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@character_bn')->name('character_bn');
    Route::get('/character_en/{sonod_no}/{union_id}/{type}', 'VerifyController@character_en')->name('character_en');


    //for vumihin sonod
    Route::get('/vumihin_application/{sonod_no}/{union_id}/{type}', 'VerifyController@vumihin_application')->name('vumihin_application');
    Route::get('/vumihin_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@vumihin_bn')->name('vumihin_bn');
    Route::get('/vumihin_en/{sonod_no}/{union_id}/{type}', 'VerifyController@vumihin_en')->name('vumihin_en');

    //for yearlyincome sonod
    Route::get('/yearlyincome_application/{sonod_no}/{union_id}/{type}', 'VerifyController@yearlyincome_application')->name('yearlyincome_application');
    Route::get('/yearlyincome_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@yearlyincome_bn')->name('yearlyincome_bn');
    Route::get('/yearlyincome_en/{sonod_no}/{union_id}/{type}', 'VerifyController@yearlyincome_en')->name('yearlyincome_en');

    //for protibondi sonod
    Route::get('/protibondi_application/{sonod_no}/{union_id}/{type}', 'VerifyController@protibondi_application')->name('protibondi_application');
    Route::get('/protibondi_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@protibondi_bn')->name('protibondi_bn');
    Route::get('/protibondi_en/{sonod_no}/{union_id}/{type}', 'VerifyController@protibondi_en')->name('protibondi_en');

    //for onumoti sonod
    Route::get('/onumoti_application/{sonod_no}/{union_id}/{type}', 'VerifyController@onumoti_application')->name('onumoti_application');
    Route::get('/onumoti_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@onumoti_bn')->name('onumoti_bn');
    Route::get('/onumoti_en/{sonod_no}/{union_id}/{type}', 'VerifyController@onumoti_en')->name('onumoti_en');

    //for onapotti sonod
    Route::get('/onapotti_application/{tracking}/{union_id}/{type}', 'VerifyController@onapotti_application')->name('onapotti_application');
    Route::get('/onapotti_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@onapotti_bn')->name('onapotti_bn');
    Route::get('/onapotti_en/{sonod_no}/{union_id}/{type}', 'VerifyController@onapotti_en')->name('onapotti_en');

    //for voter sonod
    Route::get('/voter_application/{tracking}/{union_id}/{type}', 'VerifyController@voter_application')->name('voter_application');
    Route::get('/voter_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@voter_bn')->name('voter_bn');
    Route::get('/voter_en/{sonod_no}/{union_id}/{type}', 'VerifyController@voter_en')->name('voter_en');

    //for bibahito sonod
    Route::get('/bibahito_application/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_application')->name('bibahito_application');
    Route::get('/bibahito_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_bn')->name('bibahito_bn');
    Route::get('/bibahito_en/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_en')->name('bibahito_en');

    // for premises sonod
    Route::get('/premises_application/{sonod_no}/{union_id}/{type}', 'VerifyController@premises_application')->name('premises_application');

    Route::get('/premises_bn/{sonod_no}/{union_id}/{fiscal_year}', 'VerifyController@premises_bn')->name('premises_bn');
    Route::get('/premises_en/{sonod_no}/{union_id}/{fiscal_year}', 'VerifyController@premises_en')->name('premises_en');



    // for emarot sonod
    Route::get('/emarot_application/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_application')->name('emarot_application');
    Route::get('/emarot_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_bn')->name('emarot_bn');
    Route::get('/emarot_en/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_en')->name('emarot_en');

    // for holding namjari sonod
    Route::get('/namjari_application/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_application')->name('namjari_application');
    Route::get('/namjari_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_bn')->name('namjari_bn');
    Route::get('/namjari_en/{sonod_no}/{union_id}/{type}', 'VerifyController@bibahito_en')->name('namjari_en');

    // for holding new holding sonod
    Route::get('/newholding_application/{sonod_no}/{union_id}/{type}', 'VerifyController@newholding_application')->name('newholding_application');
    Route::get('/newholding_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@newholding_bn')->name('namjari_bn');
    Route::get('/newholding_en/{sonod_no}/{union_id}/{type}', 'VerifyController@newholding_en')->name('namjari_en');

    // for road_excavation_application sonod
    Route::get('/road_excavation_application/{sonod_no}/{union_id}/{type}', 'VerifyController@road_application')->name('road_application');

    Route::get('/roadexcavation_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@road_bn')->name('road_bn');

    Route::get('/roadexcavation_en/{sonod_no}/{union_id}/{type}', 'VerifyController@road_en')->name('road_en');

    // for land_use_application sonod
    Route::get('/land_use_application/{sonod_no}/{union_id}/{type}', 'VerifyController@land_application')->name('road_application');

    Route::get('/landuse_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@land_bn')->name('landuse_bn');

    Route::get('/landuse_en/{sonod_no}/{union_id}/{type}', 'VerifyController@land_en')->name('landuse_en');


     //for animal sonod
     Route::get('/animal_application/{sonod_no}/{union_id}/{type}', 'VerifyController@animal_application')->name('animal_application');
     Route::get('/animal_bn/{sonod_no}/{union_id}/{type}', 'VerifyController@animal_bn')->name('animal_bn');
     Route::get('/animal_en/{sonod_no}/{union_id}/{type}', 'VerifyController@animal_en')->name('animal_en');



});

// get geo locations
Route::group(['prefix' => '/geo/code', 'middleware' => 'web'], function () {
    Route::get('/', [
        'uses' => 'GeoCodeController@getDistrict'
    ]);

    Route::get('/get', [
        'uses' => 'GeoCodeController@getLocation'
    ]);
});


// ================= Sync ===================== //
// sync app table structure
Route::get('sync-table','SyncTableStructureController@handle');

