<?php

namespace App\Http\Controllers;

use App\Models\kartu_stok_tinta;
use App\Http\Requests\Storekartu_stok_tintaRequest;
use App\Http\Requests\Updatekartu_stok_tintaRequest;
use App\Models\cabang;
use App\Models\detail_tinta;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KartuStokTintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == "Admin") {
            return view('kartu_stok.tinta.ListKartuStokTinta', [
                "kartu_stok" => kartu_stok_tinta::get(),
                "list_tinta" => detail_tinta::where('deleted', 0)->get(),
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "list_transaksi" => transaksi::orWhere('status_pengerjaan', 'Sedang dikerjakan')->orWhere('status_pengerjaan', 'Selesai')->orWhere('status_pengerjaan', 'Pesanan telah diambil')->get(),
                "title" => "Kartu Stok Tinta"
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
                                       
            return view('kartu_stok.tinta.ListKartuStokTinta', [
                "kartu_stok" => kartu_stok_tinta::where('cabang_id', Auth::user()->cabang_id)->get(),
                "list_tinta" => detail_tinta::where('deleted', 0)->get(),
                "list_transaksi" => $list_transaksi,
                "title" => "Kartu Stok Tinta"
            ]); 
        }
    }

    public function stokOpname()
    {
        if (Auth::user()->user_role == "Admin" || Auth::user()->user_role == "Kepala Toko" || Auth::user()->user_role == "Wakil Kepala Toko") {
            return view('kartu_stok.tinta.StokOpnameTinta', [
                "list_tinta" => detail_tinta::where('deleted', 0)->get(),
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "title" => "Stok Opname Tinta"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function tambahStokTinta(Request $request)
    {
        $data = detail_tinta::join('tintas', 'detail_tintas.tinta_id', 'tintas.id')
                            ->select('detail_tintas.id', 'tintas.jenis_tinta', 'detail_tintas.warna')
                            ->where('detail_tintas.id', '=', $request->detail_tinta_id)
                            ->first();

        return response()->json($data);
    }

    public function addStokAwalTinta()
    {
        if (Auth::user()->user_role == "Admin") {
            return view('kartu_stok.tinta.AddStokAwalTinta', [
                "list_tinta" => detail_tinta::where('deleted', 0)->get(),
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "title" => "Add Stok Awal Tinta"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function storeStokAwalTinta(Request $request)
    {
        if ($request->input('detail_tinta_id') != null) {
            $count = count($request->input('detail_tinta_id'));
        }
        else {
            $count = 0;
        }
        
        for($i = 0; $i < $count; $i++) {
            $validatedData['tanggal'] = $request->tanggal;
            $validatedData['cabang_id'] = $request->cabang_id;
            $validatedData['detail_tinta_id'] = $request->detail_tinta_id[$i];
            $validatedData['quantity_masuk'] = $request->quantity_masuk[$i];
            $validatedData['quantity_keluar'] = 0;
            $validatedData['quantity_sekarang'] = $request->quantity_masuk[$i];
            $validatedData['satuan'] = $request->satuan[$i];
            $validatedData['harga_beli'] = $request->harga_beli[$i];
            $validatedData['harga_average'] = $request->harga_average[$i];
            $validatedData['status'] = "Masuk";

            kartu_stok_tinta::create($validatedData);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/kartu-stok-tinta');
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
     * @param  \App\Http\Requests\Storekartu_stok_tintaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storekartu_stok_tintaRequest $request)
    {
        if ($request->input('detail_tinta_id') != null) {
            $count = count($request->input('detail_tinta_id'));
        }
        else {
            $count = 0;
        }
        
        for($i = 0; $i < $count; $i++) {
            $stok = kartu_stok_tinta::where('detail_tinta_id', $request->detail_tinta_id[$i])
                                    ->where('cabang_id', $request->cabang_id)
                                    ->latest()
                                    ->first();
            
            $validatedData['tanggal'] = $request->tanggal;
            $validatedData['cabang_id'] = $request->cabang_id;
            $validatedData['detail_tinta_id'] = $request->detail_tinta_id[$i];
            $validatedData['quantity_masuk'] = 0;
            $validatedData['quantity_keluar'] = $stok->quantity_sekarang - $request->quantity_sekarang[$i];
            $validatedData['quantity_sekarang'] = $request->quantity_sekarang[$i];
            $validatedData['satuan'] = $request->satuan[$i];
            $validatedData['harga_beli'] = 0;
            $validatedData['harga_average'] = $stok->harga_average;
            $validatedData['status'] = "Stok Opname";

            kartu_stok_tinta::create($validatedData);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/kartu-stok-tinta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function show(kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function edit(kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatekartu_stok_tintaRequest  $request
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatekartu_stok_tintaRequest $request, kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kartu_stok_tinta  $kartu_stok_tinta
     * @return \Illuminate\Http\Response
     */
    public function destroy(kartu_stok_tinta $kartu_stok_tinta)
    {
        //
    }
}
