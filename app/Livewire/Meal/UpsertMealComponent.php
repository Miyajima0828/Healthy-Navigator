<?php

namespace App\Livewire\Meal;

use App\Http\Requests\MealRequest;
use App\Services\Meal\UpsertMealService;
use App\Services\Meal\UpsertMealServiceInterface;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * @property array foods
 * @property array originalFoodsValue
 * @property int quantity
 * @property UpsertMealServiceInterface upsertMealService
 */
class UpsertMealComponent extends Component
{
    public array $foods = [];
    public array $originalFoodsValue = [];
    public int $quantity = 100;
    protected UpsertMealServiceInterface $upsertMealService;

    public function mount()
    {
        if (session()?->has('food')) {
            $this->addFood(session('food'));
        }
    }

    public function boot(UpsertMealServiceInterface $upsertMealService)
    {
        $this->upsertMealService = $upsertMealService;
    }

    public function upsertMeal(MealRequest $request)
    {
        $this->upsertMealService = new UpsertMealService();
        $validatedData = $request->validated();
        $this->upsertMealService->store($validatedData);
        session()?->flash('message', '食事を追加しました');
        return redirect()->route('home');
    }

    #[On('addFood')]
    public function addFood($food)
    {
        $this->originalFoodsValue[$food['id']] = $food;
        $this->foods[$food['id']] = [
            'id' => $food['id'],
            'name' => $food['name'],
            'quantity' => $this->quantity,
            'calorie' => $food['calorie'],
            'protein' => $food['protein'],
            'fat' => $food['fat'],
            'carbohydrate' => $food['carbohydrate'],
        ];
    }

    public function updateQuantity($id, $quantity)
    {
        $this->foods[$id]['quantity'] = $quantity;
        $this->foods[$id]['calorie'] = round($this->originalFoodsValue[$id]['calorie'] * $quantity / 100);
        $this->foods[$id]['protein'] = round($this->originalFoodsValue[$id]['protein'] * $quantity / 100);
        $this->foods[$id]['fat'] = round($this->originalFoodsValue[$id]['fat'] * $quantity / 100);
        $this->foods[$id]['carbohydrate'] = round($this->originalFoodsValue[$id]['carbohydrate'] * $quantity / 100);
    }

    public function removeFood($id)
    {
        unset($this->foods[$id]);
    }

    public function render()
    {
        return view('livewire.meal.upsert-meal-component');
    }
}