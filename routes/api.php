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


// ------------------- sync routes ---------------------//

Route::post('sync/bd-location','SyncController@syncBdLoaction');
Route::post('sync/union-information','SyncController@syncUnionInformation');
Route::post('sync/employees','SyncController@syncEmployees');
Route::post('sync/allowance','SyncController@syncAllowance');

Route::post('sync/business-type','SyncController@syncBusinessType');
Route::post('sync/fiscal-year', 'SyncController@syncFiscalYear');
Route::post('sync/notice', 'SyncController@syncNotice');
Route::post('sync/slides', 'SyncController@syncSlides');
Route::post('sync/designation', 'SyncController@syncDesignation');
