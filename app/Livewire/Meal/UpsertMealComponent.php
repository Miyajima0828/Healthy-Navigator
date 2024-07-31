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

    /**
     * 食事の記録を登録または更新する
     * @param MealRequest $request
     * @return void
     */
    public function upsertMeal(MealRequest $request)
    {
        $this->upsertMealService = new UpsertMealService();
        $validatedData = $request->validated();
        $this->upsertMealService->store($validatedData);
        session()?->flash('message', '食事を追加しました');
        return $this->determineRedirect($request);
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
            'quantity' => $this->quantity,
            'calorie' => $food['calorie'],
            'protein' => $food['protein'],
            'fat' => $food['fat'],
            'carbohydrate' => $food['carbohydrate'],
        ];
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
     * 食品を削除する
     * @param int $id
     * @return void
     */
    public function removeFood($id)
    {
        unset($this->foods[$id]);
    }

    /**
     * リダイレクト先を決定する
     * @param MealRequest $request
     * @return void
     */
    private function determineRedirect(MealRequest $request)
    {
        return $request->header('referer') === env('APP_URL') . '/meal/create' ?
            redirect()->route('home') :
            redirect()->route('meal.records');
    }

    public function render()
    {
        return view('livewire.meal.upsert-meal-component');
    }
}
