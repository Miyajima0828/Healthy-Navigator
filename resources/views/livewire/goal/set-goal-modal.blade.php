<div>
    <button wire:click="openModal()" type="button"
        class="px-4 py-2 font-bold text-white bg-amber-500 rounded hover:bg-amber-700">
        目標設定
    </button>

    @if ($is_show)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal()">
                </div>
                <div
                    class="inline-block w-4/5 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-xl text-center leading-6 font-medium text-black">
                            一日の目標摂取量
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('goal.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <label for="calorie" class="text-lg text-gray-700">
                                            カロリー(kcal)
                                        </label>
                                    </div>
                                    <input type="number" name="goal[calorie]" value={{old('goal[calorie]',$goal ? $goal->calorie : 0)}} id="calorie"
                                        class="w-4/5 m-auto rounded-full text-center border border-gray-300 p-2">
                                    <div class="text-center">
                                        <label for="protein" class="text-lg text-gray-700">
                                            タンパク質(g)
                                        </label>
                                    </div>
                                    <input type="number" name="goal[protein]" value={{old('goal[protein]',$goal ? $goal->protein : 0)}} id="protein"
                                        class="w-4/5 m-auto rounded-full text-center border border-gray-300 p-2">
                                    <div class="text-center">
                                        <label for="fat" class="text-lg text-gray-700">
                                            脂質(g)
                                        </label>
                                    </div>
                                    <input type="number" name="goal[fat]" value={{old('goal[fat]',$goal ? $goal->fat : 0)}} id="fat"
                                        class="w-4/5 m-auto rounded-full text-center border border-gray-300 p-2">
                                    <div class="text-center">
                                        <label for="carbohydrate" class="text-lg text-gray-700">
                                            炭水化物(g)
                                        </label>
                                    </div>
                                    <input type="number" name="goal[carbohydrate]" value={{old('goal[carbohydrate]',$goal ? $goal->carbohydrate : 0)}} id="carbohydrate"
                                        class="w-4/5 m-auto rounded-full text-center border border-gray-300 p-2">
                                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button wire:click="closeModal()" type="button"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50">
                                            閉じる
                                        </button>
                                    </div>
                                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="submit"
                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50">
                                            保存
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
