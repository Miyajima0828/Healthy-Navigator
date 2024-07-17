<?php

namespace App\Livewire\Goal;

use App\Http\Requests\GoalUpsertRequest;
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
    public array $goal = [];
    protected UpsertGoalService $upsertGoalService;

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
        $this->goal = $request->validated()['goal'];
        $this->upsertGoalService->upsert($this->goal);
        session()?->flash('message', '目標を設定しました');
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.goal.set-goal-modal');
    }
}