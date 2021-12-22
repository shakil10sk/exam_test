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

// --------------- full table sync ------------------
Route::post('/sync/bd-location', 'SynController@syncBdLoaction');
Route::post('/sync/allowance', 'SynController@syncAllowance');
Route::post('/sync/employees', 'SynController@syncEmployees');
Route::post('/sync/projects', 'SynController@syncProjects');
Route::post('/sync/union-information', 'SynController@syncUnionInformation');
Route::post('/sync/report', 'SynController@syncReport');

Route::post('/sync/committee', 'SynController@syncCommittee');
Route::post('/sync/committee-type', 'SynController@syncCommitteeType');
Route::post('/sync/committee-member', 'SynController@syncComMember');

Route::post('/sync/letter', 'SynController@syncLetter');
Route::post('/sync/asset-register', 'SynController@syncAssetRegister');
Route::post('/sync/attendance', 'SynController@syncAttendance');

// ---------------- process sync -----------------------

Route::post('/sync/public-service/certificate', 'SynController@syncPublicServiceCertificate');
Route::post('/sync/public-service/application', 'SynController@syncPublicServiceApplication');
