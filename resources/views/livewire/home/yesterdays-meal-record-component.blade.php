<div class="w-full h-full mt-4 px-2 bg-amber-50 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center my-4 text-slate-600">昨日の食事</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        @foreach ($yesterdaysMeals as $mealType => $meal)
            <div class="h-44 bg-indigo-50 p-4 rounded-lg shadow-sm flex flex-col justify-between h-full overflow-y-auto">
                <div>
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold mb-2 text-amber-600">{{ $mealType }}</h3>
                        <p class="text-sm text-gray-500">
                            {{ $meal
                                ? round(
                                    $meal->foods->sum(function ($food) {
                                        return $food->calorie * ($food->pivot->quantity / 100);
                                    }),
                                )
                                : 0 }}
                            kcal</p>
                    </div>
                    <ul class="list-disc list-inside">
                        @if (is_null($meal))
                            <li>食事なし</li>
                        @else
                            @foreach ($meal->foods as $food)
                                <li>{{ $food->short_name }} ({{ $food->pivot->quantity }}g)</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex justify-end mt-4">
        <a href="{{ route('meal.records') }}"
            class="px-4 text-lg text-yellow-300 hover:text-yellow-200 font-semibold bg-cyan-500 rounded-lg hover:bg-cyan-600">過去の記録を確認</a>
    </div>
</div>
