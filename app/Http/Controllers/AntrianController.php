<?php

namespace App\Http\Controllers;

use App\Models\antrian;
use App\Models\cabang;
use App\Models\pelanggan;
use App\Http\Requests\StoreantrianRequest;
use App\Http\Requests\UpdateantrianRequest;
use App\Models\transaksi;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('antrian.AddAntrian', [
            "idantrian" => antrian::CreateID(),
            "nomorantrian" => antrian::CreateAntrian(),
            "list_cabang" => cabang::where('deleted', 0)->get(),
            "list_pelanggan" => pelanggan::where('deleted', 0)->get(),
            "title" => "Add Antrian",
            // "list_cara" => [
            //     "Onsite",
            //     "WhatsApp"
            // ]
        ]);
    }

    public function listAntrian()
    {
        $transaksi = transaksi::get('antrian_id');

        return view('antrian.ListAntrian', [
            "list_antrian" => antrian::leftJoin('transaksis', 'antrians.id', '=', 'transaksis.antrian_id')->whereNotIn('antrians.id', $transaksi)->orWhere('transaksis.status_pengerjaan', '!=', 'Selesai')->ListAntrian()->orderBy('antrians.id', 'DESC')->get(),
            "title" => "Daftar Antrian"
        ]);
    }

    public function indexHistory()
    {   
        return view('antrian.HistoryAntrian', [
            "history_antrian" => antrian::join('transaksis', 'antrians.id', '=', 'transaksis.antrian_id')->where('transaksis.status_pengerjaan', 'Selesai')->ListAntrian()->where('antrians.deleted', 0)->orderBy('antrians.id', 'DESC')->get(),
            "title" => "History Antrian"
        ]);
    }

    public function fetchNomorAntrian(Request $request)
    {
        $data['nomor_antrian'] = antrian::where('tanggal_antrian', '=', $request->tanggal_antrian)->where('cabang_id', '=', $request->cabang_id)->max('nomor_antrian');
        $jumlah_antrian = antrian::where('tanggal_antrian', '=', $request->tanggal_antrian)->where('cabang_id', '=', $request->cabang_id)->max('nomor_antrian');
        $cabang = cabang::where('id', $request->cabang_id)->first();

        if ($jumlah_antrian >= 99) {
            $idantrian = date('Ymd')."/".$cabang->nama_cabang."/".($jumlah_antrian + 1);
        }
        else if ($jumlah_antrian >= 9) {
            $idantrian = date('Ymd')."/".$cabang->nama_cabang."/0".($jumlah_antrian + 1);
        }
        else if ($jumlah_antrian >= 1){
            $idantrian = date('Ymd')."/".$cabang->nama_cabang."/00".($jumlah_antrian + 1);
        }
        else {
            $idantrian = date('Ymd')."/".$cabang->nama_cabang."/00".(1);
        }

        $data['id_antrian'] = $idantrian;
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
     * @param  \App\Http\Requests\StoreantrianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreantrianRequest $request)
    {
        $validatedData = $request->validate([
            'id_antrian' => 'required|unique:antrians',
            'cabang_id' => 'required',
            'tanggal_antrian' => 'required',
            'nomor_antrian' => 'required',
            'pelanggan_id' => 'required'
        ]);

        antrian::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/list-antrian');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function show(antrian $antrian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function edit(antrian $antrian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateantrianRequest  $request
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateantrianRequest $request, antrian $antrian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\antrian  $antrian
     * @return \Illuminate\Http\Response
     */
    public function destroy(antrian $antrian)
    {
        antrian::where('id', $antrian->id)
               ->update(['deleted' => '1']);

        return redirect('/list-antrian')->with('success', 'Antrian berhasil dihapus!');
    }
}
