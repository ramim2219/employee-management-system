<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome_page');


Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::get('signup', 'signup')->name('signup')->middleware(ValidUser::class);
    Route::get('make_admin', 'make_admin')->name('make_admin');
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
    Route::get('/UpdatePositionPage/{id}','UpdatePositionPage')->name('UpdatePositionPage')->middleware(ValidUser::class);
    Route::post('/UpdatePosition/{id}','UpdatePosition')->name('UpdatePosition')->middleware(ValidUser::class);
    Route::get('/position_Delete/{id}','position_Delete')->name('position_Delete')->middleware(ValidUser::class);

    //Attendence route
    Route::get('attendence','attendence')->name('attendence')->middleware(ValidUser::class);
    Route::post('EmployeeAttendenceSave','EmployeeAttendenceSave')->name('EmployeeAttendenceSave')->middleware(ValidUser::class);

    //payroll
    Route::get('countMonthlySellary','countMonthlySellary')->name('countMonthlySellary')->middleware(ValidUser::class);
    Route::post('paymentCountResult','paymentCountResult')->name('paymentCountResult')->middleware(ValidUser::class);
    Route::post('/pay_monthly_bill/{employee}','pay_monthly_bill')->name('pay_monthly_bill')->middleware(ValidUser::class);

    //task
    Route::get('give_task','give_task')->name('give_task')->middleware(ValidUser::class);
    Route::get('taskShow','taskShow')->name('taskShow');
    Route::post('saveTask','saveTask')->name('saveTask')->middleware(ValidUser::class);
    Route::post('updateTask','updateTask')->name('updateTask');
    Route::get('/tasks/{id}/updateTaskStatus','updateTaskStatus')->name('tasks.updateTaskStatus');
    Route::get('/tasks/{id}/Approve','ApproveTask')->name('tasks.Approve');
    Route::get('/tasks/{id}/Cancel','CancelTask')->name('tasks.Cancel');
    Route::get('allAssignedTasks','allAssignedTasks')->name('allAssignedTasks')->middleware(ValidUser::class);
});

//employee payment details
Route::get('/payment_details',[AuthController::class,'payment_details'])->name('payment_details');

// Forgot Password Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Reset Password Routes
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/comment/store', [PostController::class, 'commentStore'])->name('posts.comment.store');
});