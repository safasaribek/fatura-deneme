<?php

namespace App\Livewire;

use App\Models\Cari;
use App\Models\Clients;
use App\Models\Items;
use App\Models\SatisFatura;
use App\Models\Stok;
use Livewire\Component;

class CounterEdit extends Component
{
    public $fatura;
    public $faturaurunu;

    public $cari;
    public $stok;
    public $miktar = 0;
    public $fiyat = 0;
    public $iskonto = 0;
    public $kdv = 0;
    public $toplam = 0;
    public $salttoplam = 0;
    public $kur = 1;
    public $faturano;
    public $ftarih;
    public $sontarih;
    public $odemeyontemi;
    public $odemedurumu;
    public $parabirimi = '₺';

    public function mount($params)
    {
        $this->fatura = $params['fatura'];
        $this->faturaurunu = $params['faturaurunu'];

        $fatura = $this->fatura;
        $faturaurunu = $this->faturaurunu;

        $this->cari = $fatura->clients_id;
        $this->stok = $faturaurunu->items_id;

        $this->miktar = $faturaurunu->amount;
        $this->fiyat = $faturaurunu->price;
        $this->iskonto = $faturaurunu->discount;
        $this->kdv = $faturaurunu->vat;
        $this->faturano = $fatura->invoice_number;
        $this->ftarih = explode(' ',$fatura->invoice_date)[0];
        $this->sontarih = explode(' ',$fatura->deadline)[0];
        $this->odemeyontemi = $fatura->payment_method;
        $this->odemedurumu = $fatura->payment_status;
        $this->parabirimi = $faturaurunu->currency;
        $this->kur = $faturaurunu->rate;
        $this->toplam=(($faturaurunu->amount*$faturaurunu->price-($faturaurunu->amount*$faturaurunu->price)*($faturaurunu->discount/100))+($faturaurunu->amount*$faturaurunu->price-($faturaurunu->amount*$faturaurunu->price)*($faturaurunu->discount/100))*($faturaurunu->vat/100))*$faturaurunu->rate;
        $this->salttoplam=($faturaurunu->amount*$faturaurunu->price-($faturaurunu->amount*$faturaurunu->price)*($faturaurunu->discount/100))+($faturaurunu->amount*$faturaurunu->price-($faturaurunu->amount*$faturaurunu->price)*($faturaurunu->discount/100))*($faturaurunu->vat/100);
    }

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
    }
    public function kurfunc()
    {
        $kur = $this->kur;
        $top = $this->salttoplam;
        $this->toplam = $kur*$top;
    }

    public function render()
    {
        $cariler = Clients::all();
        $stoklar = Items::all();
        return view('livewire.counterEdit',compact('cariler','stoklar'));
    }
}
