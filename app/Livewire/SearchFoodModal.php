<?php

namespace App\Livewire;

use App\Services\FoodService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class SearchFoodModal extends Component
{
    public $searchTerm = '';
    public $foods;
    protected $foodService;
    public bool $is_show = false;

    // #[On()]でイベント名を設定する
    #[On('openModal')]
    public function openModal()
    {
        $this->is_show = true;
    }

    /**
     * 検索結果を取得
     * @return void
     */
    public function updateSearchTerm(): void
    {
        $this->foodService = new FoodService();
        $this->foods = $this->foodService->SearchFoodModals($this->searchTerm);
    }

    #[On('foodSelected')]
    public function selectFood($food)
    {
        $this->dispatch('addFood', $food);
        $this->is_show = false;
    }

    public function render(): View
    {
        return view('livewire.search-food-modal');
    }
}
