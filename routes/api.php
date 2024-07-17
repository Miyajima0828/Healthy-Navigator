<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Goal\GoalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [LoginController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->group(function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::put('/goal/update', [GoalController::class, 'upsert'])->name('goal.update');
    });
