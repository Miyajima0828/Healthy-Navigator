<?php

namespace App\Livewire\Goal;

use App\Http\Requests\GoalUpsertRequest;
use App\Models\Goal;
use App\Services\Goal\GetGoalServiceInterface;
use App\Services\Goal\UpsertGoalService;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * @property bool is_show
 * @property array goal
 * @property UpsertGoalService upsertGoalService
 */
class SetGoalModal extends Component
{
    public bool $is_show = false;
    public ?Goal $goal;
    protected UpsertGoalService $upsertGoalService;
    protected GetGoalServiceInterface $getGoalService;
    // モーダルの名前
    const VIEW_NAME = 'livewire.goal.set-goal-modal';

    /**
     * コンポーネントの初期設定
     * @param GetGoalServiceInterface $getGoalService
     */
    public function boot(GetGoalServiceInterface $getGoalService)
    {
        $this->getGoalService = $getGoalService;
        $this->goal = $this->getGoalService->getGoal();
    }
    /**
     * モーダルを開く
     */
    #[On('openModal')]
    public function openModal(): void
    {
        $this->is_show = true;
    }

    /**
     * モーダルを閉じる
     */
    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->is_show = false;
    }

    /**
     * 目標を登録または更新する
     * @param GoalUpsertRequest $request
     * @return RedirectResponse
     */
    public function upsert(GoalUpsertRequest $request): RedirectResponse
    {
        $this->upsertGoalService = new UpsertGoalService();
        $this->upsertGoalService->upsert($request->validated()['goal']);
        session()?->flash('message', '目標を設定しました');
        return redirect()->route('home');
    }

    public function render()
    {
        return view(self::VIEW_NAME);
    }
}
