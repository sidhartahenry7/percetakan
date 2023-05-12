<?php

namespace App\Http\Controllers;

use App\Models\pembelian_bahan;
use App\Models\produk;
use App\Models\cabang;
use App\Http\Requests\Storepembelian_bahanRequest;
use App\Http\Requests\Updatepembelian_bahanRequest;
use App\Models\detail_pembelian_bahan;
use App\Models\penerimaan_bahan_baku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin' || Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            return view('pembelian.bahan_baku.AddPembelianBahanBaku', [
                "idpembelianbahan" => pembelian_bahan::CreateID(),
                "bahan" => produk::where('deleted', 0)->get(),
                "cabang" => cabang::where('deleted', 0)->get(),
                "title" => "Add Pembelian Bahan Baku"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function detailPembelian($id)
    {
        return view('pembelian.bahan_baku.DetailPembelianBahanBaku', [
            "pembelian" => pembelian_bahan::where('deleted', 0)->where('id', $id)->first(),
            "penerimaan" => penerimaan_bahan_baku::where('pembelian_bahan_id', $id)->first(),
            "detail" => detail_pembelian_bahan::where('pembelian_bahan_id', $id)->get(),
            "title" => "Detail Pembelian Bahan Baku"
        ]);
    }
    
    public function listPembelian()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pembelian.bahan_baku.ListPembelianBahanBaku', [
                "list_pembelian" => pembelian_bahan::where('deleted', 0)->where('status', 'Pending')->get(),
                "title" => "Daftar Pembelian Bahan Baku"
            ]);
        }
        else {
            return view('pembelian.bahan_baku.ListPembelianBahanBaku', [
                "list_pembelian" => pembelian_bahan::where('deleted', 0)->where('status', 'Pending')->where('cabang_id', Auth::user()->cabang_id)->get(),
                "title" => "Daftar Pembelian Bahan Baku"
            ]);
        }
    }

    public function historyPembelian()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pembelian.bahan_baku.HistoryPembelianBahanBaku', [
                "list_pembelian" => pembelian_bahan::where('deleted', 0)->where('status', '!=', 'Pending')->get(),
                "title" => "History Pembelian Bahan Baku"
            ]);
        }
        else {
            return view('pembelian.bahan_baku.HistoryPembelianBahanBaku', [
                "list_pembelian" => pembelian_bahan::where('deleted', 0)->where('status', '!=', 'Pending')->where('cabang_id', Auth::user()->cabang_id)->get(),
                "title" => "History Pembelian Bahan Baku"
            ]);
        }
    }

    public function tambahBahanBaku(Request $request)
    {
        $data['produk'] = produk::select('id', 'id_produk', 'ukuran', 'panjang', 'lebar', 'satuan', 'jenis_kertas')->where('id', '=', $request->produk_id)->get();
        // $data['produk'] = $request->produk_id;
        return response()->json($data);
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
     * @param  \App\Http\Requests\Storepembelian_bahanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepembelian_bahanRequest $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'id_pembelian_bahan' => 'required|unique:pembelian_bahans',
            'cabang_id' => 'required',
            'pegawai_id' => 'required',
            'tanggal_pembelian_bahan' => 'required'
        ]);

        pembelian_bahan::create($validatedData);

        $id = pembelian_bahan::where('id_pembelian_bahan', $request->id_pembelian_bahan)->first();
        $count = count($request->input('produk_id'));
        $total = 0;

        for($i = 0; $i < $count; $i++) {
            $validatedData['produk_id'] = $request->produk_id[$i];
            $validatedData['pembelian_bahan_id'] = $id->id;
            $validatedData['quantity'] = $request->quantity[$i];
            $validatedData['satuan'] = $request->satuan[$i];
            $validatedData['harga'] = $request->harga[$i];

            detail_pembelian_bahan::create($validatedData);

            $total += $request->harga[$i];
        }

        pembelian_bahan::where('id', $id->id)
                       ->update(['total' => $total]);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-pembelian-bahan-baku/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembelian_bahan  $pembelian_bahan
     * @return \Illuminate\Http\Response
     */
    public function show(pembelian_bahan $pembelian_bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembelian_bahan  $pembelian_bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(pembelian_bahan $pembelian_bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepembelian_bahanRequest  $request
     * @param  \App\Models\pembelian_bahan  $pembelian_bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepembelian_bahanRequest $request, pembelian_bahan $pembelian_bahan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembelian_bahan  $pembelian_bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembelian_bahan $pembelian_bahan)
    {
        pembelian_bahan::where('id', $pembelian_bahan->id)
                       ->update(['deleted' => '1']);

        return redirect('/list-pembelian-bahan-baku')->with('success', 'Pembelian bahan baku berhasil dihapus!');
    }
}
