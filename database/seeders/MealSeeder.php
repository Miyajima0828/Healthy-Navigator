<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = now();
        $startOfDate = $date->startOfWeek()->subWeek();
        $mealTypes = [0, 1, 2, 3];

        // ランダムなFoodレコード20件を取得
        $foods = Food::inRandomOrder()->limit(30)->get();

        foreach (range(0, 20) as $i) {
            $date = $startOfDate->copy()->addDays($i);
            $this->createMealsForDate($date, $foods, $mealTypes);
        }
    }

    private function createMealsForDate($date, $foods, $mealTypes) {
        foreach ($mealTypes as $mealType) {
            $meal = [
                'user_id' => 1,
                'date' => $date,
                'meal_type' => $mealType,
            ];
            $mealFood = $foods->random(3)->mapWithKeys(function ($food) {
                return [
                    $food->id => ['quantity' => rand(100, 300)],
                ];
            })->toArray();
            $mealId = Meal::factory()->create($meal)->id;
            Meal::find($mealId)->foods()->attach($mealFood);
        }
    }
}
