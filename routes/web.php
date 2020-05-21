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
    return view('auth.login');
})->name('logs_in');

Route::any('/acquired/search','AcquiredTransactionsController@view');
Route::any('/acquired/display','AcquiredTransactionsController@display');

Route::any('/issued/search','IssuedController@view');
Route::any('/issued/display','IssuedController@display');


Route::any('/settlement/search','SettlementController@view');
Route::any('/settlement/display','SettlementController@display');

Route::any('/merchants/search','MerchantsController@view');
Route::any('/merchants/display','MerchantsController@display');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
