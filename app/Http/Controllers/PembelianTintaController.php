<?php

namespace App\Http\Controllers;

use App\Models\pembelian_tinta;
use App\Http\Requests\Storepembelian_tintaRequest;
use App\Http\Requests\Updatepembelian_tintaRequest;
use App\Models\detail_tinta;
use App\Models\cabang;
use App\Models\detail_pembelian_tinta;
use App\Models\penerimaan_tinta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianTintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pembelian.tinta.AddPembelianTinta', [
                "idpembeliantinta" => pembelian_tinta::CreateID(),
                "tinta" => detail_tinta::where('deleted', 0)->get(),
                "cabang" => cabang::where('deleted', 0)->get(),
                "title" => "Add Pembelian Tinta"
            ]);
        }
        else {
            abort(403);
        }
    }

    public function detailPembelian($id)
    {
        return view('pembelian.tinta.DetailPembelianTinta', [
            "pembelian" => pembelian_tinta::where('deleted', 0)->where('id', $id)->first(),
            "penerimaan" => penerimaan_tinta::where('pembelian_tinta_id', $id)->first(),
            "detail" => detail_pembelian_tinta::where('pembelian_tinta_id', $id)->get(),
            "title" => "Detail Pembelian Tinta"
        ]);
    }
    
    public function listPembelian()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pembelian.tinta.ListPembelianTinta', [
                "list_pembelian" => pembelian_tinta::where('deleted', 0)->where('status', 'Pending')->get(),
                "title" => "Daftar Pembelian Tinta"
            ]);
        }
        else {
            return view('pembelian.tinta.ListPembelianTinta', [
                "list_pembelian" => pembelian_tinta::where('deleted', 0)->where('status', 'Pending')->where('cabang_id', Auth::user()->cabang_id)->get(),
                "title" => "Daftar Pembelian Tinta"
            ]);
        }
    }

    public function historyPembelian()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('pembelian.tinta.HistoryPembelianTinta', [
                "list_pembelian" => pembelian_tinta::where('deleted', 0)->where('status', '!=', 'Pending')->get(),
                "title" => "History Pembelian Tinta"
            ]);
        }
        else {
            return view('pembelian.tinta.HistoryPembelianTinta', [
                "list_pembelian" => pembelian_tinta::where('deleted', 0)->whereNot('status', '!=', 'Pending')->where('cabang_id', Auth::user()->cabang_id)->get(),
                "title" => "History Pembelian Tinta"
            ]);
        }
    }

    public function tambahTinta(Request $request)
    {
        $data['detail_tinta'] = detail_tinta::join('tintas', 'detail_tintas.tinta_id', '=', 'tintas.id')->where('detail_tintas.id', '=', $request->detail_tinta_id)->select('tintas.jenis_tinta', 'detail_tintas.id', 'detail_tintas.warna')->get();
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
     * @param  \App\Http\Requests\Storepembelian_tintaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepembelian_tintaRequest $request)
    {
        $validatedData = $request->validate([
            'id_pembelian_tinta' => 'required|unique:pembelian_tintas',
            'cabang_id' => 'required',
            'tanggal_pembelian_tinta' => 'required'
        ]);

        pembelian_tinta::create($validatedData);

        $id = pembelian_tinta::where('id_pembelian_tinta', $request->id_pembelian_tinta)->first();
        $count = count($request->input('detail_tinta_id'));
        $total = 0;

        for($i = 0; $i < $count; $i++) {
            $validatedData['detail_tinta_id'] = $request->detail_tinta_id[$i];
            $validatedData['pembelian_tinta_id'] = $id->id;
            $validatedData['quantity'] = $request->quantity[$i];
            $validatedData['harga'] = $request->harga[$i];

            detail_pembelian_tinta::create($validatedData);

            $total += $request->harga[$i];
        }

        pembelian_tinta::where('id', $id->id)
                       ->update(['total' => $total]);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-pembelian-tinta/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembelian_tinta  $pembelian_tinta
     * @return \Illuminate\Http\Response
     */
    public function show(pembelian_tinta $pembelian_tinta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembelian_tinta  $pembelian_tinta
     * @return \Illuminate\Http\Response
     */
    public function edit(pembelian_tinta $pembelian_tinta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepembelian_tintaRequest  $request
     * @param  \App\Models\pembelian_tinta  $pembelian_tinta
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepembelian_tintaRequest $request, pembelian_tinta $pembelian_tinta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembelian_tinta  $pembelian_tinta
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembelian_tinta $pembelian_tinta)
    {
        pembelian_tinta::where('id', $pembelian_tinta->id)
                       ->update(['deleted' => '1']);

        return redirect('/list-pembelian-tinta')->with('success', 'Pembelian tinta berhasil dihapus!');
    }
}
