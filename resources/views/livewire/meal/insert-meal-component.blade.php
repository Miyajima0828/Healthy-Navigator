<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('食事追加') }}
    </h2>
</x-slot>
<div>
    <table class="mx-auto w-full max-w-4xl bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">食品名</th>
                <th class="px-4 py-2">量(g)</th>
                <th class="px-4 py-2">カロリー(kcal)</th>
                <th class="px-4 py-2">タンパク質(g)</th>
                <th class="px-4 py-2">脂質(g)</th>
                <th class="px-4 py-2">炭水化物(g)</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $food['name'] }}</td>
                    <td class="px-4 py-2">
                        <input type="number" wire:change="updateQuantity({{ $food['id'] }}, $event.target.value)"
                            value="{{ $food['quantity'] }}" class="w-full p-2 border rounded">
                    </td>
                    <td class="px-4 py-2">{{ round($food['calorie']) }} kcal</td>
                    <td class="px-4 py-2">{{ round($food['protein']) }} g</td>
                    <td class="px-4 py-2">{{ round($food['fat']) }} g</td>
                    <td class="px-4 py-2">{{ round($food['carbohydrate']) }} g</td>
                    <td class="px-4 py-2 text-center">
                        <button wire:click="removeFood({{ $food['id'] }})"
                            class="px-4 py-2 font-bold text-white bg-gray-500 rounded hover:bg-red-700">✕</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('meal.store') }}" method="POST" id="mealForm" class="mt-8 w-full max-w-4xl mx-auto bg-white p-6 shadow-md rounded-lg">
        @csrf
        @foreach ($foods as $food)
            <input type="hidden" name="foods[{{ $food['id'] }}][id]" value="{{ $food['id'] }}">
            <input type="hidden" name="foods[{{ $food['id'] }}][name]" value="{{ $food['name'] }}">
            <input type="hidden" name="foods[{{ $food['id'] }}][quantity]" value="{{ $food['quantity'] }}">
            <input type="hidden" name="foods[{{ $food['id'] }}][calorie]" value="{{ $food['calorie'] }}">
            <input type="hidden" name="foods[{{ $food['id'] }}][protein]" value="{{ $food['protein'] }}">
            <input type="hidden" name="foods[{{ $food['id'] }}][fat]" value="{{ $food['fat'] }}">
            <input type="hidden" name="foods[{{ $food['id'] }}][carbohydrate]" value="{{ $food['carbohydrate'] }}">
        @endforeach
        <div class="flex justify-around items-center mb-4">
            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="p-2 border rounded">
            <select name="meal_type" form="mealForm" class=" border rounded">
                <option value="0">朝食</option>
                <option value="1">昼食</option>
                <option value="2">夕食</option>
                <option value="3">間食</option>
            </select>
        </div>
        <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700"
            wire:confirm="食事を追加しますか?">食事追加</button>
    </form>
</div>
