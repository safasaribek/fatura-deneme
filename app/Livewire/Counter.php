<?php

namespace App\Livewire;

use App\Models\Clients;
use App\Models\Items;
use Livewire\Component;

class Counter extends Component
{
    public $miktar = 0;
    public $fiyat = 0;
    public $iskonto = 0;
    public $kdv = 0;
    public $toplam = 0;
    public $salttoplam = 0;
    public $kur = 1;
    public $parabirimi = '₺';

    public function birim()
    {
        $this->parabirimi;
    }

    public function hesap()
    {
        $miktar = $this->miktar;
        $fiyat = $this->fiyat;
        $iskonto = $this->iskonto;
        $kdv = $this->kdv;
        $this->toplam=($miktar*$fiyat-($miktar*$fiyat)*($iskonto/100))+($miktar*$fiyat-($miktar*$fiyat)*($iskonto/100))*($kdv/100);
        $this->salttoplam=($miktar*$fiyat-($miktar*$fiyat)*($iskonto/100))+($miktar*$fiyat-($miktar*$fiyat)*($iskonto/100))*($kdv/100);
    }
    public function kurfunc()
    {
        $kur = $this->kur;
        $top = $this->salttoplam;
        $this->toplam = intval($kur)*$top;
    }

    public function render()
    {
        $cariler = Clients::all();
        $stoklar = Items::all();
        return view('livewire.counter',compact('cariler','stoklar'));
    }
}
