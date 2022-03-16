<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/profit-goals', [Profit_goal_controller::class, 'showall']);
Route::get('/profit-goal/{id}', [Profit_goal_controller::class, 'show']);

Route::post('/profit-goal-create', [Profit_goal_controller::class, 'create']);

Route::put('/profit-goal-update/{id}', [Profit_goal_controller::class, 'update']);

Route::delete('/profit-goal-delete/{id}', [Profit_goal_controller::class, 'destroy']);


