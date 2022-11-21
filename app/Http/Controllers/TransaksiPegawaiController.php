<?php

namespace App\Http\Controllers;

use App\Models\transaksi_pegawai;
use App\Http\Requests\Storetransaksi_pegawaiRequest;
use App\Http\Requests\Updatetransaksi_pegawaiRequest;

class TransaksiPegawaiController extends Controller
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
     * @param  \App\Http\Requests\Storetransaksi_pegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storetransaksi_pegawaiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi_pegawai  $transaksi_pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi_pegawai $transaksi_pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi_pegawai  $transaksi_pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi_pegawai $transaksi_pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetransaksi_pegawaiRequest  $request
     * @param  \App\Models\transaksi_pegawai  $transaksi_pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Updatetransaksi_pegawaiRequest $request, transaksi_pegawai $transaksi_pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi_pegawai  $transaksi_pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi_pegawai $transaksi_pegawai)
    {
        //
    }
}
