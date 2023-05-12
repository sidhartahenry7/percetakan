<?php

namespace App\Http\Controllers;

use App\Models\status_transaksi;
use App\Http\Requests\Storestatus_transaksiRequest;
use App\Http\Requests\Updatestatus_transaksiRequest;

class StatusTransaksiController extends Controller
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
     * @param  \App\Http\Requests\Storestatus_transaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storestatus_transaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\status_transaksi  $status_transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(status_transaksi $status_transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\status_transaksi  $status_transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(status_transaksi $status_transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatestatus_transaksiRequest  $request
     * @param  \App\Models\status_transaksi  $status_transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatestatus_transaksiRequest $request, status_transaksi $status_transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\status_transaksi  $status_transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(status_transaksi $status_transaksi)
    {
        //
    }
}
