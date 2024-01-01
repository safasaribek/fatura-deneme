<?php

namespace App\Livewire;

use App\Models\Clients;
use App\Models\InvoiceItems;
use App\Models\Items;
use Livewire\Component;

class Counter extends Component
{
    public $stoklar = [];
    public $cariler = [];
    public $item = 0;
    public $miktar = 0;
    public $fiyat = 0;
    public $iskonto = 0;
    public $kdv = 0;
    public $toplam = 0;
    public $salttoplam = 0;
    public $kur = 1;
    public $parabirimi = '₺';
    public $rows = [];
    public function addRow()
    {
        $this->rows[] = [
            'item' => $this->item,
            'quantity' => $this->miktar,
            'price' => $this->fiyat,
            'tax' => $this->kdv,
            'discount' => $this->iskonto,
            'toplam' => 0,
        ];
    }
    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
        $this->totalToplam();
    }
    public function birim()
    {
        $this->parabirimi;
    }
    public function updated($key,$value)
    {
        $index = explode('.',$key)[1];
        $brutFiyat = (float)$this->rows[$index]['quantity'] * (float)$this->rows[$index]['price'];
        $iskontoMiktari = $brutFiyat * ($this->rows[$index]['discount'] / 100);
        $netFiyat = $brutFiyat - $iskontoMiktari;
        $kdvMiktari = $netFiyat * ($this->rows[$index]['tax'] / 100);
        $this->rows[$index]['toplam'] = $netFiyat + $kdvMiktari;
        $this->kurfunc();
        $this->totalToplam();
    }
    public function kurfunc()
    {
        foreach ($this->rows as $index => $row) {
            $kur = $this->kur;
            $this->rows[$index]['toplam'] = intval($kur) * $row['toplam'];
        }
        $this->totalToplam();
    }
    public function totalToplam()
    {
        $this->toplam = 0;

        foreach ($this->rows as $row) {
            $this->toplam += $row['toplam'];
        }
    }
    public function mount()
    {
        $this->cariler = Clients::all();
        $this->stoklar = Items::all();
    }
    public function render()
    {
        return view('livewire.counter');
    }
}
