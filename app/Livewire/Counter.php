<?php

namespace App\Livewire;

use App\Models\Cari;
use App\Models\SatisFatura;
use App\Models\Stok;
use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $miktar = 0;
    public $fiyat = 0;
    public $iskonto = 0;
    public $kdv = 0;
    public $toplam = 0;

    public function hesap()
    {
        $miktar = $this->miktar;
        $fiyat = $this->fiyat;
        $iskonto = $this->iskonto;
        $kdv = $this->kdv;
        $this->toplam=($miktar*$fiyat-($miktar*$fiyat)*($iskonto/100))+($miktar*$fiyat-($miktar*$fiyat)*($iskonto/100))*($kdv/100);
    }
    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        $cariler = Cari::all();
        $stoklar = Stok::all();
        return view('livewire.counter',compact('cariler','stoklar'));
    }
}
