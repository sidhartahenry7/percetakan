<?php

namespace App\Http\Controllers;

use App\Models\gaji;
use App\Http\Requests\StoregajiRequest;
use App\Http\Requests\UpdategajiRequest;
use App\Models\komplain;
use App\Models\pegawai;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('gaji.AddGaji');
        }
        else {
            abort(403);
        }
    }
    
    public function listGaji()
    {
        if (Auth::user()->user_role == 'Admin') {
            return view('gaji.ListGaji', [
                "list_gaji" => gaji::join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')
                                   ->whereNull('pegawais.tanggal_keluar')
                                   ->where('pegawais.deleted', 0)
                                   ->where('pegawais.user_role', '!=', 'Admin')
                                   ->get()
            ]);
        }
        else {
            return view('gaji.ListGaji', [
                "list_gaji" => gaji::join('pegawais', 'gajis.pegawai_id', '=', 'pegawais.id')->where('pegawais.id', Auth::user()->id)->get()
            ]);
        }
    }

    public function hitungGaji(Request $request)
    {
        $month = Carbon::createFromFormat('Y-m-d', $request->tanggal_cetak)->format('m');

        $data['pegawai'] = pegawai::select('pegawais.*', 'cabangs.nama_cabang')
                                  ->join('cabangs', 'pegawais.cabang_id', '=', 'cabangs.id')
                                  ->where('pegawais.user_role', '!=', 'Admin')
                                  ->where('pegawais.deleted', 0)
                                  ->whereNull('pegawais.tanggal_keluar')
                                  ->get();
        
        $data['jumlah_hari'] = pegawai::selectRaw('pegawais.id, COUNT(absensis.id) AS jumlah_hari_masuk')
                                      ->leftJoin('absensis', 'pegawais.id', '=', 'absensis.pegawai_id')
                                      ->whereMonth('absensis.tanggal_masuk', $month)
                                      ->groupBy('pegawais.id')
                                      ->get();
        
        $data['bonus_kepala_toko'] = transaksi::selectRaw('antrians.cabang_id, SUM(transaksis.total) AS omset')
                                              ->join('antrians', 'transaksis.antrian_id', '=', 'antrians.id')
                                              ->whereMonth('antrians.tanggal_antrian', $month)
                                              ->groupBy('antrians.cabang_id')
                                              ->get();
        
        $data['bonus_pegawai'] = pegawai::selectRaw('pegawais.id, COUNT(komplains.id) AS jumlah_komplain')
                                        ->leftJoin('transaksi_pegawais', 'pegawais.id', '=', 'transaksi_pegawais.pegawai_id')
                                        ->leftJoin('komplains', 'transaksi_pegawais.transaksi_id', '=', 'komplains.detail_transaksi_id')
                                        ->leftJoin('transaksis', 'transaksi_pegawais.transaksi_id', '=', 'transaksis.id')
                                        ->leftJoin('antrians', 'transaksis.antrian_id', '=', 'antrians.id')
                                        ->whereMonth('antrians.tanggal_antrian', $month)
                                        ->groupBy('pegawais.id')
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
     * @param  \App\Http\Requests\StoregajiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoregajiRequest $request)
    {
        $tanggal_cetak = $request->tanggal_cetak;
        $pegawai_id = $request->pegawai_id;
        $gaji_pokok= $request->gaji_pokok;
        $jumlah_hari_masuk= $request->jumlah_hari_masuk;
        $bonus= $request->bonus;
        $total_gaji= $request->total_gaji;

        foreach($pegawai_id as $key => $no)
        {
            $input['pegawai_id'] = $no;
            $input['tanggal_cetak'] = $tanggal_cetak[$key];
            $input['gaji_pokok'] = $gaji_pokok[$key];
            $input['jumlah_hari_masuk'] = $jumlah_hari_masuk[$key];
            $input['bonus'] = $bonus[$key];
            $input['total_gaji'] = $total_gaji[$key];

            gaji::create($input);
        }
        $request->session()->flash('success','Penyimpanan Berhasil');

        return redirect('/gaji');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function show(gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(gaji $gaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategajiRequest  $request
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function update(UpdategajiRequest $request, gaji $gaji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(gaji $gaji)
    {
        //
    }
}
