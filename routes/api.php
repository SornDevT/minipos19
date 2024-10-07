<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\TransectionController;
use App\Http\Controllers\API\BillController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::get('logout',[UserController::class,'logout']);

Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('logout',[UserController::class,'logout']);
    });


    // transection
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::post('transection/add',[TransectionController::class,'add']);
    });

    // Bill
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('bills/print/{id}',[BillController::class,'print_bill']);
    });

// Route::controller(BillController::class)->group(
//     function(){
//         Route::get('bills/print/{id}','print_bill');
//     });


// ບໍ່ມີການກວດຊອບ token
// Route::controller(StoreController::class)->group(
//     function(){
//         Route::post('store/add','add');
//     });

// ມີການກວດຊອບ token 
Route::group(["middleware"=>["auth:api"]],
    function(){
        Route::get('store',[StoreController::class,'index']);
        Route::get('store/edit/{id}',[StoreController::class,'edit']);
        Route::post('store/add',[StoreController::class,'add']);
        Route::post('store/update/{id}',[StoreController::class,'update']);
        Route::delete('store/delete/{id}',[StoreController::class,'detele']);
    });