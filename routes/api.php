<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteCalculatorController;
use App\Http\Controllers\Api\ApiKeyController;


Route::post('/key-generate', [ApiKeyController::class, 'generateApiKey']);


Route::middleware(\App\Http\Middleware\ApiKeyMiddleware::class)->get('/calculate-route', [RouteCalculatorController::class, 'getRoute']);
