<?php

namespace App\Services\Meal;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Collection;

/**
 * 食事関連の処理を行うサービスクラス
 */
class getMealService implements getMealServiceInterface
{
    /**
     * 食事記録を取得するメソッド
     * @param Carbon $startOfWeek
     * @param Carbon $endOfWeek
     * @return Collection
     */
    public function getMealRecords($startOfWeek, $endOfWeek): Collection
    {
        return Meal::query()
            ->where('user_id', auth()->id())
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date', 'asc')
            ->orderBy('meal_type', 'asc')
            ->with('foods')
            ->get()
            ->map(function ($meal) {
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
}
