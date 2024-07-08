<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * 食品関連の処理を行うサービスクラス
 */
class FoodService
{
    /**
     * 検索条件に一致する食品を取得
     * @param string $searchTerm
     * @return Collection|null
     */
    public function SearchFoodModals($searchTerm): ?Collection
    {
        // キャッシュキーを生成
        $cacheKey = 'foods_search_' . md5($searchTerm);

        // キャッシュからデータを取得、存在しない場合はデータベースから取得してキャッシュに保存
        // return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($searchTerm) {
            return Food::query()->where('name', 'like', '%' . $searchTerm . '%')->exists() ? Food::where('name', 'like', '%' . $searchTerm . '%')->get() : null;
        // });
    }
}
