<?php

use App\api\Controllers\CategoryController;
use App\api\Controllers\OrderController;
use App\api\Controllers\ProductController;

return [
    '/product' => ProductController::class,
    '/category' => CategoryController::class,
    '/order' => OrderController::class
];