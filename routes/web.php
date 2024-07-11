<?php

use App\Livewire\HomeComponent;
use App\Livewire\InsertMealComponent;
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
    Route::get('/home', [HomeComponent::class, 'render'])->name('home');
    Route::get('meal/create', InsertMealPage::class)->name('meal.create');
    Route::post('meal/store', [InsertMealComponent::class, 'insertMeal'])->name('meal.store');
});
