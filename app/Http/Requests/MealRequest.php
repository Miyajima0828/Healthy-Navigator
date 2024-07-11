<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array>
     */
    public function rules(): array
    {
        return [
            'foods' => ['required', 'array'],
            'foods.*.id' => ['required', 'integer', 'exists:foods,id',],
            'foods.*.name' => ['required', 'string'],
            'foods.*.quantity' => ['required', 'integer'],
            'foods.*.calorie' => ['required', 'integer'],
            'foods.*.protein' => ['required', 'integer'],
            'foods.*.fat' => ['required', 'integer'],
            'foods.*.carbohydrate' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'meal_type' => ['required', 'integer'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'foods.required' => '食品情報が選択されていません。',
            'foods.array' => '食品情報は配列でなければなりません。',
            'foods.*.id.required' => 'IDは必須です。',
            'foods.*.id.integer' => 'IDは整数でなければなりません。',
            'foods.*.id.exists' => 'IDが存在しません。',
            'foods.*.name.required' => '名前は必須です。',
            'foods.*.name.string' => '名前は文字列でなければなりません。',
            'foods.*.quantity.required' => '量は必須です。',
            'foods.*.quantity.integer' => '量は整数でなければなりません。',
            'foods.*.calorie.required' => 'カロリーは必須です。',
            'foods.*.calorie.integer' => 'カロリーは整数でなければなりません。',
            'foods.*.protein.required' => 'タンパク質は必須です。',
            'foods.*.protein.integer' => 'タンパク質は整数でなければなりません。',
            'foods.*.fat.required' => '脂質は必須です。',
            'foods.*.fat.integer' => '脂質は整数でなければなりません。',
            'foods.*.carbohydrate.required' => '炭水化物は必須です。',
            'foods.*.carbohydrate.integer' => '炭水化物は整数でなければなりません。',
            'date.required' => '日付は必須です。',
            'date.date' => '日付は有効な日付形式でなければなりません。',
            'meal_type.required' => '食事タイプは必須です。',
            'meal_type.integer' => '食事タイプは整数でなければなりません。',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'foods.*.id' => 'ID',
            'foods.*.name' => '名前',
            'foods.*.quantity' => '量',
            'foods.*.calorie' => 'カロリー',
            'foods.*.protein' => 'タンパク質',
            'foods.*.fat' => '脂質',
            'foods.*.carbohydrate' => '炭水化物',
            'date' => '日付',
            'meal_type' => '食事タイプ',
        ];
    }
}
