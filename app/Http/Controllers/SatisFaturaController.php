<?php

namespace App\Http\Controllers;

use App\Models\Cari;
use App\Models\FaturaCari;
use App\Models\SatisFatura;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SatisFaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cari = Cari::all();
        $sfatura = SatisFatura::all();
        $toplam = 0;
        foreach($sfatura as $f) {
            $iskonto = ($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100));
            $kdv = ($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100))*($f['kdv']/100);
            $toplam += $iskonto + $kdv;
        }
        return view('satisfatura.index',compact('sfatura','toplam','cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'stokadi' => 'required|min:3|max:20',
//            'miktar' => 'required|integer',
//            'fiyat' => 'required|integer'
//        ],[
//            'stokadi.required' => 'Stok Adı alanı zorunludur',
//            'stokadi.min' => 'Başlık en az 3 karakter olmalıdır',
//            'stokadi.max' => 'Başlık en fazla 255 karakter olmalıdır',
//            'miktar.required' => 'Miktar alanı zorunludur',
//            'miktar.integer' => 'Miktar sayı olmalıdır',
//            'fiyat.required' => 'Fiyat alanı zorunludur',
//            'fiyat.integer' => 'Fiyat sayı olmalıdır',
//        ]);

        $sfatura = SatisFatura::create([
            'stokadi' => $request->stokadi,
            'slug' => Str::slug($request->stokadi),
            'miktar' => $request->miktar,
            'fiyat' => $request->fiyat,
            'kdv' => $request->kdv,
            'iskonto' => $request->iskonto,
            'faturatarihi' => $request->ftarih,
            'sontarih' => $request->sontarih,
            'odemeyontemi' => $request->odeme,
            'parabirimi' => $request->parabirimi,
            'kur' => $request->kur,
        ]);

        $sfatura->cari()->sync($request->cari);

        return redirect()->back();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SatisFatura::findOrFail($id)->delete();
        FaturaCari::findOrFail($id)->delete();

        return redirect()->route('satisfatura.index');
    }
}
