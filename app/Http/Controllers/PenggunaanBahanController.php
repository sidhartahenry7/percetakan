<?php

namespace App\Http\Controllers;

use App\Models\penggunaan_bahan;
use App\Http\Requests\Storepenggunaan_bahanRequest;
use App\Http\Requests\Updatepenggunaan_bahanRequest;

class PenggunaanBahanController extends Controller
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
     * @param  \App\Http\Requests\Storepenggunaan_bahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenggunaan_bahanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penggunaan_bahan  $penggunaan_bahan
     * @return \Illuminate\Http\Response
     */
    public function show(penggunaan_bahan $penggunaan_bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penggunaan_bahan  $penggunaan_bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(penggunaan_bahan $penggunaan_bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenggunaan_bahanRequest  $request
     * @param  \App\Models\penggunaan_bahan  $penggunaan_bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenggunaan_bahanRequest $request, penggunaan_bahan $penggunaan_bahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penggunaan_bahan  $penggunaan_bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(penggunaan_bahan $penggunaan_bahan)
    {
        //
    }
}
