<?php

use App\Http\Controllers\Meal\MealController;
use App\Livewire\Home\HomeComponent;
use App\Livewire\Meal\UpsertMealPage;
use App\Livewire\Goal\SetGoalModal;
use App\Livewire\Meal\GetMealRecordsPage;
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
    Route::get('meal/create', UpsertMealPage::class)->name('meal.create');
    Route::put('meal/store', [MealController::class, 'upsertMeal'])->name('meal.store');
    Route::put('goal/update', [SetGoalModal::class, 'upsert'])->name('goal.update');
    Route::get('meal/records', GetMealRecordsPage::class)->name('meal.records');
});
