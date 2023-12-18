<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\resetPasswordController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('sendPasswordResetLink',[resetPasswordController::class,'sendPasswordResetLink']);
Route::post('resetPassword',[resetPasswordController::class,'resetPassword']);


Route::get('logout',[AuthController::class,'logout']);

//usuarios

Route::middleware('jwt.verify')->group(function(){
    Route::get('index',[userController::class,'index']);
    Route::get('show',[AuthController::class,'getaccount']);
    Route::get('refresh',[AuthController::class,'refresh']);
   
    
    
});

//productos

Route::get('/indexProduct',[ProductController::class,'index']);
Route::get('/getInfoProduct/{id}',[ProductController::class,'getInfo']);
Route::get('/showProduct/{id}',[ProductController::class,'show']);

Route::middleware(['jwt.verify','productMiddleware'])->group(function(){
    Route::post('/createProduct',[ProductController::class,'create']);
    Route::put('/updateProduct/{id}',[ProductController::class,'update']);
    Route::delete('/deleteProduct/{id}',[ProductController::class,'delete']);
    
});




