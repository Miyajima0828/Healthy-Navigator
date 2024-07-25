<?php

namespace App\Services\Goal;

use App\Models\Goal;
use Exception;
use Illuminate\Support\Facades\Auth;

/**
 * 目標設定関連の処理を行うサービスクラス
 */
class GetGoalService implements GetGoalServiceInterface
{
    /**
     * 目標設定を取得するメソッド
     */
    public function getGoal()
    {
        $goal = Goal::query()->where('user_id', Auth::id())->first();
        if (!$goal) {
            // エラーハンドリングを追加
            throw new Exception('目標が見つかりません');
        }
        return $goal;
    }
}
