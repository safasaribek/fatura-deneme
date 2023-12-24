<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stoklar = Items::all();
        return view('stok.index',compact('stoklar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Items::create([
            'name' => $request->stokadi,
            'unit' => $request->birim,
            'amount' => $request->miktar,
            'price' => $request->fiyat,
        ]);

        return redirect()->route('stoklar.index');
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
        $stok = Items::findOrFail($id);
        return view('stok.edit',compact('stok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stok = Items::findOrFail($id);

        $stok->update([
            'name' => $request->stokadi,
            'unit' => $request->birim,
            'amount' => $request->miktar,
            'price' => $request->fiyat,
        ]);

        return redirect()->route('stoklar.edit',$stok);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
