<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\TimeController;
use App\Http\Controllers\Api\FieldController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// apiResource non utilizza gia di default sia create che edit  inoltre aggiungo la show per indicare che non la  voglio

Route::apiResource('times', TimeController::class)->except(['show']);
Route::apiResource('reservations', ReservationController::class)->except(['show']);
Route::apiResource('fields', FieldController::class)->except(['show']);

