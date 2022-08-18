<?php

use App\Models\Customer;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Middleware\CustomerAuth;

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



Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1','middleware'=>['auth:sanctum',AdminAuth::class]],function(){

Route::apiResource('customers',CustomerController::class);
Route::apiResource('invoices',InvoiceController::class);
});

Route::get('/customer/{$id}',[CustomerController::class,'show'])->middleware(CustomerAuth::class,AdminAuth::class);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);




Route::group(['middleware'=>['auth:sanctum',CustomerAuth::class]], function () {

 
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
   


});