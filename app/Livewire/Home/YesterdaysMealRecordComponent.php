<?php

namespace App\Livewire\Home;

use App\Services\Meal\GetMealServiceInterface;
use Illuminate\Support\Collection;
use Livewire\Component;

class YesterdaysMealRecordComponent extends Component
{
    public Collection $yesterdaysMeals;
    protected GetMealServiceInterface $GetMealService;

    public function mount()
    {
        $meals = $this->GetMealService->getMealRecords(now()->copy()->subDay());
        $this->yesterdaysMeals = collect([
            '朝食' => $meals->where('meal_type', '朝食')->first(),
            '昼食' => $meals->where('meal_type', '昼食')->first(),
            '夕食' => $meals->where('meal_type', '夕食')->first(),
            '間食' => $meals->where('meal_type', '間食')->first(),
        ]);
    }

    /**
     * サービスクラスをDIするメソッド
     * @param GetMealServiceInterface $GetMealService
     */
    public function boot(GetMealServiceInterface $GetMealService)
    {
        $this->GetMealService = $GetMealService;
    }

    public function render()
    {
        return view('livewire.home.yesterdays-meal-record-component');
    }
}
