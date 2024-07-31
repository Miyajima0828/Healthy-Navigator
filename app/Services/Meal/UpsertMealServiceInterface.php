<?php

namespace App\Services\Meal;



interface UpsertMealServiceInterface
{
    /**
     * 食事記録を保存するメソッド
     * @param array $request
     * @throws Exception
     * @return void
     */
    public function store($request);
}
