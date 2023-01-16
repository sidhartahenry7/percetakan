<?php

namespace App\Http\Controllers;

use App\Models\komplain;
use App\Models\transaksi;
use App\Models\detail_transaksi;
use App\Models\pegawai;
use App\Http\Requests\StorekomplainRequest;
use App\Http\Requests\UpdatekomplainRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KomplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('komplain.AddKomplain', [
                "list_transaksi" => DB::table('detail_transaksis')->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')->where('transaksis.status_pengerjaan', 'Selesai')->whereNotIn('detail_transaksis.id', komplain::all()->pluck('detail_transaksi_id'))->select('detail_transaksis.*', 'transaksis.id_transaksi', 'detail_produks.nama_produk')->get(),
                "title" => "Add Komplain"
            ]);
    
        } else {
            return view('komplain.AddKomplain', [
                "list_transaksi" => DB::table('detail_transaksis')->join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')->where('transaksis.status_pengerjaan', 'Selesai')->select('detail_transaksis.*', 'transaksis.id_transaksi', 'detail_produks.nama_produk')->get(),
                "title" => "Add Komplain"
            ]);
        }
    }
    
    public function listKomplain()
    {
        return view('komplain.ListKomplain', [
            "list_komplain" => komplain::get(),
            "title" => "Daftar Komplain"
        ]);
    }

    public function indexDetail($id)
    {
        return view('komplain.DetailKomplain', [
            "komplain" => komplain::where('komplains.id', $id)->first(),
            "title" => "Detail Komplain"
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
     * @param  \App\Http\Requests\StorekomplainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekomplainRequest $request)
    {
        Request()->validate([
            'detail_transaksi_id' => 'required',
            'isi_komplain' => 'required',
            'bukti_komplain',
        ]);

        $transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')->where('detail_transaksis.id', $request->detail_transaksi_id)->first();
        $produk = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')->where('detail_transaksis.id', $request->detail_transaksi_id)->first();

        $filename = "";
        if (Request()->hasFile('bukti_komplain')) {
            if (Request()->file('bukti_komplain')) {
                $file = Request()->file('bukti_komplain');
                $filename = date('YmdHi').'_'.$transaksi->id_transaksi.'_'.$produk->nama_produk;
                $file->move(public_path('images/bukti_komplain/'), $filename);
            }
        }
        DB::table('komplains')->insert([
            'detail_transaksi_id' => Request()->detail_transaksi_id,
            'isi_komplain' => Request()->isi_komplain,
            'bukti_komplain' => $filename
        ]);
        DB::commit();
        return redirect('/list-komplain')->with("create_success", "Komplain Berhasil Ditambah");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function show(komplain $komplain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function edit(komplain $komplain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekomplainRequest  $request
     * @param  \App\Models\komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekomplainRequest $request, komplain $komplain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\komplain  $komplain
     * @return \Illuminate\Http\Response
     */
    public function destroy(komplain $komplain)
    {
        komplain::destroy($komplain->id);
        
        return redirect('/list-komplain')->with('success', 'Komplain berhasil dihapus!');
    }
}
