<?php

namespace App\Http\Controllers;

use App\Models\Cari;
use Illuminate\Http\Request;

class CariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cariler = Cari::all();
        return view('cariler.index',compact('cariler'));
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
//            'adı' => 'required|min:3|max:255',
//        ], [
//            'adı.required' => 'Başlık alanı zorunludur',
//            'adı.min' => 'Başlık en az 3 karakter olmalıdır',
//            'adı.max' => 'Başlık en fazla 255 karakter olmalıdır',
//        ]);

        Cari::create([
            'adi'=>$request->adi,
            'soyadi'=>$request->soyadi,
            'email'=>$request->email,
            'kimlikno'=>$request->kimlikno,
            'vergino'=>$request->vergino,
            'telefon'=>$request->telefon,
            'caritipi'=>$request->tip,
            'ulke'=>$request->ulke,
            'il'=>$request->il,
            'ilce'=>$request->ilce,
            'adres'=>$request->adres,
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
        $cariler = Cari::findOrFail($id);
        return view('cariler.edit',compact('cariler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $cari = Cari::findOrFail($id);

        $cari->update([
            'adi'=>$request->adi,
            'soyadi'=>$request->soyadi,
            'email'=>$request->email,
            'kimlikno'=>$request->kimlikno,
            'vergino'=>$request->vergino,
            'telefon'=>$request->telefon,
            'caritipi'=>$request->tip,
            'ulke'=>$request->ulke,
            'il'=>$request->il,
            'ilce'=>$request->ilce,
            'adres'=>$request->adres,
        ]);

        return redirect()->route('cariler.edit',$cari)->with('success','Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
