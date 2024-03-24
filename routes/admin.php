<?php

use App\Http\Controllers\AdminController; 
use App\Http\Middleware\IsAdmin;

//admin section
Route::get('loginPage', [AdminController::class, 'loginPage'])->name('adminLogin');
Route::post('login', [AdminController::class, 'login']);
Route::get('logout', [AdminController::class, 'logout']);

Route::get('settingsPanel', [AdminController::class, 'settingsPanel'])->name('settingsPanel')->middleware(IsAdmin::class);
Route::post('saveSettings', [AdminController::class, 'saveSettings'])->middleware(IsAdmin::class);
Route::get('editImageForm/{id}', [AdminController::class, 'editImageForm'])->middleware(IsAdmin::class);

Route::post('addImage', [AdminController::class, 'addImage'])->middleware(IsAdmin::class);
Route::get('deleteImage/{id}', [AdminController::class, 'deleteImage'])->middleware(IsAdmin::class);
Route::post('editImage/{id}', [AdminController::class, 'editImage'])->middleware(IsAdmin::class);
Route::get('getImage/{id}', [AdminController::class, 'getImage'])->middleware(IsAdmin::class);
Route::get('imagesPanel', [AdminController::class, 'imagesPanel'])->name('imagesPanel')->middleware(IsAdmin::class);