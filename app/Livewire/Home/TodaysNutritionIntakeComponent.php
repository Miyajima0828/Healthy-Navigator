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
    public ?Goal $goal;
    protected GetMealServiceInterface $getMealService;
    protected GetGoalServiceInterface $getGoalService;
    // ビューの名前
    const VIEW_NAME = 'livewire.home.todays-nutrition-intake-component';

    public function mount()
    {
        $this->meals = $this->getMealService->getMealRecords(Carbon::today());
        $this->totalNutrition = $this->getTodaysNutrition();
        $this->goal = $this->getGoalService->getGoal();
    }

    /**
     * サービスクラスをDIするメソッド
     * @param GetMealServiceInterface $getMealService
     */
    public function boot(GetMealServiceInterface $getMealService, GetGoalServiceInterface $getGoalService)
    {
        $this->getMealService = $getMealService;
        $this->getGoalService = $getGoalService;
    }

    /**
     * 今日の摂取量を取得するメソッド
     * @return SupportCollection
     */
    public function getTodaysNutrition()
    {
        return collect([
            'total_calorie' => $this->getMealService->calculateNutrientSum($this->meals,'calorie'),
            'total_protein' => $this->getMealService->calculateNutrientSum($this->meals,'protein'),
            'total_fat' => $this->getMealService->calculateNutrientSum($this->meals,'fat'),
            'total_carbohydrate' => $this->getMealService->calculateNutrientSum($this->meals,'carbohydrate'),
        ]);
    }
    public function render()
    {
        return view(self::VIEW_NAME);
    }
}
