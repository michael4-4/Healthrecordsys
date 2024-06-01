<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthAPI;
use App\Http\Controllers\test1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return "shit";
});

Route::post("/login", [APIController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
