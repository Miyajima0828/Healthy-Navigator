<?php

namespace App\Livewire\Meal;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Livewire\food\SearchFoodModal;

class UpsertMealPage extends Component
{
    // モーダルの名前
    const VIEW_NAME = 'livewire.meal.upsert-meal-page';

    #[On('callModal')]
    public function callModal()
    {
        // イベント名を指定して呼び出す
        $this->dispatch('openModal')->to(SearchFoodModal::class);
    }

    public function render()
    {
        return view(self::VIEW_NAME)->layout('layouts.app');
    }
}
