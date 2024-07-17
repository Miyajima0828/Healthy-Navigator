<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalUpsertRequest extends FormRequest
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
     * @return array{string: array{string, string, string, string}}
     */
    public function rules(): array
    {
        return [
            'goal' => ['required', 'array'],
            'goal.calorie' => ['required', 'integer', 'min:0', 'max:9999'],
            'goal.protein' => ['required', 'integer', 'min:0', 'max:9999'],
            'goal.fat' => ['required', 'integer', 'min:0', 'max:9999'],
            'goal.carbohydrate' => ['required', 'integer', 'min:0', 'max:9999'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array{string: string}
     */
    public function messages(): array
    {
        return [
            'goal.required' => '目標が設定されていません。',
            'goal.array' => '目標は配列でなければなりません。',
            'goal.calorie.required' => 'カロリーは必須です。',
            'goal.calorie.integer' => 'カロリーは整数でなければなりません。',
            'goal.calorie.min' => 'カロリーは0以上でなければなりません。',
            'goal.calorie.max' => 'カロリーは9999以下でなければなりません。',
            'goal.protein.required' => 'タンパク質は必須です。',
            'goal.protein.integer' => 'タンパク質は整数でなければなりません。',
            'goal.protein.min' => 'タンパク質は0以上でなければなりません。',
            'goal.protein.max' => 'タンパク質は9999以下でなければなりません。',
            'goal.fat.required' => '脂質は必須です。',
            'goal.fat.integer' => '脂質は整数でなければなりません。',
            'goal.fat.min' => '脂質は0以上でなければなりません。',
            'goal.fat.max' => '脂質は9999以下でなければなりません。',
            'goal.carbohydrate.required' => '炭水化物は必須です。',
            'goal.carbohydrate.integer' => '炭水化物は整数でなければなりません。',
            'goal.carbohydrate.min' => '炭水化物は0以上でなければなりません。',
            'goal.carbohydrate.max' => '炭水化物は9999以下でなければなりません。',
        ];
    }

    /**
     * @return array{string: string}
     */
    public function attributes(): array
    {
        return [
            'goal' => '目標',
            'goal.calorie' => 'カロリー',
            'goal.protein' => 'タンパク質',
            'goal.fat' => '脂質',
            'goal.carbohydrate' => '炭水化物',
        ];
    }
}
