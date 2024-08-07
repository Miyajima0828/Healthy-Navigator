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
    public ?Goal $goal;
    public string  $nutrientAchievement;
    protected GetMealServiceInterface $getMealService;
    protected GetGoalServiceInterface $getGoalService;
    // ビューの名前
    const VIEW_NAME = 'livewire.home.todays-achievement-component';

    public function mount()
    {
        $this->meals = $this->getMealService->getMealRecords(Carbon::today());
        $this->goal = $this->getGoalService->getGoal();
        $this->nutrientAchievement = $this->generateNutrientAchievementJson();
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

    public function generateNutrientAchievementJson()
    {
        return $this->goal ? json_encode([
            $this->goal->calorie ? round($this->getMealService->calculateNutrientSum($this->meals, 'calorie') / $this->goal->calorie * 100) : 0,
            $this->goal->protein ? round($this->getMealService->calculateNutrientSum($this->meals, 'protein') / $this->goal->protein * 100) : 0,
            $this->goal->fat ? round($this->getMealService->calculateNutrientSum($this->meals, 'fat') / $this->goal->fat * 100) : 0,
            $this->goal->carbohydrate ? round($this->getMealService->calculateNutrientSum($this->meals, 'carbohydrate') / $this->goal->carbohydrate * 100) : 0
        ]) : '';
    }

    public function render()
    {
        return view(self::VIEW_NAME);
    }
}
