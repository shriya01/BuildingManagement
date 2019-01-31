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


// User routes
Route::group(['middleware' => ['web']], function () {
	// Admin User Login routes
Route::get('/', 'AdminController@getLogin');
Route::post('/', 'AdminController@postLogin');
    // User register routes
Route::get('/register', 'UserController@register');
Route::post('/register', ['as'=>'register','uses'=>'UserController@userRegister']);
    // User welcome route
Route::get('/welcome', 'UserController@index');
    // User show maintenance
Route::get('/userrMaintenance/{id?}/{user_id?}', ['as'=>'userrMaintenance','uses'=>'UserController@userrMaintenance']);

// Admin Dashboard 
Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index']);

Route::get('dashboard/queryData', 'DashboardController@users');
Route::get('dashboard/show', 'DashboardController@showmaintenance');
// Admin Dashboard show maintenance list Add edit route for maintenance
Route::get('/showMaintenance/{id?}', ['as'=>'showmaintenance','uses'=>'DashboardController@showmaintenance']);
    // Admin Dashboard Add user
Route::get('/addMaintenance/{id?}/{user_id?}', ['as'=>'addmaintenance','uses'=>'DashboardController@addMaintenance']);
    // Admin Dashboard Edit user
Route::get('/editmaintenance/{user_id?}', ['as'=>'editmaintenance','uses'=>'DashboardController@editMaintenance']);
    // Admin Dashboard Post user
Route::post('/addMaintenance/{id?}/{user_id?}', ['as'=>'editmaintenance','uses'=>'DashboardController@postMaintenence']);
// Admin Dashboard delete user
Route::get('/logout','DashboardController@getLogout');
// Admin Excel for user list
Route::get('downloadExcel/{type}', 'DashboardController@downloadExcel');
// Admin for maintenance list
Route::get('downloadExcel/{type}/{id?}', 'DashboardController@downloadMaintenanceExcel');
// Admin for imfort file
Route::post('importExcel', 'DashboardController@importExcel');
// Flat Maintenance Master Table Routes For CRUD Operations
Route::get('/maintenanceMaster', ['as'=>'maintenanceMaster','uses'=>'DashboardController@maintenanceMaster']);
Route::get('/addMaintenanceMaster/{user_id?}', ['as'=>'addMaintenanceMaster','uses'=>'DashboardController@getMaintenanceMaster']);
Route::post('/addMaintenanceMaster/{user_id?}', ['as'=>'editMaintenanceMaster','uses'=>'DashboardController@postMaintenanceMaster']);
Route::get('/deleteMastere/{user_id?}', ['as'=>'delete','uses'=>'DashboardController@deleteMaintenanceMastere']);
// Flat Type Master Table Routes For CRUD Operations
Route::get('/flatType', ['as'=>'flatType','uses'=>'DashboardController@flatType']);
Route::get('/addFlatType/{user_id?}', ['as'=>'addFlatType','uses'=>'DashboardController@getFlatType']);
Route::post('/addFlatType/{user_id?}', ['as'=>'editFlatType','uses'=>'DashboardController@postFlatType']);
Route::get('/delete/{user_id?}', ['as'=>'delete','uses'=>'DashboardController@deleteFlatType']);
// Admin flats master CRUD
Route::get('/flats', ['as'=>'flats','uses'=>'DashboardController@flats']);
Route::get('/addFlat/{user_id?}', ['as'=>'addFlat','uses'=>'DashboardController@getFlat']);
Route::post('/addFlat/{user_id?}', ['as'=>'addFlat','uses'=>'DashboardController@postFlat']);
Route::post('/deleteUser','DashboardController@deleteUser');

Route::get('/showMaintenanceTransactionList', ['as'=>'showMaintenanceTransactionList','uses'=>'DashboardController@showMaintenanceTransactionList']);
Route::get('/addMaintenanceTransaction/{year}/{month}', ['as'=>'addMaintenanceTransaction','uses'=>'DashboardController@addMaintenanceTransaction']);

Route::get('/monthlyTransactionList', ['as'=>'monthlyTransactionList','uses'=>'DashboardController@monthlyTransactionList']);
Route::get('/monthlyExpences', ['as'=>'monthlyExpences','uses'=>'DashboardController@monthlyExpences']);
Route::post('/paid','DashboardController@paidmaintenanceTransaction');
Route::get('/addMonthlyExpense', ['as'=>'addMonthlyExpense','uses'=>'DashboardController@addMonthlyExpense']);
Route::post("addMoreMonthlyExpense","DashboardController@addMoreMonthlyExpense")->name('addMoreMonthlyExpense');
Route::get('/addMaintenanceTransaction', ['as'=>'addMaintenanceTransaction','uses'=>'DashboardController@addMaintenanceTransaction']);
Route::post('flats/getflattype', 'DashboardController@changeflattype')->name('flats/getflattype');
Route::post('showmonthlytransaction', 'DashboardController@showMonthlyTransaction')->name('showmonthlytransaction');
Route::post('showMonthlyExpenses', 'DashboardController@showMonthlyExpenses')->name('showMonthlyExpenses');
Route::get('generate-pdf/{flat_number?}/{month?}/{email_send?}','DashboardController@generateAndEmailPDF');
});
});