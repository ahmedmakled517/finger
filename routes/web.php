<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix("dashboard")->name("dashboard.")->group(function(){


    Route::get('/index', "Dashboard\DashboardController@index")->name("index");
    Route::resource('employee','Dashboard\EmployeeController');
    // Route::get('/setting', "Dashboard\SetingController@index")->name("setting");
    Route::get('/setting_create', "Dashboard\SetingController@create")->name("setting_create");
    Route::post('/setting_store', "Dashboard\SetingController@store")->name("setting_store");
    Route::get('/setting_edit{id}', "Dashboard\SetingController@edit")->name("setting_edit");
    Route::put('/setting_update{id}', "Dashboard\SetingController@update")->name("setting_update");
    Route::resource('official','Dashboard\OfficiallyController');
    Route::get('/regest_create', "Dashboard\RegestController@create")->name("regest_create");
    Route::post('/regest_store', "Dashboard\RegestController@store")->name("regest_store");
    Route::get('/report', "Dashboard\ReportController@index")->name("report");
    Route::get('/get_report', "Dashboard\ReportController@report")->name("get_report");
    Route::get('/resign_index', "Dashboard\ResignationController@index")->name("resign_index");
    Route::get('/resign_create', "Dashboard\ResignationController@create")->name("resign_create");
    Route::post('/resign_store', "Dashboard\ResignationController@store")->name("resign_store");
    Route::get('/emplo{id}','PrintController@index')->name('emplo');
    Route::get('/prnpriview','PrintController@prnpriview')->name('prnpriview');

});
