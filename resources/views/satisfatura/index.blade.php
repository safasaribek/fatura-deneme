<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Satış Faturası') }}
        </h2>
    </x-slot>

{{--    <form class="m-10 flex flex-row items-center mb-5 gap-10" method="post" action="{{ route('satisfatura.store') }}">--}}
{{--        @csrf--}}
{{--        <div>--}}
{{--            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Adı</label>--}}
{{--            <input id="stok" name="stokadi" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Stok Adı" required>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label for="miktar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Miktar</label>--}}
{{--            <input id="miktar" name="miktar" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Miktar" required>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label for="fiyat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fiyat</label>--}}
{{--            <input id="fiyat" name="fiyat" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Fiyat" required>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label for="kdv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">KDV</label>--}}
{{--            <input id="kdv" name="kdv" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="%" required>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <label for="iskonto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">İskonto</label>--}}
{{--            <input id="iskonto" name="iskonto" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="%" required>--}}
{{--        </div>--}}
{{--        <button type="submit" class="mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kaydet</button>--}}
{{--    </form>--}}

    @livewireStyles
    <livewire:counter/>
    {{--    @livewire('counter')--}}
    {{--    <livewire:hello-world/>--}}
    @livewireScripts

    <div class="flex flex-col">
        <table class="table-auto w-full m-10 max-w-7xl overflow-auto">
            <thead class="border-b-2 border-gray-300">
            <tr class="text-left">
                <th>{{__('Stok Adı')}}</th>
                <th>{{__('Miktar')}}</th>
                <th>{{__('Fiyat')}}</th>
                <th>{{__('İskonto')}}</th>
                <th>{{__('KDV')}}</th>
                <th>{{__('Kur')}}</th>
                <th>{{__('Para Birimi')}}</th>
                <th>{{__('Ödeme Yöntemi')}}</th>
                <th>{{__('Fatura Tarihi')}}</th>
                <th>{{__('Son Ödeme Tarihi')}}</th>
                <th>{{__('Toplam')}}</th>
                <th class="flex justify-end">{{__('Düzenle')}}</th>
            </tr>
            </thead>
            <tbody class="divide-y-2 divide-gray-300">
            @foreach($sfatura as $f)
                <tr class="text-left hover:bg-gray-100">
                    <td class="py-2">
                        {{\App\Models\Stok::where('id',$f['stokadi'])->value('stokadi')}}
                    </td>
                    <td class="py-2">
                        {{$f['miktar']}}
                    </td>
                    <td class="py-2">
                        {{$f['fiyat']}}
                    </td>
                    {{--İSKONTO === ($f['miktar']*$f['fiyat'])*($f['iskonto']/100)--}}
                    <td class="py-2">
                        %{{$f['iskonto']}}
                    </td>
                    {{--KDV === ($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100))*($f['kdv']/100)--}}
                    <td class="py-2">
                        %{{$f['kdv']}}
                    </td>
                    <td class="py-2">
                        {{$f['kur']}}
                    </td>
                    <td class="py-2">
                        {{$f['parabirimi']}}
                    </td>
                    <td class="py-2">
                        @if($f['odemeyontemi'] == 1)
                            {{__('Nakit')}}
                        @elseif($f['odemeyontemi'] == 2)
                            {{__('Kredi Kartı')}}
                        @else
                            {{__('Havale')}}
                        @endif
                    </td>
                    <td class="py-2">
                        {{$f['faturatarihi']}}
                    </td>
                    <td class="py-2">
                        {{$f['sontarih']}}
                    </td>
                    {{--TOPLAM--}}
                    <td class="py-2">
                        {{($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100))+($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100))*($f['kdv']/100)}}
                    </td>
                    <td class="py-2">
                        <form action="{{ route('satisfatura.destroy', $f) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <div class="flex justify-end">
                                <x-danger-button>
                                    {{ __('Sil') }}
                                </x-danger-button>
                            </div>

                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <span class="mr-16 mb-20 self-end">
            TOPLAM = {{$toplam}}
        </span>
    </div>

</x-app-layout>
