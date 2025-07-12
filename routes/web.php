<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/welcome', [ProductController::class, 'index']);
Route::get('/welcome/add', [ProductController::class, 'add_form'])->name('add');
Route::post('/welcome/save', [ProductController::class, 'save'])->name('save');
Route::get('/welcome/edit/{id}', [ProductController::class, 'edit']);
Route::post('/welcome/update', [ProductController::class, 'update'])->name('update');
Route::post('/welcome/delete', [ProductController::class, 'delete'])->name('delete');
Route::get('/importposts', [ProductController::class, 'importPosts']);