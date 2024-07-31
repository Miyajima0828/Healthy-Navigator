<div>
    {{-- 食事記録を編集するための表示 --}}
    @if ($is_show)
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-8 py-8">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal()"></div>
                <div
                    class="inline-block align-middle w-full max-w-4xl min-h-96 bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl text-center leading-6 font-medium text-black">
                            食事記録編集
                        </h3>
                        <div class="mt-4 min-h-96">
                            <form action="{{ route('meal.store') }}" method="POST" class="min-h-96">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-7 items-center mb-4 min-h-96">
                                    <div class="font-semibold text-center">食品名</div>
                                    <div class="font-semibold text-center">量(g)</div>
                                    <div class="font-semibold text-center">カロリー(kcal)</div>
                                    <div class="font-semibold text-center">タンパク質</div>
                                    <div class="font-semibold text-center">脂質</div>
                                    <div class="font-semibold text-center">炭水化物</div>
                                    <div class="font-semibold text-center">
                                        @livewire('food.search-food-modal')
                                    </div>
                                    @foreach ($foods as $food)
                                        <div class="col-span-7 grid grid-cols-7 gap-4 items-center">
                                            <div class="col-span-1">{{ $foods[$food['id']]['name'] }}</div>
                                            <div class="col-span-1">
                                                <input type="number" name="foods[{{ $food['id'] }}][quantity]"
                                                    wire:change="updateQuantity({{ $food['id'] }}, $event.target.value)"
                                                    value="{{ $food['quantity'] }}" class="w-full p-2 border rounded">
                                                    @error('foods.'.$food['id'].'.quantity') <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="col-span-1">{{ $foods[$food['id']]['calorie'] }}</div>
                                            <div class="col-span-1">{{ $foods[$food['id']]['protein'] }}</div>
                                            <div class="col-span-1">{{ $foods[$food['id']]['fat'] }}</div>
                                            <div class="col-span-1">{{ $foods[$food['id']]['carbohydrate'] }}</div>
                                            <div class="col-span-1 flex justify-end">
                                                <button type="button" wire:click="removeFood({{ $food['id'] }})"
                                                    class="px-2 py-1 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                                    ✕
                                                </button>
                                            </div>
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
                                        </div>
                                    @endforeach
                                    <div></div>
                                    <div class="col-span-2">
                                        <button type="button" wire:click="closeModal()"
                                            class="w-full px-4 py-2 font-bold text-white bg-slate-400 rounded hover:bg-slate-500">
                                            閉じる
                                        </button>
                                    </div>
                                    <div></div>
                                    <div class="col-span-2 flex justify-end">
                                        <button type="submit"
                                            class="w-full px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                            保存
                                        </button>
                                    </div>
                                    <div></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
