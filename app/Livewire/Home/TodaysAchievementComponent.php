<?php

namespace App\Livewire\Home;

use App\Models\Goal;
use App\Services\Goal\GetGoalServiceInterface;
use Carbon\Carbon;
use App\Services\Meal\GetMealServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TodaysAchievementComponent extends Component
{
    public Collection $meals;
    public Goal $goal;
    public  $nutrientAchievement;
    protected GetMealServiceInterface $GetMealService;
    protected GetGoalServiceInterface $GetGoalService;

    public function mount()
    {
        $this->meals = $this->GetMealService->getMealRecords(Carbon::today());
        $this->goal = $this->GetGoalService->getGoal();
        $this->nutrientAchievement = $this->generateNutrientAchievementJson();
    }

    /**
     * サービスクラスをDIするメソッド
     * @param GetMealServiceInterface $GetMealService
     */
    public function boot(GetMealServiceInterface $GetMealService, GetGoalServiceInterface $GetGoalService)
    {
        $this->GetMealService = $GetMealService;
        $this->GetGoalService = $GetGoalService;
    }

    public function generateNutrientAchievementJson()
    {
        return json_encode([
            round($this->GetMealService->calculateNutrientSum($this->meals, 'calorie') / $this->goal->calorie * 100),
            round($this->GetMealService->calculateNutrientSum($this->meals, 'protein') / $this->goal->protein * 100),
            round($this->GetMealService->calculateNutrientSum($this->meals, 'fat') / $this->goal->fat * 100),
            round($this->GetMealService->calculateNutrientSum($this->meals, 'carbohydrate') / $this->goal->carbohydrate * 100)
        ]);
    }

    public function render()
    {
        return view('livewire.home.todays-achievement-component');
    }
}
