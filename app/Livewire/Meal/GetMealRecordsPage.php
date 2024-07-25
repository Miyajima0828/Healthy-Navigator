<?php

namespace App\Livewire\Meal;

use App\Services\Meal\GetMealServiceInterface;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property Carbon today
 * @property Carbon startOfWeek
 * @property Carbon endOfWeek
 * @property array week
 * @property ?string selectedDate
 */
class GetMealRecordsPage extends Component
{
    use WithPagination;

    public Carbon $today;
    public Carbon $startOfWeek;
    public Carbon $endOfWeek;
    public array $week = [];
    public ?string $selectedDate = null;
    protected GetMealServiceInterface $getMealService;

    public function mount()
    {
        $this->today = Carbon::now();
        $this->selectedDate = $this->today->toDateString();
        $this->initializeDates($this->today);
    }

    public function boot(GetMealServiceInterface $getMealService)
    {
        $this->GetMealService = $getMealService;
    }

    /**
     * 該当の日付の週を初期化するメソッド
     * @param Carbon $date
     * @return void
     */
    private function initializeDates($date): void
    {
        $this->startOfWeek = $date->copy()->startOfWeek();
        $this->endOfWeek = $date->copy()->endOfWeek();
        $this->week = [];
        // 今週の日付を配列で取得
        for ($i = 0; $i < 7; $i++) {
            $this->week[] = $this->startOfWeek->copy()->addDays($i);
        }
    }

    /**
     * 選択した日付の食事記録を取得するメソッド
     * @return void
     */
    #[On('getMealRecordsByDate')]
    public function getMealRecordsByDate(): void
    {
        if (!$this->selectedDate) {
            return;
        }
        $selectedDate = Carbon::parse($this->selectedDate);
        $this->initializeDates($selectedDate);
    }

    /**
     * selectedDateの日付を一週間分遡るメソッド
     * @return void
     */
    public function showPreviousWeek()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subWeek()->toDateString();
        $this->getMealRecordsByDate();
    }

    /**
     * selectedDateの日付を一週間分進めるメソッド
     * @return void
     */
    public function showNextWeek()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->addWeek()->toDateString();
        $this->getMealRecordsByDate();
    }

    public function render()
    {
        $mealRecords = $this->GetMealService->getMealRecords($this->startOfWeek, $this->endOfWeek);
        return view('livewire.meal.get-meal-records-page', compact('mealRecords'))
        ->layout('layouts.app');
    }
}
