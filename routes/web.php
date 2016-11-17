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
Route::get('/learning', function () {
    return view('learning.index');
});
