<?php

namespace App\Livewire\Home;

use App\Services\Meal\GetMealServiceInterface;
use Illuminate\Support\Collection;
use Livewire\Component;

class YesterdaysMealRecordComponent extends Component
{
    public Collection $yesterdaysMeals;
    protected GetMealServiceInterface $getMealService;

    public function mount()
    {
        $meals = $this->getMealService->getMealRecords(now()->copy()->subDay());
        $this->yesterdaysMeals = collect([
            '朝食' => $meals->where('meal_type', '朝食')->first(),
            '昼食' => $meals->where('meal_type', '昼食')->first(),
            '夕食' => $meals->where('meal_type', '夕食')->first(),
            '間食' => $meals->where('meal_type', '間食')->first(),
        ]);
    }

    /**
     * サービスクラスをDIするメソッド
     * @param GetMealServiceInterface $getMealService
     */
    public function boot(GetMealServiceInterface $getMealService)
    {
        $this->getMealService = $getMealService;
    }

    public function render()
    {
        return view('livewire.home.yesterdays-meal-record-component');
    }
}
