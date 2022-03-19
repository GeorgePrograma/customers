<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;

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

//Get All customers
Route::get("customer", [CustomerController::class, "index"]);

//Get one customer
Route::get("customer/{id}", [CustomerController::class, "show"]);

//Create customer
Route::post("customer/", [CustomerController::class, "store"]);

//Delete one customer
Route::delete("customer/{customer}", [CustomerController::class, "destroy"]);


//Route::resource("/customer",CustomerController::class);