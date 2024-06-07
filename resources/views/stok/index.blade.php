<x-app-layout>

    <x-slot name="header">
        <div class="w-full flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Stoklar') }}
            </h2>
            <a href="{{route('stoklar.create')}}" class="self-end">
                <x-primary-button>{{__('Stok Ekle')}}</x-primary-button>
            </a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <table class="table-auto w-full">
                        <thead class="border-b-2 border-gray-300">
                        <tr class="text-left">
                            <th>
                                {{ __('Stok Adı') }}
                            </th>
                            <th>
                                {{ __('Birim') }}
                            </th>
                            <th>
                                {{ __('Miktar') }}
                            </th>
                            <th>
                                {{ __('Fiyat') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody class="divide-y-2 divide-gray-300">

                        @foreach($stoklar as $stok)
                            <tr class="text-left hover:bg-gray-100">
                                <td class="py-2">
                                    {{ $stok->name }}
                                </td>
                                <td class="py-2">
                                    {{ $stok->unit }}
                                </td>
                                <td class="py-2">
                                    {{ $stok->quantity }}
                                </td>
                                <td class="py-2">
                                    {{ $stok->price }}
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <a href="{{ route('stoklar.edit', $stok) }}">
                                            <x-secondary-button class="bg-gray-600 text-white">
                                                {{ __('Düzenle') }}
                                            </x-secondary-button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
