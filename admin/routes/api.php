<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Bangladesh GeoCode route group
Route::group(['prefix' => '/geo/code', 'middleware' => 'api'], function () {
    Route::get('/', [
        'uses' => 'GeoCodeController@getDistrict'
    ]);

    Route::post('/get', [
        'uses' => 'GeoCodeController@getLocation'
    ]);
});

//trade renew application
Route::group(['prefix' => '/trade_renew', 'middleware' => 'api'], function () {
    Route::post('/', [
        'uses' => 'ApiController@trade_renew'
    ]);

});

//web Application form request
Route::group(['prefix' => '/application', 'middleware' => 'api'], function () {
    Route::post('/nagorik', [
        'uses' => 'Applications\NagorikController@store'
    ]);
    Route::post('/tradelicense', [
        'uses' => 'Applications\TradelicenseController@store'
    ]);
    Route::post('/warish', [
        'uses' => 'Applications\WarishController@store'
    ]);
    Route::post('/family', [
        'uses' => 'Applications\FamilyController@store'
    ]);
    Route::post('/character', [
        'uses' => 'Applications\CharacterController@store'
    ]);
    Route::post('/bibahito', [
        'uses' => 'Applications\BibahitoController@store'
    ]);
    Route::post('/vumihin', [
        'uses' => 'Applications\VumihinController@store'
    ]);
    Route::post('/protibondi', [
        'uses' => 'Applications\ProtibondiController@store'
    ]);
    Route::post('/onumoti', [
        'uses' => 'Applications\OnumotiController@store'
    ]);
    Route::post('/sonatondhormo', [
        'uses' => 'Applications\SonatondhormoController@store'
    ]);
    Route::post('/obibahito', [
        'uses' => 'Applications\ObibahitoController@store'
    ]);
    Route::post('/mrritu', [
        'uses' => 'Applications\DeathController@store'
    ]);
    Route::post('/punobibaho', [
        'uses' => 'Applications\PunobibahoController@store'
    ]);
    Route::post('/voterid', [
        'uses' => 'Applications\VoterController@store'
    ]);
    Route::post('/onapotti', [
        'uses' => 'Applications\OnapottiController@store'
    ]);
    Route::post('/ekoinam', [
        'uses' => 'Applications\EkoinamController@store'
    ]);
    Route::post('/yearlyincome', [
        'uses' => 'Applications\YearlyincomeController@store'
    ]);
    Route::post('/prottyon', [
        'uses' => 'Applications\ProttyonController@store'
    ]);
    Route::post('/nodibanga', [
        'uses' => 'Applications\NodibangaController@store'
    ]);

    Route::post('/premises', [
        'uses' => 'Applications\PremiseslicenseController@store'
    ]);

    Route::post('/roadexcavation', [
        'uses' => 'Applications\RoadExcavationController@store'
    ]);

    Route::post('/emarot', [
        'uses' => 'Applications\EmarotController@store'
    ]);

    Route::post('/landuse', [
        'uses' => 'Applications\LandUseController@store'
    ]);

    Route::post('/newholding', [
        'uses' => 'Applications\NewholdingController@store'
    ]);

    Route::post('/holdingnamjari', [
        'uses' => 'Applications\HoldingNamjariController@store'
    ]);

    Route::post('/animal', [
        'uses' => 'Applications\AnimalController@store'
    ]);

});

//check exiting application data routes
Route::group(['prefix' => '/check/exiting/application', 'middleware' => 'api'], function () {
    Route::post('/', [
        // 'uses' => 'Applications\Check\ExitingDataController@findCitizenInformation'
        'uses' => 'Applications\Check\ExitingDataController@CheckExitingData'
    ]);
});

// return pdf data to web
Route::group(['prefix' => 'get/pdf-data/{tracking}/{union_id}/{type}/{appType}/{appDb}', 'middleware' => 'api'], function () {
    Route::get('/', [
        'uses' => 'ApiController@getPdfData'// dd($tracking,$union_id,$type);
    ]);
});

// trade pdf data
Route::get('get/trade-pdf-data/{sonod_no}/{union_id}/{fiscal_year}/{appDb}','ApiController@getTradeCertificateData');

Route::get('get/premises-pdf-data/{sonod_no}/{union_id}/{fiscal_year}/{appDb}','ApiController@getPremisesCertificateData');


//web Application form request
Route::group(['prefix' => '/', 'middleware' => 'api'], function () {
    Route::post('/nagorik', [
        'uses' => 'Applications\NagorikController@webApplly'
    ]);
    Route::post('/death', [
        'uses' => 'Applications\DeathController@webApplly'
    ]);
    Route::post('/obibahito', [
        'uses' => 'Applications\ObibahitoController@webApplly'
    ]);
    Route::post('/punobibaho', [
        'uses' => 'Applications\PunobibahoController@webApplly'
    ]);
    Route::post('/ekoinam', [
        'uses' => 'Applications\EkoinamController@webApplly'
    ]);
    Route::post('/sonaton', [
        'uses' => 'Applications\SonatondhormoController@webApplly'
    ]);
    Route::post('/prottyon', [
        'uses' => 'Applications\ProttyonController@webApplly'
    ]);
    Route::post('/nodibanga', [
        'uses' => 'Applications\NodibangaController@webApplly'
    ]);
    Route::post('/character', [
        'uses' => 'Applications\CharacterController@webApplly'
    ]);
    Route::post('/vumihin', [
        'uses' => 'Applications\VumihinController@webApplly'
    ]);
    Route::post('/yearlyincome', [
        'uses' => 'Applications\YearlyincomeController@webApplly'
    ]);
    Route::post('/protibondi', [
        'uses' => 'Applications\ProtibondiController@webApplly'
    ]);
    Route::post('/onumoti', [
        'uses' => 'Applications\OnumotiController@webApplly'
    ]);
    Route::post('/voter', [
        'uses' => 'Applications\VoterController@webApplly'
    ]);
    Route::post('/onapotti', [
        'uses' => 'Applications\OnapottiController@webApplly'
    ]);
    // Route::post('/rastakhonon', [
    //     'uses' => 'Applications\RastakhononController@webApplly'
    // ]);
    Route::post('/warish', [
        'uses' => 'Applications\WarishController@webApplly'
    ]);
    Route::post('/family', [
        'uses' => 'Applications\FamilyController@webApplly'
    ]);
    Route::post('/trade', [
        'uses' => 'Applications\TradelicenseController@webApplly'
    ]);
    Route::post('/bibahito', [
        'uses' => 'Applications\BibahitoController@webApplly'
    ]);
});


