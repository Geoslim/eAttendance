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

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', 'HomeController@index');

Auth::routes([
    'register' => false,
    'reset' => false
  ]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
 
    // admin access
    Route::get('/dashboard', 'dashboardController@index')->name('dashboard');

    //manage staff
    Route::get('/add-staff', 'dashboardController@addStaff');
    Route::post('/store-staff', 'dashboardController@storeStaff');
    Route::get('/all-staff', 'dashboardController@allStaff');
    Route::get('/general-attendance', 'dashboardController@genAttend');
    
    // staff dashboard
    Route::get('/staff-dashboard', 'StaffController@index')->name('staff-dashboard');
    Route::put('/updateStaffStatus/{id}', 'StaffController@updateStaffStatus')->name('updateStaffStatus');

});



