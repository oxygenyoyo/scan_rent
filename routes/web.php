<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::group(['prefix' => 'admin'], function () {
  

  /*
  ==================================================
  Dashboard
  ==================================================
  */
  Route::get('/', 'DashboardController@index');


  /*
  ==================================================
  Requisition
  ==================================================
  */
  Route::get('/requisition', 'RequisitionController@index');
  Route::get('/requisition/create', 'RequisitionController@create');
  Route::get('/requisition/{id}', 'RequisitionController@show');
  Route::get('/requisition/{id}/edit', 'RequisitionController@edit');
  Route::put('/requisition/{id}', 'RequisitionController@update');
  Route::post('/requisition', 'RequisitionController@store');
  Route::get('/requisition/{id}/pdf', 'RequisitionController@showPDF');
  Route::get('/requisition/{id}/genpdf', 'RequisitionController@genPDF');
  Route::get('/requisition/{id}/return', 'RequisitionController@returnScan');
  Route::get('/requisition/{id}/editReturnScan', 'RequisitionController@editReturnScan');
  
  


  /*
  ==================================================
  Scan
  ==================================================
  */
  Route::get('/scan', 'ScanController@index');
  Route::get('/scan/search', 'ScanController@search');
  Route::post('/scan', 'ScanController@store');
  Route::get('/scan/{id}/edit', 'ScanController@edit');
  Route::put('/scan/{id}', 'ScanController@update');
  Route::get('/scan/create', 'ScanController@create');
  Route::delete('/scan/{id}', 'ScanController@destroy');
  



  Route::get('testpdf', function() {

    $pdf = PDF::loadView('test');

    return $pdf->stream();
    // return view('test');

  });

});