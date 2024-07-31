<?php

namespace App\Services\Meal;

use App\Models\Meal;
use App\Models\MealFood;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * 食事関連の処理を行うサービスクラス
 */
class GetMealService implements GetMealServiceInterface
{
    /**
     * 食事記録を取得するメソッド
     * @param Carbon $startDate
     * @param Carbon|null $endDate
     * @return Collection
     */
    public function getMealRecords(Carbon $startDate, Carbon $endDate = null): Collection
    {
        $query = Meal::query()
            ->where('user_id', auth()->id())
            ->orderBy('date', 'asc')
            ->orderBy('meal_type', 'asc')
            ->with('foods');

        $endDate ? $query->whereBetween('date', [$startDate, $endDate]) : $query->whereDate('date', $startDate);

        return $query->get()->map(function ($meal) {
            $meal->total_calories = $meal->foods->sum(function ($food) {
                return $food->calorie * ($food->pivot->quantity / 100);
            });
            return $meal;
        });
    }

    /**
     * 指定された栄養素の合計値を計算するメソッド
     * @param Collection $meals
     * @param string $nutrient
     * @return int
     */
    public function calculateNutrientSum(Collection $meals, string $nutrient): int
    {
        return $meals->sum(function ($meal) use ($nutrient) {
            return $meal->foods->sum(function ($food) use ($nutrient) {
                return round($food->$nutrient * $food->pivot->quantity / 100);
            });
        });
    }

    /**
     * 該当の食事記録を削除するメソッド
     * @param int $mealId
     * @return void
     */
    public function deleteMealRecord(int $mealId): void
    {
        DB::transaction(function () use ($mealId) {
            MealFood::query()->where('meal_id', $mealId)->delete();
            Meal::query()->findOrFail($mealId)->delete();
        });
    }

}
