<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;





Route::get('/', function () {
    return view('welcome');
});



//end user routes

Route::get('/category-transactions/{id}', [CategoryController::class, 'getCategoryTransactions']);

Route::get('/create-category/{name}', [CategoryController::class, 'createCategory']);

Route::get('/categories', [CategoryController::class, 'getCategories']);

Route::get('/create-transaction/{id}', [TransactionController::class, 'makeTransaction']);
