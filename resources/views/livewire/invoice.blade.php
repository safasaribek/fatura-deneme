<div>
    <x-session-errors/>
    <form class="max-w-7xl mx-auto p-5 flex flex-col items-start gap-10" method="post"
          action="{{ isset($invoice->id) ? route('satisfatura.update',$invoice->id) : route('satisfatura.store') }}">
        @csrf

        @if(isset($invoice->id))
            @method('PUT')
        @endif

        <div class="w-full flex flex-col items-start gap-5">

            <div class="w-full flex gap-5">
                <div class="w-[80%] flex flex-col gap-5 flex-wrap bg-white p-10 rounded-2xl">
                    <div>
                        <x-input-label :value="__('Cariler')"/>
                        {{--                        <select wire:model="cari" data-te-select-init data-te-select-filter="true" name="cari"--}}
                        {{--                                class="rounded-lg border-gray-300 mt-2">--}}
                        {{--                            <option value="" selected>Seçiniz</option>--}}
                        {{--                            @foreach($clients as $client)--}}
                        {{--                                <option value="{{$client['id']}}">{{$client['name']}}</option>--}}
                        {{--                            @endforeach--}}
                        {{--                        </select>--}}
                        <select name="client"
                                class="w-full rounded-lg border-gray-300 mt-2" required>
                            <option value="" selected>Seçiniz</option>
                            @foreach($clients as $client)
                                <option
                                    value="{{$client['id']}}" {{$invoice && $invoice->client_id == $client->id ? 'selected' : ''}}>
                                    {{$client['name'].' '.$client['surname']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="invoiceNo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fatura No')}}</label>
                        <input id="invoiceNo" name="invoiceNo" type="number"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                               required value="{{$invoice->invoice_number ?? ''}}">
                    </div>
                </div>
                <div class="w-[20%] flex flex-col gap-5 flex-wrap bg-white p-10 rounded-2xl">
                    <div>
                        <label for="invoiceDate"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fatura Tarihi')}}</label>
                        <input
                            value="{{$invoice ? \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') : date('Y-m-d')}}"
                            id="invoiceDate" name="invoiceDate"
                            type="date"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            required>
                    </div>
                    <div>
                        <label for="deadline"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Son Ödeme Tarihi')}}</label>
                        <input
                            value="{{$invoice ? \Carbon\Carbon::parse($invoice->deadline)->format('Y-m-d') : date('Y-m-d')}}"
                            id="deadline"
                            name="deadline" type="date"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            required>
                    </div>
                </div>
            </div>

            <div class="w-full flex gap-5">
                <div class="w-[80%] flex flex-col gap-5 flex-wrap bg-white p-10 rounded-2xl">
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th>İsim</th>
                            <th>Miktar</th>
                            <th>Fiyat</th>
                            <th>İskonto(%)</th>
                            <th>KDV(%)</th>
                            <th>Toplam</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rows as $index => $row)
                            <tr>
                                <td>
                                    {{--                                    <select data-te-select-init data-te-select-filter="true"--}}
                                    {{--                                            wire:model.live="rows.{{ $index }}.item" name="items[{{$index}}][name]"--}}
                                    {{--                                            class="rounded-lg border-gray-300">--}}
                                    {{--                                        <option value="" selected>Seçiniz</option>--}}
                                    {{--                                        @foreach($items as $item)--}}
                                    {{--                                            <option value="{{$item['id']}}">{{$item['name']}}</option>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                    </select>--}}
                                    <select wire:model.live="rows.{{ $index }}.item" name="items[{{$index}}][name]"
                                            class="w-full rounded-lg border-gray-300">
                                        <option value="" selected>Seçiniz</option>
                                        @foreach($items as $item)
                                            <option value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input wire:model.change="rows.{{ $index }}.quantity"
                                           name="items[{{$index}}][quantity]" type="number"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                           placeholder="Miktar" required>
                                </td>
                                <td>
                                    <input wire:model.change="rows.{{ $index }}.price" name="items[{{$index}}][price]"
                                           type="number"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                           placeholder="Fiyat" required>
                                </td>
                                <td>
                                    <input wire:model.change="rows.{{ $index }}.discount"
                                           name="items[{{$index}}][discountRate]" type="number"
                                           class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                           placeholder="İskonto" required>

                                    <input type="hidden" name="items[{{$index}}][discountTotal]"
                                           value="{{$row['discountTotal'] ?? 0}}">
                                </td>
                                <td>
                                    <select required wire:model.change="rows.{{ $index }}.vat"
                                            name="items[{{$index}}][vatRate]" class="w-full rounded-lg border-gray-300">
                                        <option value="0" selected>0</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                    </select>

                                    <input type="hidden" name="items[{{$index}}][vatTotal]"
                                           value="{{$row['vatTotal'] ?? 0}}">
                                </td>
                                <td class="text-center">
                                    <span>{{number_format($row['grandTotal'],2,',','.')}} {{$currency}}</span>

                                    <input type="hidden" name="items[{{$index}}][invItmTotal]"
                                           value="{{$row['total']}}">
                                    <input type="hidden" name="items[{{$index}}][invItmGrandTotal]"
                                           value="{{$row['grandTotal']}}">
                                </td>
                                <td>
                                    <button wire:click="removeRow({{ $index }})" type="button"
                                            class="self-end ml-10 text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Sil
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <h1 class="mt-10 flex justify-end font-bold text-red-500">
                        Toplam : {{number_format($total,2,',','.')}} {{$currency}}
                        <input type="hidden" name="invoiceTotal" value="{{number_format($total,2)}}">
                    </h1>
                    <h1 class="-mt-5 flex justify-end font-bold text-red-500">
                        İskonto Toplam : {{number_format($discountTotal,2,',','.')}} {{$currency}}
                        <input type="hidden" name="discountTotal" value="{{number_format($discountTotal,2)}}">
                    </h1>
                    <h1 class="-mt-5 flex justify-end font-bold text-red-500">
                        KDV Toplam : {{number_format($vatTotal,2,',','.')}} {{$currency}}
                        <input type="hidden" name="vatTotal" value="{{number_format($vatTotal,2)}}">
                    </h1>
                    <h1 class="-mt-5 flex justify-end font-bold text-red-500">
                        Genel Toplam : {{number_format($grandTotal,2,',','.')}} {{$currency}}
                        <input type="hidden" name="grandTotal" value="{{number_format($grandTotal,2)}}">
                    </h1>
                    <button wire:click="addRow" type="button"
                            class="self-end mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Satır Ekle
                    </button>
                </div>
                <div class="w-[20%] flex flex-col gap-5 flex-wrap bg-white p-10 rounded-2xl">
                    <div>
                        <label for="paymentMethod"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Ödeme Yöntemi')}}</label>
                        <select name="paymentMethod" class="w-full rounded-lg border-gray-300">
                            <option value="1" {{$invoice && $invoice->payment_method == 1 ? 'selected':''}}>
                                {{__('Nakit')}}
                            </option>
                            <option value="2" {{$invoice && $invoice->payment_method == 2 ? 'selected':''}}>
                                {{__('Kredi Kartı')}}
                            </option>
                            <option value="3" {{$invoice && $invoice->payment_method == 3 ? 'selected':''}}>
                                {{__('Havale')}}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="paymentStatus"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Ödeme Durumu')}}</label>
                        <select name="paymentStatus"
                                class="w-full rounded-lg border-gray-300">
                            <option value="1" {{$invoice && $invoice->payment_status == 1 ? 'selected':''}}>
                                {{__('Ödendi')}}
                            </option>
                            <option value="2" {{$invoice && $invoice->payment_status == 2 ? 'selected':''}}>
                                {{__('Ödenmedi')}}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="currency"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Para Birimi')}}</label>
                        <select wire:change="unit" wire:model="currency" name="currency"
                                class="w-full rounded-lg border-gray-300">
                            <option value="₺">{{__('Türk Lirası')}}</option>
                            <option value="$">{{__('Dolar')}}</option>
                            <option value="€">{{__('Euro')}}</option>
                        </select>
                    </div>
                    <div>
                        <label for="currencyRate"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Kur')}}</label>
                        <input wire:model.live="currencyRate" id="currencyRate"
                               name="currencyRate" type="number"
                               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                               required>
                    </div>
                </div>
            </div>

            <button type="submit"
                    class="self-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Kaydet
            </button>
        </div>
    </form>
    @if(isset($invoice->id))
        <form action="{{ route('satisfatura.destroy', $invoice) }}" method="post" class="max-w-7xl mx-auto pr-5">
            @csrf
            @method('DELETE')

            <div class="flex justify-end">
                <x-danger-button>
                    {{ __('Faturayı Sil') }}
                </x-danger-button>
            </div>
        </form>
    @endif
</div>
