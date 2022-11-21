<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\antrian;
use App\Models\detail_transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Transaksi', [
        //     "idtransaksi" => transaksi::CreateID(),
        //     "list_transaksi" => transaksi::all(),
        //     "list_antrian" => antrian::ListAntrian()->get()
        //     // "list_antrian" => antrian::whereNotIn('id', transaksi::all()->pluck('antrian_id'))->get()
        // ]);

        if (Auth::user()->user_role == 'Admin') {
            
            return view('transaksi.Transaksi', [
                "idtransaksi" => transaksi::CreateID(),
                "list_transaksi" => transaksi::where('status_pengerjaan', '!=', 'Selesai')->where('status_pengerjaan', '!=', 'Batal')->get(),
                "list_antrian" => antrian::whereNotIn('id', transaksi::all()->pluck('antrian_id'))->get(),
                "list_status" => [
                    "Belum dikerjakan",
                    "Sedang dikerjakan",
                    "Selesai",
                    "Batal"
                ]
            ]);
        }
        else {
            return view('transaksi.Transaksi', [
                "idtransaksi" => transaksi::CreateID(),
                "list_transaksi" => transaksi::join('antrians', 'antrians.id', '=', 'transaksis.antrian_id')->where('antrians.cabang_id', Auth::user()->cabang_id)->where('status_pengerjaan', '!=', 'Selesai')->where('status_pengerjaan', '!=', 'Batal')->get(),
                "list_antrian" => antrian::whereNotIn('id', transaksi::all()->pluck('antrian_id'))->where('cabang_id', '=', Auth::user()->cabang_id)->get(),
                "list_status" => [
                    "Belum dikerjakan",
                    "Sedang dikerjakan",
                    "Selesai",
                    "Batal"
                ]
            ]);

        }
    }

    public function indexHistory()
    {   
        return view('transaksi.HistoryTransaksi', [
            "history_transaksi" => transaksi::where('status_pengerjaan', 'Selesai')->orWhere('status_pengerjaan', 'Batal')->orderBy('id', 'DESC')->get(),
        ]);
    }
    
    public function printNota($id)
    {   
        $transaksi = transaksi::join('antrians', 'transaksis.antrian_id', '=', 'antrians.id')
                              ->join('pelanggans', 'antrians.pelanggan_id', '=', 'pelanggans.id')
                              ->join('cabangs', 'antrians.cabang_id', '=', 'cabangs.id')
                              ->where('transaksis.id', $id)
                              ->select('transaksis.*', 'antrians.id_antrian', 'antrians.tanggal_antrian', 'cabangs.alamat', 'pelanggans.nama_pelanggan', 'pelanggans.nomor_handphone')
                              ->first();

        $detail_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
                                            ->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')
                                            ->join('produks', 'detail_produks.produk_id', '=', 'produks.id')
                                            ->join('tintas', 'detail_produks.tinta_id', '=', 'tintas.id')
                                            ->where('transaksis.id', $id)
                                            ->select('detail_transaksis.*', 'detail_produks.nama_produk', 'detail_produks.finishing', 'produks.ukuran', 'produks.jenis_kertas', 'tintas.jenis_tinta')
                                            ->get();

        // return view('purchaseorder/bahanbaku.notaBahanBaku', compact('po_bahan_baku', 'detail_po'));
        
        return view('transaksi.NotaTransaksi', [
            "transaksi" => $transaksi,
            "detail_transaksi" => $detail_transaksi
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
     * @param  \App\Http\Requests\StoretransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoretransaksiRequest $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => 'required|unique:transaksis',
            'antrian_id' => 'required|max:255'
        ]);

        transaksi::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatetransaksiRequest  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatetransaksiRequest $request, transaksi $transaksi)
    {
        transaksi::where('id', $request->id)
                 ->update(['status_pengerjaan' => $request->status_pengerjaan]);

        $request->session()->flash('success','Status Berhasil Diupdate');

        return redirect('/transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaksi $transaksi)
    {
        //
    }
}
