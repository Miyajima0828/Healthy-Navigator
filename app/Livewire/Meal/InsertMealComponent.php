<?php

namespace App\Livewire\Meal;

use App\Http\Requests\MealRequest;
use App\Services\Meal\InsertMealService;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * @property array foods
 * @property array originalFoodsValue
 * @property int quantity
 * @property InsertMealService insertMealService
 */
class InsertMealComponent extends Component
{
    public array $foods = [];
    public array $originalFoodsValue = [];
    public int $quantity = 100;
    protected $insertMealService;

    public function mount()
    {
        if (session()?->has('food')) {
            $this->addFood(session('food'));
        }
    }

    public function insertMeal(MealRequest $request)
    {
        $this->insertMealService = new InsertMealService();
        $validatedData = $request->validated();
        $this->insertMealService->store($validatedData);
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
        $this->foods[$id]['calorie'] = $this->originalFoodsValue[$id]['calorie'] * $quantity / 100;
        $this->foods[$id]['protein'] = $this->originalFoodsValue[$id]['protein'] * $quantity / 100;
        $this->foods[$id]['fat'] = $this->originalFoodsValue[$id]['fat'] * $quantity / 100;
        $this->foods[$id]['carbohydrate'] = $this->originalFoodsValue[$id]['carbohydrate'] * $quantity / 100;
    }

    public function removeFood($id)
    {
        unset($this->foods[$id]);
    }

    public function render()
    {
        return view('livewire.meal.insert-meal-component');
    }
}
