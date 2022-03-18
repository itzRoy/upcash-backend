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

//user routes

Route::resource('recuring', recurringController::class);

//Admin routes

Route::resource('admin', AdminController::class);

//currency routes

Route::resource('currency', CurrencyController::class);

//create a Category route
Route::post('/create-category', [CategoryController::class, 'createCategory']);


//read all categories
Route::get('/categories', [CategoryController::class, 'getCategories']);


//find category by id and get all it's transactions
Route::get('/category-transactions/{id}', [CategoryController::class, 'getCategoryTransactions']);




Route::get('/create-transaction/{id}', [TransactionController::class, 'makeTransaction']);

//show profit goals
Route::get('/profit-goals', [Profit_goal_controller::class, 'showall']);
Route::get('/profit-goal/{id}', [Profit_goal_controller::class, 'show']);

//create new profit goal
Route::post('/profit-goal-create', [Profit_goal_controller::class, 'create']);


//update profit goal
Route::put('/profit-goal-update/{id}', [Profit_goal_controller::class, 'update']);

//delete profit goal
Route::delete('/profit-goal-delete/{id}', [Profit_goal_controller::class, 'destroy']);


