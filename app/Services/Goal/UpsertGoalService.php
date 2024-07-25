<?php

namespace App\Services\Goal;

use App\Models\Goal;
use Illuminate\Support\Facades\Auth;

/**
 * 目標設定関連の処理を行うサービスクラス
 */
class UpsertGoalService
{
    /**
     * 目標設定が存在すれば更新、存在しない場合は新規作成
     */
    public function upsert($goal): void
    {
        $user = Auth::user();
        Goal::query()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'calorie' => $goal['calorie'],
                'protein' => $goal['protein'],
                'fat' => $goal['fat'],
                'carbohydrate' => $goal['carbohydrate'],
            ]
        );
    }
}
