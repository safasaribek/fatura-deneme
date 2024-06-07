<x-app-layout>

    <x-slot name="header">
        <div class="w-full flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Cari Ekle') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('cariler.update',$cariler) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-row gap-5 bg-white p-5 rounded-lg flex-wrap">
                    <div>
                        <x-input-label :value="__('Cari Adı')"/>
                        <x-text-input class="w-32" name="adi" placeholder="Cari Adı" value="{{ old('adi',$cariler->name) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Cari Soyadı')"/>
                        <x-text-input class="w-32" name="soyadi" placeholder="Cari Soyadı" value="{{ old('soyadi',$cariler->surname) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Email')"/>
                        <x-text-input type="email" name="email" placeholder="Email" value="{{ old('email',$cariler->email) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Kimlik No')"/>
                        <x-text-input class="w-40" type="number" name="kimlikno" placeholder="Kimlik No" value="{{ old('kimlikno',$cariler->identity) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Vergi No')"/>
                        <x-text-input class="w-40" type="number" name="vergino" placeholder="Vergi No" value="{{ old('vergino',$cariler->tax) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Telefon')"/>
                        <x-text-input class="w-40" type="number" name="telefon" placeholder="Telefon" value="{{ old('telefon',$cariler->phone) }}"/>
                    </div>
                    <div>
                        <x-input-label :value="__('Cari Tipi')"/>
                        <select data-te-select-init name="tip" class="rounded-lg border-gray-300">
                            <option {{$cariler->type = '1' ? 'selected' : ''}} value="1">{{__('Alıcı')}}</option>
                            <option {{$cariler->type = '2' ? 'selected' : ''}} value="2">{{__('Satıcı')}}</option>
                            <option {{$cariler->type = '3' ? 'selected' : ''}} value="3">{{__('Personel')}}</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label :value="__('Ülke')"/>
                        <select data-te-select-init name="ulke" class="rounded-lg border-gray-300">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label :value="__('İl')"/>
                        <select data-te-select-init name="il" class="rounded-lg border-gray-300">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label :value="__('İlçe')"/>
                        <select data-te-select-init name="ilce" class="rounded-lg border-gray-300">
                            <option value="1">OneOne</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <x-input-label :value="__('Adres')"/>
                        <textarea name="adres" class="w-full rounded p-4 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            {{old('adres',$cariler->address)}}
                        </textarea>
                    </div>
                </div>


                <div class="flex gap-2 justify-end p-6 bg-white shadow-sm sm:rounded-lg w-full">
                    <form action="{{ route('cariler.destroy', $cariler) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <div class="flex justify-end">
                            <x-danger-button>
                                {{ __('Sil') }}
                            </x-danger-button>
                        </div>
                    </form>
                    <a href="{{ route('cariler.index') }}">
                        <x-secondary-button>
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


