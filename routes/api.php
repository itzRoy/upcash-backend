<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecurringController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Profit_goal_controller;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return "hello there";
});

//recuring routes

Route::resource('recurring', recurringController::class);

//Admin routes

Route::resource('admin', AdminController::class);

//currency routes

Route::resource('currency', CurrencyController::class);


// Category CRUD route
Route::resources(['/categories' => CategoryController::class]);
Route::get('/categoriesTransactions', [CategoryController::class, 'categoriesTransactions']);
Route::get('/create-transaction/{id}', [TransactionController::class, 'makeTransaction']);

//show profit goals
Route::resources(['profit-goals'=> Profit_goal_controller::class]);
