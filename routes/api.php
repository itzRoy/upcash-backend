<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecurringController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Profit_goal_controller;
use App\Http\Controllers\AuthController;


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

//auth routes

Route::post('/login', [AuthController::class, 'login']);
Route::post('/addadmin', [AuthController::class, 'addAdmin']);
Route::get('/authadmin',[AuthController::class, 'authAdmin'])->middleware('auth:api');


//Admin routes
Route::resource('admin', AdminController::class);
Route::get('/getadmin/{$id}', [AdminController::class, 'getAdmin']);


//Transactions routes
Route::resource('transactions', TransactionController::class);


// Category CRUD route
Route::resources(['/categories' => CategoryController::class]);
Route::get('/categoriesTransactions', [CategoryController::class, 'categoriesTransactions']);
Route::get('/create-transaction/{id}', [TransactionController::class, 'makeTransaction']);


//currency routes
Route::resource('currency', CurrencyController::class);


//recuring routes
Route::resource('recurring', recurringController::class);



//show profit goals
Route::resources(['profit-goals'=> Profit_goal_controller::class]);

