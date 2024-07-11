<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * 食事と食品の中間テーブルモデル
 * @property int $meal_id
 * @property int $food_id
 * @property int $quantity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Meal $meal
 * @property Food $food
 */
class MealFood extends Model
{
    use HasFactory;

    protected $table = 'meal_food';

    protected $fillable = [
        'meal_id',
        'food_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public $timestamps = true;

    /**
     * @return BelongsTo
     */
    public function meal(): BelongsTo
    {
        return $this->belongsTo(Meal::class);
    }

    /**
     * @return BelongsTo
     */
    public function food(): BelongsTo
    {
        return $this->belongsTo(Food::class);
    }
}
