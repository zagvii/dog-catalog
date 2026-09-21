<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreedCatalogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/breeds', [
    BreedCatalogController::class,
    'index'
])->name('breeds.index');