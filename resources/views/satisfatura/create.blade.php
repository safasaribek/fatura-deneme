<x-app-layout>

    <x-slot name="header">
        <div class="w-full flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Fatura Ekle') }}
            </h2>
        </div>
    </x-slot>

    <livewire:invoice/>
</x-app-layout>


