<?php

namespace App\Http\Controllers;

use App\Models\tinta;
use App\Http\Requests\StoretintaRequest;
use App\Http\Requests\UpdatetintaRequest;
use App\Models\detail_tinta;
use Illuminate\Support\Facades\Auth;

class TintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddTinta', [
                "idproduk" => tinta::CreateID(),
                "title" => "Add Produk Tinta"
            ]);
        }
        else {
            abort(403);
        }
    }
    
    public function listTinta()
    {
        return view('produk.ListTinta', [
            "list_tinta" => tinta::where('deleted', 0)->get(),
            "title" => "Daftar Produk Tinta"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoretintaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretintaRequest $request)
    {
        $validatedData = $request->validate([
            'id_tinta' => 'required|unique:tintas',
            'jenis_tinta' => 'required|max:255'
        ]);

        tinta::create($validatedData);

        $tinta = tinta::where('id_tinta', $request->id_tinta)->first();

        $warna = ["Cyan", "Magenta", "Yellow", "Black"];

        for($i = 0; $i < 4; $i++) {
            detail_tinta::create([
                'tinta_id' => $tinta->id,
                'warna' => $warna[$i]
            ]);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-tinta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tinta  $tinta
     * @return \Illuminate\Http\Response
     */
    public function show(tinta $tinta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tinta  $tinta
     * @return \Illuminate\Http\Response
     */
    public function edit(tinta $tinta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetintaRequest  $request
     * @param  \App\Models\tinta  $tinta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetintaRequest $request, tinta $tinta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tinta  $tinta
     * @return \Illuminate\Http\Response
     */
    public function destroy(tinta $tinta)
    {
        tinta::where('id', $tinta->id)
              ->update(['deleted' => '1']);
        
        return redirect('/list-tinta')->with('success', 'Tinta berhasil dihapus!');
    }
}
