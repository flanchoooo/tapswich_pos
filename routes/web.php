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

//Companies Controllers
Route::get('/companies/display','CompaniesController@display')->name('compaedit_user_type_profilenies');
Route::get('/companies/creates','CompaniesController@view')->name('createview');
Route::post('/companies/create','CompaniesController@create');
Route::post('/company/edit','CompaniesController@edit');
Route::post('/companies/update','CompaniesController@update');

//Employees
Route::post('/employees/display','EmployeesController@display')->name('employees');
Route::any('/employees/create','EmployeesController@view')->name('create_employee');
Route::any('/employees/creates_','EmployeesController@creates_')->name('new');
Route::any('/employees/creates','EmployeesController@creates');
Route::any('/employees/edit','EmployeesController@view');
Route::any('/employees/update','EmployeesController@update');

//User & Permissions
Route::any('/permissions/display','PermissionsController@display');
Route::any('/permissions/create','PermissionsController@view')->name('create_user_type');
Route::any('permissions/creates', 'PermissionsController@creates')->name('create_user_type_profile');
Route::any('permissions/edit', 'PermissionsController@edit')->name('edit_user_type_profile');
Route::any('permissions/update', 'PermissionsController@update')->name('update_user_type_profile');

//Access
Route::any('/access/display','AccessController@display');
Route::any('/access/create','AccessController@view')->name('create_access_profile');
Route::any('/access/creates','AccessController@creates')->name('create_access');
Route::any('/access/edit','AccessController@edit')->name('edit_access_profile');
Route::any('/access/update','AccessController@update')->name('update_access');


//Product Controllers
Route::any('/products/display','ProductController@display');
Route::any('/products/create','ProductController@view')->name('create_product');
Route::any('/products/creates','ProductController@creates');
Route::any('/products/edit','ProductController@edit');
Route::any('/products/update','ProductController@update');


//Fleet Management
Route::any('/fleet/display','FleetController@display');
Route::any('/fleet/create','FleetController@view')->name('create_car_profile');
Route::any('/fleet/creates','FleetController@creates');
Route::any('/fleet/edit','FleetController@edit');
Route::any('/fleet/update','FleetController@update');

//Order
Route::any('/order/order','OrderController@view');
Route::any('/order/create','OrderController@create');
Route::any('/order/cancel','OrderController@cancel');
Route::any('/order/display','OrderController@display');
Route::any('/order/auth','OrderController@auth');
Route::any('/order/declined','OrderController@declined');
Route::any('/order/approve','OrderController@approve');


//Dealer Management
Route::any('/dealers/display','DealerController@display');
Route::any('/dealers/create','DealerController@create');
Route::any('/dealers/view','DealerController@view')->name('create_dealers');
Route::any('/order/reports','OrderController@auth_reports');


//Order
Route::any('/float/view','FloatController@view');
Route::any('/float/management','FloatController@value_management');
Route::any('/float/search','FloatController@search');
Route::any('/float/updates','FloatController@updates');
Route::any('/float/deposit','FloatController@deposit')->name('topup');
Route::any('/float/adjustment','FloatController@adjustment')->name('adjustment');
Route::any('/float/deposits','FloatController@deposits');
Route::any('/float/deposits/transact','FloatController@transact');
Route::any('/management/decline','FloatController@decline');
Route::any('/management/approve','FloatController@approve');
Route::any('/management/approve','FloatController@approve');
Route::any('/management/adjust','FloatController@adjust');
Route::any('/float/adjust/management','FloatController@adjust_management');
Route::any('/management/adjustment/process','FloatController@process_adjustment');

//Reports
Route::any('/reports/view','ReportsController@view');
Route::any('/reports/search','ReportsController@search');
Route::any('/reports/position','ReportsController@position');

//Bulk
Route::any('/bulk/display','BulkController@display');
Route::any('/bulk/upload/view','BulkController@upload_view')->name('upload_file');
Route::any('/bulk/upload','BulkController@upload');
Route::any('/bulk/authorize','BulkController@authorize_transaction');
Route::any('/bulk/decline','BulkController@decline');
Route::any('/bulk/search','Bulkcontroller@search');
Route::any('/bulk/reports','Bulkcontroller@reports');
Route::any('bulk/employee','Bulkcontroller@employee');
Route::any('/bulk/settle','Bulkcontroller@settle');

//
Route::any('/notify/send','TwillioController@send');



Route::any('/dealer/reports','DealerController@reports');


Route::any('/acquired/search','AcquiredTransactionsController@view');
Route::any('/acquired/display','AcquiredTransactionsController@display');

Route::any('/issued/search','IssuedController@view');
Route::any('/issued/display','IssuedController@display');





Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
