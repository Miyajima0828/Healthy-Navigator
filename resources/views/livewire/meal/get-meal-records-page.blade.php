<div class="container mx-auto px-4 py-6">
    <div>
        @if (session()->has('message'))
            <div class="animate-flash fixed top-24 translate-x-1/2 right-6 sm:translate-x-0 z-30 w-fit max-w-[90%] sm:max-w-1/2 py-4 px-6 flex justify-center items-center bg-white shadow-lg border border-line-100 rounded-[3px]">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('これまでの食事記録') }}
            </h2>
        </div>
    </x-slot>
    <div class="flex justify-center mb-6">
        <form wire:submit.prevent="getMealRecordsByDate" class="w-1/3 rounded-lg flex justify-center items-center">
            <div class="flex-1">
                <div class="flex justify-center">
                    <input type="date" id="date" wire:model="selectedDate"
                        class="w-3/4 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <button type="submit"
                        class="bg-slate-400 hover:bg-slate-500 text-sm text-white font-bold ml-2 p-2 rounded focus:outline-none focus:shadow-outline">
                        <span class="material-symbols-outlined align-middle">
                            search
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="overflow-x-auto">
        <div class="min-w-max">
            <div class="grid grid-cols-8 gap-0 border border-gray-600">
                <!-- Header Row -->
                <div class="col-span-1 font-bold border border-gray-600 px-2 py-2 text-center bg-orange-200 ">

                </div>
                @foreach ($week as $date)
                    <div class="col-span-1 font-bold border border-gray-600 px-4 py-2 text-center bg-orange-200 ">
                        {{ $date->format('m/d(D)') }}
                    </div>
                @endforeach
                <!-- Data Rows -->
                @foreach (['朝食', '昼食', '夕食', '間食'] as $mealType)
                    <div
                        class="left-0 col-span-1 font-bold border border-gray-600 px-2 py-2 bg-orange-200 text-center place-content-center h-40 overflow-auto">
                        {{ $mealType }}
                    </div>
                    @foreach ($week as $date)
                        <div
                            class="group relative col-span-1 border border-gray-600 px-4 py-2 {{ $today->format('Y-m-d') === $date->format('Y-m-d') ? 'bg-yellow-100' : 'bg-white' }} h-40 overflow-auto">
                            @php
                                $meal = $mealRecords
                                    ->where('date', $date->format('Y-m-d'))
                                    ->firstWhere('meal_type', $mealType);
                            @endphp
                            @if ($meal)
                                <ul>
                                    <li>総摂取カロリー: {{ round($meal->total_calories) }} kcal</li>
                                    <li>
                                        <ul>
                                            @foreach ($meal->foods as $food)
                                                <li class="text-sm py-2">{{ $food->short_name }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            @else
                                <p>登録なし</p>
                            @endif
                            <div class="px-4 py-2 text-center">
                                @if ($meal)
                                    <div class="flex justify-end">
                                        <button
                                            wire:click="deleteMealRecord({{ $meal->id }})"
                                            class="hidden group-hover:block absolute top-2 right-2 px-2 py-1 font-bold text-white bg-gray-500 opacity-25 rounded hover:bg-red-700 hover:opacity-100"
                                            wire:confirm="食事記録を削除しますか？"
                                        >
                                            ✕
                                        </button>
                                    </div>
                                    <div>
                                        <div class="flex justify-end">
                                            <button
                                                wire:click="editMealRecord({{ $meal }})"
                                                class="hidden group-hover:block absolute bottom-2 right-2 px-2 py-1 font-bold text-white bg-gray-500 opacity-50 rounded hover:bg-green-500 hover:opacity-100"
                                            >
                                                編集
                                            </button>
                                            @livewire('meal.edit-meal-records-modal')
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex justify-center items-center">
        <form wire:submit.prevent="showPreviousWeek">
            <input type="hidden" wire:model="selectedDate">
            <button type="submit" class="m-2 font-bold text-slate-500 rounded hover:text-slate-700">
                <span class="material-symbols-outlined align-middle">
                    chevron_left
                </span>
            </button>
        </form>
        <div class="m-2 font-bold text-slate-500">
            {{ $startOfWeek->format('Y年m月') }}
            第{{ ceil((date('d', strtotime($startOfWeek)) - date('w', strtotime($startOfWeek)) - 1) / 7) + 1 }}週目
        </div>
        <form wire:submit.prevent="showNextWeek">
            <input type="hidden" wire:model="selectedDate">
            <button type="submit" class="m-2 font-bold text-slate-500 rounded hover:text-slate-700">
                <span class="material-symbols-outlined align-middle">
                    chevron_right
                </span>
            </button>
        </form>
    </div>
</div>
