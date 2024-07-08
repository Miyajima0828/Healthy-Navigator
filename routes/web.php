<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MealController;
use App\Livewire\InsertMealPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/insert-meal', InsertMealPage::class)->name('meal.index');
    Route::post('/insert-meal', [MealController::class, 'create'])->name('meal.create');
});
