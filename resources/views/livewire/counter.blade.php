<div>

    <x-session-errors/>

    <form class="bg-white p-10 rounded-lg m-10 flex flex-col items-start mb-5 gap-10" method="post" action="{{ route('satisfatura.store') }}">
        @csrf
        <button type="submit" class="self-end mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kaydet</button>
        <div class="flex flex-row items-center gap-10">
            <div>
                <x-input-label :value="__('Cariler')"/>
                <select data-te-select-init name="cari" class="rounded-lg border-gray-300 mt-2">
                    @foreach($cariler as $cari)
                        <option value="{{$cari['id']}}">{{$cari['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="faturano" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fatura No')}}</label>
                <input id="faturano" name="faturano" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div>
                <label for="ftarih" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fatura Tarihi')}}</label>
                <input value="{{date('Y-m-d')}}" id="ftarih" name="ftarih" type="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div>
                <label for="sontarih" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Son Ödeme Tarihi')}}</label>
                <input value="{{date('Y-m-d')}}" id="sontarih" name="sontarih" type="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div>
                <label for="odemeyontemi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Ödeme Yöntemi')}}</label>
                <select data-te-select-init name="odemeyontemi" class="rounded-lg border-gray-300">
                    <option value="1">{{__('Nakit')}}</option>
                    <option value="2">{{__('Kredi Kartı')}}</option>
                    <option value="3">{{__('Havale')}}</option>
                </select>
            </div>
            <div>
                <label for="odemedurumu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Ödeme Durumu')}}</label>
                <select data-te-select-init name="odemedurumu" class="rounded-lg border-gray-300">
                    <option value="1">{{__('Ödendi')}}</option>
                    <option value="2">{{__('Ödenmedi ')}}</option>
                </select>
            </div>
            <div>
                <label for="parabirimi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Para Birimi')}}</label>
                <select wire:change="birim" wire:model="parabirimi" data-te-select-init name="parabirimi" class="rounded-lg border-gray-300">
                    <option value="₺">{{__('Türk Lirası')}}</option>
                    <option value="$">{{__('Dolar')}}</option>
                    <option value="€">{{__('Euro')}}</option>
                </select>
            </div>
            <div>
                <label for="kur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Kur')}}</label>
                <input wire:change="kurfunc" wire:model="kur" id="kur" name="kur" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
        </div>
        <div class="w-full">
            <table class="w-full">
                <thead>
                <tr>
                    <th>İsim</th>
                    <th>Miktar</th>
                    <th>Fiyat</th>
                    <th>İskonto</th>
                    <th>KDV</th>
                    <th>Toplam</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rows as $index => $row)
                    <tr>
                        <td>
                            <select wire:model.live="rows.{{ $index }}.item" data-te-select-init name="items[{{$index}}][name]" class="rounded-lg border-gray-300">
                                <option value="" selected>Seçiniz</option>
                                @foreach($stoklar as $stok)
                                    <option value="{{$stok['id']}}">{{$stok['name']}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input wire:model.live="rows.{{ $index }}.quantity" name="items[{{$index}}][quantity]" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Miktar" required>
                        </td>
                        <td>
                            <input wire:model.live="rows.{{ $index }}.price" name="items[{{$index}}][price]" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Fiyat" required>
                        </td>
                        <td>
                            <input wire:model.live="rows.{{ $index }}.discount" name="items[{{$index}}][discount]" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="İskonto" required>
                        </td>
                        <td>
                            <input wire:model.live="rows.{{ $index }}.tax" name="items[{{$index}}][tax]" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="KDV" required>
                        </td>
                        <td>
                            <span>{{$row['toplam']}} {{$parabirimi}}</span>
                        </td>
                        <td>
                            <button wire:click="removeRow({{ $index }})" type="button" class="self-end ml-10 text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sil</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h1 class="mt-10 flex justify-end font-bold text-red-500">Toplam : {{number_format($toplam,2,',','.')}} {{$parabirimi}}</h1>
            <button wire:click="addRow" type="button" class="self-end mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Satır Ekle</button>
        </div>
    </form>
</div>
