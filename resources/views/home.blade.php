<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('home') }}
        </h2>
    </x-slot>
    
    <div class=" m-10">
        <livewire:search-food-modal />
    </div>
</x-app-layout>
