<?php

namespace App\Livewire\Meal;

use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GetMealRecordsPage extends Component
{
    use WithPagination;

    public Collection $mealRecords;
    public Carbon $today;
    public Carbon $startOfWeek;
    public Carbon $endOfWeek;
    public array $week = [];
    public ?string $selectedDate= null;

    public function mount()
    {
        $this->today = Carbon::now();
        $this->selectedDate = $this->today->toDateString();
        $this->initializeDates($this->today);
        $this->fetchMealRecords($this->startOfWeek, $this->endOfWeek);
    }

    /**
     * 該当の日付の週を初期化するメソッド
     */
    private function initializeDates($date)
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
     * 食事記録を取得するメソッド
     */
    private function fetchMealRecords($startOfWeek, $endOfWeek)
    {
        $this->mealRecords = Meal::query()
            ->where('user_id', auth()->id())
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->orderBy('date', 'asc')
            ->orderBy('meal_type', 'asc')
            ->with('foods') // リレーションをロード
            ->get()
            ->map(function ($meal) {
                $meal->total_calories = $meal->foods->sum(function ($food) {
                    return $food->calorie * ($food->pivot->quantity / 100);
                });
                return $meal;
            });
    }

    /**
     * 選択した日付の食事記録を取得するメソッド
     */
    #[On('getMealRecordsByDate')]
    public function getMealRecordsByDate()
    {
        if (!$this->selectedDate) {
            return;
        }
        $selectedDate = Carbon::parse($this->selectedDate);
        $this->initializeDates($selectedDate);
        $this->fetchMealRecords($this->startOfWeek, $this->endOfWeek);

    }

    /**
     * selectedDateの日付を一週間分遡るメソッド
     */
    public function showPreviousWeek()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->subWeek()->toDateString();
        $this->getMealRecordsByDate();
    }

    /**
     * selectedDateの日付を一週間分進めるメソッド
     */
    public function showNextWeek()
    {
        $this->selectedDate = Carbon::parse($this->selectedDate)->addWeek()->toDateString();
        $this->getMealRecordsByDate();
    }

    public function render()
    {
        return view('livewire.meal.get-meal-records-page')->layout('layouts.app');
    }
}
