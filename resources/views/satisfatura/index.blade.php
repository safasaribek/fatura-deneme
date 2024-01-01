<x-app-layout>

    <x-slot name="header">
        <div class="w-full flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Satış Faturası') }}
            </h2>
            <a href="{{route('satisfatura.create')}}" class="self-end">
                <x-primary-button>{{__('Fatura Ekle')}}</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="flex flex-col">
        <table class="table-auto w-full m-10 max-w-7xl overflow-auto">
            <thead class="border-b-2 border-gray-300">
            <tr class="text-left">
{{--                <th>{{__('Stok Adı')}}</th>--}}
{{--                <th>{{__('Miktar')}}</th>--}}
{{--                <th>{{__('Fiyat')}}</th>--}}
{{--                <th>{{__('İskonto')}}</th>--}}
{{--                <th>{{__('KDV')}}</th>--}}
{{--                <th>{{__('Kur')}}</th>--}}
{{--                <th>{{__('Para Birimi')}}</th>--}}
{{--                <th>{{__('Toplam')}}</th>--}}
                <th>{{__('Ödeme Yöntemi')}}</th>
                <th>{{__('Fatura Tarihi')}}</th>
                <th>{{__('Son Ödeme Tarihi')}}</th>
                <th class="flex justify-end">{{__('İşlemler')}}</th>
            </tr>
            </thead>
            <tbody class="divide-y-2 divide-gray-300">
            @foreach($sfatura as $f)
                <tr class="text-left hover:bg-gray-100">
{{--                    @foreach($faturaurunu as $urun)--}}
{{--                        <td class="py-2">--}}
{{--                            {{\App\Models\Items::where('id',$urun['items_id'])->value('name')}}--}}
{{--                        </td>--}}
{{--                        <td class="py-2">--}}
{{--                            {{$urun['amount']}}--}}
{{--                        </td>--}}
{{--                        <td class="py-2">--}}
{{--                            {{$urun['price']}}--}}
{{--                        </td>--}}
{{--                        --}}{{--İSKONTO === ($f['miktar']*$f['fiyat'])*($f['iskonto']/100)--}}
{{--                        <td class="py-2">--}}
{{--                            %{{$urun['discount']}}--}}
{{--                        </td>--}}
{{--                        --}}{{--KDV === ($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100))*($f['kdv']/100)--}}
{{--                        <td class="py-2">--}}
{{--                            %{{$urun['vat']}}--}}
{{--                        </td>--}}
{{--                        <td class="py-2">--}}
{{--                            {{$urun['rate']}}--}}
{{--                        </td>--}}
{{--                        <td class="py-2">--}}
{{--                            {{$urun['currency']}}--}}
{{--                        </td>--}}
{{--                        --}}{{--TOPLAM--}}
{{--                        <td class="py-2">--}}
{{--                            {{(($urun->amount*$urun->price-($urun->amount*$urun->price)*($urun->discount/100))+($urun->amount*$urun->price-($urun->amount*$urun->price)*($urun->discount/100))*($urun->vat/100))*$urun->rate}}--}}
{{--                        </td>--}}
{{--                    @endforeach--}}
                    <td class="py-2">
                        @if($f['payment_method'] == 1)
                            {{__('Nakit')}}
                        @elseif($f['payment_method'] == 2)
                            {{__('Kredi Kartı')}}
                        @else
                            {{__('Havale')}}
                        @endif
                    </td>
                    <td class="py-2">
                        {{$f['invoice_date']}}
                    </td>
                    <td class="py-2">
                        {{$f['deadline']}}
                    </td>

                    <td class="py-2 flex flex-row items-center justify-end gap-5">
                        <a href="{{ route('satisfatura.edit', $f) }}">
                            <x-secondary-button class="bg-gray-600 text-white">
                                {{ __('Düzenle') }}
                            </x-secondary-button>
                        </a>
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
