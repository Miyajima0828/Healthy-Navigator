<?php

namespace App\Services\Goal;

use App\Models\Goal;
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
        return Goal::query()->where('user_id', Auth::id())->first();
    }
}
