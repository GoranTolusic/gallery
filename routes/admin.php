<?php

use App\Http\Controllers\AdminController; 
use App\Http\Middleware\IsAdmin;

//admin section
Route::get('loginPage', [AdminController::class, 'loginPage'])->name('adminLogin');
Route::post('login', [AdminController::class, 'login']);
Route::get('logout', [AdminController::class, 'logout']);

Route::get('settingsPanel', [AdminController::class, 'settingsPanel'])->name('settingsPanel')->middleware(IsAdmin::class);
Route::post('saveSettings', [AdminController::class, 'saveSettings'])->middleware(IsAdmin::class);

Route::post('addImage', [AdminController::class, 'addImage'])->middleware(IsAdmin::class);
Route::delete('deleteImage/{id}', [AdminController::class, 'deleteImage'])->middleware(IsAdmin::class);
Route::post('editImage/{id}', [AdminController::class, 'editImage'])->middleware(IsAdmin::class);
Route::get('imagesPanel', [AdminController::class, 'imagesPanel'])->name('imagesPanel')->middleware(IsAdmin::class);

Route::get('messages', [AdminController::class, 'messages'])->name('messages')->middleware(IsAdmin::class);
Route::post('deleteMessage/{id}', [AdminController::class, 'deleteMessage'])->name('deleteMessage')->middleware(IsAdmin::class);
Route::post('readMessage/{id}', [AdminController::class, 'readMessage'])->name('readMessage')->middleware(IsAdmin::class);