<?php

use Illuminate\Http\Request;

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


Route::any('login','MobileAppController@login');
Route::any('history','MobileAppController@history');
Route::any('redeem', 'MobileAppController@redeem');
Route::any('post_transaction', 'MobileAppController@post_transaction');
Route::any('qr_scan', 'MobileAppController@scanQR');
