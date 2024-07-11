<x-app-layout>
    <div>
        @if (session()->has('message'))
        <div class="animate-flash fixed top-24 translate-x-1/2 right-6 sm:translate-x-0 z-30 w-fit max-w-[90%] sm:max-w-1/2 py-4 px-6 flex justify-center items-center bg-white shadow-lg border border-line-100 rounded-[3px]">
            {{ session('message') }}
            </div>
        @endif
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'ホーム' }}
        </h2>
    </x-slot>

</x-app-layout>
