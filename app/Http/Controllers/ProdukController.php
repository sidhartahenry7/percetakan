<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddBahanBaku', [
                "idproduk" => produk::CreateID(),
                "title" => "Add Bahan Baku"
            ]);
        }
        else {
            abort(403);
        }
    }
    
    public function listProduk()
    {
        return view('produk.ListBahanBaku', [
            "list_produk" => produk::where('deleted', 0)->get(),
            "title" => "Daftar Bahan Baku"
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
     * @param  \App\Http\Requests\StoreprodukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreprodukRequest $request)
    {
        $validatedData = $request->validate([
            'id_produk' => 'required|unique:produks',
            'ukuran' => 'required|max:255',
            'jenis_kertas' => 'required|max:255'
        ]);

        produk::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-bahan-baku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateprodukRequest  $request
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateprodukRequest $request, produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(produk $produk)
    {
        produk::where('id', $produk->id)
              ->update(['deleted' => '1']);
        
        return redirect('/list-bahan-baku')->with('success', 'Produk berhasil dihapus!');
    }
}
