<?php

namespace App\Http\Controllers;

use App\Models\bahan_setengah_jadi;
use App\Http\Requests\Storebahan_setengah_jadiRequest;
use App\Http\Requests\Updatebahan_setengah_jadiRequest;
use App\Models\detail_tinta;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\penggunaan_bahan;
use App\Models\penggunaan_tinta;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BahanSetengahJadiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddBahanSetengahJadi', [
                "idbahansetengahjadi" => bahan_setengah_jadi::CreateID(),
                "list_bahan" => produk::where('deleted', 0)->get(),
                "list_tinta" => detail_tinta::where('deleted', 0)->get(),
                "title" => "Add Bahan Setengah Jadi"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function listBahanSetengahJadi()
    {
        return view('produk.ListBahanSetengahJadi', [
            "list_bahan_setengah_jadi" => bahan_setengah_jadi::where('deleted', 0)->get(),
            "title" => "Daftar Bahan Setengah Jadi"
        ]);
    }

    public function detailBahanSetengahJadi($id)
    {
        if (Auth::user()->user_role == 'Admin') {
            $stok_bahan = kartu_stok_bahan::latest()->get()->unique('produk_id');
            $stok_tinta = kartu_stok_tinta::latest()->get()->unique('detail_tinta_id');
        }
        else {
            $stok_bahan = kartu_stok_bahan::where('cabang_id', Auth::user()->cabang_id)->latest()->get()->unique('produk_id');
            $stok_tinta = kartu_stok_tinta::where('cabang_id', Auth::user()->cabang_id)->latest()->get()->unique('detail_tinta_id');
        }

        return view('produk.DetailBahanSetengahJadi', [
            "bahan_setengah_jadi" => bahan_setengah_jadi::where('deleted', 0)->where('id', $id)->first(),
            "penggunaan_bahan" => penggunaan_bahan::where('bahan_setengah_jadi_id', $id)->get(),
            "penggunaan_tinta" => penggunaan_tinta::where('bahan_setengah_jadi_id', $id)->get(),
            "stok_bahan" => $stok_bahan,
            "stok_tinta" => $stok_tinta,
            "title" => "Detail Bahan Setengah Jadi"
        ]);
    }

    public function tambahBahanBakuSetengahJadi(Request $request)
    {
        $data['produk'] = produk::select('id', 'id_produk', 'ukuran', 'panjang', 'lebar', 'satuan', 'jenis_kertas')
                                ->where('id', '=', $request->produk_id)
                                ->get();

        return response()->json($data);
    }
    
    public function tambahTintaSetengahJadi(Request $request)
    {
        $data['detail_tinta'] = detail_tinta::join('tintas', 'detail_tintas.tinta_id', 'tintas.id')
                                            ->where('detail_tintas.id', $request->detail_tinta_id)
                                            ->select('tintas.jenis_tinta', 'detail_tintas.id', 'detail_tintas.warna')
                                            ->get();

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
     * @param  \App\Http\Requests\Storebahan_setengah_jadiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storebahan_setengah_jadiRequest $request)
    {
        $validatedData = $request->validate([
            'id_bahan_setengah_jadi' => 'required',
            'nama_bahan_setengah_jadi' => 'required',
            'harga' => 'required',
        ]);

        bahan_setengah_jadi::create($validatedData);

        $bahan_setengah_jadi = bahan_setengah_jadi::where('id_bahan_setengah_jadi', $request->id_bahan_setengah_jadi)->first();

        $count_bahan = count($request->input('produk_id'));

        for($i = 0; $i < $count_bahan; $i++) {
            $penggunaan_bahan['bahan_setengah_jadi_id'] = $bahan_setengah_jadi->id;
            $penggunaan_bahan['produk_id'] = $request->produk_id[$i];
            $penggunaan_bahan['jumlah_pemakaian'] = $request->jumlah_pemakaian_bahan[$i];
            $penggunaan_bahan['satuan'] = $request->satuan_bahan[$i];
            
            penggunaan_bahan::create($penggunaan_bahan);
        }
        
        $count_tinta = count($request->input('detail_tinta_id'));

        for($i = 0; $i < $count_tinta; $i++) {
            $penggunaan_tinta['bahan_setengah_jadi_id'] = $bahan_setengah_jadi->id;
            $penggunaan_tinta['detail_tinta_id'] = $request->detail_tinta_id[$i];
            $penggunaan_tinta['jumlah_pemakaian'] = $request->jumlah_pemakaian_tinta[$i];
            $penggunaan_tinta['satuan'] = $request->satuan_tinta[$i];
            
            penggunaan_tinta::create($penggunaan_tinta);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-bahan-setengah-jadi/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bahan_setengah_jadi  $bahan_setengah_jadi
     * @return \Illuminate\Http\Response
     */
    public function show(bahan_setengah_jadi $bahan_setengah_jadi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bahan_setengah_jadi  $bahan_setengah_jadi
     * @return \Illuminate\Http\Response
     */
    public function edit(bahan_setengah_jadi $bahan_setengah_jadi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatebahan_setengah_jadiRequest  $request
     * @param  \App\Models\bahan_setengah_jadi  $bahan_setengah_jadi
     * @return \Illuminate\Http\Response
     */
    public function update(Updatebahan_setengah_jadiRequest $request, bahan_setengah_jadi $bahan_setengah_jadi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bahan_setengah_jadi  $bahan_setengah_jadi
     * @return \Illuminate\Http\Response
     */
    public function destroy(bahan_setengah_jadi $bahan_setengah_jadi)
    {
        bahan_setengah_jadi::where('id', $bahan_setengah_jadi->id)
                           ->update(['deleted' => '1']);

        return redirect('/list-bahan-setengah-jadi')->with('success', 'Bahan setengah jadi berhasil dihapus!');
    }
}
