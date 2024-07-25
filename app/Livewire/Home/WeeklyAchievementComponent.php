<?php

namespace App\Livewire\Home;

use App\Services\Goal\GetGoalServiceInterface;
use Carbon\Carbon;
use App\Services\Meal\GetMealServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class WeeklyAchievementComponent extends Component
{
    public Collection $meals;
    public $weeklyGoal;
    public $weeklyNutrient;
    public $nutrientAchievement;
    protected GetMealServiceInterface $GetMealService;
    protected GetGoalServiceInterface $GetGoalService;

    public function mount()
    {
        $this->meals = $this->GetMealService->getMealRecords(Carbon::today()->copy()->startOfWeek(), Carbon::today()->copy()->endOfWeek());
        $this->weeklyGoal = collect($this->GetGoalService->getGoal())
            ->only('calorie', 'protein', 'fat', 'carbohydrate')
            ->map(function ($value) {
                return $value * 7;
            });
        $this->weeklyNutrient = [
            'calorie' => $this->GetMealService->calculateNutrientSum($this->meals, 'calorie'),
            'protein' => $this->GetMealService->calculateNutrientSum($this->meals, 'protein'),
            'fat' => $this->GetMealService->calculateNutrientSum($this->meals, 'fat'),
            'carbohydrate' => $this->GetMealService->calculateNutrientSum($this->meals, 'carbohydrate')
        ];
        $this->nutrientAchievement = $this->generateNutrientAchievementJson($this->weeklyNutrient);
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

    public function generateNutrientAchievementJson($weeklyNutrient)
    {
        return json_encode([
            round($weeklyNutrient['calorie']/ $this->weeklyGoal['calorie'] * 100),
            round($weeklyNutrient['protein'] / $this->weeklyGoal['protein'] * 100),
            round($weeklyNutrient['fat'] / $this->weeklyGoal['fat'] * 100),
            round($weeklyNutrient['carbohydrate'] / $this->weeklyGoal['carbohydrate'] * 100)
        ]);
    }

    public function render()
    {
        return view('livewire.home.weekly-achievement-component');
    }
}
