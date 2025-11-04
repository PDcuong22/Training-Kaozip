<?php

use App\Http\Controllers\Api\AuthTokenController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function(){ return response()->json(['pong'=>true]); });
Route::post('/token', [AuthTokenController::class, 'store']);