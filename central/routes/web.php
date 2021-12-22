<?php

use App\Models\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
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

// ------------------- Dashboard ----------------- //
Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('dashboard', function () {
    return redirect('/');
});

Route::get('/home', function () {
    return redirect('/');
})->name('home');

// Upazila dashboard 
Route::get('/district/{id}','DashboardController@district')->name('dashboard.district');

// Upazila dashboard 
Route::get('/upazila/{id}','DashboardController@upazila')->name('dashboard.upazila');
Route::get('upazila/allowance/{id}','DashboardController@allowance')->name('dashboard.allowance');


// ------------------ Login --------------------- //
Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::post('/login', 'Auth\LoginController@login')->name('login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('auth');

// password reset
Route::post('/password-reset', 'Auth\ResetPasswordController@reset')->name('password-reset')->middleware('auth');

// ------------------- Admin ------------------ // 
Route::group(['prefix' => 'admin'], function () {
    Route::get('/create', 'Auth\RegisterController@showRegistrationForm')->name('admin.create');
    Route::post('/create', 'Auth\RegisterController@register')->name('admin.create.post');
});

// -------------------- User --------------------- //
// url : user
User::routes();

// -------------------- Reports --------------------- //
// Daily report
Route::get('report/daily-report/', 'ReportController@dailyReport')->name('report.daily');
Route::get('report/allowance/', 'ReportController@allowanceReport')->name('report.allowance');
Route::get('report/attendance/', 'ReportController@attendanceReport')->name('report.attendance');
Route::get('report/attendance/get-employee-list', 'ReportController@getEmployeeList')->name('report.employee-list');

Route::get('asset-register', 'ReportController@assetRegister')->name('asset.register');


// ------------------------ Reports and Register --------------------- //
Route::get('report-register/projects', 'ReportRegisterController@project')->name('report-register.project');
Route::get('report-register/{type}', 'ReportRegisterController@reportResgister')->name('report-register.reportResgister');

// ---------------------- Letters --------------------- //
Route::get('latter/letter-send', 'ReportController@letterSend')->name('letter.send');
Route::get('latter/letter-receive', 'ReportController@letterReceive')->name('letter.receive');

// ----------------------- Common Controller ---------------------- // 
Route::get('committee','CommonController@memberList')->name('member_list');


Route::get('/demo', function () {
    return view('porisod_member_list');
});

// ================= Sync ===================== //
// sync app table structure
Route::get('sync-table','SyncTableStructureController@handle');

