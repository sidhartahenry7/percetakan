<?php

namespace App\Http\Controllers;

use App\Models\kartu_stok_bahan;
use App\Http\Requests\Storekartu_stok_bahanRequest;
use App\Http\Requests\Updatekartu_stok_bahanRequest;

class KartuStokBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kartu_stok.ListKartuStokBahanBaku', [
            "kartu_stok" => kartu_stok_bahan::get(),
            "title" => "Kartu Stok Bahan Baku"
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
     * @param  \App\Http\Requests\Storekartu_stok_bahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storekartu_stok_bahanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function show(kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatekartu_stok_bahanRequest  $request
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatekartu_stok_bahanRequest $request, kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }
}
