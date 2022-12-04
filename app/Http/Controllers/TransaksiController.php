<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\antrian;
use App\Models\detail_transaksi;
use App\Http\Requests\StoretransaksiRequest;
use App\Http\Requests\UpdatetransaksiRequest;
use App\Models\transaksi_pegawai;
use Illuminate\Support\Facades\Auth;
use PDF;

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
                ],
                "title" => "Transaksi"
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
                ],
                "title" => "Transaksi"
            ]);

        }
    }

    public function indexHistory()
    {   
        return view('transaksi.HistoryTransaksi', [
            "history_transaksi" => transaksi::where('status_pengerjaan', 'Selesai')->orWhere('status_pengerjaan', 'Batal')->orderBy('id', 'DESC')->get(),
            "title" => "History Transaksi"
        ]);
    }
    
    public function printNota($id)
    {   
        $transaksi = transaksi::where('id', $id)->first();

        $detail_transaksi = detail_transaksi::where('transaksi_id', $id)->get();

        $transaksi_pegawai = transaksi_pegawai::where('transaksi_id', $id)->get();

        $pdf = PDF::loadView('transaksi/NotaTransaksi', compact('transaksi', 'detail_transaksi', 'transaksi_pegawai'));
        $pdf->setPaper('A5', 'landscape');

        return $pdf->download('notaTransaksi_'.$transaksi->antrian->id_antrian.'.pdf');
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
