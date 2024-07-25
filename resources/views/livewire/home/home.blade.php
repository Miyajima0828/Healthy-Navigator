<x-app-layout>
    <div>
        @if (session()->has('message'))
            <div class="animate-flash fixed top-24 translate-x-1/2 right-6 sm:translate-x-0 z-30 w-fit max-w-[90%] sm:max-w-1/2 py-4 px-6 flex justify-center items-center bg-white shadow-lg border border-line-100 rounded-[3px]">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="w-4/5 mx-auto my-3 grid grid-cols-2 gap-4 justify-center items-center">
        <div class="h-full flex justify-center items-center mt-4">
            @livewire('home.todays-nutrition-intake-component')
        </div>
        <div class="h-full flex justify-center items-center mt-4">
            @livewire('home.todays-achievement-component')
        </div>
        <div class="h-full flex justify-center items-center">
            @livewire('home.yesterdays-meal-record-component')
        </div>
        <div class="h-full flex justify-center items-center">
            @livewire('home.weekly-achievement-component')
        </div>
    </div>
</x-app-layout>
