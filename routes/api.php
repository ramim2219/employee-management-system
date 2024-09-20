<?php
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
Route::get('/employees/{positionId}', [AuthController::class, 'getEmployeesByPosition']);
