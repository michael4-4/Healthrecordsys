<?php

use App\Http\Controllers\AuthAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/authAPI/login", [AuthAPI::class , "login"]);

Route::get("/",function(){
    return "Healthrecordsys API";
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
