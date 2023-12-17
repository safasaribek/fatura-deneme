<?php

namespace App\Http\Controllers;

use App\Models\SatisFatura;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SatisFaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sfatura = SatisFatura::all();
        $toplam = 0;
        foreach($sfatura as $f) {
            $iskonto = ($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100));
            $kdv = ($f['miktar']*$f['fiyat']-($f['miktar']*$f['fiyat'])*($f['iskonto']/100))*($f['kdv']/100);
            $toplam += $iskonto + $kdv;
        }
        return view('satisfatura.index',compact('sfatura','toplam'));
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

        $request->validate([
            'stokadi' => 'required|min:3|max:20',
            'miktar' => 'required|integer',
            'fiyat' => 'required|integer'
        ],[
            'stokadi.required' => 'Stok Adı alanı zorunludur',
            'stokadi.min' => 'Başlık en az 3 karakter olmalıdır',
            'stokadi.max' => 'Başlık en fazla 255 karakter olmalıdır',
            'miktar.required' => 'Miktar alanı zorunludur',
            'miktar.integer' => 'Miktar sayı olmalıdır',
            'fiyat.required' => 'Fiyat alanı zorunludur',
            'fiyat.integer' => 'Fiyat sayı olmalıdır',
        ]);

        SatisFatura::create([
            'stokadi' => $request->stokadi,
            'slug' => Str::slug($request->stokadi),
            'miktar' => $request->miktar,
            'fiyat' => $request->fiyat,
            'kdv' => $request->kdv,
            'iskonto' => $request->iskonto
        ]);

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

        return redirect()->route('satisfatura.index');
    }
}
