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
use Illuminate\Support\Facades\File;

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
            $list_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
                                              ->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')
                                              ->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                              ->whereNotIn('detail_transaksis.id', komplain::all()->pluck('detail_transaksi_id'))
                                              ->get();

            return view('komplain.AddKomplain', [
                "list_transaksi" => $list_transaksi,
                "title" => "Add Komplain"
            ]);
    
        } else if (Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            $list_transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
                                              ->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')
                                              ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                              ->where('transaksis.status_pengerjaan', 'Pesanan telah diambil')
                                              ->whereNotIn('detail_transaksis.id', komplain::all()->pluck('detail_transaksi_id'))
                                              ->where('antrians.cabang_id', Auth::user()->cabang_id)
                                              ->get();

            return view('komplain.AddKomplain', [
                "list_transaksi" => $list_transaksi,
                "title" => "Add Komplain"
            ]);
        } else {
            return redirect('/dashboard');
        }
    }
    
    public function listKomplain()
    {
        return view('komplain.ListKomplain', [
            "list_komplain" => komplain::get(),
            "title" => "Daftar Komplain"
        ]);
    }

    public function listKomplainPelanggan()
    {
        return view('komplain.pelanggan.ListKomplainPelanggan', [
            "list_komplain" => komplain::join('detail_transaksis', 'komplains.detail_transaksi_id', 'detail_transaksis.id')
                                       ->join('transaksis', 'detail_transaksis.transaksi_id', 'transaksis.id')
                                       ->join('antrians', 'transaksis.antrian_id', 'antrians.id')
                                       ->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')
                                       ->where('antrians.pelanggan_id', Auth::guard('pelanggan')->user()->id)
                                       ->select('komplains.*', 'transaksis.id_transaksi', 'detail_produks.nama_produk')
                                       ->get(),
            "title" => "Daftar Komplain"
        ]);
    }

    public function addKomplainPelanggan()
    {
        return view('komplain.pelanggan.AddKomplainPelanggan', [
            "list_transaksi" => detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')
                                                ->join('antrians', 'transaksis.antrian_id', '=', 'antrians.id')
                                                ->join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')
                                                ->where('transaksis.status_pengerjaan', 'Selesai')
                                                ->where('antrians.pelanggan_id', Auth::guard('pelanggan')->user()->id)
                                                ->whereNotIn('detail_transaksis.id', komplain::all()->pluck('detail_transaksi_id'))
                                                ->select('detail_transaksis.*', 'transaksis.id_transaksi', 'detail_produks.nama_produk')
                                                ->get(),
            "title" => "Add Komplain"
        ]);
    }

    public function indexDetail($id)
    {
        if (Auth::guard('user')->check()) {
            return view('komplain.DetailKomplain', [
                "komplain" => komplain::where('komplains.id', $id)->first(),
                "title" => "Detail Komplain"
            ]);
        }
        else if (Auth::guard('pelanggan')->check()) {
            $komplain = komplain::where('id', $id)->first();
            if ($komplain->detail_transaksi->transaksi->antrian->pelanggan_id == Auth::guard('pelanggan')->user()->id) {
                return view('komplain.pelanggan.DetailKomplainPelanggan', [
                    "komplain" => komplain::where('id', $id)->first(),
                    "title" => "Detail Komplain"
                ]);
            }
            else {
                abort(403);
            }
        }
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
        // Request()->validate([
        //     'detail_transaksi_id' => 'required',
        //     'isi_komplain' => 'required',
        //     'bukti_komplain' => 'image|file',
        // ]);

        $validatedData = $request->validate([
            'detail_transaksi_id' => 'required',
            'isi_komplain' => 'required',
            'bukti_komplain' => 'image'
        ]);

        if ($request->file('bukti_komplain')) {
            $validatedData['bukti_komplain'] = $request->file('bukti_komplain')->store('bukti_komplain');
        }

        // $transaksi = detail_transaksi::join('transaksis', 'detail_transaksis.transaksi_id', '=', 'transaksis.id')->where('detail_transaksis.id', $request->detail_transaksi_id)->first();
        // $produk = detail_transaksi::join('detail_produks', 'detail_transaksis.detail_produk_id', '=', 'detail_produks.id')->where('detail_transaksis.id', $request->detail_transaksi_id)->first();

        komplain::create($validatedData);

        // $filename = "";
        // if (Request()->hasFile('bukti_komplain')) {
        //     if (Request()->file('bukti_komplain')) {
        //         $file = Request()->file('bukti_komplain');
        //         $filename = date('YmdHi').'_'.$transaksi->id_transaksi.'_'.$produk->nama_produk;
        //         $file->move(public_path('images/bukti_komplain/'), $filename);
        //     }
        // }
        // DB::table('komplains')->insert([
        //     'detail_transaksi_id' => Request()->detail_transaksi_id,
        //     'isi_komplain' => Request()->isi_komplain,
        //     'bukti_komplain' => $filename
        // ]);
        // DB::commit();

        if (Auth::guard('user')->check()) {
            $request->session()->flash('success','Penyimpanan Berhasil');

            return redirect('/list-komplain');
        }
        else if (Auth::guard('pelanggan')->check()) {
            $request->session()->flash('success','Penyimpanan Berhasil');

            return redirect('/daftar-komplain');
        }
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
        $temp = komplain::where('id', $komplain->id)->first();
        $file = public_path("storage/{$temp->bukti_komplain}");
        
        File::delete($file);
        
        komplain::destroy($komplain->id);
        
        
        if (Auth::guard('user')->check()) {
            return redirect('/list-komplain')->with('success', 'Komplain berhasil dihapus!');
        }
        else if (Auth::guard('pelanggan')->check()) {
            return redirect('/daftar-komplain')->with('success', 'Komplain berhasil dihapus!');
        }
    }
}
