<?php

namespace App\Http\Controllers;

use App\Models\biaya;
use App\Http\Requests\StorebiayaRequest;
use App\Http\Requests\UpdatebiayaRequest;
use Illuminate\Support\Facades\Auth;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('biaya.jenis_biaya.AddJenisBiaya', [
                "idbiaya" => biaya::CreateID(),
                "title" => "Add Jenis Biaya"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function listJenisBiaya()
    {
        if (Auth::user()->user_role == 'Admin' || Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            return view('biaya.jenis_biaya.ListJenisBiaya', [
                "list_jenis_biaya" => biaya::where('deleted', 0)->get(),
                "title" => "Jenis Biaya"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
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
     * @param  \App\Http\Requests\StorebiayaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebiayaRequest $request)
    {
        $validatedData = $request->validate([
            'id_jenis_biaya' => 'required|unique:biayas',
            'jenis_biaya' => 'required|max:255'
        ]);

        biaya::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/list-jenis-biaya');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function show(biaya $biaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function edit(biaya $biaya)
    {
        if (Auth::user()->user_role == 'Admin') {
            $jenis_biaya = biaya::where('id', $biaya->id)->first();    

            return view('biaya.jenis_biaya.EditJenisBiaya', [
                "title" => "Edit Jenis Biaya",
                "biaya" => $jenis_biaya        
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebiayaRequest  $request
     * @param  \App\Models\biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebiayaRequest $request, biaya $biaya)
    {
        biaya::where('id', $biaya->id)
             ->update(['jenis_biaya' => $request->jenis_biaya]); 

        return redirect('/list-jenis-biaya')->with('success', 'Jenis biaya berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\biaya  $biaya
     * @return \Illuminate\Http\Response
     */
    public function destroy(biaya $biaya)
    {
        biaya::where('id', $biaya->id)
             ->update(['deleted' => 1]); 

        return redirect('/list-jenis-biaya')->with('success', 'Jenis biaya berhasil dihapus!');
    }
}
