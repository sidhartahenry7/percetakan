<?php

namespace App\Http\Controllers;

use App\Models\kartu_stok_tinta;
use App\Http\Requests\Storekartu_stok_tintaRequest;
use App\Http\Requests\Updatekartu_stok_tintaRequest;

class KartuStokTintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kartu_stok.tinta.ListKartuStokTinta', [
            "kartu_stok" => kartu_stok_tinta::get(),
            "title" => "Kartu Stok Tinta"
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
     * @param  \App\Http\Requests\Storekartu_stok_tintaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storekartu_stok_tintaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function show(kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function edit(kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatekartu_stok_tintaRequest  $request
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatekartu_stok_tintaRequest $request, kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function destroy(kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }
}
