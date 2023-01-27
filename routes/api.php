<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('App\Http\Controllers')->group(function(){
    // Department Module
    Route::get('department', "DepartmentController@index");
    Route::get('department/public', "DepartmentController@publicSelection");
    Route::post('department/bb', "DepartmentController@importDepartmentFromBizzBox");
    Route::get('department/{id}', "DepartmentController@show");
    Route::put('department', "DepartmentController@update");
    Route::delete('department', "DepartmentController@destroy");

    // Role Module
    Route::get('role', "RoleController@index");
    Route::post('role', "RoleController@store");
    Route::get('role/{id}', "RoleController@show");
    Route::put('role', "RoleController@update");
    Route::delete('role', "RoleController@destroy");

    // Procurement Module
    Route::get('procurement', "ProcurementController@index");
    Route::post('procurement', "ProcurementController@store");
    Route::get('procurement/{id}', "ProcurementController@show");
    Route::put('procurement', "ProcurementController@update");
    Route::delete('procurement', "ProcurementController@destroy");

    // Procurement Module
    Route::post('purchaserequest/bb', "PurchaseRequestController@importPurchaseRequestFromBizzBox");
    Route::get('purchaserequest', "PurchaseRequestController@index");
    Route::post('purchaserequest', "PurchaseRequestController@store");
    Route::get('purchaserequest/{id}', "PurchaseRequestController@show");
    Route::put('purchaserequest', "PurchaseRequestController@update");
    Route::delete('purchaserequest', "PurchaseRequestController@destroy");
});