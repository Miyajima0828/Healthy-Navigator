<?php

namespace App\Http\Controllers\Goal;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoalUpsertRequest;
use App\Services\Goal\UpsertGoalService;
use Illuminate\Http\JsonResponse;

class GoalController extends Controller
{
    public function __construct(private UpsertGoalService $upsertGoalService)
    {

    }

    /**
     * 目標設定を新規作成または更新する
     * @param GoalRequest $request
     * @return JsonResponse
     */
    public function upsert(GoalUpsertRequest $request): JsonResponse
    {
        $goal = $request->validated()->input('goal');
        $this->upsertGoalService->upsert($goal);

        return response()->json(['message' => '目標を設定しました'], 200);
    }
}
