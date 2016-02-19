<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// originate from this app
Route::get('/', 'FrameController@index');
Route::get('/iep', 'FrameController@iep');
Route::post('/iep', 'FrameController@save');
Route::post('/iep/print', 'FrameController@print');
Route::post('/iep/delete', 'FrameController@delete');
Route::post('/iep/activate', 'FrameController@activate');
Route::get('/iep/print-test', 'FrameController@printTest');
Route::get('/iep/response-count', 'FrameController@responseCount');

// originate from powerschool
Route::post('/iep/update', 'PowerSchoolController@update');
Route::get('/iep/data', 'PowerSchoolController@getIepData');
Route::post('/iep/attach', 'PowerSchoolController@attachResponse');


// Legacy routes
Route::any('/print-pdf', 'BaseController@printPdf');
Route::any('/get-blanks', 'BaseController@getBlanks');
Route::any('/print-blanks', 'BaseController@printBlanks');
Route::get('/token', 'BaseController@token');

// learning center
Route::get('/learning', function() {
  return view('learning.index');
});
