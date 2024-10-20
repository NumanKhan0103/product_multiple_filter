<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::post('/filter', [ProductController::class, 'filter']);

