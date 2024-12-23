<?php

use App\Modules\Products\Controllers\ProductController;
use App\Modules\Products\Controllers\ProductRecommendationsController;
use Illuminate\Support\Facades\Route;

Route::get('/products', ProductController::class);

Route::get('/recommendations/{product}', ProductRecommendationsController::class);
