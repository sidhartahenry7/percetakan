<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Http\Requests\StorepembayaranRequest;
use App\Http\Requests\UpdatepembayaranRequest;
use App\Models\biaya;
use App\Models\cabang;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 'Admin' || Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            return view('biaya.pembayaran.AddPembayaran', [
                "list_cabang" => cabang::where('deleted', 0)->get(),
                "list_biaya" => biaya::where('deleted', 0)->get(),
                "title" => "Add Pembayaran"
            ]);
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function listPembayaran()
    {
        if (Auth::user()->user_role == 'Admin' || Auth::user()->user_role == 'Kepala Toko' || Auth::user()->user_role == 'Wakil Kepala Toko') {
            return view('biaya.pembayaran.ListPembayaran', [
                "list_pembayaran" => pembayaran::join('biayas', 'biayas.id', 'pembayarans.biaya_id')
                                               ->join('cabangs', 'cabangs.id', 'pembayarans.cabang_id')
                                               ->where('pembayarans.deleted', 0)
                                               ->where('biayas.deleted', 0)
                                               ->where('cabangs.deleted', 0)
                                               ->get(),
                "title" => "Daftar Pembayaran"
            ]);
        }
        else {
            return redirect('/dashboard');
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
     * @param  \App\Http\Requests\StorepembayaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorepembayaranRequest $request)
    {
        $validatedData = $request->validate([
            'tanggal_pembayaran' => 'required',
            'cabang_id' => 'required',
            'biaya_id' => 'required',
            'nominal' => 'required',
            'pegawai_id' => 'required',
        ]);

        pembayaran::create($validatedData);

        $request->session()->flash('success','Penyimpanan Berhasil');
        return redirect('/list-pembayaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepembayaranRequest  $request
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepembayaranRequest $request, pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(pembayaran $pembayaran)
    {
        pembayaran::where('id', $pembayaran->id)
                  ->update(['deleted' => 1]); 

        return redirect('/list-pembayaran')->with('success', 'Pembayaran berhasil dihapus!');
    }
}
