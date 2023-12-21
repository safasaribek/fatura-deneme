<div>
    <form class="m-10 flex flex-row items-center mb-5 gap-10" method="post" action="{{ route('satisfatura.store') }}">
        @csrf
        <div>
            <x-input-label :value="__('Cariler')"/>
            <select data-te-select-init name="cari" class="rounded-lg border-gray-300">
                @foreach($cariler as $cari)
                    <option value="{{$cari['id']}}">{{$cari['adi']}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-input-label :value="__('Stoklar')"/>
            <select data-te-select-init name="stokadi" class="rounded-lg border-gray-300">
                @foreach($stoklar as $stok)
                    <option value="{{$stok['id']}}">{{$stok['stokadi']}}</option>
                @endforeach
            </select>
        </div>
{{--        <div>--}}
{{--            <label for="stok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok Adı</label>--}}
{{--            <input id="stok" name="stokadi" type="text" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Stok Adı" required>--}}
{{--        </div>--}}
        <div>
            <label for="miktar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Miktar')}}</label>
            <input value="" wire:change="hesap" wire:model="miktar" id="miktar" name="miktar" type="number" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Miktar" required>
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
        <button type="submit" class="mt-7 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kaydet</button>
    </form>
    <h1 class="ml-12">
        TOPLAM = {{$toplam}}
    </h1>
</div>
