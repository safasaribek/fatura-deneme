<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cariler = Clients::all();
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

        Clients::create([
            'name'=>$request->adi,
            'surname'=>$request->soyadi,
            'email'=>$request->email,
            'identity'=>$request->kimlikno,
            'tax'=>$request->vergino,
            'phone'=>$request->telefon,
            'type'=>$request->tip,
            'country'=>$request->ulke,
            'city'=>$request->il,
            'district'=>$request->ilce,
            'address'=>$request->adres,
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
        $cariler = Clients::findOrFail($id);
        return view('cariler.edit',compact('cariler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $cari = Clients::findOrFail($id);

        $cari->update([
            'name'=>$request->adi,
            'surname'=>$request->soyadi,
            'email'=>$request->email,
            'identity'=>$request->kimlikno,
            'tax'=>$request->vergino,
            'phone'=>$request->telefon,
            'type'=>$request->tip,
            'country'=>$request->ulke,
            'city'=>$request->il,
            'district'=>$request->ilce,
            'address'=>$request->adres,
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
