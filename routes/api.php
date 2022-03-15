<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;


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


//create a Category route
Route::post('/create-category', [CategoryController::class, 'createCategory']);
//-----------------------------------------------------------------------------

//read all categories
Route::get('/categories', [CategoryController::class, 'getCategories']);
//-----------------------------------------------------------------------------

//find category by id and get all it's transactions
Route::get('/category-transactions/{id}', [CategoryController::class, 'getCategoryTransactions']);
//-----------------------------------------------------------------------------

//update a Category 
Route::put('/update-category/{id}', [CategoryController::class, 'updateCategory']);
//-----------------------------------------------------------------------------

//Delete a Category by id
Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);
//-----------------------------------------------------------------------------
