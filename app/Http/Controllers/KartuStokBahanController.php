<?php

namespace App\Http\Controllers;

use App\Models\kartu_stok_bahan;
use App\Models\produk;
use App\Http\Requests\Storekartu_stok_bahanRequest;
use App\Http\Requests\Updatekartu_stok_bahanRequest;
use App\Models\cabang;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KartuStokBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == "Admin") {
            return view('kartu_stok.bahan_baku.ListKartuStokBahanBaku', [
                "kartu_stok" => kartu_stok_bahan::get(),
                "list_bahan" => produk::where('deleted', 0)->get(),
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "list_transaksi" => transaksi::orWhere('status_pengerjaan', 'Sedang dikerjakan')->orWhere('status_pengerjaan', 'Selesai')->orWhere('status_pengerjaan', 'Pesanan telah diambil')->get(),
                "title" => "Kartu Stok Bahan Baku"
            ]);
        }
        else {
            $list_transaksi = transaksi::join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                       ->where('antrians.cabang_id', Auth::user()->cabang_id)
                                       ->where(function($query) {
                                            $query->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                                  ->orWhere('transaksis.status_pengerjaan', 'Selesai')
                                                  ->orWhere('transaksis.status_pengerjaan', 'Sedang dikerjakan');
                                       })
                                       ->get();

            return view('kartu_stok.bahan_baku.ListKartuStokBahanBaku', [
                "kartu_stok" => kartu_stok_bahan::where('cabang_id', Auth::user()->cabang_id)->get(),
                "list_bahan" => produk::where('deleted', 0)->get(),
                "list_transaksi" => $list_transaksi,
                "title" => "Kartu Stok Bahan Baku"
            ]);
        }
    }

    public function stokOpname()
    {
        if (Auth::user()->user_role == "Admin" || Auth::user()->user_role == "Kepala Toko" || Auth::user()->user_role == "Wakil Kepala Toko") {
            return view('kartu_stok.bahan_baku.StokOpnameBahanBaku', [
                "list_bahan" => produk::get(),
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "title" => "Stok Opname Bahan Baku"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }
    
    public function editSatuan(Request $request)
    {
        $data = kartu_stok_bahan::where('produk_id', $request->produk_id)
                                ->select('satuan')
                                ->latest()
                                ->first();

        return response()->json($data);
    }

    public function tambahStokBahan(Request $request)
    {
        $data['produk'] = produk::select('id', 'id_produk', 'ukuran', 'panjang', 'lebar', 'satuan', 'jenis_kertas')
                                ->where('id', '=', $request->produk_id)
                                ->get();

        return response()->json($data);
    }

    public function addStokAwalBahanBaku()
    {
        if (Auth::user()->user_role == "Admin") {
            return view('kartu_stok.bahan_baku.AddStokAwalBahanBaku', [
                "list_bahan" => produk::get(),
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "title" => "Add Stok Awal Bahan Baku"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function storeStokAwalBahanBaku(Request $request)
    {
        if ($request->input('produk_id') != null) {
            $count = count($request->input('produk_id'));
        }
        else {
            $count = 0;
        }
        
        for($i = 0; $i < $count; $i++) {
            $validatedData['tanggal'] = $request->tanggal;
            $validatedData['cabang_id'] = $request->cabang_id;
            $validatedData['produk_id'] = $request->produk_id[$i];
            $validatedData['quantity_masuk'] = $request->quantity_masuk[$i];
            $validatedData['quantity_keluar'] = 0;
            $validatedData['quantity_sekarang'] = $request->quantity_masuk[$i];
            $validatedData['satuan'] = $request->satuan[$i];
            $validatedData['harga_beli'] = $request->harga_beli[$i];
            $validatedData['harga_average'] = $request->harga_average[$i];
            $validatedData['status'] = "Masuk";

            kartu_stok_bahan::create($validatedData);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/kartu-stok-bahan-baku');
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
     * @param  \App\Http\Requests\Storekartu_stok_bahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storekartu_stok_bahanRequest $request)
    {
        if ($request->input('produk_id') != null) {
            $count = count($request->input('produk_id'));
        }
        else {
            $count = 0;
        }
        
        for($i = 0; $i < $count; $i++) {
            $stok = kartu_stok_bahan::where('produk_id', $request->produk_id[$i])
                                    ->where('cabang_id', $request->cabang_id)
                                    ->latest()
                                    ->first();
            
            $validatedData['tanggal'] = $request->tanggal;
            $validatedData['cabang_id'] = $request->cabang_id;
            $validatedData['produk_id'] = $request->produk_id[$i];
            $validatedData['quantity_masuk'] = 0;
            $validatedData['quantity_keluar'] = $stok->quantity_sekarang - $request->quantity_sekarang[$i];
            $validatedData['quantity_sekarang'] = $request->quantity_sekarang[$i];
            $validatedData['satuan'] = $request->satuan[$i];
            $validatedData['harga_beli'] = 0;
            $validatedData['harga_average'] = $stok->harga_average;
            $validatedData['status'] = "Stok Opname";

            kartu_stok_bahan::create($validatedData);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/kartu-stok-bahan-baku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function show(kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatekartu_stok_bahanRequest  $request
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatekartu_stok_bahanRequest $request, kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kartu_stok_bahan  $kartu_stok_bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(kartu_stok_bahan $kartu_stok_bahan)
    {
        //
    }
}
