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
                        class="inline-block w-4/5 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-xl text-center leading-6 font-medium text-gray-900">
                                食品検索
                            </h3>
                            <div class="mt-4">
                                <form class="text-right">
                                    <input type="search" wire:model="searchTerm" placeholder="食品名を入力"
                                        class="w-4/5 rounded-full text-center border border-gray-300 p-2">
                                    <button wire:click.prevent="updateSearchTerm"
                                        class="mx-4 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">検索</button>
                                </form>
                                @if ($foods === null)
                                    <p class="text-center mt-4">検索結果が見つかりません</p>
                                @elseif ($foods)
                                    <table class="min-w-full bg-white mt-4">
                                        <thead class="bg-gray-200">
                                            <tr>
                                                <th class="py-2 px-4 border-b">食品名 (100gあたり)</th>
                                                <th class="py-2 px-4 border-b">カロリー(kcal)</th>
                                                <th class="py-2 px-4 border-b">タンパク質(g)</th>
                                                <th class="py-2 px-4 border-b">脂質(g)</th>
                                                <th class="py-2 px-4 border-b">炭水化物(g)</th>
                                                <th class="py-2 px-4 border-b"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($foods as $food)
                                                <tr class="hover:bg-gray-100">
                                                    <td class="py-2 px-4 border-b">{{ $food->name }}</td>
                                                    <td class="py-2 px-4 border-b">{{ $food->calorie }}kcal</td>
                                                    <td class="py-2 px-4 border-b">{{ $food->protein }}g</td>
                                                    <td class="py-2 px-4 border-b">{{ $food->fat }}g</td>
                                                    <td class="py-2 px-4 border-b">{{ $food->carbohydrate }}g</td>
                                                    <td class="py-2 px-4 border-b text-center">
                                                        <button type="button" wire:click="selectFood({{ $food }})"
                                                            class="px-4 py-1 text-white bg-emerald-500 rounded hover:bg-emerald-700">追加</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
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
