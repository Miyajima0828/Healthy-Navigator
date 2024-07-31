<?php

namespace App\Livewire\Food;

use App\Livewire\Meal\EditMealRecordsModal;
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
    // モーダルの名前
    const VIEW_NAME = 'livewire.food.search-food-modal';

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
        // 食品検索モーダルを開いたページがhomeページの場合
        if ($request->header('referer') === env('APP_URL') . '/home') {
            session()?->flash('food', $food);
            return $this->redirectRoute('meal.create');
        }
        // 食品検索モーダルを開いたページがmeal/recordsページの場合
        if ($request->header('referer') === env('APP_URL') . '/meal/records') {
            $this->dispatch('addFood', $food)->to(EditMealRecordsModal::class);
            $this->closeModal();
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
        return view(self::VIEW_NAME);
    }
}
