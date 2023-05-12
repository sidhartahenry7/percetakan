<?php

namespace App\Http\Controllers;

use App\Models\detail_penawaran;
use App\Http\Requests\Storedetail_penawaranRequest;
use App\Http\Requests\Updatedetail_penawaranRequest;
use App\Models\detail_produk;
use App\Models\penawaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DetailPenawaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($penawaran_id, $detail_penawaran_id) {
        if (Auth::guard('user')->check()) {
            if (Auth::user()->user_role == 'Admin') {
                $penawaran = penawaran::where('id', $penawaran_id)->first();
                $detail_penawaran = detail_penawaran::where('id', $detail_penawaran_id)->first();
                if($penawaran->status_penawaran != 'Penawaran dibuat') {
                    return view('penawaran.pegawai.detail_penawaran.DetailProdukPenawaranPegawai', [
                        "penawaran" => $penawaran,
                        "detail_penawaran" => $detail_penawaran,
                        "list_produk" => detail_produk::where('kategori_id', $detail_penawaran->kategori_id)->where('deleted', 0)->groupBy('nama_produk')->get(),
                        "title" => "Detail Produk Penawaran"
                    ]);
                }
                else {
                    return view('penawaran.pegawai.detail_penawaran.EditDetailProdukPenawaranPegawai', [
                        "penawaran" => $penawaran,
                        "detail_penawaran" => $detail_penawaran,
                        "list_produk" => detail_produk::where('kategori_id', $detail_penawaran->kategori_id)->where('deleted', 0)->groupBy('nama_produk')->get(),
                        "title" => "Detail Produk Penawaran"
                    ]);
                }
            }
            else {
                $penawaran = penawaran::where('id', $penawaran_id)->first();
                $detail_penawaran = detail_penawaran::where('id', $detail_penawaran_id)->first();
                if($penawaran->cabang_id == Auth::guard('user')->user()->cabang_id) {
                    if($penawaran->status_penawaran != 'Penawaran dibuat') {
                        return view('penawaran.pegawai.detail_penawaran.DetailProdukPenawaranPegawai', [
                            "penawaran" => $penawaran,
                            "detail_penawaran" => $detail_penawaran,
                            "list_produk" => detail_produk::where('kategori_id', $detail_penawaran->kategori_id)->where('deleted', 0)->groupBy('nama_produk')->get(),
                            "title" => "Detail Produk Penawaran"
                        ]);
                    }
                    else {
                        return view('penawaran.pegawai.detail_penawaran.EditDetailProdukPenawaranPegawai', [
                            "penawaran" => $penawaran,
                            "detail_penawaran" => $detail_penawaran,
                            "list_produk" => detail_produk::where('kategori_id', $detail_penawaran->kategori_id)->where('deleted', 0)->groupBy('nama_produk')->get(),
                            "title" => "Detail Produk Penawaran"
                        ]);
                    }
                }
                else {
                    abort(403);
                }
            }
        }
        else if (Auth::guard('pelanggan')->check()) {
            $penawaran = penawaran::where('id', $penawaran_id)->first();
            // if($penawaran->pelanggan_id == Auth::guard('pelanggan')->user()->id) {
            //     return view('penawaran.pelanggan.DetailPenawaranPelanggan', [
            //         "penawaran" => $penawaran,
            //         "detail_penawaran" => detail_penawaran::where('penawaran_id', $penawaran->id)->get(),
            //         "list_status" => status_penawaran::where('penawaran_id', $penawaran->id)->get(),
            //         "title" => "Detail Penawaran"
            //     ]);
            // }
            // else {
            //     abort(403);
            // }
        }
    }

    public function updateDetailProdukPenawaran($penawaran_id, $detail_penawaran_id, Request $request) {
        $detail_penawaran = detail_penawaran::where('id', $detail_penawaran_id)->first();
        $penawaran = penawaran::where('id', $penawaran_id)->first();

        $validatedData['detail_produk_id'] = $request->detail_produk_id;
        $validatedData['harga'] = $request->harga;
        $validatedData['persen_cyan'] = $request->persen_cyan;
        $validatedData['persen_magenta'] = $request->persen_magenta;
        $validatedData['persen_yellow'] = $request->persen_yellow;
        $validatedData['persen_black'] = $request->persen_black;
        $validatedData['harga_finishing'] = $request->harga_finishing;
        $validatedData['diskon'] = $request->diskon;
        $validatedData['harga_custom'] = $request->harga_custom;
        $validatedData['sub_total'] = $request->sub_total_produk + $request->harga_custom;

        detail_penawaran::where('id', $detail_penawaran->id)
                        ->update($validatedData);

        $sub_total_transaksi = detail_penawaran::where('penawaran_id', $penawaran->id)->sum('sub_total');
        $dataPenawaran['sub_total_transaksi'] = $sub_total_transaksi;
        if ($penawaran->promo_id == NULL) {
            $dataPenawaran['total'] = $sub_total_transaksi;
        }
        else {
            $dataPenawaran['total'] = $sub_total_transaksi*(1-($penawaran->promo->potongan/100));
        }
        
        penawaran::where('id', $penawaran->id)
                 ->update($dataPenawaran);

        return redirect('/penawaran/'.$penawaran->id)->with('success', 'Penyimpanan Berhasil');
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
     * @param  \App\Http\Requests\Storedetail_penawaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedetail_penawaranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detail_penawaran  $detail_penawaran
     * @return \Illuminate\Http\Response
     */
    public function show(detail_penawaran $detail_penawaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detail_penawaran  $detail_penawaran
     * @return \Illuminate\Http\Response
     */
    public function edit(detail_penawaran $detail_penawaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedetail_penawaranRequest  $request
     * @param  \App\Models\detail_penawaran  $detail_penawaran
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedetail_penawaranRequest $request, detail_penawaran $detail_penawaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detail_penawaran  $detail_penawaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(detail_penawaran $detail_penawaran)
    {
        //
    }
}
