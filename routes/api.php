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

// Auth
Route::namespace('App\Http\Controllers')->group(function () {
    Route::post('signin', 'UserController@signIn');   //Login
    Route::post('signup', 'UserController@signUp');   //Signup
    Route::post('account', 'UserController@signUpAccount');   //Signup
    Route::get('user/init',"UserController@ifHasTokenValidation");
});

Route::namespace('App\Http\Controllers') -> group(function(){
    Route::get('department/public', "DepartmentController@publicSelection");
});

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::namespace('App\Http\Controllers')->group(function(){
        
        // Department Module
        Route::get('department', "DepartmentController@index");
        Route::get('department/{id}', "DepartmentController@show");
        Route::put('department', "DepartmentController@update");
        Route::post('department/bb', "DepartmentController@importDepartmentFromBizzBox");
        Route::delete('department/{id}', "DepartmentController@destroy");

        // Role Module
        Route::get('role', "RoleController@index");
        Route::post('role', "RoleController@store");
        Route::get('role/{id}', "RoleController@show");
        Route::put('role', "RoleController@update");
        Route::delete('role/{id}', "RoleController@destroy");
    
        // Procurement Module
        Route::get('procurement', "ProcurementController@index");
        Route::post('procurement', "ProcurementController@store");
        Route::get('procurement/{id}', "ProcurementController@show");
        Route::put('procurement', "ProcurementController@update");
        Route::delete('procurement/{id}', "ProcurementController@destroy");
    
        // Procurement Module
        Route::post('purchaserequest/bb', "PurchaseRequestController@importPurchaseRequestFromBizzBox");
        Route::get('purchaserequest', "PurchaseRequestController@index");
        Route::post('purchaserequest', "PurchaseRequestController@store");
        Route::get('purchaserequest/{id}', "PurchaseRequestController@show");
        Route::put('purchaserequest', "PurchaseRequestController@update");
        Route::delete('purchaserequest/{id}', "PurchaseRequestController@destroy");
    
        //User
        Route::get('user',"UserController@index");
        Route::get('user/{id}', "UserController@show");
        Route::put('user/{id}', "UserController@update");
        Route::put('user/reset', "UserController@changePassword");
        Route::put('user/Account', "UserController@updateAccount");
        Route::delete('user/logout', "UserController@logout");
        Route::delete('user/{id}', "UserController@destroy");

        //Item 
        Route::get('item', "ItemController@index");
        Route::post('item', "ItemController@store");
        Route::get('item/{id}', "ItemController@show");
        Route::put('item', "ItemController@update");
        Route::delete('item/{id}', "ItemController@delete");

        //Logs
        Route::get('logs',"LogsController@index");
        Route::post('logs',"LogsController@store");
        Route::get('logs/{id}',"LogsController@show");
        Route::put('logs',"LogsController@update");
        Route::delete('logs',"LogsController@destroy");
    });
});