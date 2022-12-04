<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddKategori', [
                "idkategori" => kategori::CreateID(),
                "title" => "Add Kategori"
            ]);
        }
        else {
            abort(403);
        }
    }
    
    public function listKategori()
    {
        return view('produk.ListKategori', [
            "list_kategori" => kategori::where('deleted', 0)->get(),
            "title" => "Daftar Kategori"
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
     * @param  \App\Http\Requests\StoreKategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKategoriRequest $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required|unique:kategoris',
            'nama_kategori' => 'required'
        ]);

        kategori::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-kategori');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKategoriRequest  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        kategori::where('id', $kategori->id)
                ->update(['deleted' => '1']);
        
        return redirect('/list-kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
