<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cariler = Client::all();
        return view('cariler.index', compact('cariler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cariler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'name' => 'required|min:3|max:255',
//            'identity' => 'unique',
//            'tax' => 'unique',
//        ], [
//            'name.required' => 'Başlık alanı zorunludur',
//            'name.min' => 'Başlık en az 3 karakter olmalıdır',
//            'name.max' => 'Başlık en fazla 255 karakter olmalıdır',
//            'identity.unique' => 'Kimlik Kayıtlı',
//            'tax.max' => 'Vergi No Kayıtlı',
//        ]);

        Client::create([
            'name' => $request->adi,
            'surname' => $request->soyadi,
            'email' => $request->email,
            'identity' => $request->kimlikno,
            'tax' => $request->vergino,
            'phone' => $request->telefon,
            'type' => $request->tip,
            'country' => $request->ulke,
            'city' => $request->il,
            'district' => $request->ilce,
            'address' => $request->adres,
        ]);

        return redirect()->route('cariler.index');
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
        $cariler = Client::findOrFail($id);
        return view('cariler.edit', compact('cariler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $cari = Client::findOrFail($id);

        $cari->update([
            'name' => $request->adi,
            'surname' => $request->soyadi,
            'email' => $request->email,
            'identity' => $request->kimlikno,
            'tax' => $request->vergino,
            'phone' => $request->telefon,
            'type' => $request->tip,
            'country' => $request->ulke,
            'city' => $request->il,
            'district' => $request->ilce,
            'address' => $request->adres,
        ]);

        return redirect()->route('cariler.edit', $cari)->with('success', 'Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('cariler.index');
    }
}
