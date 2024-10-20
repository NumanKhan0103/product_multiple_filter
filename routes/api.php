<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::post('/filter', [ProductController::class, 'filter']);

// Fallback route to catch any undefined routes
Route::fallback(function (Request $request) {
    return response()->json([
        'message' => 'Route not found. Please check your request and try again.',
        'data' => null,
        'status' => 404
    ], 404);
});