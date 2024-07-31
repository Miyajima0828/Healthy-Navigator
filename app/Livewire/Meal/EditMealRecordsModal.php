<?php

namespace App\Livewire\Meal;

use App\Http\Requests\MealRequest;
use App\Models\Meal;
use App\Services\Meal\GetMealServiceInterface;
use App\Services\Meal\UpsertMealService;
use App\Services\Meal\upsertMealServiceInterface;
use Livewire\Attributes\On;
use Livewire\Component;

class EditMealRecordsModal extends Component
{
    public bool $is_show = false;
    public ?Meal $meal = null;
    public array $foods = [];
    public array $originalFoodsValue = [];
    protected GetMealServiceInterface $getMealService;
    protected upsertMealServiceInterface $upsertMealService;
    // モーダルの名前
    const VIEW_NAME = 'livewire.meal.edit-meal-records-modal';

    public function boot(
        GetMealServiceInterface $getMealService
    ) {
        $this->getMealService = $getMealService;
    }

    /**
     * モーダルを開く
     */
    #[On('openModal')]
    public function openModal(): void
    {
        $this->is_show = true;
    }

    /**
     * モーダルを閉じる
     */
    #[On('closeModal')]
    public function closeModal(): void
    {
        $this->foods = [];
        $this->is_show = false;
    }

    /**
     * 食事の記録を登録または更新する
     * @param MealRequest $request
     * @return void
     */
    public function store(MealRequest $request): void
    {
        $this->upsertMealService = new UpsertMealService();
        $this->upsertMealService->store($request->validated());
    }

    /**
     * 選択した食事の記録を取得する
     * @param Meal $meal
     * @return void
     */
    #[On('editMealRecord')]
    public function editMealRecord(Meal $meal): void
    {
        $this->is_show = true;
        $this->meal = $meal;
        foreach ($meal->foods as $food) {
            $this->originalFoodsValue[$food['id']] = $food;
            $this->foods[$food['id']] = [
                'id' => $food['id'],
                'name' => $food['name'],
                'quantity' => $food->pivot->quantity,
                'calorie' => $food['calorie'],
                'protein' => $food['protein'],
                'fat' => $food['fat'],
                'carbohydrate' => $food['carbohydrate'],
            ];
        }
    }

    /**
     * 食品の量を更新する
     * @param int $id
     * @param int $quantity
     * @return void
     */
    public function updateQuantity($id, $quantity)
    {
        $this->foods[$id]['quantity'] = $quantity;
        $this->foods[$id]['calorie'] = round($this->originalFoodsValue[$id]['calorie'] * $quantity / 100);
        $this->foods[$id]['protein'] = round($this->originalFoodsValue[$id]['protein'] * $quantity / 100);
        $this->foods[$id]['fat'] = round($this->originalFoodsValue[$id]['fat'] * $quantity / 100);
        $this->foods[$id]['carbohydrate'] = round($this->originalFoodsValue[$id]['carbohydrate'] * $quantity / 100);
    }

    /**
     * 食品を追加する
     * @param array $food
     * @return void
     */
    #[On('addFood')]
    public function addFood($food)
    {
        $this->originalFoodsValue[$food['id']] = $food;
        $this->foods[$food['id']] = [
            'id' => $food['id'],
            'name' => $food['name'],
            'quantity' => 100,
            'calorie' => $food['calorie'],
            'protein' => $food['protein'],
            'fat' => $food['fat'],
            'carbohydrate' => $food['carbohydrate'],
        ];
    }

    /**
     * 食品を削除する
     * @param int $id
     * @return void
     */
    public function removeFood($id)
    {
        unset($this->foods[$id]);
    }

    public function render()
    {
        return view(self::VIEW_NAME);
    }
}
