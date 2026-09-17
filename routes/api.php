<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\BreedController;

Route::prefix('v1')->group(function () {
    Route::get('/breeds', [BreedController::class, 'index']);
});