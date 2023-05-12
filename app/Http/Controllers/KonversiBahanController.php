<?php

namespace App\Http\Controllers;

use App\Models\konversi_bahan;
use App\Http\Requests\Storekonversi_bahanRequest;
use App\Http\Requests\Updatekonversi_bahanRequest;

class KonversiBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storekonversi_bahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storekonversi_bahanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\konversi_bahan  $konversi_bahan
     * @return \Illuminate\Http\Response
     */
    public function show(konversi_bahan $konversi_bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\konversi_bahan  $konversi_bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(konversi_bahan $konversi_bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatekonversi_bahanRequest  $request
     * @param  \App\Models\konversi_bahan  $konversi_bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatekonversi_bahanRequest $request, konversi_bahan $konversi_bahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\konversi_bahan  $konversi_bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(konversi_bahan $konversi_bahan)
    {
        //
    }
}
