<?php

namespace App\Livewire;

use Livewire\Component;


class InsertMealPage extends Component
{

    public function callModal()
    {
        // イベント名を指定して呼び出す
        $this->dispatch('openModal')->to(SearchFoodModal::class);
    }

    public function render()
    {
        return view('livewire.insert-meal-page')->layout('layouts.app');
    }
}