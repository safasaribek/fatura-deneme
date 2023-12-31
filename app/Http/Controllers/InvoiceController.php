<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\InvoiceItems;
use App\Models\Invoices;
use App\Models\Items;
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
        $cari = Clients::all();
        $sfatura = Invoices::all();
        $faturaurunu = InvoiceItems::all();

        $toplam = 0;
        foreach($faturaurunu as $f) {
            $iskonto = ($f['amount']*$f['price']-($f['amount']*$f['price'])*($f['discount']/100));
            $kdv = ($f['amount']*$f['price']-($f['amount']*$f['price'])*($f['discount']/100))*($f['vat']/100);
            $toplam += ($iskonto + $kdv)*$f['rate'];
        }
        return view('satisfatura.index',compact('sfatura','toplam','cari','faturaurunu'));
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

        $request->validate([
            'cari' => 'required',
//            'miktar' => 'required',
//            'fiyat' => 'required'
        ],[
            'cari.required' => 'Miktar alanı zorunludur',
//            'miktar.required' => 'Miktar alanı zorunludur',
//            'fiyat.required' => 'Fiyat alanı zorunludur',
        ]);

        DB::transaction(function () use($request) {
            $sfatura = Invoices::create([
                'client_id' => $request->cari,
                'invoice_number' => $request->faturano,
                'invoice_date' => $request->ftarih,
                'deadline' => $request->sontarih,
                'payment_method' => $request->odemeyontemi,
                'payment_status' => $request->odemedurumu,
            ]);

            foreach ($request->items as $item) {
                InvoiceItems::create([
                    'invoice_id' => $sfatura->id,
                    'item_id' => $item['name'],
                    'amount' => $item['quantity'],
                    'price' => $item['price'],
                    'vat' => $item['tax'],
                    'discount' => $item['discount'],
                    'currency' => $request->parabirimi,
                    'rate' => $request->kur,
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
        $fatura = Invoices::findOrFail($id);
        $faturaurunu = InvoiceItems::findOrFail($id);
        return view('satisfatura.edit',compact('fatura','faturaurunu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sfatura = Invoices::findOrFail($id);
        $faturaurun = InvoiceItems::findOrFail($id);

        $sfatura->update([
            'clients_id' => $request->cari,
            'invoice_number' => $request->faturano,
            'invoice_date' => $request->ftarih,
            'deadline' => $request->sontarih,
            'payment_method' => $request->odemeyontemi,
            'payment_status' => $request->odemedurumu,
        ]);

        $sfatura->cari()->sync($request->cari);

        $faturaurun->update([
            'invoices_id' => $sfatura->id,
            'items_id' => $request->stokadi,
            'amount' => $request->miktar,
            'price' => $request->fiyat,
            'vat' => $request->kdv,
            'discount' => $request->iskonto,
            'currency' => $request->parabirimi,
            'rate' => $request->kur,
        ]);

        return redirect()->route('satisfatura.edit',$sfatura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Invoices::findOrFail($id)->delete();
//        FaturaCari::findOrFail($id)->delete();

        return redirect()->route('satisfatura.index');
    }
}
