<?php

namespace App\Livewire\Meal;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Livewire\food\SearchFoodModal;

class InsertMealPage extends Component
{
    #[On('callModal')]
    public function callModal()
    {
        // イベント名を指定して呼び出す
        $this->dispatch('openModal')->to(SearchFoodModal::class);
    }

    public function render()
    {
        return view('livewire.meal.insert-meal-page')->layout('layouts.app');
    }
}
