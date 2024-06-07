<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Item;
use Carbon\Carbon;
use Livewire\Component;

class Invoice extends Component
{
    public $invoice;
    public $client;
    public $item;
    public $items = [];
    public $clients = [];
    public $quantity = 0;
    public $price = 0;
    public $discount = 0;
    public $vat = 0;
    public $total = 0;
    public $discountTotal = 0;
    public $vatTotal = 0;
    public $grandTotal = 0;
    public $currencyRate = 1;
    public $currency = '₺';
    public $invoiceNo;
    public $invoiceDate;
    public $deadline;
    public $paymentMethod;
    public $paymentStatus;
    public $rows = [];


    public function mount($invoice = null)
    {
        $this->clients = Client::all();
        $this->items = Item::all();

        if ($invoice) {

            $this->invoice = $invoice;

            $this->client = $invoice->client_id ?? null;

            foreach ($invoice->invoiceItem as $item) {
                $this->rows[] = [
                    'item' => $item->item_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'discount' => $item->discount_rate,
                    'vat' => $item->vat_rate,
                    'currency' => $item->currency,

                    'total' => $item->total,
                    'discountTotal' => $item->discount_total,
                    'vatTotal' => $item->vat_total,
                    'grandTotal' => $item->grand_total,
                ];
                $this->currency = $item->currency ?? null;
                $this->currencyRate = $item->currency_rate ?? 1;
            }

            $this->total = $this->invoice->total ?? null;
            $this->discountTotal = $this->invoice->discount_total ?? null;
            $this->vatTotal = $this->invoice->vat_total ?? null;
            $this->grandTotal = $this->invoice->grand_total ?? null;

            $this->invoiceNo = $this->invoice->invoice_number ?? null;
            $this->invoiceDate = Carbon::parse($this->invoice->invoice_date)->format('Y-m-d');
            $this->deadline = Carbon::parse($this->invoice->deadline)->format('Y-m-d');
            $this->paymentMethod = $this->invoice->payment_method ?? null;
            $this->paymentStatus = $this->invoice->payment_status ?? null;
        }
    }

    public function render()
    {
        return view('livewire.invoice');
    }


    public function addRow()
    {
        $this->rows[] = [
            'item' => $this->item,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'discount' => $this->discount,
            'vat' => $this->vat,
            'currency' => $this->currency,
            'total' => $this->total,
            'discountTotal' => $this->discountTotal,
            'vatTotal' => $this->vatTotal,
            'grandTotal' => 0,
        ];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
        $this->total();
//        session()->flash('success', 'Row Deleted');
    }

    public function unit()
    {
        $this->currency;
    }

    public function updated($key, $value)
    {
        $index = explode('.', $key)[1] ?? 0;

//        $itemid = Item::find($this->rows[$index]['item']);

//        $brutFiyat = (float)$itemid->quantity * (float)$itemid->price;

//        dd($itemid->quantity);

//        $this->rows[$index]['quantity'] = $itemid->quantity;

//        dd($this->rows[$index]['quantity']);

        $brutFiyat = (float)$this->rows[$index]['quantity'] * (float)$this->rows[$index]['price'];
        $iskontoMiktari = $brutFiyat * ((float)$this->rows[$index]['discount'] / 100);
        $netFiyat = $brutFiyat - $iskontoMiktari;
        $kdvMiktari = $netFiyat * ((float)$this->rows[$index]['vat'] / 100);

        $this->rows[$index]['total'] = $brutFiyat;
        $this->rows[$index]['discount'] = (float)$this->rows[$index]['discount'];
        $this->rows[$index]['discountTotal'] = $iskontoMiktari;
        $this->rows[$index]['vat'] = (float)$this->rows[$index]['vat'];
        $this->rows[$index]['vatTotal'] = $kdvMiktari;
        $this->rows[$index]['grandTotal'] = $netFiyat + $kdvMiktari;
        $this->currencyRate();
        $this->total();
    }

    public function currencyRate()
    {
        foreach ($this->rows as $index => $row) {
            $kur = $this->currencyRate;
            $this->rows[$index]['grandTotal'] = intval($kur) * $row['grandTotal'];
        }
        $this->total();
    }

    public function total()
    {
        $this->total = 0;
        $this->discountTotal = 0;
        $this->vatTotal = 0;
        $this->grandTotal = 0;

        foreach ($this->rows as $row) {
            $this->total += $row['total'];
            $this->discountTotal += $row['discountTotal'];
            $this->vatTotal += $row['vatTotal'];
            $this->grandTotal += $row['grandTotal'];
        }
    }

}
