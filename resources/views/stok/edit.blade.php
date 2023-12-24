<x-app-layout>

    <x-slot name="header">
        <div class="w-full flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Stok Ekle') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('stoklar.update',$stok) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-row gap-5 bg-white p-5 rounded-lg flex-wrap">
                    <div>
                        <x-input-label :value="__('Stok Adı')"/>
                        <x-text-input class="w-32" name="stokadi" placeholder="Stok Adı" value="{{ old('stokadi',$stok->name) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Birim')"/>
                        <x-text-input class="w-32" name="birim" placeholder="Birim" value="{{ old('birim',$stok->unit) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Miktar')"/>
                        <x-text-input type="number" name="miktar" placeholder="Miktar" value="{{ old('miktar',$stok->amount) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Fiyat')"/>
                        <x-text-input type="number" name="fiyat" placeholder="Fiyat" value="{{ old('fiyat',$stok->price) }}"/>
                    </div>
                </div>

                <div class="flex justify-end p-6 bg-white shadow-sm sm:rounded-lg w-full">
                    <a href="{{ route('stoklar.index') }}">
                        <x-secondary-button class="mr-2">
                            {{ __('İptal') }}
                        </x-secondary-button>
                    </a>
                    <x-primary-button>
                        {{ __('Kaydet') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>


</x-app-layout>


