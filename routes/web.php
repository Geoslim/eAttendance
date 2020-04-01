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
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //manage employees - admin dashboard
    Route::get('/add-employee', 'DashboardController@addEmployee');
    Route::post('/store-employee', 'DashboardController@storeEmployee');
    Route::get('/all-employees', 'DashboardController@allEmployees');
    Route::get('/view-employee/{id}', 'DashboardController@viewEmployee')->name('view-employee');
    Route::delete('/delete-employee/{employee}', 'DashboardController@deleteEmployee')->name('employee.delete');

    Route::get('/general-attendance', 'DashboardController@genAttend');

    Route::get('/designations', 'DesignationsController@index');
    Route::get('/edit-designation/{id}', 'DesignationsController@edit')->name('designation.edit');
    Route::put('/designation/{id}', 'DesignationsController@updateDesignation')->name('designation.update');
    Route::post('/designation', 'DesignationsController@storeDesignation');

    Route::put('/hr-approve/{id}', 'DashboardController@hrApprove')->name('approveuser.update');
    


    // employees dashboard
    Route::get('/staff-dashboard', 'StaffController@index')->name('staff-dashboard');
    Route::put('/updateStaffStatus/{id}', 'StaffController@updateStaffStatus')->name('updateStaffStatus');

    Route::post('/step-out', 'StepInOutController@stepOut')->name('step.out');

});



