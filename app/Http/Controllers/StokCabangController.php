<?php

namespace App\Http\Controllers;

use App\Models\stok_cabang;
use App\Models\produk;
use App\Http\Requests\Storestok_cabangRequest;
use App\Http\Requests\Updatestok_cabangRequest;

class StokCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('StokCabang', [
            "list_cabang" => stok_cabang::ListCabang(),
            "list_produk" => produk::all(),
            "list_stok" => stok_cabang::orderBy('cabang_id', 'ASC')->orderBy('produk_id', 'ASC')->ListStok()->get()
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
     * @param  \App\Http\Requests\Storestok_cabangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storestok_cabangRequest $request)
    {
        $validatedData = $request->validate([
            'cabang_id' => 'required',
            'produk_id' => 'required',
            'jumlah_stok' => 'required'
        ]);

        stok_cabang::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/stok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stok_cabang  $stok_cabang
     * @return \Illuminate\Http\Response
     */
    public function show(stok_cabang $stok_cabang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stok_cabang  $stok_cabang
     * @return \Illuminate\Http\Response
     */
    public function edit(stok_cabang $stok_cabang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatestok_cabangRequest  $request
     * @param  \App\Models\stok_cabang  $stok_cabang
     * @return \Illuminate\Http\Response
     */
    public function update(Updatestok_cabangRequest $request, stok_cabang $stok_cabang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stok_cabang  $stok_cabang
     * @return \Illuminate\Http\Response
     */
    public function destroy(stok_cabang $stok_cabang)
    {
        //
    }
}
