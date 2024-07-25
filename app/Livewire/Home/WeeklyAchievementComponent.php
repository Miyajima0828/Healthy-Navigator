<?php

namespace App\Livewire\Home;

use App\Services\Goal\GetGoalServiceInterface;
use Carbon\Carbon;
use App\Services\Meal\GetMealServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Component;

class WeeklyAchievementComponent extends Component
{
    public Collection $meals;
    public ?SupportCollection $weeklyGoal;
    public array $weeklyNutrient;
    public string $nutrientAchievement;
    protected GetMealServiceInterface $getMealService;
    protected GetGoalServiceInterface $getGoalService;

    public function mount()
    {
        $this->meals = $this->getMealService->getMealRecords(Carbon::today()->copy()->startOfWeek(), Carbon::today()->copy()->endOfWeek());
        $this->weeklyGoal = $this->getGoalService->getGoal() ? collect($this->getGoalService->getGoal())
            ->only('calorie', 'protein', 'fat', 'carbohydrate')
            ->map(function ($value) {
                return $value * 7;
            }) : null;
        $this->weeklyNutrient = [
            'calorie' => $this->getMealService->calculateNutrientSum($this->meals, 'calorie'),
            'protein' => $this->getMealService->calculateNutrientSum($this->meals, 'protein'),
            'fat' => $this->getMealService->calculateNutrientSum($this->meals, 'fat'),
            'carbohydrate' => $this->getMealService->calculateNutrientSum($this->meals, 'carbohydrate')
        ];
        $this->nutrientAchievement = $this->generateNutrientAchievementJson($this->weeklyNutrient);
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

    public function generateNutrientAchievementJson($weeklyNutrient)
    {
        return $this->weeklyGoal ? json_encode([
            $this->weeklyGoal['calorie'] !== 0 ? round($weeklyNutrient['calorie']/ $this->weeklyGoal['calorie'] * 100) :0,
            $this->weeklyGoal['protein'] !== 0 ? round($weeklyNutrient['protein'] / $this->weeklyGoal['protein'] * 100) : 0,
            $this->weeklyGoal['fat'] !== 0 ? round($weeklyNutrient['fat'] / $this->weeklyGoal['fat'] * 100) : 0,
            $this->weeklyGoal['carbohydrate'] !== 0 ? round($weeklyNutrient['carbohydrate'] / $this->weeklyGoal['carbohydrate'] * 100) : 0
        ]) : '';
    }

    public function render()
    {
        return view('livewire.home.weekly-achievement-component');
    }
}
