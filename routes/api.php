<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
Route::middleware(['auth:sanctum'])->get( function (Request $request) {
    return null;
});
Route::apiResource('property', PropertyController::class)->middleware('auth:sanctum');
