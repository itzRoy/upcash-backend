<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});




Route::get('/category-transactions/{id}', [CategoryController::class, 'getCategoryTransactions']);

Route::get('/create-category/{name}', [CategoryController::class, 'createCategory']);

Route::get('/categories', [CategoryController::class, 'getCategories']);

Route::get('/create-transaction/{id}', [TransactionController::class, 'makeTransaction']);
