<?php

namespace App\Http\Controllers;

use App\Models\finishing;
use App\Http\Requests\StorefinishingRequest;
use App\Http\Requests\UpdatefinishingRequest;
use App\Models\bahan_setengah_jadi;
use App\Models\detail_finishing;
use App\Models\kartu_stok_bahan;
use App\Models\kartu_stok_tinta;
use App\Models\penggunaan_bahan;
use App\Models\penggunaan_tinta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinishingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('produk.AddFinishing', [
                "idproduk" => finishing::CreateID(),
                "list_bahan_setengah_jadi" => bahan_setengah_jadi::where('deleted', 0)->get(),
                "title" => "Add Finishing"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function listFinishing()
    {
        return view('produk.ListFinishing', [
            "list_finishing" => finishing::where('deleted', 0)->get(),
            "title" => "Daftar Finishing"
        ]);
    }

    public function detailBahanFinishing($id)
    {
        // if (Auth::user()->user_role == 'Admin') {
        //     $stok_bahan = kartu_stok_bahan::latest()->get()->unique('produk_id');
        //     $stok_tinta = kartu_stok_tinta::latest()->get()->unique('detail_tinta_id');
        // }
        // else {
        //     $stok_bahan = kartu_stok_bahan::where('cabang_id', Auth::user()->cabang_id)->latest()->get()->unique('produk_id');
        //     $stok_tinta = kartu_stok_tinta::where('cabang_id', Auth::user()->cabang_id)->latest()->get()->unique('detail_tinta_id');
        // }

        $detail_finishing = detail_finishing::where('finishing_id', $id)->get();
        $data = array();
        
        foreach ($detail_finishing as $res) {
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

        return view('produk.DetailFinishing', [
            "finishing" => finishing::where('id', $id)->first(),
            "detail_finishing" => detail_finishing::where('finishing_id', $id)->get(),
            "data" => $data,
            "title" => "Detail Finishing"
        ]);
    }

    public function tambahBahanFinishing(Request $request)
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
     * @param  \App\Http\Requests\StorefinishingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorefinishingRequest $request)
    {
        $validatedData = $request->validate([
            'id_finishing' => 'required|unique:finishings',
            'jenis_finishing' => 'required|max:255',
            'finishing_harga' => 'required'
        ]);

        finishing::create($validatedData);

        $finishing = finishing::where('id_finishing', $request->id_finishing)->first();
        
        if ($request->input('bahan_setengah_jadi_id') != null) {
            $count = count($request->input('bahan_setengah_jadi_id'));
        }
        else {
            $count = 0;
        }

        for($i = 0; $i < $count; $i++) {
            $detail_finishing['finishing_id'] = $finishing->id;
            $detail_finishing['bahan_setengah_jadi_id'] = $request->bahan_setengah_jadi_id[$i];
            $detail_finishing['quantity'] = $request->quantity[$i];
            
            detail_finishing::create($detail_finishing);
        }

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-finishing');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function show(finishing $finishing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function edit(finishing $finishing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefinishingRequest  $request
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatefinishingRequest $request, finishing $finishing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\finishing  $finishing
     * @return \Illuminate\Http\Response
     */
    public function destroy(finishing $finishing)
    {
        finishing::where('id', $finishing->id)
                 ->update(['deleted' => '1']);
        
        return redirect('/list-finishing')->with('success', 'Finishing berhasil dihapus!');
    }
}
