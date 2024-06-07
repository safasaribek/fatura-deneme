<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('client')->paginate(10);

        return view('satisfatura.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('satisfatura.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

//        $request->validate([
//            'cari' => 'required',
//            'name' => 'required',
//        ], [
//            'cari.required' => 'Cari alanı zorunludur',
//            'name.required' => 'Stok alanı zorunludur',
//        ]);

        DB::transaction(function () use ($request) {
            $invoice = Invoice::create([
                'client_id' => $request->client,
                'invoice_number' => $request->invoiceNo,
                'invoice_date' => $request->invoiceDate,
                'deadline' => $request->deadline,
                'payment_method' => $request->paymentMethod,
                'payment_status' => $request->paymentStatus,

                'total' => $request->invoiceTotal,
                'discount_total' => $request->discountTotal,
                'vat_total' => $request->vatTotal,
                'grand_total' => $request->grandTotal
            ]);

            foreach ($request->items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_id' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],

                    'vat_rate' => $item['vatRate'],
                    'vat_total' => $item['vatTotal'],
                    'discount_rate' => $item['discountRate'],
                    'discount_total' => $item['discountTotal'],
                    'currency' => $request->currency,
                    'currency_rate' => $request->currencyRate,
                    'total' => $item['invItmTotal'],
                    'grand_total' => $item['invItmGrandTotal']
                ]);
            }

        });

        return redirect()->route('satisfatura.index')->with('success', 'Fatura oluşturuldu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('satisfatura.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
//        $invoiceItem = InvoiceItem::findOrFail($id);
//        $invoiceItems = $invoice->invoiceItem;
//        $invoiceItems = InvoiceItem::where('invoice_id', $id)->get();

        DB::transaction(function () use ($request, $invoice) {

            $invoice->update([
                'client_id' => $request->client,
                'invoice_number' => $request->invoiceNo,
                'invoice_date' => $request->invoiceDate,
                'deadline' => $request->deadline,
                'payment_method' => $request->paymentMethod,
                'payment_status' => $request->paymentStatus,

                'total' => $request->invoiceTotal,
                'discount_total' => $request->discountTotal,
                'vat_total' => $request->vatTotal,
                'grand_total' => $request->grandTotal
            ]);

            foreach ($request->items as $item) {

                $invoiceItems = InvoiceItem::where('invoice_id', $invoice->id)
                    ->where('item_id', $item['name'])
                    ->first();

                if ($invoiceItems) {
                    $invoiceItems->update([
                        'invoice_id' => $invoice->id,
                        'item_id' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'vat_rate' => $item['vatRate'],
                        'vat_total' => $item['vatTotal'],
                        'discount_rate' => $item['discountRate'],
                        'discount_total' => $item['discountTotal'],
                        'currency' => $request->currency,
                        'currency_rate' => $request->currencyRate,
                        'total' => $item['invItmTotal'],
                        'grand_total' => $item['invItmGrandTotal']
                    ]);
                } else {
                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'item_id' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'vat_rate' => $item['vatRate'],
                        'vat_total' => $item['vatTotal'],
                        'discount_rate' => $item['discountRate'],
                        'discount_total' => $item['discountTotal'],
                        'currency' => $request->currency,
                        'currency_rate' => $request->currencyRate,
                        'total' => $item['invItmTotal'],
                        'grand_total' => $item['invItmGrandTotal']
                    ]);
                }
            }

        });

        //$invoice->client()->sync($request->cari);

        return redirect()->route('satisfatura.edit', $invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inv = Invoice::findOrFail($id);
        $inv->delete();
        InvoiceItem::where('invoice_id', $inv->id)->delete();

        return redirect()->route('satisfatura.index');
    }
}
