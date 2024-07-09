<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $csvFile = database_path('/csv/foods.csv');
        $csvData = File::get($csvFile);
        $rows = explode("\n", $csvData);
        // 1行目はヘッダー行なので削除
        array_shift($rows);
        foreach ($rows as $row) {
            $data = str_getcsv($row);

            Food::query()->insert([
                'id' => $data[0],
                'category_id' => $data[1],
                'name' => $data[2],
                'calorie' => $data[3],
                'protein' => $data[4],
                'fat' => $data[5],
                'carbohydrate' => $data[6],
                'detail' => $data[7],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
