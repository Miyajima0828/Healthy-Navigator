<?php

namespace App\Livewire;

use App\Services\FoodService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class SearchFoodModal extends Component
{
    public $searchTerm = '';
    public $foods = [];
    public bool $is_show = false;

    protected $foodService;

    public function boot(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    #[On('openModal')]
    public function openModal()
    {
        $this->resetState();
        $this->is_show = true;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->resetState();
    }

    public function updateSearchTerm(): void
    {
        $this->foods = $this->foodService->searchFoodModals($this->searchTerm);
    }

    public function selectFood($food)
    {
        $this->dispatch('addFood', $food);
        $this->closeModal();
    }

    private function resetState()
    {
        $this->searchTerm = '';
        $this->foods = [];
        $this->is_show = false;
    }

    public function render(): View
    {
        return view('livewire.search-food-modal');
    }
}
