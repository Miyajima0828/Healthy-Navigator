<?php

namespace App\Services\Meal;

use App\Models\Food;
use App\Models\Meal;
use App\Models\MealFood;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exceptions\BadRequestException;

/**
 * 食事関連の処理を行うサービスクラス
 */
class InsertMealService
{
    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        try {
            $this->validateMealRequest($request);
            DB::beginTransaction();
            $meal = Meal::query()->create([
                'user_id' => Auth::id(),
                'date' => $request['date'],
                'meal_type' => $request['meal_type'],
            ]);

            foreach ($request['foods'] as $food) {
                MealFood::query()->create([
                    'meal_id' => $meal->id,
                    'food_id' => $food['id'],
                    'quantity' => $food['quantity'],
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function validateMealRequest($request)
    {
        if (!$this->areAllFoodsExist($request)) {
            throw new BadRequestException('リクエストが不正です');
        }
    }

    private function areAllFoodsExist($request): bool
    {
        foreach ($request['foods'] as $food) {
            if (!Food::where([
                'id' => $food['id'],
                'name' => $food['name'],
            ])->exists()) {
                return false;
            }
        }
        return true;
    }
}
