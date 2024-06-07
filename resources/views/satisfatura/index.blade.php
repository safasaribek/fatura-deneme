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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col">
                    <table class="table-auto w-full">
                        <thead class="border-b-2 border-gray-300">
                        <tr class="text-left">
                            <th>{{__('Cari')}}</th>
                            <th>{{__('Fatura No')}}</th>
                            <th>{{__('Ödeme Yöntemi')}}</th>
                            <th>{{__('Ödeme Durumu')}}</th>
                            <th>{{__('Fatura Tarihi')}}</th>
                            <th>{{__('Son Ödeme Tarihi')}}</th>
                            <th>{{__('Fatura Toplamı')}}</th>
                            <th class="flex justify-end">{{__('İşlemler')}}</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y-2 divide-gray-300">
                        @foreach($invoices as $invoice)
                            <tr class="text-left hover:bg-gray-100">
                                <td>
                                    {{ $invoice->client->name.' '.$invoice->client->surname }}
                                </td>
                                <td>
                                    {{ $invoice->invoice_number }}
                                </td>
                                <td class="py-2">
                                    @if($invoice['payment_method'] == 1)
                                        {{__('Nakit')}}
                                    @elseif($invoice['payment_method'] == 2)
                                        {{__('Kredi Kartı')}}
                                    @else
                                        {{__('Havale')}}
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if($invoice['payment_status'] == 1)
                                        {{__('Ödendi')}}
                                    @elseif($invoice['payment_status'] == 2)
                                        {{__('Ödenmedi')}}
                                    @endif
                                </td>
                                <td class="py-2">
                                    {{\Carbon\Carbon::parse($invoice['invoice_date'])->format('d-m-Y')}}
                                </td>
                                <td class="py-2">
                                    {{\Carbon\Carbon::parse($invoice['deadline'])->format('d-m-Y')}}
                                </td>
                                <td class="py-2">
                                    {{$invoice->grand_total}}
                                </td>

                                <td class="py-2 flex flex-row items-center justify-end gap-5">
                                    <a href="{{ route('satisfatura.edit', $invoice) }}">
                                        <x-secondary-button class="bg-gray-600 text-white">
                                            {{ __('Düzenle') }}
                                        </x-secondary-button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--                    <span class="mt-5 self-end">Toplam = {{$toplam}}</span>--}}
                    {{--                    <span class="self-end">İskonto = {{$iskonto}}</span>--}}
                    {{--                    <span class="self-end">KDV = {{$kdv}}</span>--}}
                    {{--                    <span class="self-end">Genel T. = {{$geneltoplam}}</span>--}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
