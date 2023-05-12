<?php

namespace App\Http\Controllers;

use App\Models\detail_produk;
use App\Models\kategori;
use App\Models\produk;
use App\Models\tinta;
use App\Http\Requests\Storedetail_produkRequest;
use App\Http\Requests\Updatedetail_produkRequest;
use App\Models\bahan_setengah_jadi;
use App\Models\detail_finishing;
use App\Models\detail_produk_bahan;
use App\Models\detail_tinta;
use App\Models\finishing;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\penggunaan_bahan;
use App\Models\penggunaan_tinta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddDetailProduk', [
                "idproduk" => detail_produk::CreateID(),
                "list_kategori" => kategori::where('deleted', 0)->get(),
                "list_bahan_setengah_jadi" => bahan_setengah_jadi::where('deleted', 0)->get(),
                "list_finishing" => finishing::where('deleted', 0)->get(),
                "title" => "Add Detail Produk"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }
    
    public function listDetailProduk()
    {
        return view('produk.ListDetailProduk', [
            "list_produk" => detail_produk::where('deleted', 0)->get(),
            "title" => "Daftar Detail Produk"
        ]);
    }

    public function tambahBahanDetailProduk(Request $request)
    {
        $data['bahan_setengah_jadi'] = bahan_setengah_jadi::select('id', 'nama_bahan_setengah_jadi', 'harga')
                                                          ->where('id', '=', $request->bahan_setengah_jadi_id)
                                                          ->get();
        
        $penggunaan_bahan = penggunaan_bahan::where('bahan_setengah_jadi_id', $request->bahan_setengah_jadi_id)->first();
        if (Auth::user()->user_role == 'Admin') {
            $stok_bahan = kartu_stok_bahan::where('produk_id', $penggunaan_bahan->produk_id)->latest('created_at')->first();
        } else {
            $stok_bahan = kartu_stok_bahan::where('produk_id', $penggunaan_bahan->produk_id)->where('cabang_id', Auth::user()->cabang_id)->latest('created_at')->first();
        }
        if ($stok_bahan->harga_average == null) {
            $harga_bahan = 0*$penggunaan_bahan->jumlah_pemakaian;
        }
        else {
            $harga_bahan = $stok_bahan->harga_average*$penggunaan_bahan->jumlah_pemakaian;
        }
        
        $penggunaan_tinta = penggunaan_tinta::where('bahan_setengah_jadi_id', $request->bahan_setengah_jadi_id)->get();
        $harga_tinta_total = 0;
        foreach($penggunaan_tinta as $tintas) {
            if (Auth::user()->user_role == 'Admin') {
                $stok_tinta = kartu_stok_tinta::where('detail_tinta_id', $tintas->detail_tinta_id)->latest('created_at')->first();
            } else {
                $stok_tinta = kartu_stok_tinta::where('detail_tinta_id', $tintas->detail_tinta_id)->where('cabang_id', Auth::user()->cabang_id)->latest('created_at')->first();
            }
            if ($stok_tinta->harga_average == null) {
                $harga_tinta = 0*$tintas->jumlah_pemakaian;
            }
            else {
                $harga_tinta = $stok_tinta->harga_average*$tintas->jumlah_pemakaian;
            }
            $harga_tinta_total += $harga_tinta;
        }
        $harga_tinta_total = $harga_tinta_total;
        $data['harga_total'] = ($harga_bahan+$harga_tinta_total)*$request->quantity_bahan;

        return response()->json($data);
    }

    public function kalkulasiProduk()
    {
        return view('produk.KalkulasiProduk', [
            "list_bahan_setengah_jadi" => bahan_setengah_jadi::where('deleted', 0)->get(),
            "title" => "Kalkulasi Produk"
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
     * @param  \App\Http\Requests\Storedetail_produkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storedetail_produkRequest $request)
    {
        // $validatedData = $request->validate([
        //     'id_detail_produk' => 'required|unique:detail_produks',
        //     'nama_produk' => 'required|max:255',
        //     'keterangan' => '',
        //     'harga' => 'required',
        //     'diskon' => '',
        //     'kategori_id' => 'required',
        //     'jenis_bahan' => 'required',
        //     'ukuran' => 'required',
        //     'tinta_id' => 'required',
        //     'finishing_id' => 'required'
        // ]);

        // if($request->status_finishing == "on") {
        //     $validatedData['status_finishing'] = 1;
        // }
        // else {
        //     $validatedData['status_finishing'] = 0;
        // }

        // detail_produk::create($validatedData);
        
        // $detail_produk = detail_produk::where('id_detail_produk', $validatedData['id_detail_produk'])->first();
        
        // $penggunaan_bahan['detail_produk_id'] = $detail_produk->id;
        // $penggunaan_bahan['produk_id'] = $request->penggunaan_bahan_id;
        // $penggunaan_bahan['jumlah_pemakaian'] = $request->quantity_bahan;
        // $penggunaan_bahan['satuan'] = $request->satuan_bahan;
        
        // penggunaan_bahan::create($penggunaan_bahan);

        // for ($i=0; $i < 4; $i++) { 
        //     if ($i == 0) {
        //         $detail_tinta = detail_tinta::where('tinta_id', $request->penggunaan_tinta_id)->where('warna', 'Cyan')->first();
                
        //         $penggunaan_tinta['detail_produk_id'] = $detail_produk->id;
        //         $penggunaan_tinta['detail_tinta_id'] = $detail_tinta->id;
        //         $penggunaan_tinta['jumlah_pemakaian'] = $request->quantity_cyan;
        //         $penggunaan_tinta['satuan'] = $request->satuan_cyan;
                
        //         penggunaan_tinta::create($penggunaan_tinta);
        //     }
        //     else if ($i == 1) {
        //         $detail_tinta = detail_tinta::where('tinta_id', $request->penggunaan_tinta_id)->where('warna', 'Magenta')->first();
                
        //         $penggunaan_tinta['detail_produk_id'] = $detail_produk->id;
        //         $penggunaan_tinta['detail_tinta_id'] = $detail_tinta->id;
        //         $penggunaan_tinta['jumlah_pemakaian'] = $request->quantity_magenta;
        //         $penggunaan_tinta['satuan'] = $request->satuan_magenta;
                
        //         penggunaan_tinta::create($penggunaan_tinta);
        //     }
        //     else if ($i == 2) {
        //         $detail_tinta = detail_tinta::where('tinta_id', $request->penggunaan_tinta_id)->where('warna', 'Yellow')->first();
                
        //         $penggunaan_tinta['detail_produk_id'] = $detail_produk->id;
        //         $penggunaan_tinta['detail_tinta_id'] = $detail_tinta->id;
        //         $penggunaan_tinta['jumlah_pemakaian'] = $request->quantity_yellow;
        //         $penggunaan_tinta['satuan'] = $request->satuan_yellow;
                
        //         penggunaan_tinta::create($penggunaan_tinta);
        //     }
        //     else {
        //         $detail_tinta = detail_tinta::where('tinta_id', $request->penggunaan_tinta_id)->where('warna', 'Black')->first();
                
        //         $penggunaan_tinta['detail_produk_id'] = $detail_produk->id;
        //         $penggunaan_tinta['detail_tinta_id'] = $detail_tinta->id;
        //         $penggunaan_tinta['jumlah_pemakaian'] = $request->quantity_black;
        //         $penggunaan_tinta['satuan'] = $request->satuan_black;
                
        //         penggunaan_tinta::create($penggunaan_tinta);
        //     }
        // }

        $validatedData = $request->validate([
            'id_detail_produk' => 'required|unique:detail_produks',
            'nama_produk' => 'required|max:255',
            'keterangan' => '',
            'harga' => 'required',
            'diskon' => '',
            'kategori_id' => 'required',
            'jenis_bahan' => 'required',
            'ukuran' => 'required',
            'finishing_id' => 'required'
        ]);

        if($request->status_finishing == "on") {
            $validatedData['status_finishing'] = 1;
        }
        else {
            $validatedData['status_finishing'] = 0;
        }

        detail_produk::create($validatedData);
        
        $detail_produk = detail_produk::where('id_detail_produk', $validatedData['id_detail_produk'])->first();

        if ($request->input('bahan_setengah_jadi_id') != null) {
            $count = count($request->input('bahan_setengah_jadi_id'));
        }
        else {
            $count = 0;
        }

        for($i = 0; $i < $count; $i++) {
            $detail_produk_bahan['detail_produk_id'] = $detail_produk->id;
            $detail_produk_bahan['bahan_setengah_jadi_id'] = $request->bahan_setengah_jadi_id[$i];
            $detail_produk_bahan['quantity'] = $request->quantity[$i];
            
            detail_produk_bahan::create($detail_produk_bahan);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-detail-produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function show(detail_produk $detail_produk)
    {
        $detail_produks = detail_produk::where('id', $detail_produk->id)->first(); 
        // if (Auth::user()->user_role == 'Admin') {
        //     $stok_bahan = kartu_stok_bahan::latest()->get()->unique('produk_id');
        //     $stok_tinta = kartu_stok_tinta::latest()->get()->unique('detail_tinta_id');
        // }
        // else {
        //     $stok_bahan = kartu_stok_bahan::where('cabang_id', Auth::user()->cabang_id)->latest()->get()->unique('produk_id');
        //     $stok_tinta = kartu_stok_tinta::where('cabang_id', Auth::user()->cabang_id)->latest()->get()->unique('detail_tinta_id');
        // }

        $detail_produk_bahan = detail_produk_bahan::where('detail_produk_id', $detail_produk->id)->get();
        $data = array();
        
        foreach ($detail_produk_bahan as $res) {
            $penggunaan_bahan = penggunaan_bahan::where('bahan_setengah_jadi_id', $res->bahan_setengah_jadi_id)->first();
            if (Auth::user()->user_role == 'Admin') {
                $stok_bahan = kartu_stok_bahan::where('produk_id', $penggunaan_bahan->produk_id)->latest('created_at')->first();
            } else {
                $stok_bahan = kartu_stok_bahan::where('produk_id', $penggunaan_bahan->produk_id)->where('cabang_id', Auth::user()->cabang_id)->latest('created_at')->first();
            }
            if ($stok_bahan->harga_average == null) {
                $harga_bahan = 0*$penggunaan_bahan->jumlah_pemakaian;
            }
            else {
                $harga_bahan = $stok_bahan->harga_average*$penggunaan_bahan->jumlah_pemakaian;
            }
            
            $penggunaan_tinta = penggunaan_tinta::where('bahan_setengah_jadi_id', $res->bahan_setengah_jadi_id)->get();
            $harga_tinta_total = 0;
            foreach($penggunaan_tinta as $tintas) {
                if (Auth::user()->user_role == 'Admin') {
                    $stok_tinta = kartu_stok_tinta::where('detail_tinta_id', $tintas->detail_tinta_id)->latest('created_at')->first();
                } else {
                    $stok_tinta = kartu_stok_tinta::where('detail_tinta_id', $tintas->detail_tinta_id)->where('cabang_id', Auth::user()->cabang_id)->latest('created_at')->first();
                }
                if ($stok_tinta->harga_average == null) {
                    $harga_tinta = 0*$tintas->jumlah_pemakaian;
                }
                else {
                    $harga_tinta = $stok_tinta->harga_average*$tintas->jumlah_pemakaian;
                }
                $harga_tinta_total += $harga_tinta;
            }
            $data[] = ['id' => $res->id, 'harga_total' => ($harga_bahan+$harga_tinta_total)*$res->quantity];
        }

        $detail_finishing = detail_finishing::where('finishing_id', $detail_produk->finishing_id)->get();
        $data_finishing = array();
        
        foreach ($detail_finishing as $result) {
            $penggunaan_bahan_finishing = penggunaan_bahan::where('bahan_setengah_jadi_id', $result->bahan_setengah_jadi_id)->first();
            if (Auth::user()->user_role == 'Admin') {
                $stok_bahan_finishing = kartu_stok_bahan::where('produk_id', $penggunaan_bahan_finishing->produk_id)->latest('created_at')->first();
            } else {
                $stok_bahan_finishing = kartu_stok_bahan::where('produk_id', $penggunaan_bahan_finishing->produk_id)->where('cabang_id', Auth::user()->cabang_id)->latest('created_at')->first();
            }
            if ($stok_bahan_finishing->harga_average == null) {
                $harga_bahan_finishing = 0*$penggunaan_bahan_finishing->jumlah_pemakaian;
            }
            else {
                $harga_bahan_finishing = $stok_bahan_finishing->harga_average*$penggunaan_bahan_finishing->jumlah_pemakaian;
            }
            
            $penggunaan_tinta_finishing = penggunaan_tinta::where('bahan_setengah_jadi_id', $result->bahan_setengah_jadi_id)->get();
            $harga_tinta_finishing_total = 0;
            foreach($penggunaan_tinta_finishing as $tinta_finishing) {
                if (Auth::user()->user_role == 'Admin') {
                    $stok_tinta_finishing = kartu_stok_tinta::where('detail_tinta_id', $tinta_finishing->detail_tinta_id)->latest('created_at')->first();
                } else {
                    $stok_tinta_finishing = kartu_stok_tinta::where('detail_tinta_id', $tinta_finishing->detail_tinta_id)->where('cabang_id', Auth::user()->cabang_id)->latest('created_at')->first();
                }
                if ($stok_tinta_finishing->harga_average == null) {
                    $harga_tinta_finishing = 0*$tinta_finishing->jumlah_pemakaian;
                }
                else {
                    $harga_tinta_finishing = $stok_tinta_finishing->harga_average*$tinta_finishing->jumlah_pemakaian;
                }
                $harga_tinta_finishing_total += $harga_tinta_finishing;
            }
            $data_finishing[] = ['finishing_id' => $result->id, 'harga_finishing_total' => ($harga_bahan_finishing+$harga_tinta_finishing_total)*$result->quantity];
        }
        
        return view('produk.ViewDetailProduk', [
            "detail_produk" => $detail_produks,
            "detail_produk_bahan" => detail_produk_bahan::where('detail_produk_id', $detail_produk->id)->get(),
            "detail_finishing" => detail_finishing::where('finishing_id', $detail_produk->finishing_id)->get(),
            "data" => $data,
            "data_finishing" => $data_finishing,
            // "penggunaan_bahan" => penggunaan_bahan::where('detail_produk_id', $detail_produk->id)->get(),
            // "penggunaan_tinta" => penggunaan_tinta::where('detail_produk_id', $detail_produk->id)->get(),
            // "stok_bahan" => $stok_bahan,
            // "stok_tinta" => $stok_tinta,
            "title" => "Detail Produk"
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function edit(detail_produk $detail_produk)
    {
        if (Auth::user()->user_role == 'Admin') {
            $detail_produks = detail_produk::where('id', $detail_produk->id)->first();    

            return view('produk.EditDetailProduk', [
                "title" => "Edit Detail Produk",
                "detail_produk" => $detail_produks  ,
                "title" => "Edit Detail Produk"    
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatedetail_produkRequest  $request
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function update(Updatedetail_produkRequest $request, detail_produk $detail_produk)
    {
        detail_produk::where('id', $detail_produk->id)
                     ->update(['harga' => $request->harga,
                               'diskon' => $request->diskon
                             ]);

        return redirect('/list-detail-produk')->with('success', 'Detail produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\detail_produk  $detail_produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(detail_produk $detail_produk)
    {
        detail_produk::where('id', $detail_produk->id)
              ->update(['deleted' => '1']);
        
        return redirect('/list-detail-produk')->with('success', 'Produk berhasil dihapus!');
    }
}
