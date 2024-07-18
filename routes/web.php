<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome_page');

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::get('signup', 'signup')->name('signup')->middleware(ValidUser::class);

    Route::get('employee_details/{id}','employeeDetails')->name('employee_details')->middleware(ValidUser::class);
    Route::post('employeeDetailsSave/{id}','employeeDetailsSave')->name('employeeDetailsSave')->middleware(ValidUser::class);
    
    Route::get('dashboard', 'dashboardPage')->name('dashboard');
    Route::get('logout', 'logout')->name('logout');
    Route::post('registrationSave','registration')->name('registrationSave')->middleware(ValidUser::class);
    Route::post('registrationAdmin','registrationAdmin')->name('registrationAdmin')->middleware(ValidUser::class);
    Route::post('loginMatch','loginMatch')->name('loginMatch');
    Route::get('employee_list','employee_list')->name('employee_list')->middleware(ValidUser::class);

    //Employee details route
    Route::get('/deleteEmployee/{id}','deleteEmployee')->name('deleteEmployee')->middleware(ValidUser::class);
    Route::get('/UpdateEmployeePage/{id}','UpdateEmployeePage')->name('UpdateEmployeePage')->middleware(ValidUser::class);
    Route::post('/updateEmployee/{id}','updateEmployee')->name('updateEmployee')->middleware(ValidUser::class);

    // Employee Position
    Route::get('employee_position','employee_position')->name('employee_position')->middleware(ValidUser::class);
    Route::get('position_details','position_details')->name('position_details')->middleware(ValidUser::class);
    Route::post('positionSave','positionSave')->name('positionSave')->middleware(ValidUser::class);

    //Attendence route
    Route::get('attendence','attendence')->name('attendence')->middleware(ValidUser::class);
    Route::post('EmployeeAttendenceSave','EmployeeAttendenceSave')->name('EmployeeAttendenceSave')->middleware(ValidUser::class);

    //payroll
    Route::get('countMonthlySellary','countMonthlySellary')->name('countMonthlySellary')->middleware(ValidUser::class);
    Route::post('paymentCountResult','paymentCountResult')->name('paymentCountResult')->middleware(ValidUser::class);
    Route::post('/pay_monthly_bill/{employee}','pay_monthly_bill')->name('pay_monthly_bill')->middleware(ValidUser::class);

});

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Reset Password Routes
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
