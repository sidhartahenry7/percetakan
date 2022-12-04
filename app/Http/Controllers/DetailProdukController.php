<?php

namespace App\Http\Controllers;

use App\Models\detail_produk;
use App\Models\kategori;
use App\Models\produk;
use App\Models\tinta;
use App\Http\Requests\Storedetail_produkRequest;
use App\Http\Requests\Updatedetail_produkRequest;
use App\Models\finishing;
use Illuminate\Support\Facades\Auth;

class DetailProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddDetailProduk', [
                "idproduk" => detail_produk::CreateID(),
                "list_kategori" => kategori::where('deleted', 0)->get(),
                "list_main_produk" => produk::where('deleted', 0)->get(),
                "list_tinta" => tinta::where('deleted', 0)->get(),
                "list_finishing" => finishing::where('deleted', 0)->get(),
                "title" => "Add Detail Produk"
            ]);
        }
        else {
            abort(403);
        }
    }
    
    public function listDetailProduk()
    {
        return view('produk.ListDetailProduk', [
            "list_produk" => detail_produk::where('deleted', 0)->get(),
            "title" => "Daftar Detail Produk"
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
     * @param  \App\Http\Requests\Storedetail_produkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedetail_produkRequest $request)
    {
        // dd($request->status_finishing);
        $validatedData = $request->validate([
            'id_detail_produk' => 'required|unique:detail_produks',
            'nama_produk' => 'required|max:255',
            'keterangan' => '',
            'harga' => 'required',
            'diskon' => '',
            'kategori_id' => 'required',
            'produk_id' => 'required',
            'tinta_id' => 'required',
            'finishing_id' => 'required'
        ]);

        if($request->status_finishing == "on") {
            $validatedData['status_finishing'] = 1;
        }
        else {
            $validatedData['status_finishing'] = 0;
        }

        detail_produk::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-detail-produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function show(detail_produk $detail_produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function edit(detail_produk $detail_produk)
    {
        if (Auth::user()->user_role == 'Admin') {
            $detail_produks = detail_produk::where('id', $detail_produk->id)->first();    

            return view('produk.EditDetailProduk', [
                "title" => "Edit Detail Produk",
                "detail_produk" => $detail_produks  ,
                "title" => "Edit Detail Produk"    
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedetail_produkRequest  $request
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedetail_produkRequest $request, detail_produk $detail_produk)
    {
        detail_produk::where('id', $detail_produk->id)
                     ->update(['harga' => $request->harga,
                               'diskon' => $request->diskon
                             ]);

        // $request->session()->flash('success','Perusahaan Berhasil Diupdate');
        return redirect('/list-detail-produk')->with('success', 'Detail produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(detail_produk $detail_produk)
    {
        detail_produk::where('id', $detail_produk->id)
              ->update(['deleted' => '1']);
        
        return redirect('/list-detail-produk')->with('success', 'Produk berhasil dihapus!');
    }
}
