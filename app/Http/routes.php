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

Route::any('/', 'BaseController@index');

Route::any('/print-pdf', 'BaseController@printPdf');

Route::any('/get-blanks', 'BaseController@getBlanks');

Route::any('/print-blanks', 'BaseController@printBlanks');

Route::get('/token', 'BaseController@token');
