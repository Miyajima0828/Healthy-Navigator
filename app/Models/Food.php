<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * 食品モデル
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property int $calorie
 * @property int $protein
 * @property int $fat
 * @property int $carbohydrate
 * @property string $created_at
 * @property string $updated_at
 */
class Food extends Model
{
    use HasFactory;

    protected $table = 'foods'; // テーブル名を確認し、正しい名前を設定する

    protected $fillable = [
        'name',
        'calorie',
        'protein',
        'fat',
        'carbohydrate',
    ];

    protected $casts = [
        'calorie' => 'integer',
        'protein' => 'integer',
        'fat' => 'integer',
        'carbohydrate' => 'integer',
    ];

    /**
     * 食品との多対多のリレーション
     * @return BelongsToMany
     */
    public function meals() : BelongsToMany
    {
        return $this->belongsToMany(Meal::class,'meal_food')->withPivot('quantity')->withTimestamps();
    }

    /**
     * カテゴリーとのリレーション
     * @return BelongsToMany
     */
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function getShortNameAttribute()
    {
        // 正規表現を使用して<>や()、[]に囲まれた文字列を除外
        $cleanName = preg_replace('/[<\(\[\（\【\《\＜\［].*?[>\)\]\）\】\》\＞\］]/u', '', $this->name);

        return preg_replace('/\s/u', '', $cleanName);
    }
}
