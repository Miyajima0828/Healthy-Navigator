<?php

namespace App\Livewire\Home;

use App\Models\Goal;
use App\Services\Goal\GetGoalServiceInterface;
use App\Services\Meal\GetMealServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Carbon\Carbon;
use Livewire\Component;

class TodaysNutritionIntakeComponent extends Component
{
    public Collection $meals;
    public SupportCollection $totalNutrition;
    public Goal $goal;
    protected GetMealServiceInterface $getMealService;
    protected GetGoalServiceInterface $getGoalService;

    public function mount()
    {
        $this->meals = $this->GetMealService->getMealRecords(Carbon::today());
        $this->totalNutrition = $this->getTodaysNutrition();
        $this->goal = $this->GetGoalService->getGoal();
    }

    /**
     * サービスクラスをDIするメソッド
     * @param GetMealServiceInterface $getMealService
     */
    public function boot(GetMealServiceInterface $getMealService, GetGoalServiceInterface $getGoalService)
    {
        $this->GetMealService = $getMealService;
        $this->GetGoalService = $getGoalService;
    }

    /**
     * 今日の摂取量を取得するメソッド
     * @return SupportCollection
     */
    public function getTodaysNutrition()
    {
        return collect([
            'total_calorie' => $this->GetMealService->calculateNutrientSum($this->meals,'calorie'),
            'total_protein' => $this->GetMealService->calculateNutrientSum($this->meals,'protein'),
            'total_fat' => $this->GetMealService->calculateNutrientSum($this->meals,'fat'),
            'total_carbohydrate' => $this->GetMealService->calculateNutrientSum($this->meals,'carbohydrate'),
        ]);
    }
    public function render()
    {
        return view('livewire.home.todays-nutrition-intake-component');
    }
}
