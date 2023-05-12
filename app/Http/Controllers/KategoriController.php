<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\detail_produk;
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
            return redirect('/dashboard');
        }
    }

    public function detailKategori($id)
    {
        $kategori = kategori::where('deleted', 0)->where('id', $id)->first();
        if($kategori->estimasi_durasi >= 1440) {
            $durasi = $kategori->estimasi_durasi/60/24;
            $satuan = 'hari';
        }
        else if($kategori->estimasi_durasi >= 60) {
            $durasi = $kategori->estimasi_durasi/60;
            $satuan = 'jam';
        }
        else {
            $durasi = $kategori->estimasi_durasi;
            $satuan = $kategori->satuan_durasi;
        }
        return view('produk.DetailKategori', [
            "kategori" => $kategori,
            "durasi" => $durasi,
            "satuan" => $satuan,
            "title" => "Detail Kategori"
        ]);
    }
    
    public function listKategori()
    {
        return view('produk.ListKategori', [
            "list_kategori" => kategori::where('deleted', 0)->get(),
            "title" => "Daftar Kategori"
        ]);
    }
    
    // public function cardKategori()
    // {
    //     return view('produk.pelanggan.CardKategori', [
    //         "list_kategori" => kategori::where('deleted', 0)->get(),
    //         "title" => "Kategori Produk"
    //     ]);
    // }

    // public function listProduk($id)
    // {
    //     $kategori = kategori::where('id', $id)->first();
    //     $list_detail = detail_produk::where('kategori_id', $id)->where('deleted', 0)->groupBy('nama_produk')->get();
    //     return view('produk.pelanggan.DaftarProduk', [
    //         "kategori" => $kategori,
    //         "list_detail" => $list_detail,
    //         "title" => $kategori->nama_kategori
    //     ]);
    // }

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
        // ddd($request);

        $validatedData = $request->validate([
            'id_kategori' => 'required|unique:kategoris',
            'nama_kategori' => 'required',
            'gambar_kategori' => 'image',
            'estimasi_durasi' => 'required',
            'satuan_durasi' => 'required'
        ]);

        if ($request->satuan_durasi == 'hari') {
            $durasi = $request->estimasi_durasi*24*60;
        }
        else if ($request->satuan_durasi == 'jam') {
            $durasi = $request->estimasi_durasi*60;
        }
        else {
            $durasi = $request->estimasi_durasi;
        }
        $satuan = 'menit';

        $validatedData['estimasi_durasi'] = $durasi;
        $validatedData['satuan_durasi'] = $satuan;

        if ($request->file('gambar_kategori')) {
            $validatedData['gambar_kategori'] = $request->file('gambar_kategori')->store('kategori');
        }

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
        if (Auth::user()->user_role == 'Admin') {
            // $kategoris = kategori::where('id', $kategori->id)->first(); 
            
            if($kategori->estimasi_durasi >= 1440) {
                $durasi = $kategori->estimasi_durasi/60/24;
                $satuan = 'hari';
            }
            else if($kategori->estimasi_durasi >= 60) {
                $durasi = $kategori->estimasi_durasi/60;
                $satuan = 'jam';
            }
            else {
                $durasi = $kategori->estimasi_durasi;
                $satuan = $kategori->satuan_durasi;
            }

            $list_satuan = ['hari', 'jam', 'menit'];

            return view('produk.EditKategori', [
                "title" => "Edit Kategori",
                "kategori" => $kategori,
                "durasi" => $durasi,
                "satuan" => $satuan,
                "list_satuan" => $list_satuan,
                "title" => "Edit Kategori"        
            ]);
        }
        else {
            return redirect('/dashboard');
        }
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
        if ($request->satuan_durasi == 'hari') {
            $durasi = $request->estimasi_durasi*24*60;
        }
        else if ($request->satuan_durasi == 'jam') {
            $durasi = $request->estimasi_durasi*60;
        }
        else {
            $durasi = $request->estimasi_durasi;
        }
        $satuan = 'menit';

        $validatedData = $request->validate([
            'gambar_kategori' => 'image',
            'estimasi_durasi' => 'required',
            'satuan_durasi' => 'required'
        ]);

        if ($request->file('gambar_kategori')) {
            $validatedData['gambar_kategori'] = $request->file('gambar_kategori')->store('kategori');
        }
        
        $validatedData['estimasi_durasi'] = $durasi;
        $validatedData['satuan_durasi'] = $satuan;

        // dd($validatedData);

        kategori::where('id', $kategori->id)
                ->update($validatedData);

        $request->session()->flash('success','Kategori berhasil diupdate');

        return redirect('/list-kategori');
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
