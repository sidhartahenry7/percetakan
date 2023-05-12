<?php

namespace App\Http\Controllers;

use App\Models\status_penawaran;
use App\Http\Requests\Storestatus_penawaranRequest;
use App\Http\Requests\Updatestatus_penawaranRequest;

class StatusPenawaranController extends Controller
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
     * @param  \App\Http\Requests\Storestatus_penawaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storestatus_penawaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\status_penawaran  $status_penawaran
     * @return \Illuminate\Http\Response
     */
    public function show(status_penawaran $status_penawaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\status_penawaran  $status_penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit(status_penawaran $status_penawaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatestatus_penawaranRequest  $request
     * @param  \App\Models\status_penawaran  $status_penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(Updatestatus_penawaranRequest $request, status_penawaran $status_penawaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\status_penawaran  $status_penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(status_penawaran $status_penawaran)
    {
        //
    }
}
