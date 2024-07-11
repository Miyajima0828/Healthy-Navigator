<?php

namespace App\Livewire;

use App\Services\FoodService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class SearchFoodModal extends Component
{
    public string $searchTerm = '';
    public  $foods = [];
    public bool $is_show = false;

    protected $foodService;

    public function boot(FoodService $foodService)
    {
        $this->foodService = $foodService;
    }

    /**
     * @return void
     */
    #[On('openModal')]
    public function openModal(): void
    {
        $this->resetState();
        $this->is_show = true;
    }

    /**
     * @return void
     */
    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->resetState();
    }

    /**
     * @return void
     */
    public function updateSearchTerm(): void
    {
        $this->foods = $this->searchTerm ? $this->foodService->searchFoodModals($this->searchTerm) : null;
    }

    /**
     * @param $food
     * @return
     */
    #[On('selectFood')]
    public function selectFood($food)
    {
        if (request()->header('referer') === env('APP_URL') . '/home') {
            session()->flash('food', $food);
            return $this->redirectRoute('meal.create');
        }
        $this->dispatch('addFood', $food);
        $this->closeModal();
    }

    /**
     * @return void
     */
    private function resetState(): void
    {
        $this->searchTerm = '';
        $this->foods = [];
        $this->is_show = false;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.search-food-modal');
    }
}
