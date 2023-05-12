<?php

namespace App\Http\Controllers;

use App\Models\penerimaan_bahan_baku;
use App\Http\Requests\Storepenerimaan_bahan_bakuRequest;
use App\Http\Requests\Updatepenerimaan_bahan_bakuRequest;
use App\Models\pembelian_bahan;
use App\Models\detail_pembelian_bahan;
use App\Models\kartu_stok_bahan;
use Illuminate\Support\Carbon;

class PenerimaanBahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return view('penerimaan.bahan_baku.AddPenerimaanBahanBaku', [
            "pembelian" => pembelian_bahan::where('id', $id)->where('deleted', 0)->first(),
            "detail" => detail_pembelian_bahan::where('pembelian_bahan_id', $id)->get(),
            "title" => "Penerimaan Bahan Baku"
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
     * @param  \App\Http\Requests\Storepenerimaan_bahan_bakuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepenerimaan_bahan_bakuRequest $request)
    {
        $validatedData = $request->validate([
            'pembelian_bahan_id' => 'required',
            'pegawai_id' => 'required',
            'tanggal_penerimaan' => 'required',
            'status' => 'required'
        ]);

        penerimaan_bahan_baku::create($validatedData);

        pembelian_bahan::where('id', $request->pembelian_bahan_id)
                       ->update(['status' => $request->status]);

        $detail = detail_pembelian_bahan::where('pembelian_bahan_id', $request->pembelian_bahan_id)->get();

        $pembelian = pembelian_bahan::where('id', $request->pembelian_bahan_id)->first();

        if ($request->status == "Terima") {
            foreach ($detail as $res) {
                $jumlah = kartu_stok_bahan::where('produk_id', $res->produk_id)->where('cabang_id', $pembelian->cabang_id)->where('status', 'Masuk')->sum('quantity_masuk');
                if($res->satuan == "rim") {
                    $quantity_masuk = $res->quantity*500;
                    $satuan = "lembar";
                }
                else if($res->satuan == "rol") {
                    if($res->produk->satuan == "m2") {
                        $quantity_masuk = $res->produk->lebar*$res->produk->panjang*$res->quantity;
                        $satuan = "m2";
                    }
                    else if($res->produk->satuan == "cm2") {
                        $quantity_masuk = $res->produk->lebar*$res->produk->panjang*$res->quantity;
                        $satuan = "cm2";
                    }
                }
                else {
                    $quantity_masuk = $res->quantity;
                    $satuan = "lembar";
                }
                $stok = kartu_stok_bahan::where('produk_id', $res->produk_id)->where('cabang_id', $pembelian->cabang_id)->latest('id')->first();
                if($stok == NULL) {
                    $quantity_sekarang = 0;
                    $harga_average = $res->harga/$quantity_masuk;
                    $harga_beli = $res->harga/$quantity_masuk;
                }
                else {
                    $quantity_sekarang = $stok->quantity_sekarang;
                    $harga_average = (($stok->harga_average*$jumlah)+$res->harga)/($jumlah+$quantity_masuk);
                    $harga_beli = $res->harga/$quantity_masuk;
                }
                // dd($harga_average);
                kartu_stok_bahan::create([
                    'tanggal' => $request->tanggal_penerimaan,
                    'cabang_id' => $pembelian->cabang_id,
                    'produk_id' => $res->produk_id,
                    'quantity_masuk' => $quantity_masuk,
                    'quantity_keluar' => 0,
                    'quantity_sekarang' => $quantity_sekarang+$quantity_masuk,
                    'satuan' => $satuan,
                    'harga_beli' => $harga_beli,
                    'harga_average' => $harga_average,
                    'status' => "Masuk"
                ]);
            }
        }

        $request->session()->flash('success','Penerimaan Berhasil');

        return redirect('/list-pembelian-bahan-baku/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaan_bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function show(penerimaan_bahan_baku $penerimaan_bahan_baku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaan_bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function edit(penerimaan_bahan_baku $penerimaan_bahan_baku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepenerimaan_bahan_bakuRequest  $request
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaan_bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepenerimaan_bahan_bakuRequest $request, penerimaan_bahan_baku $penerimaan_bahan_baku)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaan_bahan_baku
     * @return \Illuminate\Http\Response
     */
    public function destroy(penerimaan_bahan_baku $penerimaan_bahan_baku)
    {
        //
    }
}
