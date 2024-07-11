<div>
    <table class="mx-auto">
        <thead>
            <tr>
                <th>食品名</th>
                <th>量(g)</th>
                <th>カロリー(kcal)</th>
                <th>タンパク質(g)</th>
                <th>脂質(g)</th>
                <th>炭水化物(g)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <td>{{ $food['name'] }}</td>
                    <td>
                        <input type="number" wire:change="updateQuantity({{ $food['id'] }}, $event.target.value)"
                            value="{{ $food['quantity'] }}">
                    </td>
                    <td>{{ $food['calorie'] }} kcal</td>
                    <td>{{ $food['protein'] }} g</td>
                    <td>{{ $food['fat'] }} g</td>
                    <td>{{ $food['carbohydrate'] }} g</td>
                    <td>
                        <button wire:click="removeFood({{ $food['id'] }})"
                            class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">削除</button>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('meal.store') }}" method="POST" id="mealForm" class="m-auto w-3/5 grid gap-20 grid-cols-1 grid-rows-2 ">
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
        <div class="flex justify-around">
            <input type="date" name="date" value="{{ date("Y-m-d") }}">
            <select name="meal_type" form="mealForm">
                <option value="0">朝食</option>
                <option value="1">昼食</option>
                <option value="2">夕食</option>
                <option value="3">間食</option>
            </select>
        </div>
        <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700"
            wire:confirm="食事を追加しますか?">食事追加</button>
    </form>
</div>
