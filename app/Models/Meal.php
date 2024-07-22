<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property date $date
 * @property int $meal_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property User $user
 * @property Food $foods
 */
class Meal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'date',
        'meal_type',
    ];

    /**
     * ユーザとのリレーション
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 食品との多対多のリレーション
     * @return BelongsToMany
     */
    public function foods()
    {
        return $this->belongsToMany(Food::class,'meal_food')->withPivot('quantity')->withTimestamps();
    }

    /**
     * 食事タイプの表示
     * @return string
     */
    public function getMealTypeAttribute(): string
    {
        $mealTypes = [
            0 => '朝食',
            1 => '昼食',
            2 => '夕食',
            3 => '間食',
        ];
        return $mealTypes[$this->attributes['meal_type']];
    }
}
