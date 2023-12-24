<div>
    <form class="bg-white p-10 rounded-lg m-10 flex flex-col items-start mb-5 gap-10" method="post" action="{{ route('satisfatura.update',$fatura) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-row items-center gap-10">
            <div>
                <x-input-label :value="__('Cariler')"/>
                <select wire:model="cari" data-te-select-init name="cari" class="rounded-lg border-gray-300 mt-2">
                    @foreach($cariler as $cari)
                        <option value="{{$cari['id']}}">{{$cari['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-input-label :value="__('Stoklar')"/>
                <select wire:model="stok" data-te-select-init name="stokadi" class="rounded-lg border-gray-300 mt-2">
                    @foreach($stoklar as $stok)
                        <option value="{{$stok['id']}}">{{$stok['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="miktar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Miktar')}}</label>
                <input wire:change="hesap" wire:model="miktar" id="miktar" name="miktar" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Miktar" required>
            </div>
            <div>
                <label for="fiyat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fiyat')}}</label>
                <input wire:change="hesap" wire:model="fiyat" id="fiyat" name="fiyat" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Fiyat" required>
            </div>
            <div>
                <label for="iskonto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('İskonto')}}</label>
                <input wire:change="hesap" wire:model="iskonto" id="iskonto" name="iskonto" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="%" required>
            </div>
            <div>
                <label for="kdv" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('KDV')}}</label>
                <input wire:change="hesap" wire:model="kdv" id="kdv" name="kdv" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="%" required>
            </div>
        </div>
        <div class="flex flex-row items-center gap-10">
            <div>
                <label for="faturano" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fatura No')}}</label>
                <input wire:model="faturano" id="faturano" name="faturano" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div>
                <label for="ftarih" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Fatura Tarihi')}}</label>
                <input wire:model="ftarih" value="{{date('Y-m-d')}}" id="ftarih" name="ftarih" type="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div>
                <label for="sontarih" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Son Ödeme Tarihi')}}</label>
                <input wire:model="sontarih" id="sontarih" name="sontarih" type="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
            </div>
            <div>
                <label for="odeme" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Ödeme Yöntemi')}}</label>
                <select wire:model="odemeyontemi" data-te-select-init name="odemeyontemi" class="rounded-lg border-gray-300">
                    <option value="1">{{__('Nakit')}}</option>
                    <option value="2">{{__('Kredi Kartı')}}</option>
                    <option value="3">{{__('Havale')}}</option>
                </select>
            </div>
            <div>
                <label for="odemedurumu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Ödeme Durumu')}}</label>
                <select wire:model="odemedurumu" data-te-select-init name="odemedurumu" class="rounded-lg border-gray-300">
                    <option value="1">{{__('Ödendi')}}</option>
                    <option value="2">{{__('Ödenmedi ')}}</option>
                </select>
            </div>
            <div>
                <label for="parabirimi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Para Birimi')}}</label>
                <select wire:model="parabirimi" data-te-select-init name="parabirimi" class="rounded-lg border-gray-300">
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
        <div class="flex flex-row items-center self-end">
            <span>{{__('Toplam')}}</span>
            <h1 class="py-2 ml-20">{{$toplam}} <span>{{$parabirimi}}</span> </h1>
        </div>
        <button type="submit" class="self-end mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kaydet</button>
    </form>
</div>
