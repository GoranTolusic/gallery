<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

//Page section
Route::get('/', [PageController::class, 'home']);
Route::get('/pictures', [PageController::class, 'pictures']);
Route::get('/picture/{id}', [PageController::class, 'picture']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::post('/contactMe', [PageController::class, 'contactMe']);

Route::prefix('admin')->group(function () {
    include 'admin.php';
});


