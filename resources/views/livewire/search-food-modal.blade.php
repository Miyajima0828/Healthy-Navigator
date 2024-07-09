<div>
    <div>
        <button wire:click="openModal()" type="button"
            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            食品検索
        </button>

        @if ($is_show)
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal()">
                    </div>
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all w-full sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                食品検索
                            </h3>
                            <div class="mt-2">
                                <form>
                                    <input type="text" wire:model="searchTerm" placeholder="食品名を入力">
                                    <button wire:click.prevent="updateSearchTerm">検索</button>
                                </form>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>食品名</th>
                                            <th>カロリー(kcal)</th>
                                            <th>タンパク質(g)</th>
                                            <th>脂質(g)</th>
                                            <th>炭水化物(g)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($foods)
                                            @foreach ($foods as $food)
                                                <tr>
                                                    <td>{{ $food->name }}</td>
                                                    <td>{{ $food->calorie }}kcal</td>
                                                    <td>{{ $food->protein }}g</td>
                                                    <td>{{ $food->fat }}g</td>
                                                    <td>{{ $food->carbohydrate }}g</td>
                                                    <td>
                                                        <button wire:click="selectFood({{ $food }})">選択</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="closeModal()" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700">
                                閉じる
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
