<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // 動的にユーザーを生成
            'date' => $this->faker->dateTimeThisYear(), // fakerを使用してランダムな日付を生成
            'meal_type' => $this->faker->numberBetween(0, 2), // 0から2の範囲でランダムな値を生成
        ];
    }
}
