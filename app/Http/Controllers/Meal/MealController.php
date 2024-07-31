<?php

namespace App\Http\Controllers\Meal;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealRequest;
use App\Services\Meal\UpsertMealServiceInterface;

class MealController extends Controller
{
    /**
     * @param UpsertMealServiceInterface $upsertMealService
     */
    public function __construct(protected UpsertMealServiceInterface $upsertMealService)
    {
    }

    /**
     * 食事の記録を登録または更新する
     * @param MealRequest $request
     * @return void
     */
    public function upsertMeal(MealRequest $request)
    {
        $validatedData = $request->validated();
        $this->upsertMealService->store($validatedData);
        session()?->flash('message', '食事を追加しました');
        return $this->determineRedirect($request);
    }

        /**
     * リダイレクト先を決定する
     * @param MealRequest $request
     * @return void
     */
    private function determineRedirect(MealRequest $request)
    {
        return $request->header('referer') === env('APP_URL') . '/meal/create' ?
            redirect()->route('home') :
            redirect()->route('meal.records');
    }

}
