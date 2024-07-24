<?php

namespace App\Services\Meal;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Collection;


interface getMealServiceInterface
{
        /**
     * 食事記録を取得するメソッド
     * @param Carbon $startOfWeek
     * @param Carbon $endOfWeek
     * @return Collection
     */
    public function getMealRecords($startOfWeek, $endOfWeek): Collection;

        /**
     * 指定された栄養素の合計値を計算するメソッド
     * @param Collection $meals
     * @param string $nutrient
     * @return float
     */
    public function calculateNutrientSum(Collection $meals, string $nutrient): float;
}
