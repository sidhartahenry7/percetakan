<?php

namespace App\Http\Controllers;

use App\Models\promo;
use App\Http\Requests\StorepromoRequest;
use App\Http\Requests\UpdatepromoRequest;
use Illuminate\Support\Facades\Auth;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('promo.AddPromo', [
                "idpromo" => promo::CreateID(),
                "title" => "Add Promo"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }
    
    public function listPromo()
    {
        return view('promo.ListPromo', [
            "list_promo" => promo::where('deleted', 0)->get(),
            "title" => "Daftar Promo"
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
     * @param  \App\Http\Requests\StorepromoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepromoRequest $request)
    {
        $validatedData = $request->validate([
            'id_promo' => 'required|unique:promos',
            'tanggal_mulai' => 'required',
            'tanggal_berakhir' => 'required',
            'potongan' => 'required'
        ]);

        promo::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-promo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(promo $promo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepromoRequest  $request
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepromoRequest $request, promo $promo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(promo $promo)
    {
        promo::where('id', $promo->id)
             ->update(['deleted' => '1']);

        return redirect('/list-promo')->with('success', 'Promo berhasil dihapus!');
    }
}
