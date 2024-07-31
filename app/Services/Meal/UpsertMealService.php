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
class UpsertMealService implements UpsertMealServiceInterface
{
    /**
     * 食事記録を保存するメソッド
     * @param array $request
     * @throws Exception
     * @return void
     */
    public function store($request)
    {
        try {
            $this->validateMealRequest($request);
            DB::beginTransaction();
            $meal = Meal::query()->updateOrCreate([
                'user_id' => Auth::id(),
                'date' => $request['date'],
                'meal_type' => $request['meal_type'],
            ]);
            $meal->foods()->detach();
            foreach ($request['foods'] as $food) {
                MealFood::query()->updateOrCreate([
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

    /**
     * リクエストのバリデーションするメソッド
     * @param array $request
     * @throws BadRequestException
     * @return void
     */
    private function validateMealRequest($request)
    {
        if (!$this->areAllFoodsExist($request)) {
            throw new BadRequestException('リクエストが不正です');
        }
    }

    /**
     * リクエストされた食品が全て存在するか確認するメソッド
     * @param array $request
     * @return bool
     */
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