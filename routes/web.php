<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;


Route::get('/login',[Authentication::class, 'index']);
Route::post('/login',[Authentication::class, 'login']);

Route::get('/page/{slug}', [App\Http\Controllers\HomeController::class, 'showPage'])->name('show.page');
