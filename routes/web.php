<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::get('signup', 'signup')->name('signup');

    Route::get('employee_details/{id}','employeeDetails')->name('employee_details');
    Route::post('employeeDetailsSave/{id}','employeeDetailsSave')->name('employeeDetailsSave');
    
    Route::get('dashboard', 'dashboardPage')->name('dashboard');
    Route::get('logout', 'logout')->name('logout');
    Route::post('registrationSave','registration')->name('registrationSave');
    Route::post('registrationAdmin','registrationAdmin')->name('registrationAdmin');
    Route::post('loginMatch','loginMatch')->name('loginMatch');
    Route::get('employee_list','employee_list')->name('employee_list');

    //Employee details route
    Route::get('/deleteEmployee/{id}','deleteEmployee')->name('deleteEmployee');
    Route::get('/UpdateEmployeePage/{id}','UpdateEmployeePage')->name('UpdateEmployeePage');
    Route::post('/updateEmployee/{id}','updateEmployee')->name('updateEmployee');


    //Attendence route
    Route::get('attendence','attendence')->name('attendence');
    Route::post('EmployeeAttendenceSave','EmployeeAttendenceSave')->name('EmployeeAttendenceSave');
});