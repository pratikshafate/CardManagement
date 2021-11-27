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
/* 
Route::get('/', function () {
   return view('welcome');
}); */

Route::get('card-details','App\Http\Controllers\CardDetailsController@index');
Route::post('card-details-store','App\Http\Controllers\CardDetailsController@store')->name('card-details-store');
Route::get('card-details-destroy/{CardId}','App\Http\Controllers\CardDetailsController@destroy')->name('card-details-destroy');
Route::get('/cardDetailsEdit/update/{CardId}','App\Http\Controllers\CardDetailsController@update')->name('card-details-edit');