<div>
    @if ($is_show)
        <x-modal>
            <form>
                <input type="text" wire:model.live="searchTerm" placeholder="食品名を入力">
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
                                <td>
                                    {{ $food->name }}
                                </td>
                                <td>
                                    {{ $food->calorie }}kcal
                                </td>
                                <td>
                                    {{ $food->protein }}g
                                </td>
                                <td>
                                    {{ $food->fat }}g
                                </td>
                                <td>
                                    {{ $food->carbohydrate }}g
                                </td>
                                <td>
                                    <button wire:click="selectFood({{ $food }})">選択</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </x-modal>
    @endif
</div>
