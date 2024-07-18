<?php

namespace App\Livewire\Food;

use App\Services\Food\SearchFoodService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * @property string searchTerm
 * @property array foods
 * @property bool is_show
 * @property SearchFoodService SearchFoodService
 */
class SearchFoodModal extends Component
{
    public string $searchTerm = '';
    public  $foods = [];
    public bool $is_show = false;

    protected $searchFoodService;

    public function boot(SearchFoodService $searchFoodService)
    {
        $this->searchFoodService = $searchFoodService;
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
        $this->foods = $this->searchTerm ? $this->searchFoodService->search($this->searchTerm) : null;
    }

    /**
     * @param $food
     * @return
     */
    #[On('selectFood')]
    public function selectFood($food, Request $request)
    {

        if ($request->header('referer') === env('APP_URL') . '/home') { // Expected type 'object'. Found 'array<string, mixed>'というエラーが出る
            session()?->flash('food', $food); //ここでExpected type 'object'. Found 'null'.intelephense(P1006)というエラーが出る
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
        return view('livewire.food.search-food-modal');
    }
}
