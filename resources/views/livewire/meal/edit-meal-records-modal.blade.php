<div>
    {{-- 食事記録を編集するための表示 --}}
    @if ($is_show)
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal()">
                </div>
                <div
                    class="inline-block w-4/5 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl text-center leading-6 font-medium text-black">
                            食事記録編集
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('meal.store') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-7 gap-4 items-center">
                                    <div>食品名</div>
                                    <div>量(g)</div>
                                    <div>カロリー(kcal)</div>
                                    <div>タンパク質</div>
                                    <div>脂質</div>
                                    <div>炭水化物</div>
                                    <div>@livewire('food.search-food-modal')
                                    </div>
                                    @foreach ($foods as $food)
                                        <div>{{$foods[$food['id']]['name']}}</div>
                                        <div>
                                            <input type="number" name="foods[{{ $food['id'] }}][quantity]"
                                                wire:change="updateQuantity({{ $food['id'] }}, $event.target.value)"
                                                value="{{ $food['quantity'] }}" class="w-full p-2 border rounded">
                                        </div>
                                        <div>{{ $foods[$food['id']]['calorie'] }}</div>
                                        <div>{{ $foods[$food['id']]['protein'] }}</div>
                                        <div>{{ $foods[$food['id']]['fat'] }}</div>
                                        <div>{{ $foods[$food['id']]['carbohydrate'] }}</div>
                                        <input type="hidden" name="foods[{{ $food['id'] }}][name]"
                                            value="{{ $food['name'] }}">
                                        <input type="hidden" name="foods[{{ $food['id'] }}][id]"
                                            value="{{ $food['id'] }}">
                                        <input type="hidden" name="foods[{{ $food['id'] }}][calorie]"
                                            value="{{ $food['calorie'] }}">
                                        <input type="hidden" name="foods[{{ $food['id'] }}][protein]"
                                            value="{{ $food['protein'] }}">
                                        <input type="hidden" name="foods[{{ $food['id'] }}][fat]"
                                            value="{{ $food['fat'] }}">
                                        <input type="hidden" name="foods[{{ $food['id'] }}][carbohydrate]"
                                            value="{{ $food['carbohydrate'] }}">
                                        <input type="hidden" name="date" value="{{ $meal->date }}"
                                            class="p-2 border rounded">
                                        <input type="hidden" name="meal_type"
                                            value="{{ $meal->getOriginalMealTypeAttribute() }}">
                                        <button type="button" wire:click="removeFood({{ $food['id'] }})">
                                            ✕
                                        </button>
                                    @endforeach
                                    <button type="submit"
                                        class="w-full px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                        保存
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
