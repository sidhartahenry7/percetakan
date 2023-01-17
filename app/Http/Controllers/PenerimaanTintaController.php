<?php

namespace App\Http\Controllers;

use App\Models\penerimaan_tinta;
use App\Http\Requests\Storepenerimaan_tintaRequest;
use App\Http\Requests\Updatepenerimaan_tintaRequest;
use App\Models\pembelian_tinta;
use App\Models\detail_pembelian_tinta;
use App\Models\kartu_stok_tinta;
use Illuminate\Support\Carbon;

class PenerimaanTintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('penerimaan.tinta.AddPenerimaanTinta', [
            "pembelian" => pembelian_tinta::where('id', $id)->where('deleted', 0)->first(),
            "detail" => detail_pembelian_tinta::where('pembelian_tinta_id', $id)->get(),
            "title" => "Penerimaan Tinta"
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
     * @param  \App\Http\Requests\Storepenerimaan_tintaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenerimaan_tintaRequest $request)
    {
        $validatedData = $request->validate([
            'pembelian_tinta_id' => 'required',
            'pegawai_id' => 'required',
            'tanggal_penerimaan' => 'required',
            'status' => 'required'
        ]);

        penerimaan_tinta::create($validatedData);

        pembelian_tinta::where('id', $request->pembelian_tinta_id)
                       ->update(['status' => $request->status]);

        $detail = detail_pembelian_tinta::where('pembelian_tinta_id', $request->pembelian_tinta_id)->get();

        $pembelian = pembelian_tinta::where('id', $request->pembelian_tinta_id)->first();

        if ($request->status == "Terima") {
            foreach ($detail as $res) {
                // dd($res->produk_id);
                $stok = kartu_stok_tinta::where('detail_tinta_id', $res->detail_tinta_id)->max('id');
                if($stok == NULL) {
                    $quantity_sekarang = 0;
                }
                else {
                    $quantity_sekarang = $stok->quantity_sekarang;
                }
                kartu_stok_tinta::create([
                    'tanggal' => Carbon::today(),
                    'cabang_id' => $pembelian->cabang_id,
                    'detail_tinta_id' => $res->detail_tinta_id,
                    'quantity_masuk' => $res->quantity,
                    'quantity_keluar' => 0,
                    'quantity_sekarang' => $quantity_sekarang+$res->quantity,
                    'status' => "Masuk"
                ]);
            }
        }

        $request->session()->flash('success','Penerimaan Berhasil');

        return redirect('/list-pembelian-tinta/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penerimaan_tinta  $penerimaan_tinta
     * @return \Illuminate\Http\Response
     */
    public function show(penerimaan_tinta $penerimaan_tinta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penerimaan_tinta  $penerimaan_tinta
     * @return \Illuminate\Http\Response
     */
    public function edit(penerimaan_tinta $penerimaan_tinta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenerimaan_tintaRequest  $request
     * @param  \App\Models\penerimaan_tinta  $penerimaan_tinta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenerimaan_tintaRequest $request, penerimaan_tinta $penerimaan_tinta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penerimaan_tinta  $penerimaan_tinta
     * @return \Illuminate\Http\Response
     */
    public function destroy(penerimaan_tinta $penerimaan_tinta)
    {
        //
    }
}
