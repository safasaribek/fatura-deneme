<x-app-layout>

    <x-slot name="header">
        <div class="w-full flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cariler') }}
            </h2>
            <a href="{{route('cariler.create')}}" class="self-end">
                <x-primary-button>{{__('Cari Ekle')}}</x-primary-button>
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
                                {{ __('Adi') }}
                            </th>
                            <th>
                                {{ __('Soyadi') }}
                            </th>
                            <th>
                                {{ __('Email') }}
                            </th>
                            <th>
                                {{ __('Kimlik No') }}
                            </th>
                            <th>
                                {{ __('Vergi No') }}
                            </th>
                            <th>
                                {{ __('Cari Tipi') }}
                            </th>
                            <th>
                                {{ __('Telefon') }}
                            </th>
                            <th>
                                {{ __('Adres') }}
                            </th>
                            <th>
                                {{ __('Düzenle') }}
                            </th>
                        </tr>
                        </thead>

                        <tbody class="divide-y-2 divide-gray-300">

                        @foreach($cariler as $cari)
                            <tr class="text-left hover:bg-gray-100">
                                <td class="py-2">
                                    {{ $cari->adi }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->soyadi }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->email }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->kimlikno }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->vergino }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->caritipi }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->telefon }}
                                </td>
                                <td class="py-2">
                                    {{ $cari->adres }}
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <a href="{{ route('cariler.edit', $cari) }}">
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
