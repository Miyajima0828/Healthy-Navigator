<?php

namespace App\Services\Meal;

use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;

interface GetMealServiceInterface
{
    /**
     * 食事記録を取得するメソッド
     * @param Carbon $startDate
     * @param Carbon|null $endDate
     * @return Collection
     */
    public function getMealRecords(Carbon $startDate, Carbon $endDate = null): Collection;

        /**
     * 指定された栄養素の合計値を計算するメソッド
     * @param Collection $meals
     * @param string $nutrient
     * @return int
     */
    public function calculateNutrientSum(Collection $meals, string $nutrient): int;
}
